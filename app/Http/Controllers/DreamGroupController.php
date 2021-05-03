<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DreamGroup;
use App\Models\Idol;
use App\Models\DreamGroupIdol;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DreamGroupRequest;
use App\Http\Requests\DreamGroupUpdateRequest;
use Illuminate\Support\Facades\Response;

class DreamGroupController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search', '');
        // $user = $request->input('user', '');

        $dreamGroups = DreamGroup::with('user')
            ->join('users', 'dream_groups.user_id', '=', 'users.id')
            ->select('*', 'dream_groups.created_at as time', 'dream_groups.name as group', 'dream_groups.id as group_id')
            ->where( function($query) use($search){
                return $query->where('dream_groups.name', 'ilike', '%' . $search . '%')
                    ->orWhere('dream_groups.display_name', 'ilike', '%' . $search . '%');
            })
            // ->when($user != '', function($query) use($user){
            //     return $query->where('dream_groups.user_id','=',Auth::user()->id);
            // })
            ->orderBy('dream_groups.created_at', 'desc')
            ->get();
       // dd($dreamGroups);
        $request->session()->put('search', $search);
        return view('dream-group.index', [
            'dreamGroups' => $dreamGroups,
        ]);
    }
    public function show($id) {
        // $idol = Idol::find($id);
        // var_dump($id);
        $dreamGroup = DreamGroup::find($id);

        // foreach($dreamGroup->idol as $an_idol) {
        //     echo $an_idol->name;
        // }
        //dd($idol);
        return view('dream-group.show', [
            'dreamGroup' => $dreamGroup,
        ]);
    }
    public function create()
    {
        $idols = Idol::with('group')
            ->leftJoin('groups', 'idols.group_id', '=', 'groups.id')
            ->select('*','groups.name as group','idols.name as idol_name','idols.id as idol_id')
            ->orderBy('idols.name')->get();
        $idolsMin = Idol::select('id','name')->get();
        return view('dream-group.create', [
            'idols' => $idols,
            'idolsMin' => $idolsMin
        ]);
    }

    public function store(DreamGroupRequest $request) 
    {
        // dd($request);
        // $request->validate([
        //     'group-name' => 'required|max:50',
        //     'display-name' => 'max:50|min:2',
        //     'idols' => 'required|min:2',
        //     'idols.*' => 'required|exists:idols,id'
        // ]);
        // ^ don't need this, using custom request
        // dd($request->old('idols'));
        $dreamGroup = new DreamGroup();
        $dreamGroup->name = $request->input('group-name');
        if (null !== ($request->input('opt-out'))) {
            $dreamGroup->display_name = Auth::user()->name;
        }
        else {
            $dreamGroup->display_name = $request->input('display-name');
        }
        
        $dreamGroup->user_id = Auth::user()->id;
        $dreamGroup->save();

        $idols = $request->input('idols');
        foreach($idols as $idol) {
            $dreamGroupIdol = new DreamGroupIdol();
            $dreamGroupIdol->dream_group_id = $dreamGroup->id;
            $dreamGroupIdol->idol_id = $idol;
            // var_dump($dreamGroupIdol);
            $dreamGroupIdol->save();
        }
        $msg = "{$dreamGroup->name} was successfully created!";
        return redirect()
            ->route('dream-group.index')
            ->with('success', $msg);
    }

    public function edit($id)
    {
        $dreamGroup = DreamGroup::find($id);
        $dreamGroupIdols = DreamGroupIdol::where('dream_group_id', '=', $id)->select('idol_id')->get();
        $dreamGroupIdolsArr = $dreamGroupIdols->toArray();
        $arr = []; // current idols in the 
        foreach($dreamGroupIdolsArr as $item) {
            // var_dump($item['idol_id']);
            array_push($arr, $item['idol_id']);
        }
        $idols = Idol::with('group')
            ->leftJoin('groups', 'idols.group_id', '=', 'groups.id')
            ->select('*','groups.name as group','idols.name as idol_name','idols.id as idol_id')
            ->orderBy('idols.name')->get();
        $idolsMin = Idol::select('id','name')->get();

        $this->authorize('update', $dreamGroup);

        return view('dream-group.edit', [
            'dreamGroup' =>  $dreamGroup,
            'idols' => $idols,
            'idolsMin' => $idolsMin,
            'dreamGroupIdols' => $arr,
        ]);
    }

    public function update(DreamGroupUpdateRequest $request, $id)
    {      
        $oldIdols = DreamGroupIdol::select('idol_id') // previous idols attached
            ->where('dream_group_id','=',$id)
            ->get();
        $idols = $request->input('idols'); // new idol ids

        $dreamGroup = DreamGroup::find($id);
        $dreamGroup->name = $request->input('group-name');
        $dreamGroup->display_name = $request->input('display-name-u');        
        
        // compare diff - could just use sync instead?
        $oldArr = [];
        foreach ($oldIdols as $old){
            array_push($oldArr, $old->idol_id);
        };
        $newArr = [];
        foreach ($idols as $new){
            array_push($newArr, intval($new));
        };

        $added = array_diff($newArr,$oldArr);
        $removed = array_diff($oldArr,$newArr);
        $dreamGroup->idols()->attach($added);
        $dreamGroup->idols()->detach($removed);
        // var_dump($added);
        // var_dump($removed);
        // foreach ($added as $newID) {
        //     //var_dump($a);
        //     $dreamGroup->idols()->attach($newID);
        // }
        // foreach ($removed as $oldID) {
        //     //var_dump($r);
        //     $dreamGroup->idols()->detatch($oldID);
        // }
        // die();
        $dreamGroup->save();
        
        $this->authorize('update', $dreamGroup);

        $msg = "{$dreamGroup->name} was successfully updated!";

        return redirect()->route('dream-group.edit', ['id' => $id])->with('success', $msg);
    }

    public function destroy($id)
    {
        $name = DreamGroup::find($id)->name;
        $dreamGroup = DreamGroup::find($id);
        foreach($dreamGroup->idols as $idol) {
            $dreamGroup->idols()->detach($idol->id); // remove from dream_group_idol
        }
        DreamGroup::destroy($id); // delete the record from dream_groups

        return redirect()->route('dream-group.index')
            ->with('success', "{$name} was deleted from our records");
    }


}
