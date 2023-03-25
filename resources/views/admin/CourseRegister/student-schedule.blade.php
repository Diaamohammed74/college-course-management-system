@extends('admin.layout.app')

@section('PageHeader')
    Student Academic Profile
@endsection

@section('PageTitle')
    Student Academic Profile
@endsection

@section('content')
    @include('admin.layout.messages')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h5>Student Name : {{ $students->name }}</h5>
                    </div>
                    <div class="col-md-4">
                        <h5>Total Credit Hours : {{ $students->total_completed_hours }}</h5>
                    </div>
                    <div class="col-md-4">
                        <h5>Student Status : {{ $students->status }}</h5>
                    </div>

                    <div class="col-md-4">
                        <h5>Student ID : {{ $students->id }}</h5>
                    </div>
                    <div class="col-md-4">
                        <h5>Remain Credit Hours : {{ $requiredHours - $students->total_completed_hours }}</h5>
                    </div>
                    <div class="col-md-4">
                        @if ($students->total_enrolled_courses_marks > 0)
                            <h5>Total Percentage
                                : {{ number_format(($students->total_courses_grades / $students->total_enrolled_courses_marks)*100,2) }}%
                            </h5>
                        @else
                            <h5>Total Percentage : {{ $students->total_courses_grades }} %</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"></h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right " placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Degree</th>

                            <th>Grade</th>
                            {{-- <th>Department</th> --}}
                            <th>Credit Hours</th>
                            <th>Result</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students->course as $course)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $course->name }}</td>
                                <td>
                                    @if ($course->pivot->course_grade != null)
                                        {{ $course->pivot->course_grade }}
                                    @else
                                        ــ
                                    @endif
                                </td>
                                <td>
                                    @if ($course->pivot->course_grade != null)
                                        @switch($course->pivot->course_grade)
                                            @case($course->pivot->course_grade >= 90)
                                                A+
                                            @break

                                            @case($course->pivot->course_grade >= 85)
                                                A
                                            @break

                                            @case($course->pivot->course_grade >= 80)
                                                B+
                                            @break

                                            @case($course->pivot->course_grade >= 75)
                                                B
                                            @break

                                            @case($course->pivot->course_grade >= 70)
                                                C+
                                            @break

                                            @case($course->pivot->course_grade >= 65)
                                                C
                                            @break

                                            @case($course->pivot->course_grade >= 60)
                                                D+
                                            @break
                                            @default
                                                F
                                        @endswitch
                                    @else
                                        ــ
                                    @endif
                                </td>
                                <td>{{ $course->credit_hours }}</td>
                                <td>
                                    @if ($course->pivot->course_grade != null)
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#myModal{{ $course->id }}">Edit Result</button>
                                <div class="modal fade" id="myModal{{ $course->id }}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit {{ $course->name }} Grade</h4>
                                            </div>
                                            <form action="{{ route('result/update') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="text" id="degree" class="form-control"
                                                        name="new_degree" placeholder="Enter New degree ">
                                                    <input type="hidden" value="{{ $course->id }}" name="course_id">
                                                    <input type="hidden" value="{{ $students->id }}" name="student_id">
                                                    <input type="hidden" value="{{ $course->pivot->course_grade}}" name="old_course_grade">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                    @else
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#myModal{{ $course->id }}">Add Result</button>
                                <div class="modal fade" id="myModal{{ $course->id }}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add {{ $course->name }} degree</h4>
                                            </div>
                                            <form action="{{ route('result/store') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="text" id="degree" class="form-control"
                                                        name="degree" placeholder="Enter degree ">
                                                        @error('degree')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    <input type="hidden" value="{{ $course->id }}" name="course_id">
                                                    <input type="hidden" value="{{ $students->id }}"
                                                        name="student_id">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group manage-button" title="Group Management">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-edit"></i> Update
                                            </a>
                                            <form action="{{ route('register/delete', [$students->id, $course->id]) }}"
                                                method="POST" class="delete-form">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="dropdown-item delete-button">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="alert alert-warning text-center" role="alert">
                                            <div>
                                                <b style="color: black"> There is no data </b>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{-- {!! $courses->links() !!} --}}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <script>
            $(document).ready(function() {
                // When the button is clicked, show the modal window
                $('button[data-target="#myModal"]').click(function() {
                    $('#myModal').modal('show');
                });
            });
        </script>
        
    @endsection
