@extends('layouts.admin')

@section('content')
<nav class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="home" aria-expanded="true">Profile</a>
    <a class="nav-item nav-link" id="nav-notes-tab" data-toggle="tab" href="#nav-notes" role="tab" aria-controls="notes" aria-expanded="false">Notes</a>
    <a class="nav-item nav-link" id="nav-auditlog-tab" data-toggle="tab" href="#nav-auditlog" role="tab" aria-controls="auditlog" aria-expanded="false">Audit Log</a>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade active show" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" aria-expanded="true">
        <div class="col-sm-12">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="form-horizontal">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                @include('partials._input', ['key' => 'name', 'label' => 'Name', 'value' => $user->name])
                @include('partials._input', ['key' => 'email', 'label' => 'E-Mail Address', 'value' => $user->email])

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save fa-fw"></i>
                    Save Changes
                </button>
            </form>
            <br />
        </div>
    </div>
    <div class="tab-pane fade" id="nav-notes" role="tabpanel" aria-labelledby="nav-notes-tab" aria-expanded="false">
        <notes id="{{ $user->id }}" product="user"></notes>
    </div>
    <div class="tab-pane fade" id="nav-auditlog" role="tabpanel" aria-labelledby="nav-auditlog-tab" aria-expanded="false">

    </div>
</div>
@endsection
