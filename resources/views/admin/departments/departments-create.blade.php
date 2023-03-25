@extends('admin.layout.app')

@section('PageHeader')
    Add-Department
@endsection

@section('PageTitle')
    Add-Department
@endsection

@section('content')
    <div class="p-1">
        <a href="#" class="btn btn-outline-primary col-2" role="button" aria-pressed="true">Back to
            Departments</a>
    </div>
    @include('admin.layout.messages')

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Create Department</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{route('department/store')}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-12">Department Name</label>
                    <div class="col-10">
                        <input type="text" name='name'
                            class="form-control @error('name')
                    is-invalid
                @enderror"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-10">
                        <label class="col-12">Department Head</label>
                        <select
                            class="form-control @error('department_head')
                        is-invalid
                    @enderror"
                            name="department_head" id="department_head">
                            <option value='0' disabled selected>Choose Department Head</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if (old('department_head') == $user->id) selected @endif>
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('department_head')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Create</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection
