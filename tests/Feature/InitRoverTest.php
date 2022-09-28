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

    public function test_init_the_rover_with_wrong_position()
    {
        $response = $this->get('/api/rover/init?direction=N&position_x=200&position_y=9');

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

        $response = $this->get('/api/rover/get');
        $response
            ->assertStatus(200)
            ->assertJson([
                'info' => 'Ok',
                'rover' => [
                    'direction' => 'N', 
                    'position_x' => 13,
                    'position_y' => 9
                ]
            ]
        );
    }

    public function test_init_the_rover_with_updated_data()
    {
        $response = $this->get('/api/rover/init?direction=N&position_x=13&position_y=9');
        $response->assertStatus(200);

        $response = $this->get('/api/rover/get');
        $response
            ->assertStatus(200)
            ->assertJson([
                'info' => 'Ok',
                'rover' => [
                    'direction' => 'N', 
                    'position_x' => 13,
                    'position_y' => 9
                ]
            ]
        );

        $response = $this->get('/api/rover/init?direction=S&position_x=1&position_y=2');
        $response->assertStatus(200);
   
        $response = $this->get('/api/rover/get');
        $response
            ->assertStatus(200)
            ->assertJson([
                'info' => 'Ok',
                'rover' => [
                    'direction' => 'S', 
                    'position_x' => 1,
                    'position_y' => 2
                ]
            ]
        );
    }

    public function test_get_rover_with_not_initialized_data()
    {
        $response = $this->get('/api/rover/get');
        $response
            ->assertStatus(200)
            ->assertJson([
                'info' => 'Not initialized'
            ]
        );
    }
}
