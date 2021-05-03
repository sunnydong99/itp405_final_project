@extends('layouts.main')

@section('title')
Editing Group {{$dreamGroup->name}}
@endsection

@section('content')
<div class="row d-flex justify-content-around align-self-stretch">
    <div class="col-12">
        {{-- {{var_dump(old())}} --}}
        <form action="{{route('dream-group.update', [ 'id' => $dreamGroup->id ])}}" method="POST" id="edit-dream-group">
            @csrf 
            <div class="row mb-3">
                <label for="group-name" class="col-2 col-form-label">Group Name</label>
                <div class="col-10"><input type="text" name="group-name" id="group-name" class="form-control" value="{{ old('group-name', $dreamGroup->name)}}"></div>
                @error('group-name') {{-- name of the function call, the require rule has a message template--}}
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>
            
            <div class="row mb-3">
                <label for="idols" class="col-2 col-form-label">Add Idols<br/><small class="hint-text">Hold Cmd ⌘ or Ctrl and click to select multiple idols</small></label>
                <div class="col-10">
                    <select name="idols[]" id="idols" multiple="multiple" class="form-control mb-3">
                        <option disabled>-- Select Idol --</option>
                        @foreach ($idols as $idol)
                            <option 
                                value="{{$idol->idol_id}}" 
                                {{ (!empty(old("idols")) && in_array($idol->idol_id, old("idols") ?: []))
                                    || ( isset($dreamGroupIdols) && in_array($idol->idol_id, $dreamGroupIdols) ) 
                                    ? "selected" : "" }}>
                                {{$idol->idol_name}}{{isset($idol->group)?" ($idol->group)" : ''}}
                            </option>
                        @endforeach
                    </select>
                    <span style="height:18px;font-size:14px;" class="d-inline-block" id="selected-idols"></span>
                    <span style="height:18px;font-size:14px;float:right;" class="d-inline-block text-right" id="previous-idols"></span>
                </div>                
                @error('idols')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="display-name-u" class="col-2 col-form-label">
                    Display Name <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" style="cursor: help" title="Fanmade groups are viewable to the public along with your display name."></i>
                </label>
                <div class="col-3">
                    <input type="text" name="display-name-u" id="display-name-u" class="form-control" value="{{ old('display-name-u', $dreamGroup->display_name)}}">
                </div>
                {{-- <div class="col-6 col-md-7 pt-2">
                    <input class="" type="checkbox" value="true" 
                            id="opt-out" name="opt-out">
                    <label class="form-check-label" for="opt-out">
                        Check to opt-out (name from registration will be used)
                    </label>
                </div> --}}
                @error('display-name-u')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>
            <button type="submit" id="update-submit" class="btn btn-dark">
                Update Group
            </button>
        </form>
    </div>
    
</div>

@endsection

@section('page-script')
<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script>
    var idols = JSON.parse("<?php echo addslashes($idolsMin); ?>");
    function displayIdolName() {
        var values = $("#idols").val();
        // cconsole.log(values);
        var idolNames = [];
        for (i = 0; i < values.length; i++) {
            //console.log(values[i]);
            var idolId = parseInt(values[i])-1;
            console.log(idolId);
            idolNames.push(idols[idolId].name);
        }
        console.log(idolNames)

        var idolString = idolNames.join(', ');
        document.querySelector('#selected-idols').innerHTML = "Selected: " + idolString;
        // console.log(values.join(', '))
    }
    function displayOldIdolNames() {
        var previousIdols = <?php echo json_encode($dreamGroupIdols); ?>;
        console.log(previousIdols);
        var previousIdolNames = [];
        for (i = 0; i < previousIdols.length; i++) {
            var idolId = parseInt(previousIdols[i])-1;
            previousIdolNames.push(idols[idolId].name);
            // console.log(idols[idolId].name);
        }
        var idolString = previousIdolNames.join(', ');
        document.querySelector('#previous-idols').innerHTML = "Previously saved: " + idolString;
    }
    // if ($("#idols").val().length > 0) {
        displayIdolName();
       displayOldIdolNames();
    // }
    document.querySelector("#idols").addEventListener("change", function() {
        displayIdolName()
    });
</script>
@endsection