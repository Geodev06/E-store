<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.meta')
    @include('partials.head')
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/corporate-ui-dashboard.css?v=1.0.0" rel="stylesheet" />

    <style>
        /* Adjust the size of pagination buttons */
        .pagination .page-link {
            padding: .3rem .6rem;
            /* Adjust padding as needed */
            font-size: 0.60rem;
            /* Adjust font size as needed */

        }

        /* Prevent text overflow */
        .pagination .page-link {
            white-space: nowrap;
            /* Prevent text wrapping */
            color: black;
            background-color: gainsboro;
            outline: unset;
            overflow: hidden;
            /* Hide overflow text */
            text-overflow: ellipsis;
            /* Display ellipsis (...) for overflow text */
        }

        .data td {
            max-width: 100px;
            /* Adjust this value as needed */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

    @include('partials.datatables')
</head>

<body class="g-sidenav-show  bg-gray-100">
    @include('partials.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('partials.nav')
        <!-- End Navbar -->
        <div class="container-fluid py-4 px-5">
            @include('partials.admin-banner')
            <hr class="my-0">

            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="col-12 my-2">
                        <div class="card shadow-xs border mb-4 pb-3">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button class="btn btn-dark" id="btn-add-category">Add Category</button>
                                    </div>
                                    <div class="col-lg-12">
                                        <table class="table align-items-center justify-content-center mb-0" id="table-category">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th width="30%" class="text-secondary text-xs font-weight-semibold opacity-7">Category</th>
                                                    <th width="40%" class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Description</th>
                                                    <th width="20%" class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Date created</th>
                                                    <th width="10%" class="text-center text-secondary text-xs font-weight-semibold opacity-7">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="data"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('partials.admin-footer')
        </div>
    </main>

    @include('category.modal_add_category')
    @include('category.modal_edit_category')
    @include('category.modal_delete_category')


    <!--   Core JS Files   -->
    @include('partials.core_js')
    <script>
        let columns = [{
                data: 'category',
                name: 'category'
            }, {
                data: 'category_description',
                name: 'category_description'
            }, {
                data: 'created_at',
                name: 'created_at'
            }, {
                data: 'action',
                name: 'action'
            },

        ]

        var tbl = loadTable('#table-category', "{{ route('category_table') }}", columns)
        $(document).ready(function() {

            $('#btn-add-category').click(function(e) {
                $('.label_error').text('')

                $('#modal_add_category').modal('show')
            })

            $('#add_category_form').on('submit', function(e) {
                e.preventDefault()
                var formData = $(this).serialize();
                const url = "{{ route('category.store') }}"

                function beforeSend() {
                    $('.label_error').text('')
                    $('#btn-save').attr('disabled', 'disabled')
                }

                function successCallback(response) {
                    if (response.status === 400) {
                        $.each(response.errors, function(field, messages) {
                            $('.error_' + field).text(messages[0])
                        });
                    }

                    if (response.status === 200) {

                        showToast(response.message, 1)
                        $('#add_category_form')[0].reset();
                        $('#modal_add_category').modal('hide')
                        tbl.reload()

                    }
                    $('#btn-save').removeAttr('disabled')

                }

                function errorCallback(response) {
                    $('#btn-save').removeAttr('disabled')
                }
                sendPostRequest(url, formData, beforeSend, successCallback, errorCallback)
            })

            $('#edit_category_form').on('submit', function(e) {
                e.preventDefault()
                var formData = $(this).serialize();
                var url = "{{ route('category.update',':id') }}"


                function beforeSend() {
                    $('.label_error').text('')
                    $('#btn-save').attr('disabled', 'disabled')
                }

                function successCallback(response) {
                    if (response.status === 400) {
                        $.each(response.errors, function(field, messages) {
                            $('.error_' + field).text(messages[0])
                        });
                    }

                    if (response.status === 200) {

                        showToast(response.message, 1)
                        $('#edit_category_form')[0].reset();
                        $('#modal_edit_category').modal('hide')
                        tbl.reload()

                    }
                    $('#btn-save').removeAttr('disabled')

                }

                function errorCallback(response) {
                    $('#btn-save').removeAttr('disabled')
                }

                sendPostRequest(url.replace(':id', $(this)[0].dataset.id), formData, beforeSend, successCallback, errorCallback)
            })
        })

        $('#table-category tbody').on('click', 'td .btn-edit', function(e) {
            var id = $(this).data('id');
            let link = "{{ route('category.get',':id') }}"
            getRequest(link.replace(':id', id), function(response) {

                $('#txt_category').val(response.category)
                $('#txt_desc').val(response.category_description)

                $('#edit_category_form').attr('data-id', id)
                $('.label_error').text('')

                $('#modal_edit_category').modal('show')

            }, function(xhr, status, error) {
                showToast(error, 2)
            });
        });

        $('#table-category tbody').on('click', 'td .btn-delete', function(e) {
            var id = $(this).data('id');
            let link = "{{ route('category.get',':id') }}"
            getRequest(link.replace(':id', id), function(response) {
                $('.label_error').text('')
                $('#lbl_category').text(response.category)

                $('#delete_id').val(id)
                $('#modal_delete_category').modal('show')

            }, function(xhr, status, error) {
                showToast(error, 2)
            });
        });

        $('#btn-delete-category').click(function(e) {
         
           var delete_id = $('#delete_id').val()
            var delete_link = "{{ route('category.delete',':id') }}"
            deleteRequest(delete_link.replace(':id', delete_id), function(response) {
                // console.log(response)
                $('#modal_delete_category').modal('hide')
                tbl.reload()
                showToast(response.msg, 1)

            }, function(xhr, status, error) {
                showToast(error, 2)
            });
        })
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Corporate UI Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/corporate-ui-dashboard.min.js?v=1.0.0"></script>
</body>

</html>