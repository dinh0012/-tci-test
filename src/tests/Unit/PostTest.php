<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected $post;

    /** @test */
    public function a_post_has_author()
    {
        $post = factory(Post::class)->create();
        $this->assertInstanceOf(User::class, $post->author);
    }


    /** @test */
    public function a_post_belongs_to_a_category()
    {
        $post = factory(Post::class)->create();
        $this->assertInstanceOf('App\Category', $post->category);
    }
}
