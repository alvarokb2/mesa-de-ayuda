<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('crear_tickets','ver_mis_tickets');
    }

    public function ver_tickets()
    {
        return Ticket::all();
    }

    public function ver_tickets_proyecto($proyecto)
    {
        return Ticket::where('id_proyecto', intval($proyecto))->get();
    }

    public function ver_tickets_usuario_proyecto($proyecto, $usuario)
    {
        return Ticket::where(['id_proyecto' => $proyecto, 'id_usuario' => $usuario])->get();
    }

    public function ver_un_ticket_usuario_proyecto($proyecto, $usuario, $ticket)
    {
        return Ticket::where(['id_proyecto' => $proyecto, 'id_usuario' => $usuario, 'id' => $ticket])->get();
    }

    public function ver_mis_tickets(Request $user)
    {
        return Ticket::where(['id_proyecto' => $user->id_proyecto, 'id_usuario' => $user->id_usuario])->get();
    }

    public function crear_tickets(Request $request)
    {
        return Ticket::create($request->all());
    }


}
