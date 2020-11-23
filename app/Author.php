<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'birth_year',
        'death_year',
    ];

    protected $hidden = ['created_at', 'updated_at',];

    //RELATIONS

    public function books()
    {
        return $this->BelongsToMany(Book::class, 'author_book');
    }

    //MUTATORS

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->surname
            . ' '
            . strtoupper($this->name[0])
            . '. '
            . strtoupper($this->patronymic[0])
            . '.';
    }
}
