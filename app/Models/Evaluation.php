<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $fillable=[
        'stagiaire_id',
        'stage_id',
        'sujet_id',
        'note',
    ];
    public function personne()
    {
        return $this->belongsTo(Personnel::class, 'stagiaire_id');
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }

    public function sujet()
    {
        return $this->belongsTo(Sujet::class, 'sujet_id');
    }
}
