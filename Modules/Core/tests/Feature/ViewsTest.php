<?php

namespace Modules\Core\tests\Feature;

class ViewsTest extends AbstractTestCase
{
    /**
     * Test that the welcome view can be rendered.
     */
    public function it_renders_welcome_view(): void
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
    public function it_renders_password_reset_view(): void
    {
        $response = $this->get('/sessions/passwordreset');

        $response->assertStatus(200);
        $response->assertSee('fi-section', false);
    }
}
