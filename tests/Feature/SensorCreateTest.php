<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Sensor;
class SensorCreateTest extends TestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    
    public function test_list_all_sensor() {
        $response = $this->get(url('/api/sensor'))
        ->assertStatus(200);
    }

    public function test_create_sensor() {
        $response = $this->post(url('/api/sensor'), ['nome'=> 'teste', 'tipo' => 'temperatura'])
        ->assertStatus(201)
        ->assertJson(['mensagem' => 'Sensor cadastrado com sucesso']);
    }

    public function test_delete_sensor() {
        $sensor = factory(\App\Sensor::class)->create();
        $response = $this->delete(url('/api/sensor', $sensor->id))
        ->assertStatus(200);
    }
}
