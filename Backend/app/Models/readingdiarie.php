<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class readingdiarie extends Model
{
    /** @use HasFactory<\Database\Factories\ReadingDiaryFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'id',
        'studentOpinion',
        'bookId',
        'grade',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'bookId', 'id');
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'studentOpinion' => $this->studentOpinion,
            'grade' => $this->grade,
            'book' => $this->book, // Automatikusan betölti a kapcsolódó könyvet
        ];
    }
}
