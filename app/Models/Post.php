<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    //table name
    protected $table = "posts";
    protected $fillable = ['title','body','cover_image'];
    public function user()
    {
     return $this->belongsTo(User::class);
    }

    public function postedBy(User $user)
    {
        return $this->user_id === $user->id;
    }
}
