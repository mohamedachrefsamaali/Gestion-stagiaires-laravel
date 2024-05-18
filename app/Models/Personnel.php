<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personnel extends Model
{
    use HasFactory , softdeletes;
    protected $fillable=[
        'name',
        'email',
        'password',
        'role',
        'telephone',
        'universite',
        'niveau',
        'titre',
        'user_id',
    ];
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
    /*
     * relation extend
     */
    public function encadrant()
    {
        return $this->hasMany(Stagiaire::class, 'encadrant_id');
    }
    public function sujet()
    {
        return $this->belongsTo(Sujet::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function taches()
    {
        return $this->hasMany(Tache::class, 'stagiaire_id');
    }
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'stagiaire_id');
    }

}
