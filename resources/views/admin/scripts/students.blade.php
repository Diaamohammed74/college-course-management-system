    {{-- Start Script --}}

    <script>
        $(function() {
            $('#department_id').on('change', function() {
                var departmentId = $(this).val();
                if (departmentId) {
                    $.ajax({
                        url: '{{ route('students/get') }}',
                        type: 'GET',
                        data: {
                            'department_id': departmentId
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('#student').empty();
                            $('#student').append($('<option>').text('Choose student')
                                .attr('value', ''));
                            $.each(data, function(key, value) {
                                $('#student').append($('<option>').text(value.id)
                                    .attr('value', value.id));
                            });
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                } else {
                    $('#student').empty();
                    $('#student').append($('<option>').text('Choose student').attr('value', ''));
                }
            });
        });

        </script>
        <script>
        $(document).ready(function() {

            // Initialize select2
            $("#student").select2();

            // Read selected option
            $('#but_read').click(function() {
                var username = $('#student option:selected').text();
                var userid = $('#student').val();

                $('#result').html("id : " + userid + ", name : " + username);

            });
        });
        $(document).ready(function() {
            $("#title").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '{{ route('autocomplete') }}',
                        data: {
                            term: request.term
                        },
                        dataType: "json",
                        success: function(data) {
                            var resp = $.map(data, function(obj) {
                                return obj.title;
                            });
                            response(resp);
                        }
                    });
                },
                minLength: 2
            });
        });
    </script>
