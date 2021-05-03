@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="row d-flex justify-content-around align-self-stretch">
    
    <p class="col-12 secondaryText"> 
            New to KPub? <a href="{{ route('registration.index') }}" class="details-link">Register</a> to create your dream group from our database of K-Pop idols.
            <br/>Already have an account? <a href="{{ route('auth.login') }}" class="details-link">Log in</a> to view your saved idols and edit your dream groups.
    </p>
    <div class="home-block-module col-sm-12">
        <h3>My Biases</h3>
        <i>You must be logged in to view your saved K-pop idol biases.</i>
    </div>
    <div class="home-block-module col-sm-12 pb-5">
        <h3>Dream Groups</h3>
        <i>You must be logged in to view your groups here.</i>
        <p><a href="{{ route('dream-group.index') }}" class="details-link">View all public fanmade groups</a></p>
    </div>
    <div class="home-block-module col-sm-12">
        <h3>Search Database</h3>
        <p>View <a href="{{ route('idol.index') }}" class="details-link">individual idols</a> or <a href="{{ route('group.index') }}" class="details-link">groups</a></p>
    </div>
    
</div>

@endsection