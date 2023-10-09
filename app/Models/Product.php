<?php

namespace App\Models;

use App\Traits\ImagebleTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    use ImagebleTrait;

    protected static $imageble = [
        'image',
    ];

    protected $guarded = ['id'];



}
