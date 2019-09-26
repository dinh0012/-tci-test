<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;

class PostTest extends TestCase
{

    public function testAuthenticatedUsersCanCreatePost()
    {
        $this->withoutExceptionHandling();
        // Login
        $this->signIn();
        $post = factory(Post::class)->make();

        // sent request to server
        $this->post(route('post.create'), $post->toArray());

        // assert see in database
        $this->assertEquals($post->id, Post::find($post->id));
    }

    public function testGuestCanNotCreatePost(){
        $this->withoutExceptionHandling();
        // expect thrown exception
        $this->expectException('Illuminate\Auth\AuthenticationException');
        // Given a Guest
        $guest = factory('App\User')->create();
        // And Giving Post object
        $post = factory('App\Post')->make();
        // When the user create Post
        $this->post(route('post.create'),$post->toArray());

    }

    public function testGuestCanViewIndex()
    {
        $response = $this->get('/'); //make GET access to blog route

        $response->assertStatus(200); //assert http status return is 200
    }
}
