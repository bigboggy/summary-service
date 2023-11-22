<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewSummaryRequest extends Model
{
    protected $fillable = [
        'room_id', 'current_sprint_day', 'current_sprint_current_morale',
        'current_sprint_progress', 'current_sprint_done', 'current_sprint_open',
        'current_sprint_blocked', 'last_sprint_day', 'last_sprint_current_morale',
        'last_sprint_progress', 'last_sprint_done', 'last_sprint_open', 'last_sprint_blocked',
        'response_text',
    ];
}
