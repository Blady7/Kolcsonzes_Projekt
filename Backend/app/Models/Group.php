<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Group extends Model
{
    /** @use HasFactory<\Database\Factories\GroupFactory> */
    use HasFactory, Notifiable;

    // protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'id',
        'group',
        'teacherId',
    ];

    // public function books()
    // {
    //     return $this->hasMany(Book::class, 'groupId', 'id');
    // }

    // public function toArray()
    // {
    //     return [
    //         'id' => $this->id,
    //         'group' => $this->group,
    //         'teacherId' => $this->teacherId,
    //         'books' => $this->books, // Automatikusan betölti a hozzá tartozó könyveket
    //     ];
    // }
}
