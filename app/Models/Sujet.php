<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sujet extends Model
{
    use HasFactory;
    protected $fillable=[
      'titre',
      'description',
    ];
    public function stages()
    {
        return $this->hasMany(Stage::class);
    }

    public function personnels()
    {
        return $this->hasMany(Personnel::class);
    }
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'sujet_id');
    }
}
