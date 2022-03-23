<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndexPage extends Model
{
    use HasFactory;
    protected $table='index_page';
    protected $fillable = [
        'id',
        'text_btn',
        'color',
        'link',
        'created_at',
    ];
    protected $attributes = [
        'link' => 'smth',
    ];
}
