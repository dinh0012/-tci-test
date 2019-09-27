<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Tests\TestCase;

/**
 * Class RegisterTest
 * @package Tests\Feature
 */
class RegisterTest extends TestCase
{
    /**
     *
     */
    public function testAuthenticatedUserCannotAccessPage()
    {
        $routeHome = route('home');
        $this->signIn();
        $this->get(route('login'))
            ->assertRedirect($routeHome);

        $this->post(route('login.post'))
            ->assertRedirect($routeHome);

        $this->get(route('register'))
            ->assertRedirect($routeHome);

        $this->post(route('register.post'))
            ->assertRedirect($routeHome);
    }

    public function testRegister()
    {
        $user = make(User::class);
        $this->post(route('register.post'), $user->toArray())
            ->assertRedirect(route('home'));
    }

    /**
     *
     */
    public function testRequiresEmail()
    {
        $this->register(['email' => null])
            ->assertSessionHasErrors('email');
    }

    public function testRequiresPassword()
    {
        $this->register(['password' => null])
            ->assertSessionHasErrors('password');
    }

    /**
     * @param array $overrides
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    protected function register(array $overrides = [])
    {
        $user = make(User::class, $overrides);
        return $this->post(route('register.post'), $user->toArray());
    }
}
