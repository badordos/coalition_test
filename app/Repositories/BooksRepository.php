<?php

namespace App\Repositories;

use App\Book;
use Illuminate\Database\Eloquent\Model;

class BooksRepository
{
    /**
     * @param int $paginate
     * @return mixed
     */
    public function getAllWithPaginate(int $paginate)
    {
        return Book::with('authors')->paginate($paginate);
    }

    /**
     * @param string $needle
     * @return mixed
     */
    public function search(string $needle)
    {
        return Book::where('title', 'LIKE', "%{$needle}%")
            ->orWhere('desc', 'LIKE', "%{$needle}%")
            ->orWhere('year', 'LIKE', "%{$needle}%")
            ->orderBy('created_at')
            ->get();
    }
}
