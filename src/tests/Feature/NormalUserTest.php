<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Tests\TestCase;


class NormalUserTest extends TestCase
{
    public function testNormalUserCanNotAccessAdmin()
    {
        $post = $this->editPost();
        $routeHome = route('home');

        $this->get(route('admin.posts'))
            ->assertRedirect($routeHome);

        $this->get(route('admin.publish.get', ['post' => $post->id]))
            ->assertRedirect($routeHome);

        $this->post(route('admin.publish.post', ['post' => $post->id]))
            ->assertRedirect($routeHome);

    }

    protected function editPost($id = null)
    {
        $this->signIn();
        return create(Post::class, ['user_id' => $id ?: auth()->id()]);
    }
}
