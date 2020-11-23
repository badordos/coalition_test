<?php

namespace App\Http\Controllers;

use App\Author;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\SearchRequest;
use App\Repositories\AuthorsRepository;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    const PAGINATE = 10;

    /**
     * AuthorController constructor.
     */
    public function __construct()
    {
        $this->authorsRepo = app(AuthorsRepository::class);
    }


    /**
     * @return mixed
     */
    public function index()
    {
        return $this->authorsRepo->getAllWithPaginate(static::PAGINATE);
    }

    /**
     * @param AuthorRequest $request
     * @return mixed
     */
    public function store(AuthorRequest $request)
    {
        $author = Author::create($request->validated());
        return $author;
    }

    /**
     * @param Author $author
     * @return mixed
     */
    public function show(Author $author)
    {
        return $author = Author::findOrFail($author);
    }

    /**
     * @param AuthorRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AuthorRequest $request, $id)
    {
        $author = Author::findOrFail($id);
        $author->fill($request->all());
        $author->save();
        return response()->json($author);
    }

    /**
     * @param AuthorRequest $request
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(AuthorRequest $request, $id)
    {
        $author = Author::findOrFail($id);
        if ($author->delete()) {
            return response(null, 204);
        }
    }

    /**
     * @param Request $request
     */
    public function search(SearchRequest $request)
    {
        return $this->authorsRepo->search($request->needle);
    }
}
