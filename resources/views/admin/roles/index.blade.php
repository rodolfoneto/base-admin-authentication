@extends('adminlte::page')

@section('title', __('Roles'))

@section('content_header')
    <h1>{{ __('Roles') }} <a href="{{ route('admin.roles.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    </h1>

@stop

@section('content')
    @include('admin.includes.alert')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('List of') }} {{ __('Roles') }}</h3>
            <div class="card-tools">
                {!! $roles->links() !!}
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th style="width: 40%">{{ __('Name') }}</th>
                    <th style="width: 40%">{{ __('Guard Name') }}</th>
                    <th style="width:120px">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->guard_name }}</td>
                        <td>
                            <form class="form form-inline" action="{{ route('admin.roles.destroy', $role->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a class="btn text-blue" href="{{ route('admin.roles.show', $role->id) }}"><i
                                        class="fas fa-edit"></i></a>
                                <button type="submit" class="btn text-red"><i class="fa fa-times"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
