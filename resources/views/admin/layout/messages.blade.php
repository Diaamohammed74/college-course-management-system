@if ($errors->has('email') || $errors->has('password'))
    <div class="alert alert-danger">
        Wrong Email,password
    </div>
@endif

@if (session()->has('success'))
    <script>
        swal("", "{{ Session::get('success') }}", 'success', {
            button: true,
            button: "OK",
            timer: 3000,
        });
    </script>
@elseif (session()->has('deleted'))
    <script>
        swal("", "{{ Session::get('deleted') }}", 'error', {
            button: false,
            button: "OK",
            timer: 3000,
        });
    </script>
@elseif (session()->has('error'))
    <script>
        swal("", "{{ Session::get('error') }}", 'error', {
            button: false,
            button: "OK",
            timer: 3000,
        });
    </script>
@elseif (session()->has('permission'))
    <script>
        swal("", "{{ Session::get('permission') }}", 'error', {
            button: false,
            button: "OK",
            timer: 3000,
        });
    </script>
    {{-- @elseif ($errors->any())
<script>
    swal("","{{Session::get('permission')}}",'error',{
        button:false,
        button:"OK",
        timer:3000,
    });
</script> --}}
@endif
