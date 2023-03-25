    {{-- Start Script --}}
    <script>
        $(function() {
            $('#department_id').on('change', function() {
                var departmentId = $(this).val();
                if (departmentId) {
                    $.ajax({
                        url: '{{ route('coursess/get') }}',
                        type: 'GET',
                        data: {
                            'department_id': departmentId
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('#course').empty();
                            $('#course').append($('<option>').text('Choose course')
                                .attr('value', ''));
                            $.each(data, function(key, value) {
                                $('#course').append($('<option>').text(value.name)
                                    .attr('value', value.id));
                            });
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                } else {
                    $('#course').empty();
                    $('#course').append($('<option>').text('Choose course').attr('value', ''));
                }
            });
        });
    </script>

{{-- /End Script --}}