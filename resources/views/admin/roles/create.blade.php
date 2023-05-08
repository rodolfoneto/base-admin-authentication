@extends('adminlte::page')

@section('title', __('Roles'))

@section('content_header')
    <h1>{{ __('Create a new') }} {{ __('Role') }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>{{ __('Basic Information') }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.roles.store') }}" method="post" class="form">
                @csrf

                <div class="row">
                    <x-adminlte-input type="text"
                                      name="name"
                                      label="{{ __('Name') }}"
                                      value="{{ old('name') }}"
                                      fgroup-class="col-md-12"/>
                </div>

                <x-adminlte-button theme="primary" type="submit" label="{{ __('Save') }}" icon="fas fa-save"/>
            </form>
        </div>
    </div>
@stop
