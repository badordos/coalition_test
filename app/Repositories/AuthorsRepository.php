<?php

namespace App\Repositories;

use App\Author;

class AuthorsRepository
{
    /**
     * @param int $paginate
     * @return mixed
     */
    public function getAllWithPaginate(int $paginate)
    {
        return Author::withCount('books')->paginate($paginate);
    }

    /**
     * @param string $needle
     * @return mixed
     */
    public function search(string $needle)
    {
        return Author::where('name', 'LIKE', "%{$needle}%")
            ->orWhere('surname', 'LIKE', "%{$needle}%")
            ->orWhere('patronymic', 'LIKE', "%{$needle}%")
            ->orWhere('birth_year', 'LIKE', "%{$needle}%")
            ->orWhere('death_year', 'LIKE', "%{$needle}%")
            ->orderBy('created_at')
            ->get();
    }
}
