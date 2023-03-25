@extends('admin.layout.app')
@section('PageHeader')
    Update-Required-Hours
@endsection
@section('PageTitle')
    Update-Required-Hours
@endsection
@section('content')
@include('admin.layout.messages')
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Required Hours For Graduate</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('required_hours/update')}}">
                    @csrf
                    <div class="form-group">
                        <label for="required_hours">Required Hours</label>
                        <input type="number" class="form-control @error('required_hours')
                            is-invalid
                        @enderror"
                        id="required_hours" name="required_hours" value="{{ $required_hours }}">
                    </div>
                    @error('required_hours')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection



