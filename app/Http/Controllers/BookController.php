<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
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
        return response()->json($books);
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
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $book = Book::create($request->all());
        return response()->json($book, 201);
    }

    // Retrieve a specific book by ID with error handling
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($book);
    }

    // Update a specific book with validation
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_date' => 'required|date',
            'genre' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $book->update($request->all());
        return response()->json($book);
    }

    // Delete a specific book (soft delete)
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();
        return response()->json(['message' => 'Book deleted successfully']);
    }

    // Search books by genre or author
    public function search(Request $request)
    {
        $query = Book::query();

        if ($request->has('author')) {
            $query->where('author', 'like', "%{$request->input('author')}%");
        }

        if ($request->has('genre')) {
            $query->where('genre', 'like', "%{$request->input('genre')}%");
        }

        $books = $query->paginate(10);
        return response()->json($books);
    }
}
