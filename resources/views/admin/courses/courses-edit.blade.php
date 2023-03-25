@extends('admin.layout.app')

@section('PageHeader')
    Edit-Course
@endsection

@section('PageTitle')
    Edit-Course
@endsection

@section('content')
    <div class="p-1">
        <a href="#" class="btn btn-outline-primary col-2" role="button" aria-pressed="true">Back to
            Courses</a>
    </div>
    @include('admin.layout.messages')

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Edit Course</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{route('course/update',$course->id)}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name">Course Name</label>
                        <input type="text" name='name'
                            class="form-control @error('name')
                    is-invalid
                @enderror"
                            value="{{$course->name}}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="department_id">Department</label>
                        <select
                            class="form-control @error('department')
                        is-invalid
                    @enderror"
                            name="department_id" id="department_id">
                            <option value='0' disabled selected>Choose Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" @if ($course->department_id == $department->id) selected @endif>
                                    {{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="full_mark">Full Mark</label>
                        <input type="number" name='full_mark'
                            class="form-control @error('full_mark')
                is-invalid
            @enderror"
                            value="{{ $course->full_mark }}">
                        @error('full_mark')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="credit_hours">Credit Hours</label>
                        <input type="number" name='credit_hours'
                            class="form-control @error('credit_hours')
                is-invalid
            @enderror"
                            value="{{ $course->credit_hours }}">
                        @error('credit_hours')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="name">Course Description</label>
                        <textarea class="form-control @error('description')
                        is-invalid
                    @enderror"
                            name="description" class="summernote" id="summernote">{{ $course->description }}</textarea>
                        @error('description')
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
