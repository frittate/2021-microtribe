<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Note extends Model
{
    use HasFactory;

    const STATUS = [
        'draft' => 1,
        'unapproved' => 2,
        'approved' => 3,
        'archived' => 4,
        'flagged' => 5
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'user_id',
        'content',
    ];

    protected $guarded = [
        'uuid'
    ];

    protected $appends = ['parsedContent'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tribes()
    {
        return $this->belongsToMany(Tribe::class, 'tribe_notes');
    }

    public function getRouteKey()
    {
        return $this->uuid;
    }

    public function getParsedContentAttribute()
    {
        $excerpt = [];
        $content = json_decode($this->content);
        if(isset($content)) {
            foreach ($content as $entry) {
                if(isset($entry->content)) {
                    $excerpt[] = $entry->content[0]->text;
                }
            }
        }
        $parsedContent = implode(' ', $excerpt);

       /*  */
        return Str::words($parsedContent, 12, '...');
    }
}

/* [
    {
        "type": "heading", 
        "attrs": {"level": 2}, "
        content": [
            {"text": "MicroTribes is a new social media platform.", "type": "text"}
            ]
        },
        {"type": "heading", "attrs": {"level": 3}, "content": [{"text": "MicroTribes encourages you to write and share content thoughfully.", "type": "text"}]}, {"type": "paragraph", "content": [{"text": "Here is where I explain why that's cool.", "type": "text"}]}, {"type": "paragraph"}, {"type": "heading", "attrs": {"level": 3}, "content": [{"text": "MicroTribes lives on group interactions: everybody is an admin!", "type": "text"}]}, {"type": "paragraph", "content": [{"text": "How the content in a tribe is displayed is up the users of the tribe.", "type": "text"}]}] */