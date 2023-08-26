@extends('welcome')
@section('content')

<div class="row justify-content-center x-container">
    <div class="col-12">
        <h1 class="x-title">Config</h1>
    </div>
    <div class="col-12 col-sm-2">
        <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list" href="/admin/config/general" role="tab" aria-controls="list-home">General</a>
            <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile">Profile</a>
            <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list" href="#list-messages" role="tab" aria-controls="list-messages">Messages</a>
            <a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="list-settings">Settings</a>
        </div>
    </div>
    <div class="col-12 col-sm-10">
        <div class="tab-content" id="nav-tabContent" style="background-color:Red;">
            <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">@yield('content')</div>
            <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">Load section via ajax</div>
            <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">asdfas</div>
            <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">Load section via ajax</div>
        </div>
        
        <div class="x-config-control d-flex justify-content-end mt-1">
            <button type="button" class="btn btn-secondary">Save</button>
        </div>
    </div>
</div>
<script src="{{ asset('/js/app.js') }}"></script>
<script>
    // $('.x-container').xconfig();
</script>
@endsection