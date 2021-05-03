@extends('layouts.main')

@section('title', 'My Biases')

@section('content')
<div class="row">
    <p>Keep track of all your favorite K-Pop idols here!</p>
    <div class="col-12">
        @if ($favorites->count() == 0)
            <p class="mt-2"><i class="fas fa-heart-broken mx-2"></i>You haven't saved any artists yet. Click on <i class="fa fa-plus bias-link"></i> next to your favorites in the Idols page to keep track of them here.</p>
            {{-- <a href="{{ route(idol.index) }}">Idols</a>         --}}
        @else
            <div class="col-12 d-flex justify-content-between">
                <small class="hint-text">Click <i class="fa fa-times"></i> to remove an idol from your list of biases</small>
                <small class="hint-text text-right">Showing {{$favorites->count()}} idol(s).</small>
            </div>
            <table class='table table-striped' id="favorites-table">
                <thead>
                    <tr>
                        <th class="col-3"></th>
                        <th class="col-2">Name</th>
                        {{-- <th>Gender</th>
                        <th>Solo</th>
                        <th>Group Association</th>   --}}
                        <th class="col-2"></th>
                        <th class="col-3"><i class="far fa-calendar-alt mx-1"></i> Date Added</th>
                        <th class="col-2"></th>
                    </tr>
                </thead>
                <tbody id="accordion">
                    @foreach($favorites as $favorite) 
                    {{-- {{var_dump("#collapse$favorite->id")}} --}}
                        <tr class="clickable"
                        data-toggle="collapse" data-target="#collapse-{{$favorite->id}}"
                         aria-expanded="false" aria-controls="collapse-{{$favorite->id}}">
                            <td>
                                <form method="post" action="{{ route('fav.destroy', ['id' => $favorite->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn bias-link p-0"><i class="fa fa-times"></i></button>
                                </form>
                            </td>
                            <td>
                                {{-- <a class="details-link" href="{{ route('idol.show', ['id' => $idol->idol_id])}}">{{ $idol->idol }}</a> --}}
                                {{$favorite->idol->name}}
                            </td>
                            <td></td>
                            <td>
                                {{ Timezone::convertToLocal($favorite->created_at) }}
                            </td>
                            <td></td>
                        </tr>
                        <div style="display:none;" class="hiddenRow collapse" id="collapse-{{$favorite->id}}"
                            data-parent="#accordion">
                            <td class="col-3">Birthday: {{ $favorite->idol->birthday}}</td>
                            <td class="col-2">
                                {{ $favorite->idol->gender == 'F' ? "Female" : "Male" }}
                            </td>
                            <td class="col-2">
                                {{ $favorite->idol->company->name }}
                            </td>
                            <td class="col-3">
                                Fanclub: {{ isset($favorite->idol->fanclub_name) && !empty($favorite->idol->fanclub_name) ? $favorite->idol->fanclub_name : "None"  }}
                            </td>
                            <td class="col-2">
                                Group: {{ isset($favorite->idol->group) && !empty($favorite->idol->group) ? $favorite->idol->group->name : "None"  }}
                            </td>
                        </div>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection

@section('page-script')
<script>
    $( ".clickable" ).click(function() {
        console.log('click');
        console.log(this.nextElementSibling);
        var next = this.nextElementSibling;
        console.log(next.style.display)
        if (next.style.display == "none") {
            next.style.display = "block";
        }
        else {
            next.style.display = "none";
        }
    });
</script>
@endsection