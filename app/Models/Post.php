<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    // define model attributes for database
    // also define user_id for post author/ownership
    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    // define relationship with user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
