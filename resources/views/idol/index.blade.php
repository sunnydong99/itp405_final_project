@extends('layouts.main')

@section('title', 'Idols')

@section('content')
<div class="row d-flex justify-content-around align-self-stretch">
    {{-- <p class="col-12 secondaryText"> New to KPub? Log in to create your dream group from our database of K-Pop idols.</p> --}}
    <div class="col-12">
        <form action="{{route('idol.index')}}" method="GET" id="idol-form">
            @csrf 
            <div class="row">
                
                <div class="col col-3">
                    <select name="type" id="type" class="form-control">
                        <option value="both"
                            {{ "both" == session()->get('type') ? "selected" : "" }}
                            >All Idols</option>
                        <option value="solo"
                            {{ "solo" == session()->get('type') ? "selected" : "" }}
                            >Solo Artists Only</option>
                        <option value="group"
                            {{ "group" == session()->get('type') ? "selected" : "" }}
                            >Group Members Only</option>
                    </select>
                </div>
                <div class="col col-3">
                    {{ old('gender')}}
                    <select name="gender" id="gender" class="form-control">
                        <option value="both"
                            {{ "both" == session()->get('gender') ? "selected" : "" }}
                            >Male & Female</option>
                        <option value="m"
                            {{ "m" == session()->get('gender') ? "selected" : "" }}
                            >Male</option>
                        <option value="f"
                            {{ "f" == session()->get('gender') ? "selected" : "" }}
                            >Female</option>
                    </select>
                </div>
                <div class="col col-6">
                    <div class="search-box-container">
                        <input type="text" name="name" id="name" class="form-control" 
                                placeholder="Search idols by name or group name"
                                value="{{ session()->get('name')}}" 
                        >
                        <button type="submit" class="btn idols-btn"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-12 d-flex justify-content-between">
        <small class="hint-text">@if(Auth::check())Click <i class="fa fa-plus"></i> to add idol to your list of favorites. @endif Click on <span style="text-decoration: underline">idol name</span> to see more details.</small>
        <small class="hint-text text-right">Showing {{$idols->count()}} result(s).</small>
    </div>
    <div class="col-12">
        @if ($idols->count() == 0)
            <p class="mt-2"><i class="fas fa-heart-broken mx-2"></i>No results matched your search. Try something else.</p>
        @else
            <table class='table table-striped'>
                <thead>
                    <tr>
                        @if(Auth::check())<th></th>@endif
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Solo</th>
                        <th>Group Association</th>  
                    </tr>
                </thead>
                <tbody>
                    @foreach($idols as $idol) 
                        <tr>
                            @if(Auth::check())<td>
                                <form method="post" action="{{ route('fav.store', ['idol_id' => $idol->idol_id]) }}">
                                    @csrf
                                    <button type="submit" class="btn bias-link p-0"><i class="fa fa-plus"></i></button>
                                </form>
                                
                            </td>@endif
                            <td>
                                <a class="details-link" href="{{ route('idol.show', ['id' => $idol->idol_id])}}">{{ $idol->idol }}</a>
                            </td>
                            <td>
                                {{ $idol->gender == 'F' ? "Female" : "Male" }}
                            </td>
                            <td>
                                <i class="{{ $idol->solo ? 'fa fa-check' : 'fa fa-times'}}"></i>
                                {{-- {{ $idol->solo}} --}}
                            </td>
                            <td>
                                {{ (is_null($idol->group) || empty($idol->group)) ? 'Solo artist' : $idol->group }}
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    
</div>

@endsection