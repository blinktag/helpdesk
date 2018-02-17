@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-pie-chart fa-fw"></i>
                Tickets Per Day
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-cogs fa-fw"></i>
                Configuration
            </div>
            <div class="card-body">
                <p>
                    <a href="{{ route('admin.departments.index') }}">
                        Departments
                    </a>
                </p>
                <p class="mb0">
                    <a href="{{ route('admin.pipes.index') }}">
                        E-Mail Pipes
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
