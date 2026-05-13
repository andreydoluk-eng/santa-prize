<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Application extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'message',
        'source_url',
    ];
}
