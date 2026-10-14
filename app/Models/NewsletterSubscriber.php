<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $table = 'newsletter_subscribers';

    protected $fillable = [
        'full_name',
        'email',
        'interests',
        'status',
    ];

    protected $casts = [
        'interests' => 'array',
    ];
}
