<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MoveRoverTest extends TestCase
{
    //to start always with an empty database
    use RefreshDatabase;

    public function test_move_the_rover_without_initialized_data()
    {
        $response = $this->get('/api/rover/move');
        $response
            ->assertStatus(422)
            ->assertJson([
                'info' => 'Not initialized'
                ]
        );
    }

    public function test_move_the_rover_without_command_parameter()
    {
        $this->get('/api/rover/init?direction=N&position_x=2&position_y=1');
        $response = $this->get('/api/rover/move');
        $response
            ->assertStatus(422)
            ->assertJson([
                'error' => 'Get parameter commands needed'
                ]
        );
    }

    public function test_move_the_rover_with_wrong_commands()
    {
        $this->get('/api/rover/init?direction=N&position_x=2&position_y=1');
        $response = $this->get('/api/rover/move?commands=KKKK');
        $response->assertStatus(422);
    }

    public function test_move_the_rover_with_one_wrong_command()
    {
        $this->get('/api/rover/init?direction=N&position_x=2&position_y=1');
        $response = $this->get('/api/rover/move?commands=LLK');
        $response->assertStatus(422);
    }

    public function test_move_the_rover_with_one_correct_command()
    {
        $this->get('/api/rover/init?direction=N&position_x=2&position_y=1');
        $response = $this->get('/api/rover/move?commands=L');
        $response
            ->assertStatus(200)
            ->assertJson([
                "info"=> "Ok",
                "rover"=> [
                    "direction"=> "W",
                    "position_x"=> 1,
                    "position_y"=> 1
                ]
            ]
        );
    }

    public function test_move_the_rover_with_correct_commands()
    {
        $this->get('/api/rover/init?direction=N&position_x=2&position_y=1');
        $response = $this->get('/api/rover/move?commands=LL');
        $response
            ->assertStatus(200)
            ->assertJson([
                "info"=> "Ok",
                "rover"=> [
                    "direction"=> "S",
                    "position_x"=> 1,
                    "position_y"=> 0
                ]
            ]
        );
    }

    public function test_move_the_rover_with_correct_commands_outside_the_map()
    {
        $this->get('/api/rover/init?direction=N&position_x=2&position_y=1');
        $response = $this->get('/api/rover/move?commands=LLF');
        $response
            ->assertStatus(200)
            ->assertJson([
                "info"=> "Obstacle detected, so sequence aborted. Could not finish the command movements.",
                "rover"=> [
                    "direction"=> "S",
                    "position_x"=> 1,
                    "position_y"=> 0
                ]
            ]
        );
    }
 
}
