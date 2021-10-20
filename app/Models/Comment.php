<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['post_id', 'user_id', 'comment'];
    protected $perPage = 5;

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Post()
    {
        return $this->belongsTo(Post::class);
    }
}