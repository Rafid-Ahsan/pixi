<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class BlogImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'images',
    ];

    public function setFilenamesAttributes($value) {
        $this->attributes['images'] = json_encode($value);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
