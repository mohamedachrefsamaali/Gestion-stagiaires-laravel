<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;
    protected $fillable=[
        'date_debut',
        'date_fin',
        'type',
        'stagiaire_id',
        'sujet_id',
    ];
    public function sujet()
    {
        return $this->belongsTo(Sujet::class);
    }

    public function personnels()
    {
        return $this->hasMany(Personnel::class);
    }
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'stage_id');
    }

}
