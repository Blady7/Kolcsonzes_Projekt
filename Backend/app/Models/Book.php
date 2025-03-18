<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory, Notifiable;

    // Ha az id nem auto-increment, meg kell adni a primaryKey-t
    // protected $primaryKey = 'id';
    public $incrementing = false;
    
    public $timestamps = false;

    protected $fillable = [
        'id',
        'poet',
        'title',
        'groupId',
    ];

    // Kapcsolat a Group modellel (Many-to-One)
    // public function group()
    // {
    //     return $this->belongsTo(Group::class, 'groupId', 'id');
    // }

    // Ezt az osztályt a kérésre adott válasz testreszabására használjuk
    // public function toArray()
    // {
    //     return [
    //         'id' => $this->id,
    //         'poet' => $this->poet,
    //         'title' => $this->title,
    //         'group' => $this->group, // Automatikusan betölti a kapcsolódó csoportot
    //     ];
    // }
}
