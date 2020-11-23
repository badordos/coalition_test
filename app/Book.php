<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'desc',
        'year',
    ];

    protected $hidden = ['created_at', 'updated_at',];

    protected $appends = ['authorsList'];

    //RELATIONS
    public function authors()
    {
        return $this->BelongsToMany(Author::class, 'author_book');
    }

    //MUTATORS
    public function getAuthorsListAttribute()
    {
        $result = '';
        foreach ($this->authors as $author) {
            $result .= $author->fullName . ', ';
        }

        return $result;
    }
}
