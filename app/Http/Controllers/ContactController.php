<?php

namespace App\Http\Controllers;

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

        $firstName = $validated['first_name'];
        $lastName = $validated['last_name'];
        $email = $validated['business_email'];
        $company = $validated['company_name'] ?? 'N/A';
        $purpose = $validated['purpose'] ?? 'General Inquiry';
        $details = $validated['details'] ?? 'None provided';
        $phone = $validated['contact_number'] ?? 'N/A';
        $jobTitle = $validated['job_title'] ?? 'N/A';

        Log::info("Contact Inquiry Received: {$firstName} {$lastName} ({$company}) <{$email}> - {$purpose}");

        // Automated Email Notification to Staff (if mail driver is configured)
        $staffEmail = env('MAIL_NOTIFICATION_ADDRESS', env('MAIL_FROM_ADDRESS', 'management@marketech-apac.com'));

        $this->notifyStaff(
            $staffEmail,
            "New Contact Inquiry: {$firstName} {$lastName} ({$company})",
            "A new inquiry has been submitted through the WECON website:\n\n" .
            "Name: {$firstName} {$lastName}\n" .
            "Email: {$email}\n" .
            "Phone: {$phone}\n" .
            "Company: {$company}\n" .
            "Job Title: {$jobTitle}\n" .
            "Purpose: {$purpose}\n" .
            "Details: {$details}\n\n" .
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

        $email = $validated['email'];
        $fullName = $validated['full_name'] ?? 'N/A';
        $interestsList = !empty($validated['interests']) ? implode(', ', $validated['interests']) : 'General Updates';

        Log::info("Newsletter Subscription: {$email} ({$fullName}) - Interests: {$interestsList}");

        // Automated Email to Staff (if mail driver is configured)
        $staffEmail = env('MAIL_NOTIFICATION_ADDRESS', env('MAIL_FROM_ADDRESS', 'management@marketech-apac.com'));

        $this->notifyStaff(
            $staffEmail,
            "New Newsletter Subscriber: {$email}",
            "A new subscriber has joined the WECON Asia information network:\n\n" .
            "Name: {$fullName}\n" .
            "Email: {$email}\n" .
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
            Log::info("Automated email notification note: " . $e->getMessage());
        }
    }
}
