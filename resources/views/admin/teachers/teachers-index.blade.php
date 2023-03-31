@extends('admin.layout.app')

@section('PageHeader')
    View-Lecturers
@endsection

@section('PageTitle')
    View-Lecturers
@endsection

@section('content')
    <form action="{{ route('teachers') }}" method="GET">
        <div class="col-md-6">
            <div class="form-group">
                <label for="filter">Filter:</label>
                <div class="row">
                    <div class="col-sm-3">
                        <select class="form-control" name="department">
                            <option value="">By Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ $departmentFilter == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" name="designation">
                            <option value="">By Designation</option>
                            @foreach ($designations as $key => $value)
                                <option value={{ $value }} {{ $designationFilter == $value ? 'selected' : '' }}>
                                    {{ $key }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" name="status">
                            <option value="">By Status</option>
                            @foreach ($status as $key => $value)
                                <option value="{{ $value }}" {{ $statusFilter == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('teachers') }}" class="btn btn-info">Reset</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('teachers.pdf') }}" method="GET">
        <div class="col-md-6">
            <div class="form-group">
                <label for="pdf">Export PDF</label>
                <div class="row">
                    <div class="col-sm-3">
                        <select class="form-control" name="department">
                            <option value="">By Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" name="designation">
                            <option value="">By Designation</option>
                            @foreach ($designations as $key => $value)
                                <option value={{ $value }}>
                                    {{ $key }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" name="status">
                            <option value="">By Status</option>
                            @foreach ($status as $key => $value)
                                <option value="{{ $value }}">
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-secondary">PDF</button>
                        <a href="{{ route('teachers') }}" class="btn btn-info">Reset</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @include('admin.layout.messages')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <form action="{{ route('teachers/search') }}" method="GET">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" name="search" class="form-control float-right " placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Teach</th>
                            <th>Status</th>
                            @cannot('is_college_advisor')
                                <th>Manage</th>
                            @endcannot
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($teachers as $teacher)
                            <tr>
                                <td>{{ $teachers->firstItem() + $loop->index }}</td>
                                <td>{{ $teacher->id }}</td>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->phone }}</td>
                                <td style="color: blue">
                                    {{ $teacher->department->name }}
                                </td>
                                <td style="color: blue">
                                    {{ $teacher->designation }}
                                </td>
                                <td>
                                    @if ($teacher->course_id != null)
                                        {{ optional($teacher->course)->name ?? 'None' }}
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <span style="width: 80px; height: 40px; font-size: 18px;"
                                        class="d-inline p-2 badge text-center badge-{{ $teacher->status == 'active' ? 'success' : 'danger' }}">
                                        {{ $teacher->status }}
                                    </span>
                                </td>
                                @cannot('is_college_advisor')
                                    <td>
                                        <div class="btn-group manage-button" title="Group Management">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('teacher/edit', $teacher->id) }}">
                                                    <i class="fas fa-edit"></i> Update
                                                </a>
                                                <form action="{{ route('teacher/delete', $teacher->id) }}" method="POST"
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
                                <td colspan="10">
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
                    {!! $teachers->links() !!}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
