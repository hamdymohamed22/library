<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // all books

    public function mod()
    {
        $books  = Book::paginate(3);

        return view("books.all", ["books" => $books]);
    }

    // show one 
    public function one($id)
    {
        $one =  Book::findorFail($id);
        return view("books.show", compact("one"));
    }
    // create book 
    public function create()
    {
        $categories = Cat::all();
        return view("books.create",compact('categories'));
    }

    // store book
    public function store(Request $request)
    {

        // validate
        $data =  $request->validate([
            "title" => "required|string|max:255",
            "desc" => "required|string",
            "image" => "required|mimes:png,jpg,jpeg|image",
            "price" => "required|numeric",
            "cat_id" => "required|exists:cats,id"
        ]);
        // rename 
        // move uploaded file 
        $data['image'] = Storage::putFile("books", $data['image']);

        $data['user_id'] = 1;
        // store data
        Book::create($data);
        // success message in session 
        session()->flash("success", "data inserted successfuly");
        // rdirect 
        return redirect()->route('allBooks');
    }

    //Edit & Update
    public function edit($id)
    {
        $book =  Book::findorFail($id);
        $categories = Cat::all();
        return view("books.edit", compact("book","categories"));
    }

    public function update($id, Request $request)
    {

        $data =  $request->validate([
            "title" => "string|max:255",
            "desc" => "string",
            "image" => "mimes:png,jpg,jpeg|image",
            "price" => "numeric",
            "cat_id" => "exists:cats,id"
        ]);

        $book =  Book::findorFail($id);

        // check if has image to update
        if ($request->has("image")) {
            // unlink for the old image
            if (strlen($book->image)!= 0) {
                Storage::delete($book->image);
            }
            // stor the new image
            $data['image'] = Storage::putFile("books", $data['image']);
        }

        $book->update($data);
        return redirect()->route('allBooks');
    }

    // delete 
    public function delete($id)
    {
        $book =  Book::findorFail($id);

        if (strlen($book->image) != 0) {
            Storage::delete($book->image);
        }

        $book->delete();
        return redirect()->route('allBooks');
    }
}
