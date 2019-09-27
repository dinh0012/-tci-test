<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Tests\TestCase;


class EditPostTest extends TestCase
{
    public $post;

    public function testAuthenticatedUserCanEditOwnPost()
    {
        $post = $this->editPost();
        $this->get(route('edit.get', ['post' => $post->id]))
            ->assertSee($post->title)
            ->assertSee($post->content);
    }

    public function testAuthorizedUsersCannotEditOtherPostGet()
    {
        $otherUser = create(User::class);
        $post = $this->editPost($otherUser->id);
        $this->get(route('edit.get', ['post' => $post->id]))
            ->assertStatus(403);
    }
    public function te1stAuthorizedUsersCannotEditOtherPostPost()
    {
        $otherUser = create(User::class);
        $post = $this->editPost($otherUser->id);
        $this->post(route('update.post', ['post' => $post->id]), $post->toArray())
            ->assertStatus(403);
    }

    protected function editPost($id = null)
    {
        $this->signIn();
        return create(Post::class, ['user_id' => $id ?: auth()->id()]);
    }

    protected function makeNewPost($id, array $array)
    {
        return $this->post(route('update.post', ['id' => $id]), $array);
    }
}
