        {{-- Start Script --}}


        <script>
            $(function() {
                $('#department_id').on('change', function() {
                    var departmentId = $(this).val();
                    if (departmentId) {
                        $.ajax({
                            url: '{{ route('levels/get') }}',
                            type: 'GET',
                            data: {
                                'department_id': departmentId
                            },
                            dataType: 'json',
                            success: function(data) {
                                $('#level').empty();
                                $('#level').append($('<option>').text('Choose level')
                                    .attr('value', ''));
                                $.each(data, function(key, value) {
                                    $('#level').append($('<option>').text(value.name)
                                        .attr('value', value.id));
                                });
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    } else {
                        $('#level').empty();
                        $('#level').append($('<option>').text('Choose level').attr('value', ''));
                    }
                });
            });
        </script>
        
        {{-- /End Script --}}