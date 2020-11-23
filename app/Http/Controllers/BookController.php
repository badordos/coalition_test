<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookRequest;
use App\Http\Requests\SearchRequest;
use App\Repositories\BooksRepository;
use Illuminate\Http\Request;

class BookController extends Controller
{
    const PAGINATE = 20;

    /**
     * @var BooksRepository
     */
    private $booksRepo;

    /**
     * BookController constructor.
     */
    public function __construct()
    {
        $this->booksRepo = app(BooksRepository::class);
    }


    /**
     * @return mixed
     */
    public function index()
    {
        return $this->booksRepo->getAllWithPaginate(static::PAGINATE);
    }

    /**
     * @param BookRequest $request
     * @return mixed
     */
    public function store(BookRequest $request)
    {
        $book = Book::create($request->validated());
        return $book;
    }

    /**
     * @param Book $book
     * @return mixed
     */
    public function show(Book $book)
    {
        $book = Book::findOrFail($book);
        $result = $book ?? response(null, 404);
        return $result;
    }

    /**
     * @param BookRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BookRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->fill($request->all());
        $book->save();
        return response()->json($book);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if ($book->delete()) {
            return response(null, 204);
        }
    }

    /**
     * @param Request $request
     */
    public function search(SearchRequest $request)
    {
        return $this->booksRepo->search($request->needle);
    }
}
