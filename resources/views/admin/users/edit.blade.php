@extends('adminlte::page')

@section('title', __('User'))

@section('content_header')
    <h1>{{ __('Edit') }} {{ $user->name }}</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('admin.users.update', $user->id) }}" method="post" class="form">
            @csrf
            @method('put')
            <div class="card-header">
                <h5>{{ __('Basic Information') }}</h5>
            </div>
            <div class="card-body">
                    @include('admin.users.includes.form')
            </div>
            <div class="card-footer">
                <x-adminlte-button theme="primary" type="submit" label="{{ __('Save') }}" icon="fas fa-save"/>
            </div>
        </form>
    </div>
@stop
