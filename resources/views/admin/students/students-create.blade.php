@extends('admin.layout.app')

@section('PageHeader')
    Add-Student
@endsection

@section('PageTitle')
    Add-Student
@endsection

@section('content')
    <div class="p-1">
        <a href="#" class="btn btn-outline-primary col-2" role="button" aria-pressed="true">Back to
            Students</a>
    </div>
    @include('admin.layout.messages')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add Student</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{route('student/store')}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="name">Student Name</label>
                        <input type="text" name='name'
                            class="form-control @error('name')
                    is-invalid
                @enderror"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="email">Student Email</label>
                        <input type="text" name='email'
                            class="form-control @error('email')
                    is-invalid
                @enderror"
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="phone">Student Phone</label>
                        <input type="phone" name='phone'
                            class="form-control @error('phone')
                    is-invalid
                @enderror"
                            value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="department_id">Department</label>
                        <select
                            class="form-control @error('department_id')
                            is-invalid
                        @enderror"
                            name="department_id" id="department_id">
                            <option value='0' disabled selected>Choose Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="level">Choose Level</label>
                        <select
                            class="form-control @error('level')
                            is-invalid
                        @enderror"
                            name="level_id" id="level">
                            <option value='0' disabled selected>Choose level</option>
                        </select>
                        @error('level')
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
