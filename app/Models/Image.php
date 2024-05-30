<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'image',
        'path',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
