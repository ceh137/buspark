<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckQuestion extends Model
{
    use HasFactory;

    public function answers() {
        return $this->hasMany(Answer::class, 'check_question_id');
    }
    public function check_list() {
        return $this->belongsTo(CheckList::class, 'check_list_id');
    }
}
