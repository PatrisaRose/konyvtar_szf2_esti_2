<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = response()->json(Lending::all());
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lending = new Lending();
        $lending->user_id = $request->user_id;
        $lending->copy_id = $request->copy_id;
        $lending->start = $request->start;
        $lending->save();
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id, $copy_id, $start)
    {
        $lending = Lending::where('user_id', $user_id)->where('copy_id', $copy_id)->where('start', $start)->get();
        return $lending[0];
    }

    /**
     * Update the specified resource in storage.
     */
    //egyelőre ezt nincs értelme
    /* public function update(Request $request, $user_id, $copy_id, $start)
    {
        $lending = $this->show($user_id, $copy_id, $start);
        
    } */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id, $copy_id, $start)
    {
        Lending::where('user_id', $user_id)
            ->where('copy_id', $copy_id)
            ->where('start', $start)
            ->delete();
    }

    public function allLendingUserCopy()
    {
        //a modellben megírt függvény
        //neveit használom
        $datas = Lending::with(['copies', 'users'])
        ->get();
        return $datas;
    }

    public function osszesKolcsonzes($keresettDatum)
    {
        //a modellben megírt függvény
        //neveit használom
        $kolcsonzes = Lending::with(['copies', 'users'])->whereDate('start', '=', $keresettDatum)
        ->get();
        return $kolcsonzes;
    }

    public function adottKolcsonzesPeldany($keresettID)
    {
        //a modellben megírt függvény
        //neveit használom
        $peldany = Lending::with(['copies', 'users'])->where('copy_id', '=', $keresettID)
        ->get();
        return $peldany;
    }

    public function harmadik(){
        $user = Auth::user();
        $szamlalo = Lending::with( 'users')->where('user_id', '=', $user->id)
        ->count();
        return $szamlalo;
    }
}
