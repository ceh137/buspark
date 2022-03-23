<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    use HasFactory;
    protected $table  = 'inputs';
    protected $fillable = [
        'id','type','name', 'label', 'index_page_id'
    ];

    public function options() {
        return $this->hasMany(Option::class, 'input_id');
    }

    public function index_page() {
        return $this->belongsTo(IndexPage::class, 'index_page_id');
    }
}
