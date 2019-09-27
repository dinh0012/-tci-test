<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;

/**
 * Class CreatePostTest
 * @package Tests\Feature
 */
class CreatePostTest extends TestCase
{

    /**
     *
     */
    public function testGuestCanNotCreatePost()
    {
        $routeLogin = route('login');

        $this->get(route('posts'))
            ->assertRedirect($routeLogin);

        $this->get(route('create.get'))
            ->assertRedirect($routeLogin);

        $this->post(route('create.post'))
            ->assertRedirect($routeLogin);
    }

    /**
     *
     */
    public function testAuthenticatedUserCanCreatePost()
    {
        // Login
        $this->signIn();
        $post = make(Post::class, ['user_id' => auth()->id()]);
        $postArray = $post->toArray();

        // sent request to server
        $this->post(route('create.post'), $postArray)
            ->assertRedirect(route('posts'));

        $this->assertDatabaseHas('posts', $postArray);
    }

    /**
     *
     */
    function testPostRequiresTitle()
    {
        $this->publishPost(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /**
     *
     */
    function testPostRequiresContent()
    {
        $this->publishPost(['content' => null])
            ->assertSessionHasErrors('content');
    }

    /**
     *
     */
    function testPostRequiresCategoryId()
    {
        $this->publishPost(['category_id' => null])
            ->assertSessionHasErrors('category_id');
    }

    /**
     *
     */
    public function testGuestCanViewIndex()
    {
        $response = $this->get('/'); //make GET access to blog route

        $response->assertStatus(200); //assert http status return is 200
    }

    /**
     * @param array $overrides
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    protected function publishPost($overrides = [])
    {
        $this->signIn();
        $post = make(Post::class, $overrides);
        return $this->post(route('create.post'), $post->toArray());
    }
}
