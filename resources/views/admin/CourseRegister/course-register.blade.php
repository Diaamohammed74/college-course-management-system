@extends('admin.layout.app')

@section('PageHeader')
    Register-Course
@endsection

@section('PageTitle')
    Register-Course
@endsection

@section('content')
    @include('admin.layout.messages')
    <form action="{{ route('coursess/register') }}" method="POST">
        @csrf
        <div class="form-group">
            <div class="col-md-4">
                <label for="department_id">Department</label>
                <select class="form-control @error('department_id')
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
                <select class="form-control @error('course_id')
                is-invalid
            @enderror"
                    name="course_id" id="course">
                    <option value='0' disabled selected>Choose Course</option>
                </select>
                @error('course_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="student">Student:</label>
                <select class="form-control @error('student_id')
                is-invalid
            @enderror"
                    name="student_id" id="student">
                    <option value='0' disabled selected>Choose student</option>
                </select>
                @error('student_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div id="res">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary form-control">Register</button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <a href="{{route('courses.register.form')}}" class="btn btn-secondary form-control" role="button" aria-pressed="true">Reset table</a>
            </div>
        </div>
    </form>
    @include('admin.scripts.courses')
    @include('admin.scripts.students')
@endsection
