<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Movie extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'movies';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'created_by_name',
        'title',
        'director',
        'year',
        'genres',
        'synopsis',
        'poster_url',
    ];

    protected function casts(): array
    {
        return [
            'genres' => 'array',
            'year' => 'integer',
        ];
    }
}
