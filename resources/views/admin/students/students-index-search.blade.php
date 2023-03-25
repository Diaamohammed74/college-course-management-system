@extends('admin.layout.app')

@section('PageHeader')
    View-Students
@endsection

@section('PageTitle')
    View-Students
@endsection
@section('content')

    @include('admin.layout.messages')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <form action="{{ route('student/search') }}" method="GET">
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
                            <th>Level</th>
                            <th>Total Grade</th>
                            <th>Status</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->phone }}</td>
                                <td style="color: blue">
                                    {{ $student->department->name }}
                                </td>
                                <td style="color: blue">
                                    {{ $student->level->name }}
                                </td>
                                <td>
                                    @if($student->total_courses_grades>0)
                                    {{($student->total_courses_grades/$student->total_enrolled_courses_marks)*100}} %
                                    @else
                                    ــ
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <span style="width: 90px; height: 40px; font-size: 15px;"
                                        class="d-inline p-2 badge text-center badge-{{ $student->status == 'grad' ? 'success' : 'danger' }}">
                                        {{ $student->status }}
                                    </span>
                                </td>

                                <td>
                                    <div class="btn-group manage-button" title="Group Management">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('schedule/view', $student->id) }}">
                                                <i class="fas fa-user"></i> Academic Profile
                                            </a>
                                            <a class="dropdown-item" href="{{ route('student/edit', $student->id) }}">
                                                <i class="fas fa-edit"></i> Update
                                            </a>
                                            <form action="{{ route('student/delete', $student->id) }}" method="POST"
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
                    {{-- {!! $students->links() !!} --}}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
