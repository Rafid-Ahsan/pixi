<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SingleImage extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'team_id', 'title', 'description', 'image', 'price', 'label'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
