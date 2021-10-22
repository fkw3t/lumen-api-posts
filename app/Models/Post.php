<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'user_id'];
    protected $perPage = 5;
    protected $appends = ['links'];

    public function getLinksAttribute(): array
    {
        return [
            'comments' => '/api/post/' . $this->id . '/comment'
        ];
    }

    public function Users()
    {
        return $this->belongsTo(User::class);
    }
    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }
}