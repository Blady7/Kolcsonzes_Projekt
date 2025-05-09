<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Rental extends Model
{
    /** @use HasFactory<\Database\Factories\RentalFactory> */
    use HasFactory, Notifiable;

    // protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'id',
        'specimenId',
        'userId',
        'startingDate',
        'endingDate',
        'opinion'
    ];

    // public function specimen()
    // {
    //     return $this->belongsTo(Specimen::class, 'specimenId', 'id');
    // }

    // public function toArray()
    // {
    //     return [
    //         'id' => $this->id,
    //         'startingDate' => $this->startingDate,
    //         'endingDate' => $this->endingDate,
    //         'specimen' => $this->specimen, // Automatikusan betölti a kapcsolódó példányt
    //     ];
    // }
}
