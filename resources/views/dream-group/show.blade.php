@extends('layouts.main')

@section('title')
Group Details | {{$dreamGroup->name}} 
@endsection


@section('content')
<div class="row detail-container mx-auto">
    <div class="col-12 d-flex justify-content-between align-bottom">
        <h2 class="d-inline">{{ $dreamGroup->name }}</h2>
        <a href="{{route('dream-group.index')}}" class="return-link align-bottom">Back to All Dream Groups</a>
    </div>
    <div class="col-12 d-flex justify-content-between">
        <small class="hint-text">Created by {{$dreamGroup->display_name}} at {{$dreamGroup->created_at}}</small>
        <small class="hint-text text-right">{{count($dreamGroup->idols)}} idols(s).</small>
    </div>
    <div class="col-12">
        <table class='table table-striped'>
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Current Group</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dreamGroup->idols as $dIdol) 
                    <tr>
                        <td>
                            {{ $dIdol->name }}
                        </td>
                        <td>
                            {{ isset($dIdol->group) && !empty($dIdol->group) ? $dIdol->group->name : "None" }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @can('delete', $dreamGroup)
            <form method="post" action="{{ route('dream-group.destroy', ['id' => $dreamGroup->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this group? This action is irreversible.');">Delete This Group</button>
            </form>
        @endcan
    </div>
   
</div>

@endsection