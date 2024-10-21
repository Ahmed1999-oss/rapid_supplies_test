<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    // Retrieve all books with pagination and search filters
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%$search%")
                ->orWhere('author', 'like', "%$search%");
        }

        $books = $query->paginate(10);
        return $this->sendResponse(true, Response::HTTP_OK, 'All books with pagination', $books);

    }

    // Create a new book with validation
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_date' => 'required|date',
            'genre' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $validator->errors(), 'Validation Error');

        }

        $book = Book::create($request->all());
        return $this->sendResponse(true, Response::HTTP_CREATED, 'Create a new book', $book);

    }

    // Retrieve a specific book by ID with error handling
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return $this->sendResponse(true, Response::HTTP_OK, 'Book by ID', $book);
    }

    // Update a specific book with validation
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return $this->sendResponse(false, Response::HTTP_NOT_FOUND, 'Book not found', null);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_date' => 'required|date',
            'genre' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $validator->errors(), 'Validation Error');
        }

        $book->update($request->all());
        return $this->sendResponse(true, Response::HTTP_OK, 'Book Updated', $book);
    }

    // Delete a specific book (soft delete)
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return $this->sendResponse(false, Response::HTTP_NOT_FOUND, 'Book not found', null);

        }

        $book->delete();
        return $this->sendResponse(true, Response::HTTP_OK, 'Book deleted successfully', null);

    }

    // Search books by genre or author
    public function searchBook(Request $request)
    {
        $query = Book::query();

        if ($request->has('genre')) {
            $genre = $request->input('genre');
            $query->where('genre', 'like', "%$genre%");
            $books = $query->paginate();
            return $this->sendResponse(true, Response::HTTP_OK, 'Search books successfully', $books);

        }
        if ($request->has('author')) {
            $author = $request->input('author');
            $query->orWhere('author', 'like', "%$author%");
            $books = $query->paginate();
            return $this->sendResponse(true, Response::HTTP_OK, 'Search books successfully', $books);
        }
        return $this->sendResponse(false, Response::HTTP_NOT_FOUND, 'Search books not found', null);

    }

}
