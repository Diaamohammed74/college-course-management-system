@extends('admin.layout.app')
@section('PageHeader')
    Required-Hours
@endsection
@section('PageTitle')
    Required-Hours
@endsection
@section('content')
@include('admin.layout.messages')
    <div class="card">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Required Hours</h3>
                    </div>
                    <div class="card-body">
                        <p class="lead mb-4"><b>Required Hours For Graduate:
                            <span style="color: red">
                                {{ $required_hours }}
                            Hours
                        </span>
                        </b></p>
                        <a href="{{route('required_hours/edit')}}" class="btn btn-primary btn-lg">Update</a>
                    </div>
                </div>
            </div>
    </div>
@endsection
