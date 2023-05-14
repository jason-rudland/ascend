<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = Book::all();
        if ($request->header('Accept') == 'application/json') {
            return response()->json($books);
        } else {
            Return Inertia::render('book/index', [
                'books' => $books
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Return Inertia::render('book/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());

        return response()->json([
            'message' => 'Book created successfully',
            'data' => $book
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Book $book)
    {
        if ($request->header('Accept') == 'application/json') {
            return response()->json($book);
        } else {
            Return Inertia::render('book/show', [
                'book' => $book
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return Inertia::render('book/edit', [
            'book' => $book,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $validatedData = $request->validated();

        $book->update($validatedData);

        return response()->json([
            'message' => 'Book updated successfully',
            'data' => $book,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully',
        ], 200);
    }

    /**
     * Loan the book to a user
     */
    public function checkout(User $user, Book $book)
    {
        // Check user has joined the library to which the book belongs
        $joinedLibraries = $user->libraries->pluck('name');
        if ($joinedLibraries->contains($book->library->name)) {
            if (!$book->loaned) {
                // Mark book as loaned
                $book->loaned = true;
                $book->save();

                // Create the Loan record
                Loan::create([
                    'book_id' => $book->id,
                    'user_id' => $user->id,
                    'status' => 'Loaned'
                ]);
                return response()->json([
                    'message' => 'Book loaned successfully',
                    'data' => $book,
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Book is out on loan.',
                ], 400);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User is not a member of this library.',
            ], 400);
        }
    }

    public function checkin(User $user, Book $book) {
        // Check the book is on loan to this user
       if ($this->isLoanedToUser($book, $user)) {
           // Crate return loan record
           Loan::create([
               'book_id' => $book->id,
               'user_id' => $user->id,
               'status' => 'Returned'
           ]);

           // mark book as returned
           $book->loaned = false;
           $book->save();

           return response()->json([
               'message' => 'Book returned successfully',
               'data' => $book,
           ], 200);
       } else {
           return response()->json([
               'status' => 'error',
               'message' => 'User has not been loaned this book.',
           ], 400);
       }
    }

    /**
     * Check if the book has been lonaed to the user
     * @param $book
     * @param $user
     * @return bool
     */
    private function isLoanedToUser($book, $user): bool
    {
        if ($book->loans->last()->user->name === $user->name && $book->loaned === true) {
            return true;
        } else
            return false;
    }

}
