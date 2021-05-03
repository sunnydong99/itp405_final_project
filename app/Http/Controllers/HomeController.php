<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\DreamGroup;


class HomeController extends Controller
{
    public function index(){
        // check auth, return view(home.index) if not logged in, redirect to home.home if logged in
        if (Auth::check()) { // logged in
            return redirect()->route('home.user');
        }
        else {
            return view('home.index');
        }
    }
    public function userIndex() {
        $user = Auth::user();
        // need to show: most recent favorites (top 5)
        // most recent DreamGroups (top 3?)
        $favorites = Favorite::with('idol')
            ->where('user_id','=',$user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        $dreamGroups = DreamGroup::where('dream_groups.user_id', '=', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        // dd($dreamGroups);
        return view('home.home', [
            'favorites' => $favorites,
            'dreamGroups' => $dreamGroups,
        ]);
    }
}
