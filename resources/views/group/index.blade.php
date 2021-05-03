@extends('layouts.main')

@section('title', 'Groups')

@section('content')
<div class="row d-flex justify-content-around align-self-stretch">
    {{-- <p class="col-12 secondaryText"> New to KPub? Log in to create your dream group from our database of K-Pop idols.</p> --}}
    <div class="col-12">
        <form action="{{route('group.index')}}" method="GET" id="group-form">
            @csrf 
            <div class="row">
                
                <div class="col col-3">
                    <select name="active" id="active" class="form-control">
                        <option value="all"
                            {{ "all" == session()->get('active') ? "selected" : "" }}
                            >All</option>
                        <option value="true"
                            {{ "true" == session()->get('active') ? "selected" : "" }}
                            >Active Groups Only</option>
                        <option value="false"
                            {{ "false" == session()->get('active') ? "selected" : "" }}
                            >Inactive Groups Only</option>
                    </select>
                </div>
                <div class="col col-3">
                    <select name="type" id="type" class="form-control">
                        <option value="all"
                            {{ "all" == session()->get('type') ? "selected" : "" }}
                            >All</option>
                        <option value="boy"
                            {{ "boy" == session()->get('type') ? "selected" : "" }}
                            >Boy Groups</option>
                        <option value="girl"
                            {{ "girl" == session()->get('type') ? "selected" : "" }}
                            >Girl Groups</option>
                        <option value="co-ed"
                            {{ "co-ed" == session()->get('type') ? "selected" : "" }}
                            >Co-ed Groups</option>
                    </select>
                </div>
                <div class="col col-2">
                    <input type="number" name="num" id="num" class="form-control" 
                        placeholder="# members"
                        value="{{ session()->get('num')}}" >                    
                </div>
                <div class="col col-4">
                    <div class="search-box-container">
                        <input type="text" name="name" id="name" class="form-control" 
                                placeholder="Search groups by name or company"
                                value="{{ session()->get('name')}}" 
                        >
                        <button type="submit" class="btn idols-btn"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-12 d-flex justify-content-between">
        <small class="hint-text">Click on <span style="text-decoration: underline">group name</span> to see more details.</small>
        <small class="hint-text text-right">Showing {{$groups->count()}} result(s).</small>
    </div>
    <div class="col-12">
        @if ($groups->count() == 0)
            <p class="mt-2"><i class="fas fa-heart-broken mx-2"></i>No results matched your search. Try something else.</p>
        @else
            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Number of members</th>
                        <th>Entertainment Company</th>  
                        <th>Active</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groups as $group) 
                        <tr>
                            
                            <td>
                                <a class="details-link" href="{{ route('group.show', ['id' => $group->group_id])}}">{{ $group->group }}</a>
                            </td>
                            <td>
                                {{ ucfirst($group->type) }} group
                            </td>
                            <td>
                                {{ $group->num_members}}
                            </td>
                            <td>
                                {{ $group->company }}
                            </td>
                            <td>
                                <i class='{{($group->active) ? "far fa-check-circle" : "far fa-times-circle"}}'></i>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    
</div>

@endsection