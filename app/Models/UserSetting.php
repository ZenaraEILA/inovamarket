<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'notification_preferences',
        'privacy_settings',
        'theme',
        'language',
        'currency',
        'timezone',
        'marketing_emails',
        'order_notifications',
        'security_alerts',
    ];

    protected $casts = [
        'notification_preferences' => 'array',
        'privacy_settings' => 'array',
        'marketing_emails' => 'boolean',
        'order_notifications' => 'boolean',
        'security_alerts' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
