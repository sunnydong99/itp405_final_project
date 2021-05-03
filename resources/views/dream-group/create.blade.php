@extends('layouts.main')

@section('title', 'Create New Group')

@section('content')
<div class="row d-flex justify-content-around align-self-stretch">
    {{-- <p class="col-12 secondaryText"> New to KPub? Log in to create your dream group from our database of K-Pop idols.</p> --}}
    <div class="col-12">
        {{-- {{ var_dump(old()) }} --}}
        <form action="{{ route('dream-group.store') }}" method="POST" id="create-dream-group">
            @csrf 
            <div class="row mb-3">
                <label for="group-name" class="col-2 col-form-label">Group Name</label>
                <div class="col-10"><input type="text" name="group-name" id="group-name" class="form-control" value="{{ old('group-name')}}"></div>
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
                                value="{{$idol->idol_id}}" {{ !empty(old("idols")) && in_array($idol->idol_id, old("idols") ?: []) ? "selected" : "" }}
                            >
                                {{$idol->idol_name}}{{isset($idol->group)?" ($idol->group)" : ''}}
                            </option>
                        @endforeach
                    </select>
                    <span style="height:18px;font-size:14px;" class="d-block" id="selected-idols"></span>
                </div>                
                @error('idols')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="display-name" class="col-2 col-form-label">
                    Display Name <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" style="cursor: help" title="Fanmade groups are viewable to the public along with your display name."></i>
                </label>
                <div class="col-4 col-md-3">
                    <input type="text" name="display-name" id="display-name" class="form-control" value="{{ old('display-name')}}">
                </div>
                <div class="col-6 col-md-7 pt-2">
                    <input class="" type="checkbox" value="1" id="opt-out" name="opt-out" {{ null !==old('opt-out') || !empty(old('opt-out')) ? 'checked': ''}}>
                    <label class="form-check-label" for="opt-out">
                        Check to opt-out (name from registration will be used)
                    </label>
                </div>
                @error('display-name')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>
            <button type="submit" id="create-submit" class="btn btn-dark">
                Create
            </button>
        </form>
    </div>
    
</div>

@endsection

@section('page-script')
<script>
    document.querySelector('#opt-out').onchange = function() {
        var nameInput = document.querySelector('#display-name');
        nameInput.disabled = this.checked;
    }

    function onloadCheckbox() {
        console.log('onload event')
        var checked = document.querySelector('#opt-out');
        var nameInput = document.querySelector('#display-name');
        console.log(checked + " "+ nameInput);
        nameInput.disabled = this.checked;
    }
    // var optOut = document.querySelector('#opt-out'); // checkbox 
    // var nameInput = document.querySelector('#display-name'); // input
    // console.log(nameInput);
    // console.log(optOut);
    // optOut.addEventListener("change", function() {
    //     console.log('change');
    //     disableInput(this.checked);
    // })
    // function disableInput(btn) {
    //     console.log(btn);
    //     document.querySelector('#display-name').disabled = !this;
    // }
    // window.onload(disableInput(optOut));

    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
      onloadCheckbox(); 
    });
</script>
<script>
    function displayIdolName() {
        var values = $("#idols").val();
        // cconsole.log(values);
        var idols = JSON.parse("<?php echo addslashes($idolsMin); ?>");
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
    if ($("#idols").val().length > 0) {
        displayIdolName();
    }
    document.querySelector("#idols").addEventListener("change", function() {
        displayIdolName()
    });
</script>
@endsection