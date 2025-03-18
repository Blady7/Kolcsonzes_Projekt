<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory, Notifiable;

    // protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'id',
        'role',
    ];

    public function toArray()
    {
        return [
            'id' => $this->id,
            'role' => $this->role,
        ];
    }
}
