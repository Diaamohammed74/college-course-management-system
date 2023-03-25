<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 Create PDF File using DomPDF Tutorial - LaravelTuts.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
        <p>{{$department_name}} Doctors</p>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Department</th>
            <th>Course</th>
        </tr>
        @foreach($teachers as $teacher)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->department->name }}</td>
                <td>{{ $teacher->course->name }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>