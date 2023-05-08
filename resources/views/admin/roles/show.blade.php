@extends('adminlte::page')

@section('title', __('Role') . $role->name)

@section('content_header')
    <h1>{{ __('Role') }} {{ $role->name }}</h1>
@stop

@section('content')
    @include('admin.includes.alert')
    <div class="card">
        <form action="{{ route('admin.roles.permissions', $role->id) }}" method="post" class="form">
            @csrf
            <div class="card-header">
                <h5>{{ __('Permissions') }}</h5>
            </div>
            <div class="card-body">
                @foreach($permissions as $permission)
                    <div class="custom-control custom-checkbox">
                        <input
                            class="custom-control-input"
                            type="checkbox"
                            id="checkbox-{{ $permission->id }}"
                            name="permissions[]"
                            value="{{ $permission->id }}"
                            {{ in_array($permission->id, $permissionAssigned) ? 'checked' : '' }}>
                        <label for="checkbox-{{ $permission->id }}" class="custom-control-label">{{ $permission->name }}</label>
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <x-adminlte-button theme="primary" type="submit" label="{{ __('Save') }}" icon="fas fa-save"/>
            </div>
        </form>
    </div>
@stop
