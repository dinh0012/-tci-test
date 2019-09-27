<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Tests\TestCase;

/**
 * Class LoginTest
 * @package Tests\Feature
 */
class LoginTest extends TestCase
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

    /**
     *
     */
    public function testLoginSuccess()
    {
        $this->login()->assertRedirect(route('home'));
    }

    /**
     *
     */
    public function testLoginFails()
    {
        $this->login(['email' => 'aaaa', 'password' => 123])->assertSessionHasErrors();
    }

    /**
     * @param array $overrides
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    protected function login($overrides = [])
    {
        $user = make(User::class, $overrides);
        return $this->post(route('login.post'), $user->toArray());
    }
}
