<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InitRoverTest extends TestCase
{
    //to start always with an empty database
    use RefreshDatabase;

    public function test_init_the_rover_without_data()
    {
        $response = $this->get('/api/rover/init');

        $response->assertStatus(422);
    }

    public function test_init_the_rover_without_position()
    {
        $response = $this->get('/api/rover/init?direction=N');

        $response->assertStatus(422);
    }

    public function test_init_the_rover_with_wrong_direction()
    {
        $response = $this->get('/api/rover/init?direction=4&position_x=13&position_y=9');

        $response->assertStatus(422);
    }

    public function test_init_the_rover_without_direction()
    {
        $response = $this->get('/api/rover/init?position_x=13&position_y=9');

        $response->assertStatus(422);
    }

    public function test_init_the_rover_with_correct_data()
    {
        $response = $this->get('/api/rover/init?direction=N&position_x=13&position_y=9');

        $response->assertStatus(200);
    }
}
