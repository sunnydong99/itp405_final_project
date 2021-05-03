<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Idol;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    public function index() {
        $favorites = Favorite::with('idol')
            ->where('user_id','=',Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('favorite.index', [
            'favorites' => $favorites,
        ]);
    }
    public function store(Request $request) 
    {
        // dd($requst);
        $request->validate([
            'idol_id' => 'required|exists:idols,id',
        ]);

        $favorite = new Favorite();
        $favorite->idol_id = $request->input('idol_id');
        $favorite->user_id = Auth::user()->id;
        $favorite->save(); 
        $idol = Idol::find($request->input('idol_id'));

        return redirect()
            ->route('idol.index') // how to return to idols or idols/id based on where it was added? 2 store methods?
            ->with('success', "Successfully added {$idol->name} to your list of biases!");
    }
    public function destroy($id)
    {
        
        // dd($favorite);
        $idol = Favorite::find($id)->idol->name;
        Favorite::destroy($id);

            return redirect()->back()
                ->with('success', "You removed {$idol} from your list of biases!");
    }
}
