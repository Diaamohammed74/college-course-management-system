@extends('admin.layout.app')

@section('PageHeader')
    Add-Teacher
@endsection

@section('PageTitle')
    Add-Teacher
@endsection

@section('content')
    <div class="p-1">
        <a href="#" class="btn btn-outline-primary col-2" role="button" aria-pressed="true">Back to
            Teachers</a>
    </div>
    @include('admin.layout.messages')

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add Teacher</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{route('teacher/store')}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="name">Teacher Name</label>
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
                        <label for="email">Teacher Email</label>
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
                        <label for="phone">Teacher Phone</label>
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
                        <label for="designation">Designation</label>
                        <select
                            class="form-control @error('designation')
                            is-invalid
                        @enderror"
                            name="designation" id="designation">
                            <option value='0' disabled selected>Choose Designation</option>
                            @foreach ($designations as $value => $designation)
                                <option value="{{ $value }}">{{ $designation }}</option>
                            @endforeach
                        </select>
                        @error('designation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
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
                        <label for="course">Choose Course</label>
                        <select
                            class="form-control @error('course')
                            is-invalid
                        @enderror"
                            name="course_id" id="course">
                            <option value='0' disabled selected>Choose Course</option>
                        </select>
                        @error('course')
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
@include('admin.scripts.courses')
@endsection
