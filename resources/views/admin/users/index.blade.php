@extends('adminlte::page')

@section('title', __('Users'))

@section('content_header')
    <h1>{{ __('Users') }} <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    </h1>

@stop

@section('content')
    @include('admin.includes.alert')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('List of') }} {{ __('Users') }}</h3>
            <div class="card-tools">
                {!! $users->links() !!}
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th style="width: 50%">{{ __('Name') }}</th>
                    <th>Email</th>
                    <th style="width:120px">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form class="form form-inline" action="{{ route('admin.users.destroy', $user->id) }}"
                                  method="post">
                                @csrf
                                @method('DELETE')
                                <div class="form-group clearfix">
                                    <a class="btn text-blue" href="{{ route('admin.users.edit', $user->id) }}"><i
                                            class="fas fa-edit"></i></a>
                                    <button type="submit" class="btn text-red"
                                            href="{{ route('admin.users.edit', $user->id) }}"><i
                                            class="fas fa-user-times"></i></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@stop
