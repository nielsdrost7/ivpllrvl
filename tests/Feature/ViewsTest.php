<?php

namespace Tests\Feature;

use Tests\TestCase;

class ViewsTest extends TestCase
{
    /**
     * Test that the welcome view can be rendered.
     */
    public function test_welcome_view_renders(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('fi-section', false);
    }

    /**
     * Test that the login view can be rendered.
     */
    public function test_login_view_renders(): void
    {
        $response = $this->get('/sessions/login');

        $response->assertStatus(200);
        $response->assertSee('fi-section', false);
    }

    /**
     * Test that the password reset view can be rendered.
     */
    public function test_password_reset_view_renders(): void
    {
        $response = $this->get('/sessions/passwordreset');

        $response->assertStatus(200);
        $response->assertSee('fi-section', false);
    }
}
