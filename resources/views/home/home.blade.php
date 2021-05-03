@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="row d-flex justify-content-around align-self-stretch">
    
    <p class="col-12 secondaryText"> 
        Welcome back, {{Auth::user()->name}}!
    </p>
    <div class="home-block-module col-sm-12">
        <h3>My Biases</h3>
        
        @if($favorites->count() ==0)
            You have no idol biases yet. Add your first bias in the <a href="{{ route('idol.index') }}" class="details-link">idols page</a>!
        @else
            <small>Recently added:</small>
            @foreach($favorites as $favorite)
                <p class="list-text"><b>{{$favorite->idol->name}}</b>, added {{$favorite->created_at->format('M j H:iA')}}</p>
            @endforeach
            <a class="details-link" href="{{route('fav.index')}}">View all favorites</a>
        @endif
    </div>
    <div class="home-block-module col-sm-12">
        <h3>Dream Groups</h3>
        @if($dreamGroups->count() ==0)
            You haven't created any groups yet. <a href="{{ route('dream-group.create') }}" class="details-link">Create your first fanmade group</a>
        @else
            <small>Your recent groups:</small>
            @foreach($dreamGroups as $dreamGroup)
                <p class="list-text"><b>{{$dreamGroup->name}}</b>, created at {{$dreamGroup->created_at->format('M j H:iA')}}</p>
            @endforeach
            <a class="details-link" href="{{route('dream-group.index')}}">View all groups</a>
        @endif
    </div>
    <div class="home-block-module col-sm-12">
        <h3>Search Database</h3>
        <p>View <a href="{{ route('idol.index') }}" class="details-link">individual idols</a> or <a href="{{ route('group.index') }}" class="details-link">groups</a></p>
    </div>
    
</div>

@endsection