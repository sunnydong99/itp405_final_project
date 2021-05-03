@extends('layouts.main')

@section('title', 'Dream Groups')

@section('content')
<div class="row d-flex justify-content-around align-self-stretch">
    {{-- <p class="col-12 secondaryText"> New to KPub? Log in to create your dream group from our database of K-Pop idols.</p> --}}
    <div class="col-12">
        <form action="{{route('dream-group.index')}}" method="GET" id="dream-group-form">
            @csrf 
            <div class="row d-flex justify-content-center">
                @if(Auth::check())
                <div class="form-check d-inline col col-4">
                    <input class="" type="checkbox" value="true" id="user" {{ !Auth::check() ? 'disabled' : '' }}>
                    <label class="form-check-label" for="user">
                        View your groups only
                    </label>
                    <br/>
                    <small class="text-dark invisible" id="tiptext">Your must be logged in to filter by account</small>
                </div>
                @endif
                <div class="col col-5">
                    <div class="search-box-container">
                        <input type="text" name="search" id="search" class="form-control" 
                                placeholder="Search groups by name or creator"
                                value="{{ session()->get('search')}}" 
                        >
                        <button type="submit" class="btn idols-btn"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
    <div class='text-end my-3'>Make the All-Star K-Pop line up of your dreams come true!
        @if (Auth::check())
                <a href="{{ route('dream-group.create') }}" class="details-link">Create A Group</a>
            
        @else 
            <a href="{{ route('auth.login') }}" class="details-link">Log in</a> to create a group
        @endif
        or view all public groups below.
    </div>
    <div class="col-12 d-flex justify-content-between">
        <small class="hint-text">Click on <span style="text-decoration: underline">group name</span> to see more details.</small>
        <small class="hint-text text-right">Showing {{$dreamGroups->count()}} result(s).</small>
    </div>
    <div class="col-12">
        @if ($dreamGroups->count() == 0)
            <p class="mt-2"><i class="fas fa-heart-broken mx-2"></i>No results matched your search. Try something else.</p>
        @else
            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Created By</th>
                        <th>Date Added</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dreamGroups as $dreamGroup) 
                        <tr>
                            <td>
                                <a class="details-link" href="{{ route('dream-group.show', ['id' => $dreamGroup->group_id])}}">{{ $dreamGroup->group }}</a>
                            </td>
                            <td>
                                {{ $dreamGroup->display_name }}
                            </td>
                            <td>
                                {{ $dreamGroup->time }}
                            </td>
                            <td>
                                @can('update', $dreamGroup)
                                    <a class="details-link" href="{{ route('dream-group.edit', ['id' => $dreamGroup->group_id]) }}">
                                        Edit 
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    
</div>

@endsection

@section('page-script')
<script>
    // var checkbox = document.querySelector('#user');
    // console.log(checkbox)
    // document.querySelector('#user').addEventListener("onmousedown", function() {
    //     console.log('click');
    //     if (checkbox.disabled){
    //         console.log(disabled);
    //         document.querySelector('#tiptext').visibility = visible;
    //     }
    // })
</script>
@endsection