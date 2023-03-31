@extends('admin.layout.app')

@section('PageHeader')
    View-Courses
@endsection

@section('PageTitle')
    View-Courses
@endsection

@section('content')
    <div class="col-md-6">
        <div class="form-group">
            <label for="filter">Filter:</label>
            <form action="{{ route('courses') }}" method="GET">
                <div class="row">
                    <div class="col-sm-4">
                        <select class="form-control" name="department">
                            <option value="">By Department</option>
                            @foreach ($departments as $department)
                                <option value={{ $department->id }}
                                    {{ $departmentFilter == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control" name="credit">
                            <option value="">By Credit Hours</option>
                            @foreach ($creditHours as $creditHour)
                                <option value="{{ $creditHour }}" {{ $creditFilter == $creditHour ? 'selected' : '' }}>
                                    {{ $creditHour }} Hours
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('courses') }}" class="btn btn-default">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('admin.layout.messages')
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
                            <th>Course Name</th>
                            <th>Department</th>
                            <th>Full Mark</th>
                            <th>Credit Hours</th>
                            <th>No.Students</th>
                            <th>Lecturer</th>
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
                                    {{ $course->department->name }}
                                </td>
                                <td>{{ $course->full_mark }}</td>
                                <td>{{ $course->credit_hours }}</td>
                                <td>{{ $course->student->count() }}</td>
                                <td>
                                    @if ($course->teacher->count() > 0)
                                        @foreach ($course->teacher as $teacher)
                                            @if ($teacher->designation == 'doctor')
                                                <span style="color: blue">
                                                    <b>Doctor:</b>
                                                </span>
                                                {{ $teacher->name }}
                                                @if ($teacher->status == 'disable')
                                                    <span style="color: red">Lecturer Disabled</span>
                                                @endif
                                                <br>
                                            @elseif($teacher->designation == 'assistant')
                                                <span style="color: blue">
                                                    <b> Assistant:</b>
                                                </span>
                                                {{ $teacher->name }}
                                                <br>
                                                @if ($teacher->status == 'disable')
                                                    <span style="color: red">Lecturer Disabled</span>
                                                @endif
                                            @endif
                                        @endforeach
                                    @else
                                        Not Assigned Yet
                                    @endif
                                </td>
                                @cannot('is_college_advisor')
                                    <td>
                                        <div class="btn-group manage-button" title="Group Management">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('course/edit', $course->id) }}">
                                                    <i class="fas fa-edit"></i> Update
                                                </a>
                                                <form action="{{ route('course/delete', $course->id) }}" method="POST"
                                                    class="delete-form">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="dropdown-item delete-button">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                @endcannot
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
            </div>

            <!-- /.card-body -->
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $courses->links() }}
        </div>
    </div>
@endsection
