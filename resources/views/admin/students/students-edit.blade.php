@extends('admin.layout.app')

@section('PageHeader')
    Edit-Student
@endsection

@section('PageTitle')
    Edit-Student
@endsection

@section('content')
    <div class="p-1">
        <a href="#" class="btn btn-outline-primary col-2" role="button" aria-pressed="true">Back to
            Students</a>
    </div>
    @include('admin.layout.messages')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Edit Student</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{route('student/update',$student->id)}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="status">Status</label>
                        <select
                            class="form-control @error('status')
                            is-invalid
                        @enderror"
                            name="status" id="status">
                            <option value='0' disabled selected>Status</option>
                            @foreach ($status as $value => $status)
                                <option value="{{ $value }}" {{ $student->status == $value ? 'selected' : '' }}>
                                    {{ $status }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="department_id">Department</label>
                        <select
                            class="form-control @error('department_id')
                            is-invalid
                        @enderror"
                            name="department_id" id="department_id">
                            <option value='0' disabled selected>Choose Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{$department->id == $student->department_id?'selected':''}}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    
                    <div class="col-md-4">
                        <label for="name">Student Name</label>
                        <input type="text" name='name'
                            class="form-control @error('name')
                    is-invalid
                @enderror"
                            value="{{ $student->name }}">
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
                            value="{{ $student->email }}">
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
                            value="{{ $student->phone }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- if user -> super admin--}}
                <div class="form-group row">
                    {{-- <div class="col-md-4">
                        <label for="level">Level</label>
                        <select
                            class="form-control @error('level')
                            is-invalid
                        @enderror"
                            name="level_id" id="level" data-levels="{{ route('levels/get') }}">
                            <option value='0' disabled selected>Choose level</option>
                        </select>
                        @error('level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}
                </div>
                {{--
                    if user is admin or college advisor 
                    read only
                    --}}
                {{-- <div class="form-group row">
                    <div class="col-md-6">
                        <label for="department_id">Department</label>
                        <select
                            class="form-control @error('department_id')
                            is-invalid
                        @enderror"
                            name="department_id" id="department_id">
                            <option value='0' disabled selected>Choose Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{$department->id == $student->department_id?'selected':''}}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="level">Level</label>
                        <input type="text" id="level" name="level" 
                            class="form-control" value="{{ $student->level->name }}" readonly>
                    </div>
                </div> --}}
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
