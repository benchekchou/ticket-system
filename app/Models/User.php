<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    public function tickets() {
        return $this->hasMany(Ticket::class);
    }
    
    public function replies() {
        return $this->hasMany(Reply::class);
    }
}
