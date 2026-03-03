<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Delhivery Pin Code Serviceability</title>
    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

    <form id="pin-code-form">
        @csrf
        <input type="text" id="pin_code" name="pin_code" placeholder="Enter Pin Code">
        <button type="submit">Check Serviceability</button>
    </form>

    <div id="result"></div>

    <script>
        $(document).ready(function () {
            $('#pin-code-form').on('submit', function (e) {
                e.preventDefault(); // Prevent form submission

                var pinCode = $('#pin_code').val();
                var token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ url('check-pin-code') }}", // Laravel route
                    type: 'POST',
                    data: {
                        pin_code: pinCode,
                        _token: token // Laravel CSRF protection
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            $('#result').html('<p>' + response.message + '</p>');
                        } else {
                            $('#result').html('<p>' + response.message + '</p>');
                        }
                    },
                    error: function (xhr) {
                        $('#result').html('<p>' + xhr.responseJSON.message + '</p>');
                    }
                });
            });
        });
    </script>

</body>
</html>
