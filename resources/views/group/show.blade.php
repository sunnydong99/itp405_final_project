@extends('layouts.main')

@section('title')
Group Details | {{ $group->name }}
@endsection

@section('content')
<div class="row detail-container mx-auto">
    <div class="col-12 d-flex justify-content-between align-bottom">
        <h2 class="d-inline">{{ $group->name }}</h2>
        <a href="{{route('group.index')}}" class="return-link align-bottom">Back to All Groups</a>
    </div>
    <div class="col-12">
        <table class='table table-striped'>
                <tr>
                    <th class="col-5">Entertainment Company</th>
                    <td>{{ $group->company->name}}</td>
                </tr>
                <tr>
                    <th class="col-5">Size</th>
                    <td>{{ $group->num_members}}</td>
                </tr>
                <tr>
                    <th class="col-5">Type</th>
                    <td>{{ ucfirst($group->type) }} group</td>
                </tr>
                <tr>
                    <th class="col-5">Members</th>
                    <td>
                        {{$idol_names }}
                    </td>
                </tr>
                <tr>
                    <th class="col-5">Fandom name</th>
                    <td>{{ isset($group->fanclub_name) && !empty($group->fanclub_name) ? $group->fanclub_name : "Not available"  }}</td>
                </tr>
                <tr>
                    <th class="col-5">Debut Date</th>
                    <td>{{ $group->debut_date}}</td>
                </tr>
                <tr>
                    <th class="col-5">Active</th>
                    <td><i class='{{($group->active) ? "far fa-check-circle" : "far fa-times-circle"}}'></i></td>
                </tr>
                <tr>
                    <th class="col-5">Added By</th>
                    <td>{{ $group->user->name}} ({{ $group->user->role->slug}})</td>
                </tr>
        </table>
    </div>
    
</div>

@endsection