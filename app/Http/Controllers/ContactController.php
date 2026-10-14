<?php

namespace App\Http\Controllers;

use App\Models\CmsContent;
use App\Models\ContactInquiry;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Submit contact inquiry from Section 9 modal
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:120',
            'last_name' => 'required|string|max:120',
            'business_email' => 'required|email|max:190',
            'contact_number' => 'nullable|string|max:60',
            'job_title' => 'nullable|string|max:120',
            'company_name' => 'nullable|string|max:150',
            'purpose' => 'nullable|string|max:150',
            'details' => 'nullable|string|max:5000',
            'consent_agreed' => 'required|accepted',
        ]);

        $inquiry = ContactInquiry::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'business_email' => $validated['business_email'],
            'contact_number' => $validated['contact_number'] ?? null,
            'job_title' => $validated['job_title'] ?? null,
            'company_name' => $validated['company_name'] ?? null,
            'purpose' => $validated['purpose'] ?? 'General Inquiry',
            'details' => $validated['details'] ?? null,
            'consent_agreed' => true,
            'status' => 'new',
        ]);

        // Automated Email Notification to Staff
        $sec9 = CmsContent::getSection('section_9_contact');
        $staffEmail = $sec9['staff_notification_email'] ?? env('MAIL_FROM_ADDRESS', 'management@marketech-apac.com');

        $this->notifyStaff(
            $staffEmail,
            "New Contact Inquiry: {$inquiry->first_name} {$inquiry->last_name} ({$inquiry->company_name})",
            "A new inquiry has been submitted through the WECON/MARKETECH APAC website:\n\n" .
            "Name: {$inquiry->first_name} {$inquiry->last_name}\n" .
            "Email: {$inquiry->business_email}\n" .
            "Phone: {$inquiry->contact_number}\n" .
            "Company: {$inquiry->company_name}\n" .
            "Job Title: {$inquiry->job_title}\n" .
            "Purpose: {$inquiry->purpose}\n" .
            "Details: {$inquiry->details}\n\n" .
            "Submitted at: " . now()->toDayDateTimeString()
        );

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your information has been submitted. Our team will get in touch shortly.',
        ]);
    }

    /**
     * Submit newsletter subscriber from Section 7
     */
    public function subscribeNewsletter(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'nullable|string|max:150',
            'email' => 'required|email|max:190',
            'interests' => 'nullable|array',
        ]);

        $subscriber = NewsletterSubscriber::updateOrCreate(
            ['email' => $validated['email']],
            [
                'full_name' => $validated['full_name'] ?? null,
                'interests' => $validated['interests'] ?? ['all'],
                'status' => 'active',
            ]
        );

        // Automated Email to Staff
        $sec7 = CmsContent::getSection('section_7_newsletter');
        $staffEmail = $sec7['recipient_email'] ?? env('MAIL_FROM_ADDRESS', 'management@marketech-apac.com');
        $interestsList = !empty($validated['interests']) ? implode(', ', $validated['interests']) : 'General Updates';

        $this->notifyStaff(
            $staffEmail,
            "New Newsletter Subscriber: {$subscriber->email}",
            "A new subscriber has joined the WECON Asia information network:\n\n" .
            "Name: " . ($subscriber->full_name ?: 'N/A') . "\n" .
            "Email: {$subscriber->email}\n" .
            "Interests: {$interestsList}\n\n" .
            "Subscribed at: " . now()->toDayDateTimeString()
        );

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing! Your subscription is active.',
        ]);
    }

    /**
     * Helper to safely dispatch notification email without crashing if mail driver is unconfigured
     */
    protected function notifyStaff(string $toEmail, string $subject, string $bodyText)
    {
        try {
            Mail::raw($bodyText, function ($message) use ($toEmail, $subject) {
                $message->to($toEmail)
                        ->subject($subject);
            });
        } catch (\Throwable $e) {
            // Log for monitoring in case local SMTP is offline or in log mode
            Log::info("Automated email notification queued/logged: [{$subject}] to {$toEmail}. Error note: " . $e->getMessage());
        }
    }
}
