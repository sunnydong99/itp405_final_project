@extends('layouts.main')

@section('title', 'Idol Detail')
{{-- Add actual idol name here --}}

@section('content')
<div class="row detail-container mx-auto">
    <div class="col-12 d-flex justify-content-between align-bottom">
        <h2 class="d-inline">{{ $idol->name }}</h2>
        <a href="{{route('idol.index')}}" class="return-link align-bottom">Back to All Idols</a>
    </div>
    <div class="col-12">
        <table class='table table-striped'>
                <tr>
                    <th>Entertainment Company</th>
                    <td>{{ $idol->company->name}}</td>
                </tr>
                <tr>
                    <th>Group</th>
                    <td>{{ isset($idol->group) && !empty($idol->group) ? $idol->group->name : "Not available" }}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{ $idol->gender == 'M' ? "Male" : "Female"}}</td>
                </tr>
                <tr>
                    <th>Birthday</th>
                    <td>{{ $idol->birthday}}</td>
                </tr>
                <tr>
                    <th>Fandom name</th>
                    <td>{{ isset($idol->fanclub_name) && !empty($idol->fanclub_name) ? $idol->fanclub_name : "Not available"  }}</td>
                </tr>
                <tr>
                    <th>Added By</th>
                    <td>{{ $idol->user->name}} ({{ $idol->user->role->slug}})</td>
                </tr>
        </table>
    </div>
    
</div>

@endsection