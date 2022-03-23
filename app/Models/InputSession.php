<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputSession extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function index(){
        return $this->belongsTo(IndexPage::class, 'index_page_id');
    }
    public function inputs() {
        return $this->belongsToMany(Input::class, 'input_answers', 'input_session_id', 'input_id' );
    }
    public function answers() {
        return $this->hasMany(InputAnswer::class, 'input_session_id');
    }

}
