<?php

namespace Tests\Feature;

use Tests\TestCase;

class LandingAppTest extends TestCase
{
    /** Get Landing page assert View is landing.index */
    public function test_landing_page_route(): void
    {
        $response = $this->get('/');
        $response->assertViewIs('landing.index');
    }
}
