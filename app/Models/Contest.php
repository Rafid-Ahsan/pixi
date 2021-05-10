<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'first_prize',
        'second_prize',
        'status'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function uploads() {
        return $this->hasMany(ContestUpload::class);
    }
}
