<script>
    function sendPostRequest(url, data, beforeSend, successCallback, errorCallback) {
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            dataType: 'json',
            beforeSend: function() {
                if (beforeSend && typeof beforeSend === 'function') {
                    beforeSend();
                }
            },
            success: function(response) {
                if (successCallback && typeof successCallback === 'function') {
                    successCallback(response);
                }
            },
            error: function(xhr, status, error) {
                if (errorCallback && typeof errorCallback === 'function') {
                    errorCallback(xhr, status, error);
                }
            }
        });
    }

    function getRequest(url, successCallback, errorCallback) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                if (successCallback && typeof successCallback === 'function') {
                    successCallback(response);
                }
            },
            error: function(xhr, status, error) {
                if (errorCallback && typeof errorCallback === 'function') {
                    errorCallback(xhr, status, error);
                }
            }
        });
    }

    function deleteRequest(url, successCallback, errorCallback) {
        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (successCallback && typeof successCallback === 'function') {
                    successCallback(response);
                }
            },
            error: function(xhr, status, error) {
                if (errorCallback && typeof errorCallback === 'function') {
                    errorCallback(xhr, status, error);
                }
            }
        });
    }

    $('#btn-sign-out').on('click', function(e) {

        const url = "{{ route('user.logout') }}"

        var formData = {
            _token: "{{ csrf_token() }}"
        }

        function beforeSend() {


        }

        function successCallback(response) {

            window.location.assign("{{ route('admin.login') }}")
        }

        function errorCallback(response) {


        }

        sendPostRequest(url, formData, beforeSend, successCallback, errorCallback)
    })
</script>