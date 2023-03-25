@extends('admin.layout.app')

@section('PageHeader')
@foreach ($students as $student )
    Top 10 Students <span style="color: red;"> {{$student->department->name}} {{$student->level->name}} </span>
@endforeach
@endsection
@section('PageTitle')
    Top 10 Students 
@endsection
@section('content')
    @include('admin.layout.messages')
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Total Grade</th>
                            <th>Status</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>
                                    @if($student->total_courses_grades>0)
                                    {{$student->total_courses_grades}}
                                    @else
                                    0
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
                                <td colspan="11">
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
