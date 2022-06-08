<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;

    public function user() {
        return $this->hasOne(User::class);
    }

    public function enseignements() {
        return $this->hasMany(Enseignement::class);
    }
}
