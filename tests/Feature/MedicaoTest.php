<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Sensor;
class MedicaoTest extends TestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    
    public function test_list_all_medicao() {
        $response = $this->get(url('/api/medicao'))
        ->assertStatus(200);
    }

    public function test_create_medicao() {
        $sensor = factory(\App\Sensor::class)->create();
        $response = $this->post(url('/api/medicao'), ['sensor_id'=> $sensor->id, 'valor' => 50, 'data_horario' => '2019-09-24-06:00'])
        ->assertStatus(201)
        ->assertJson(['mensagem' => 'Medicao cadastrado com sucesso']);
    }

    public function test_edit_medicao() {
        $medicao = factory(\App\Medicao::class)->create();
        $sensor = factory(\App\Sensor::class)->create();
        $sensor->nome = 'atualizado';
        $sensor->tipo = 'presença';
        $response = $this->put(url('/api/medicao', $medicao->id), ['sensor_id' => $sensor->id, 'valor' => 65, 'data_horario' => '2019-12-04-16:00'])
        ->assertStatus(200)
        ->assertJson(['data' => ['mensagem' => 'Medicão atualizado com sucesso!']]);

    }

    public function test_medicao_does_not_exist() {
        $response = $this->get(url('/api/medicao', 0))
        ->assertStatus(404)
        ->assertJson(['data' => ['error' => 'Medicão não encontrado']]);
    }

    public function test_delete_medicao() {
        $medicao = factory(\App\Medicao::class)->create();
        $response = $this->delete(url('/api/medicao', $medicao->id))
        ->assertStatus(200)
        ->assertJson(['data' => ['mensagem' => 'Medicão excluído com sucesso']]);
    }
}
