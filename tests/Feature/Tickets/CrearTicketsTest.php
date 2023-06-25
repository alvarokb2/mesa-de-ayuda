<?php

namespace Tests\Feature\Tickets;

use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrearTicketsTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_no_autenticado_puede_crear_ticket()
    {
        $ticket = [
            'id_proyecto' => 1,
            'id_usuario' => 1,
            'titulo' => 'ticket de prueba',
            'descripcion' => 'descripcion de prueba',
            'estado' => 'nuevo',
        ];
        $this->post('/api/tickets', $ticket)
            ->assertStatus(201);
    }
}
