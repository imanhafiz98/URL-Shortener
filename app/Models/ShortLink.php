<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    $protected = [
        'code',
        'link',
        'visits',
    ];
    use HasFactory;
}
