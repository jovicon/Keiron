<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Models
use App\User;
use App\Ticket;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','user']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $users = User::where('user_type_id', 2)->where('id',$user->id)->orderBy('id')->get(); // seleccionando solo usuarios no admin
        $tickets = Ticket::where('user_id',$user->id)->orderBy('id')->get();

        return view('user')
                ->with('users',$users)
                ->with('tickets',$tickets);
    }
}
