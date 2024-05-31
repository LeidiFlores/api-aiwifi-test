<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
        'estimates_gender',
        'probability_gender',
        'estimates_age',
        'estimates_nationality',
        'probability_nationality',
        'mail_smtp_check',
        'mail_role',
        'mail_disposable',
        'mail_free',
    ];
}
