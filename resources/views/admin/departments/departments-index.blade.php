@extends('admin.layout.app')

@section('PageHeader')
    View-Departments
@endsection

@section('PageTitle')
    View-Departments
@endsection

@section('content')
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
                            <th>Department Name</th>
                            <th>Departments Head</th>
                            @can('is_super_admin')
                            <th>Manage</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($departments as $department)
                            <tr>
                                <td>1</td>
                                <td>{{ $department->name }}</td>
                                <td style="color: blue">
                                    {{$department->user->name}}
                                </td>
                                @can('is_super_admin')
                                <td>
                                    <div class="btn-group manage-button" title="Group Management">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{route('department/edit',$department->id)}}">
                                                <i class="fas fa-edit"></i> Update
                                            </a>
                                            <form action="{{route('department/delete',$department->id)}}" method="POST" class="delete-form">
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
                                <td colspan="5">
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
                    {{-- {!! $departments->links() !!} --}}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
