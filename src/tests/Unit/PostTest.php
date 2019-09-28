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
    public function testPostHasAuthor()
    {
        $post = create(Post::class);
        $this->assertInstanceOf(User::class, $post->author);
    }
}
