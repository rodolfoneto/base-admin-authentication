@extends('adminlte::page')

@section('title', __('Users'))

@section('content_header')
    <h1>{{ __('Create a new') }} {{ __('User') }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>{{ __('Basic Information') }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="post" class="form">
                @csrf

                <div class="row">
                    <x-adminlte-input type="text"
                                      name="name"
                                      label="{{ __('Name') }}"
                                      value="{{ old('name') }}"
                                      fgroup-class="col-md-12"/>
                </div>

                <div class="row">
                    <x-adminlte-input type="email"
                                      name="email"
                                      label="Email"
                                      value="{{ old('email') }}"
                                      fgroup-class="col-md-12"/>
                </div>

                <div class="row">
                    <x-adminlte-input type="password"
                                      name="password"
                                      label="{{ __('Password') }}"
                                      fgroup-class="col-md-12"/>
                </div>

                <div class="row">
                    <x-adminlte-input type="password"
                                      name="password_confirmation"
                                      label="{{ __('Password Confirmation') }}"
                                      fgroup-class="col-md-12"/>
                </div>

                <x-adminlte-button theme="primary" type="submit" label="{{ __('Save') }}" icon="fas fa-save"/>
            </form>
        </div>
    </div>
@stop
