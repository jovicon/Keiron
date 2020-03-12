<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\User;
use App\Ticket;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('user_type_id',2)->orderBy('id')->get(); // seleccionando solo usuarios no admin
        $tickets = Ticket::orderBy('id')->get();

        return view('admin')
                ->with('users',$users)
                ->with('tickets',$tickets);
    }
}
