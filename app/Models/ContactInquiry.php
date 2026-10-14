<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    protected $table = 'contact_inquiries';

    protected $fillable = [
        'first_name',
        'last_name',
        'business_email',
        'contact_number',
        'job_title',
        'company_name',
        'purpose',
        'details',
        'consent_agreed',
        'status',
    ];

    protected $casts = [
        'consent_agreed' => 'boolean',
    ];
}
