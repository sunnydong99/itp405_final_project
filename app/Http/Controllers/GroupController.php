<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    public function index(Request $request)
    {
       // dd($request);
        // if (!is_null($request->input('name'))) {

        // }
        $name = $request->input('name', '');
        $type = $request->input('type', 'all');
        $active = $request->input('active', 'all');
        $num = $request->input('num', '');
        // add them to the clause IF they exist
        //var_dump($num);

        // $groups = Group::leftJoin('groups', 'idols.group_id', '=', 'groups.id')
// 
        $groups = Group::with('company')
            ->join('companies', 'companies.id', '=', 'groups.company_id')
            ->select('*','groups.id as group_id', 'groups.name as group', 'companies.name as company')
            ->orderBy('groups.name')
            ->when( $num != '' && !empty($num), function($query) use($num) {
                return $query->where('groups.num_members', '=', $num);
            })
            ->when ($type != 'all',function($query) use($type) {
                return $query->where('type', '=', $type);
            })
            ->when($name != '', function($query) use($name){
                return $query->where('groups.name', 'ilike', '%' . $name . '%')
                    ->orWhere('companies.name', 'ilike', '%' . $name . '%');
            })
            ->when ($active != 'all', function($query) use($active) {
                // var_dump($type);
                
                if ($active == 'true') {
                    // var_dump('solo');
                    return $query->where('active', true);
                }
                else {
                    // var_dump('group');
                    return $query->where('active', false);
                }
            })
           
            
            ->get();
        $request->session()->put('name', $name);
        $request->session()->put('type', $type);
        $request->session()->put('active', $active);
        $request->session()->put('num', $num);

        return view('group.index', [
            'groups' => $groups,
            
        ]);
    }
    public function show($id) {
        $group = Group::find($id);
        $idols = $group->idols()->get();
        // var_dump($group->user);
        // var_dump($idols);
        // die();
        $idol_names = "";
        foreach($idols as $idol) {
            $idol_names .= $idol->name . ', ';
        }
        $idol_names = rtrim($idol_names, ", ");
        return view('group.show', [
            'group' => $group,
            'idols' => $idols,
            'idol_names' => $idol_names,
        ]);
    }
}
