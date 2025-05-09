<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppNotifications extends Model
{
    use HasFactory;

    const MESSAGE_TYPE_TEXT = 'text';
    const MESSAGE_TYPE_TEMPLATE = 'template';
}
