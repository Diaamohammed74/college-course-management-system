@extends('admin.layout.app')

@section('PageHeader')
    Edit-Faculty Member
@endsection

@section('PageTitle')
    Edit-Faculty Member
@endsection

@section('content')
    <div class="p-1">
        <a href="{{route('users')}}" class="btn btn-outline-primary col-2" role="button" aria-pressed="true">
            Show Faculty Members
        </a>
    </div>
    @include('admin.layout.messages')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Edit Faculty Member</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{route('users/update',$user->id)}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name">Member Name</label>
                        <input type="text" name='name'
                            class="form-control @error('name')
                    is-invalid
                @enderror"
                            value="{{ $user->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email">Member Email</label>
                        <input type="text" name='email'
                            class="form-control @error('email')
                    is-invalid
                @enderror"
                            value="{{ $user->email }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="type">Member Type</label>
                        <select
                            class="form-control @error('type')
                            is-invalid
                        @enderror"
                            name="type" id="type">
                            @foreach ($types as $key =>$value )
                            <option value='{{$value}}' @if ($value==$user->type)
                                selected
                            @endif>{{$key}}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="status">Member Status</label>
                        <select
                            class="form-control @error('status')
                            is-invalid
                        @enderror"
                            name="status" id="status">
                            @foreach ($status as $key =>$value )
                            <option value='{{$value}}' @if ($value==$user->status)
                                selected
                            @endif>{{$key}}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password">Member Password</label>
                        <input type="password" name='password'
                            class="form-control @error('password')
                    is-invalid
                @enderror"
                            >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name='password_confirmation'
                            class="form-control @error('password_confirmation')
                    is-invalid
                @enderror">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@include('admin.scripts.levels')
@endsection
