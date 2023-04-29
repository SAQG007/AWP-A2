<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'file_name',
        'file_unique_name',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
