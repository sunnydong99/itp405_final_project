<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Idol;
use App\Models\Group;

class IdolController extends Controller
{
    public function index(Request $request)
    {
       // dd($request);
        // if (!is_null($request->input('name'))) {

        // }
        $name = $request->input('name', '');
        $gender = $request->input('gender', 'both');
        $type = $request->input('type', 'both');
        // add them to the clause IF they exist
        // var_dump($gender);

        $idols = Idol::leftJoin('groups', 'idols.group_id', '=', 'groups.id')
            ->select('*','idols.id as idol_id', 'idols.name as idol', 'groups.name as group')
            ->orderBy('group')
            ->orderBy('idol')
            ->when ($gender != 'both',function($query) use($gender) {
                // var_dump($gender);
                return $query->where('gender', 'ilike', $gender);
            })
            ->where(function($query) use($name){
                return $query->where('idols.name', 'ilike', '%' . $name . '%')
                    ->orWhere('groups.name', 'ilike', '%' . $name . '%');
            })
            ->when ($type != 'both', function($query) use($type) {
                // var_dump($type);
                
                if ($type == 'solo') {
                    // var_dump('solo');
                    return $query->where('solo', true);
                }
                else {
                    // var_dump('group');
                    return $query->where('solo', false);
                }
            })
           
            
            ->get();
        $request->session()->put('name', $name);
        $request->session()->put('gender', $gender);
        $request->session()->put('type', $type);

        return view('idol.index', [
            'idols' => $idols,
        ]);
    }
    public function show($id) {
        // $idol = Idol::find($id);
        $idol = Idol::with(['group', 'company'])->find($id);
        //dd($idol);
        return view('idol.show', [
            'idol' => $idol,
        ]);
    }

}
