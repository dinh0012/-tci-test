<?php
namespace App\Repositories;

use App\Post;
use App\Repositories\EloquentRepository;

class PostRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Post::class;
    }
}
