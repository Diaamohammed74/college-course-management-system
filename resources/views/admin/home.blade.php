@extends('admin.layout.app')

@section('PageHeader')
    Statistics
@endsection

@section('PageTitle')
    Home
@endsection

@section('content')
    @include('admin.layout.messages')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-university"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Departments</span>
                            <span class="info-box-number">
                                {{ $departments->count() }}
                            </span>
                            <a href="{{ route('departments') }}" class="small-box-footer " style="color: black;">More info
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-book"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Courses</span>
                            <span class="info-box-number">
                                {{ $courses }}
                            </span>
                            <a href="{{ route('courses') }}" class="small-box-footer" style="color: black;">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="ion ion-person"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Doctors</span>
                            <span class="info-box-number">
                                {{ $doctors }}
                            </span>
                            <a href="{{ route('teachers') }}" class="small-box-footer" style="color: black;">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="ion ion-person"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Teacher Assistants</span>
                            <span class="info-box-number">
                                {{ $teacherAssistant }}
                            </span>
                            <a href="{{ route('teachers') }}" class="small-box-footer" style="color: black;">More info <i
                                    class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            {{-- double contents start --}}
            <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Students</span>
                            <span class="info-box-number">
                                {{ $students }}
                            </span>
                            <a href="{{ route('students') }}" class="small-box-footer" style="color: black;">
                                More info
                                <i class="fas fa-arrow-circle-right"> </i>
                                </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark elevation-1"><i class="ion ion-person"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Undergraduated Students</span>
                            <span class="info-box-number">
                                {{ $underGradStudents }}
                            </span>
                            <a href="{{ route('students/undergrad') }}" class="small-box-footer" style="color: black;">More
                                info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark elevation-1"><i class="fa fa-user-graduate"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Graduated Students</span>
                            <span class="info-box-number">
                                {{ $gradStudents }}
                            </span>
                            <a href="{{ route('students/grad') }}" class="small-box-footer" style="color: black;">More info
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div>
                    <form action="{{ route('students/bylevel') }}" method="GET">
                        <label for="">
                            <H2> Top 10 Students</H2>
                        </label>
                        <div class="form-group row" name="format">
                            <div class="col-md-2">
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
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="level">Choose Level</label>
                                <select
                                    class="form-control @error('level_id')
                            is-invalid
                        @enderror"
                                    name="level_id" id="level">
                                    <option value='0' disabled selected>Choose level</option>
                                </select>
                                @error('level_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
    </section>
    </div>
    @include('admin.scripts.levels')
@endsection
