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
                        <h5>Completed Credit Hours : {{ $students->total_completed_hours }}</h5>
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
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Full Mark</th>
                            <th>Degree</th>
                            <th>Grade</th>
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
                                <td>{{ $course->full_mark }}</td>
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
                                            <form action="{{ route('result/update',[$student->id, $course->id]) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="text" id="degree" class="form-control"
                                                        name="new_degree" placeholder="Enter New degree ">
                                                        @error('new_degree')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
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
                                            <form action="{{ route('result/store2',[$student->id, $course->id]) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="text" id="degree" class="form-control"
                                                        name="degree" placeholder="Enter degree ">
                                                        @error('degree')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
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
                                    <form action="{{ route('register/delete', [$students->id, $course->id]) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger delete-button">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
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
            </div>
            @if ($student->course()->onlyTrashed()->count() > 0)
            <div class="col-12">
                <div class="card">     
                    <div class="card-header">
                        <h5><span style="color: red">Disabled Courses</span></h5>
                    </div>       
            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Full Mark</th>
                            <th>Degree</th>
                            <th>Grade</th>
                            <th>Credit Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($student->course as $course)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->full_mark }}</td>
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
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
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
        @endif
        <script>
            $(document).ready(function() {
                // When the button is clicked, show the modal window
                $('button[data-target="#myModal"]').click(function() {
                    $('#myModal').modal('show');
                });
            });
        </script>
        @if ($errors->any())
        <script>
            $(document).ready(function(){
                $('#myModal{{ $course->id }}').modal('show');
            });
        </script>
    @endif
    @endsection