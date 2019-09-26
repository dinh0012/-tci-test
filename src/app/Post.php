<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'user_id', 'category_id', 'title', 'content', 'is_published'
    ];

    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'content' => 'required',
        ];
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
