<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(){
        $books = response()->json(Book::all());
        return $books;
    }

    public function show($id){
        $book = response()->json(Book::find($id));
        return $book;
    }

    public function store(Request $request){
        $Book = new Book();
        $Book->author = $request->author;
        $Book->title = $request->title;
        $Book->save();
    }

    public function update(Request $request, $id){
        $Book = Book::find($id);
        $Book->author = $request->author;
        $Book->title = $request->title;
        $Book->save();
    }
    public function destroy($id)
    {
        //find helyett a paraméter
        Book::find($id)->delete();
    }

    public function titleCount($title) {
      $copies = DB::table('copies as c')	//egy tábla lehet csak
    //->select('mezo_neve')		//itt nem szükséges
      ->join('books as b' ,'c.book_id','=','b.book_id') //kapcsolat leírása, akár több join is lehet
      ->where('b.title','=', $title) 	//esetleges szűrés
      ->count();				//esetleges aggregálás; ha select, akkor get() a vége
      return $copies;  
    }
    
}
