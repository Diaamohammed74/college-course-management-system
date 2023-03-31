@extends('admin.layout.app')

@section('PageHeader')
    View-Disabled Courses
@endsection

@section('PageTitle')
    View-Courses
@endsection

@section('content')
@include('admin.layout.messages')
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
                            <th>Course Name</th>
                            <th>Department</th>
                            <th>Full Mark</th>
                            <th>Credit Hours</th>
                            <th>Doctor</th>
                            @cannot('is_college_advisor')
                            <th>Manage</th>
                            @endcannot
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                            <tr>
                                <td>{{ $courses->firstItem() + $loop->index }}</td>
                                <td>{{ $course->name }}</td>
                                <td style="color: blue">
                                    {{$course->department->name}}
                                </td>
                                <td>{{ $course->full_mark }}</td>
                                <td>{{ $course->credit_hours }}</td>
                                <td>
                                    @if ($course->teacher->count()>0)
                                    @foreach ($course->teacher as $teacher)
                                    {{$teacher->name }}<br>
                                    @endforeach
                                    @else
                                    Not Assigned Yet
                                    @endif
                                </td>
                                @cannot('is_college_advisor')
                                <td>
                                            <form action="{{route('course/restore',$course->id)}}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-sync-alt"></i> Restore
                                                </button>
                                            </form>
                                </td>
                                @endcannot
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
            </div>
            <!-- /.card-body -->
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $courses->links() }}
        </div>
    </div>
@endsection
