<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'set_ticket'
    ];

    public function user() {
        return User::where('id',$this->user_id)->first();
    }
}
