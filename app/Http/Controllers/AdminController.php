<?php

namespace App\Http\Controllers;

use App\Models\CmsContent;
use App\Models\ContactInquiry;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the CMS Dashboard with all section editors
     */
    public function dashboard()
    {
        $sections = [
            'section_1_hero' => CmsContent::getSection('section_1_hero'),
            'section_2_about' => CmsContent::getSection('section_2_about'),
            'section_3_why' => CmsContent::getSection('section_3_why'),
            'section_4_events' => CmsContent::getSection('section_4_events'),
            'section_5_speakers' => CmsContent::getSection('section_5_speakers'),
            'section_6_insights' => CmsContent::getSection('section_6_insights'),
            'section_7_newsletter' => CmsContent::getSection('section_7_newsletter'),
            'section_pathways' => CmsContent::getSection('section_pathways'),
            'section_careers' => CmsContent::getSection('section_careers'),
            'section_9_contact' => CmsContent::getSection('section_9_contact'),
        ];

        $inquiries = ContactInquiry::latest()->take(50)->get();
        $subscribers = NewsletterSubscriber::latest()->take(50)->get();

        return view('admin.dashboard', compact('sections', 'inquiries', 'subscribers'));
    }

    /**
     * Update dynamic content for a specific section
     */
    public function updateSection(Request $request, string $sectionKey)
    {
        $currentContent = CmsContent::getSection($sectionKey);
        $submittedData = $request->input('content', []);

        // Handle file uploads (e.g. hero image, logos)
        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $submittedData['hero_image'] = 'uploads/' . $filename;
        }

        // Clean jobs list if this is section_careers
        if ($sectionKey === 'section_careers' || isset($submittedData['jobs'])) {
            $submittedData['jobs'] = array_values($submittedData['jobs'] ?? []);
        }

        // Merge arrays
        $merged = array_merge($currentContent, $submittedData);

        CmsContent::setSection($sectionKey, $merged);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Section updated successfully!',
            ]);
        }

        return redirect()->route('admin.dashboard', ['tab' => $sectionKey])
            ->with('success', 'Section content successfully updated!');
    }

    /**
     * Delete an inquiry
     */
    public function deleteInquiry($id)
    {
        ContactInquiry::destroy($id);
        return back()->with('success', 'Inquiry deleted successfully.');
    }

    /**
     * Delete a subscriber
     */
    public function deleteSubscriber($id)
    {
        NewsletterSubscriber::destroy($id);
        return back()->with('success', 'Subscriber deleted successfully.');
    }
}
