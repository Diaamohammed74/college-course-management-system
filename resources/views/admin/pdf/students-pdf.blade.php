<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 Create PDF File using DomPDF Tutorial - LaravelTuts.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>level</th>
        </tr>
        @foreach($students as $student)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->level->name }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>