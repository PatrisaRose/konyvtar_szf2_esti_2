<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function show($book_id, $user_id, $start){
        $res = Reservation::where('book_id', $book_id)
        ->where('user_id', $user_id)
        ->where('start', $start)
        ->first();
        return $res;
    }

    public function index()
    {
        $res = response()->json(Reservation::all());
        return $res;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $res = new Reservation();
        $res->user_id = $request->user_id;
        $res->book_id = $request->book_id;
        $res->start = $request->start;
        $res->save();
    }

    
    public function update(Request $request, $user_id, $book_id, $start)
    {
        $res = $this->show($user_id, $book_id, $start);
        $res -> fill($request -> all());
        $res -> save();
        
    }

    
    public function destroy($user_id, $book_id, $start)
    {

        $this->show($user_id, $book_id, $start)->delete();
        /* Reservation::where('user_id', $user_id)
            ->where('book_id', $book_id)
            ->where('start', $start)
            ->delete(); */
    }
}
