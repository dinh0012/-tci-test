<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Tests\TestCase;


class AdminUserTest extends TestCase
{
    public function adminCanPublishedPost()
    {
       $post = $this->editPost(['is_published' => 0]);
       $this->makeNewPost($post->id, $post->toArray())
           ->assertSee();

    }

    protected function editPost($data = [])
    {
        $this->signIn();
        return create(Post::class, $data);
    }

    protected function makeNewPost($id, array $array)
    {
        return $this->post(route('admin.publish.post', ['id' => $id]), $array);
    }
}
