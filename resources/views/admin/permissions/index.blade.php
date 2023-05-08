@extends('adminlte::page')

@section('title', __('Permissions'))

@section('content_header')
    <h1>
        {{ __('Permissions') }}
        <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    </h1>

@stop

@section('content')
    @include('admin.includes.alert')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('List of') }} {{ __('Permissions') }}</h3>
            <div class="card-tools">
                {!! $permissions->links() !!}
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th style="width: 50%">{{ __('Name') }}</th>
                    <th style="width: 50%">{{ __('Guard Name') }}</th>
                    <th style="width:120px">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->guard_name }}</td>
                        <td>
                            <form class="form-inline" action="{{ route('admin.permissions.destroy', $permission->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn text-red border"><i class="fa fa-times"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
