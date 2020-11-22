<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tribe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    protected $guarded = [
        'uuid'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'tribe_users');
    }

    public function notes()
    {
        return $this->belongsToMany(Note::class, 'tribe_notes')->withPivot('status_id');
    }
}