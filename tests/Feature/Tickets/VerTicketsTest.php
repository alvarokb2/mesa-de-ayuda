<?php

namespace Feature\Tickets;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerTicketsTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_usuario_autenticado_puede_ver_todos_los_tickets()
    {
        $user = User::factory()->create();
        Ticket::factory()->count(5)->create();
        $this->actingAs($user)->get('/api/tickets')
            ->assertJsonCount(5);
    }

    public function test_un_usuario_autenticado_puede_ver_todos_los_tickets_de_un_proyecto()
    {
        $user = User::factory()->create();
        Ticket::factory()->create();
        Ticket::factory()->create(['id_proyecto' => 2]);
        $this->actingAs($user)->get('/api/1/tickets')
            ->assertJsonFragment(['id_proyecto' => 1]);
    }

    public function test_un_usuario_autenticado_puede_ver_todos_los_tickets_de_un_usuario_en_un_proyecto()
    {
        $user = User::factory()->create();
        Ticket::factory()->create(); // proyecto 1, usuario 1
        Ticket::factory()->create([
            'id_usuario' => 2,
        ]);
        $this->actingAs($user)->get('/api/1/usuario/2/tickets')
            ->assertJsonFragment(['id_usuario' => 2]);
    }

    public function test_un_usuario_autenticado_puede_ver_un_ticket_de_un_usuario_y_proyecto_determinado()
    {
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create();

        $response = $this->actingAs($user)->get('api/1/usuario/1/tickets/' . $ticket->id);
        $response->assertJsonFragment([
            'id_usuario' => 1,
            'id_proyecto' => 1,
            'id' => $ticket->id,]);
    }

    public function test_un_invitado_no_puede_ver_tickets()
    {
        $this->get('/api/tickets')->assertRedirect('/login');
    }

    public function test_un_invitado_puede_ver_sus_propios_tickets()
    {
        $ticket = Ticket::factory()->create();
        $user = [
            'id_usuario' => 1,
            'id_proyecto' => 1
        ];
        $response = $this->post('/api/mis-tickets', $user);
        $response->assertJsonFragment([
            'id_usuario' => 1,
            'id_proyecto' => 1,
            'id' => $ticket->id,
        ]);
    }
}
