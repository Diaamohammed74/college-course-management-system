@extends('admin.layout.app')

@section('PageHeader')
    View-Faculty Members
@endsection

@section('PageTitle')
    View-Faculty Members
@endsection
@section('content')
    <div class="col-md-6">
        <div class="form-group">
            <label for="filter">Filter:</label>
            <form action="" method="GET">
                <div class="row">

                    <div class="col-sm-4">
                        <select class="form-control" name="type">
                            <option value="">By type</option>
                            @foreach ($type as $key => $value)
                                <option value="{{ $value }}" {{ $typeFilter == $value ? 'selected' : '' }}>
                                    {{ $key }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control" name="status">
                            <option value="">By Status</option>
                            @foreach ($status as $key => $value)
                                <option value="{{ $value }}" {{ $statusFilter == $value ? 'selected' : '' }}>
                                    {{ $key }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('students') }}" class="btn btn-default">Reset</a>
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
                    <form action="#" method="GET">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" name="Search" class="form-control float-right " placeholder="Search">
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
                            <th>Type</th>
                            <th>Status</th>
                            @can('is_super_admin')
                            <th>Manage</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $users->firstItem() + $loop->index }}</td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td style="color: blue">
                                    @if ($user->type=='super_admin')
                                        Super Admin
                                        @elseif ($user->type=='admin')
                                        Admin
                                        @else
                                        College Advisor
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <span style="width: 90px; height: 40px; font-size: 15px;"
                                        class="d-inline p-2 badge text-center badge-{{ $user->status == 'active' ? 'success' : 'danger' }}">
                                        {{ $user->status }}
                                    </span>
                                </td>
                                @can('is_super_admin')
                                <td>
                                    <div class="btn-group manage-button" title="Group Management">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{route('users/edit',$user->id)}}">
                                                <i class="fas fa-edit"></i> Update
                                            </a>
                                            <form action="{{route('users/delete',$user->id)}}" method="POST"
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
                                @endcan
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">
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
                    {!! $users->links() !!}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
