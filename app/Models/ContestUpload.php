<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'contest_id',
        'publisher_id',
        'participator_id',
        'status'
    ];

    public function users() {
        $this->hasMany(Users::class);
    }
}
