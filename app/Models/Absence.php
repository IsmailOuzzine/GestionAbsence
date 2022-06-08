<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    public function module() {
        return $this->belongsTo(Module::class);
    }

    public function etudiant() {
        return $this->belongsTo(Etudiant::class);
    }
}
