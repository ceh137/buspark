<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckListSession extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function check_list(){
        return $this->belongsTo(CheckList::class, 'check_list_id');
    }
    public function questions() {
        return $this->belongsToMany(CheckQuestion::class, 'answered_questions', 'session_id', 'question_id' );
    }
    public function answers() {
        return $this->belongsToMany(Answer::class, 'answered_questions', 'session_id', 'answer_id' );
    }
}
