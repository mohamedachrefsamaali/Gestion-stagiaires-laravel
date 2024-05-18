<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;
    protected $fillable=[
       'titre',
       'description',
       'stagiaire_id',
        'date_debut',
        'date_fin',
    ];
    /*
     * relation avec personnel
     */
    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'stagiaire_id');
    }
}
