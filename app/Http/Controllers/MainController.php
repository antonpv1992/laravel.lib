<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     // @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $content = 'components/main';
        if($request->filter) {
            $sort = $request->sort;
            if($request->order && $request->order === 'up'){
                $order = 'asc';
            } else {
                $order = 'desc';
            }
            $books = Book::where(function($query) use ($request) {
                if(isset($request->filter)){
                    foreach ($request->filter as $key => $value) {
                        $query->orWhere($value, 'LIKE', '%' . $request->bsearch . '%');
                    }
                }
            })->orderBy($sort, $order)->paginate(8)->appends(request()->query());
        } else {
            $books = Book::orderBy('id', 'desc')->paginate(8);
        }
        return view('welcome', compact('books', 'content', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     // @return \Illuminate\Http\Response
     */
    public function create()
    {
        $content = 'components/add-edit';
        return view('welcome', compact('content'));
    }

    /**
     * Store a newly created resource in storage.
     *
     // @param  \Illuminate\Http\Request  $request
     // @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $book = new Book();
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->genre = $request->genre;
        $book->year = $request->year;
        $book->country = $request->country;
        $book->book = $request->book;
        $book->pages = $request->pages;
        if($request->file('image')){
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);
        } else {
            $url = 'images/book.jpg';
        }
        $book->image = $url;
        $book->save();
        return redirect()->route('home')->with('success', 'added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     // @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content = 'components/book';
        $book = DB::table('books')->find($id);
        return view('welcome', compact('content', 'book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     // @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $content = 'components/add-edit';
        $book = DB::table('books')->find($id);
        return view('welcome', compact('content', 'book'));
    }

    /**
     * Update the specified resource in storage.
     *
     // @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     // @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, int $id)
    {
        $book = Book::find($id);//DB::table('books')->find($id);
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->genre = $request->genre;
        $book->year = $request->year;
        $book->country = $request->country;
        $book->book = $request->book;
        $book->pages = $request->pages;
        if($request->file('image')){
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);
            $book->image = $url;
        }
        $book->update();
        return redirect()->route('book', $book)->with('success', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     // @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('home')->with('success', 'removed');
    }
}
