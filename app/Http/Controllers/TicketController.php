<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\User;
use App\Ticket;

class TicketController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // silent is gold
    }

    public function createTicket(Request $request) {

        // creando nuevo ticket asignado a un usuario
        try{
            $new_ticket = new Ticket();
            $new_ticket->user_id = $request->user_id;
            $new_ticket->set_ticket = $request->set_ticket;
            $new_ticket->save();

            $result = $new_ticket->id;

            $status = 'success';
            $message = 'Ticket creado correctamente';
        }
        catch(\Exception $ex) {
            $status = 'error';
            $message = $ex->getMessage();
            $result = '';
        }

        return (['status'=>$status, 'message' => $message, 'result' => $result ]);
    }

    public function updateTicket(Request $request) {
        try{
            $ticket = Ticket::where('id',$request->ticket_id)->first();
            $ticket->user_id = $request->user_id;
            $ticket->set_ticket = $request->set_ticket;
            $ticket->save();

            $status = 'success';
            $message = 'Ticket actualizado correctamente';
        }
        catch(\Exception $ex) {
            $status = 'error';
            $message = $ex->getMessage();
        }

        return (['status'=>$status, 'message' => $message ]);
    }

    public function deleteTicket(Request $request) {
        try {
            $ticket = Ticket::where('id', $request->ticket_id)->first();
            $ticket->delete();

            $status = 'success';
            $message = 'Ticket borrado correctamente';
        }
        catch(\Exception $ex) {
            $status = 'error';
            $message = $ex->getMessage();
        }

        return (['status' => $status, 'message' => $message]);
    }
}
