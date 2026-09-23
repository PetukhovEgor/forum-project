<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Thread extends Model
{
    use HasFactory;

    public mixed $user_id;
    public mixed $id;
    protected $fillable = ['user_id', 'title', 'body', 'image_path']
;

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
