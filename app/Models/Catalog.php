<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'image', 'user_id', 'team_id'
    ];

    public function setFilenamesAttributes($value) {
        $this->attributes['images'] = json_encode($value);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
