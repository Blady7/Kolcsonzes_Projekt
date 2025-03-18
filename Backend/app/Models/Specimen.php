<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Specimen extends Model
{
    /** @use HasFactory<\Database\Factories\SpecimenFactory> */
    use HasFactory, Notifiable;

    // protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'id',
        'bookId',
        'price',
        'acquisitionDate',
    ];

    // public function book()
    // {
    //     return $this->belongsTo(Book::class, 'bookId', 'id');
    // }

    // public function toArray()
    // {
    //     return [
    //         'id' => $this->id,
    //         'price' => $this->price,
    //         'acquisitionDate' => $this->acquisitionDate,
    //         'book' => $this->book, // Automatikusan betölti a kapcsolódó könyvet
    //     ];
    // }
}
