<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnsweredQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'question_id',
        'answer_id',
        'post_by_id',
        'created_at',
        ];



}
