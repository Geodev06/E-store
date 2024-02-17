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


        #product-preview {
            margin-top: 5px;
            width: auto;
            height: auto;
            overflow: hidden;

        }

        #product-preview img {
            max-width: 100%;
            max-height: 200px;
        }

        #edit-product-preview {
            margin-top: 5px;
            width: auto;
            height: auto;
            overflow: hidden;
        }

        #edit-product-preview img {
            max-width: 100%;
            max-height: 200px;
        }

        #product-img-preview {
            max-width: 100%;
            max-height: 800px;
        }
        .textarea-x {
            width: 100%;
            min-height: 100px;
            /* Set a minimum height */
            resize: vertical;
            /* Allow vertical resizing only */
        }

        /* Optionally, you can adjust the label width for consistency */
        .label-x {
            width: 100%;
        }

        .table-img {
            max-height: 100px;
            max-width: 100px;

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
                                        <button class="btn btn-dark" id="btn-add-product">Add Product</button>
                                    </div>
                                    <div class="col-lg-12">

                                        <table class="table align-items-center justify-content-center mb-0" id="table-product">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th width="20%" class="text-secondary text-xs font-weight-semibold opacity-7">Cover photo</th>
                                                    <th width="20%" class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Product Name</th>
                                                    <th width="15%" class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Category</th>
                                                    <th width="10%" class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Price</th>
                                                    <th width="10%" class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Date created</th>
                                                    <th width="15%" class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Status</th>

                                                    <th width="10%" class="text-center text-secondary text-xs font-weight-semibold opacity-7">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="data "></tbody>
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

    @include('product.modal_add_product')
    @include('product.modal_edit_product')
    @include('product.modal_delete_product')
    @include('product.modal_view_product')


    <!--   Core JS Files   -->
    @include('partials.core_js')
    <script>
        let columns = [{
                data: 'photo',
                name: 'photo'
            }, {
                data: 'name',
                name: 'name'
            },
            {
                data: 'category_ids',
                name: 'category_ids'
            },
            {
                data: 'price',
                name: 'price'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },

            {
                data: 'active_flag',
                name: 'active_flag'
            }, {
                data: 'action',
                name: 'action'
            },

        ]

        var tbl = loadTable('#table-product', "{{ route('product_table') }}", columns)

        const fileInput = document.getElementById('product-input');
        const imagePreview = document.getElementById('product-preview');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    imagePreview.innerHTML = '';
                    imagePreview.appendChild(img);
                }
                reader.readAsDataURL(file);
            } else {
                imagePreview.innerHTML = 'No image selected';
            }
        });

        const editfileInput = document.getElementById('edit-product-input');
        const editimagePreview = document.getElementById('edit-product-preview');

        editfileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    editimagePreview.innerHTML = '';
                    editimagePreview.appendChild(img);
                }
                reader.readAsDataURL(file);
            } else {
                editimagePreview.innerHTML = 'No image selected';
            }
        });





        $(document).ready(function() {

            turn_selectize('#category_ids')
            var selectize = $('#category_ids')[0].selectize;
            var selectedValues = selectize.getValue();

            turn_selectize('#edit_category_ids')
            var edit_selectize = $('#edit_category_ids')[0].selectize;

            $('#btn-add-product').click(function(e) {
                $('.label_error').text('')
                $('#product-input').val('');
                imagePreview.innerHTML = ''
                $('#modal_add_product').modal('show')

                selectize.clear()

            })


            $('#add_product_form').on('submit', function(e) {
                e.preventDefault()
                // Create FormData object
                var formData = new FormData(this);
                formData.append('category_ids', selectedValues);

                // Perform AJAX request
                $.ajax({
                    url: "{{ route('product.store') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('.label_error').text('')
                        $('#btn-save').attr('disabled', 'disabled')
                    },
                    success: function(response) {
                        if (response.status === 400) {
                            $.each(response.errors, function(field, messages) {
                                $('.error_' + field).text(messages[0])
                            });
                        }

                        if (response.status === 200) {

                            showToast(response.message, 1)
                            $('#add_product_form')[0].reset();
                            selectize.clear();
                            $('#modal_add_product').modal('hide')
                            tbl.reload()

                        }
                        $('#btn-save').removeAttr('disabled')
                    },
                    error: function(xhr, status, error) {
                        $('#btn-save').removeAttr('disabled')
                    }
                });

            })




            $('#table-product tbody').on('click', '.btn-edit', function(e) {
                var p_id = $(this).data('id');
                var url = "{{ route('product.get', ':id') }}";

                $.ajax({
                    url: url.replace(':id', p_id),
                    type: 'GET',
                    beforeSend: function() {
                        $('.label_error').text('');
                    },
                    success: function(response) {
                        edit_selectize.setValue(response.category_ids.split(","));

                        const fileInput = document.getElementById('edit-product-input');
                        const imagePreview = document.getElementById('edit-product-preview');

                        // Constructing the image path in JavaScript
                        var img_path = "{{ asset(':value') }}".replace(':value', response.photo);

                        const img = document.createElement('img');
                        img.src = img_path;
                        imagePreview.innerHTML = '';
                        imagePreview.appendChild(img);

                        $('#edit_product_form').attr('data-id', response.id);

                        $('#product_name').val(response.name)
                        $('#product_description').val(response.description)
                        $('#price').val(response.price)
                        var f = response.file.replace("uploads/books_files/", "")

                        $('#file-view').val(f)
                        response.active_flag == 'Y' ? $("#active_y").prop("checked", true) : $("#active_n").prop("checked", true)
                        $('#modal_edit_product').modal('show');
                    },
                    error: function(xhr, status, error) {
                        showToast(error, 2);
                    }
                });
            });

            $('#edit_product_form').on('submit', function(e) {
                e.preventDefault()
                // Create FormData object
                var formData = new FormData(this);
                formData.append('edit_category_ids', selectedValues);

                var url = "{{ route('product.update',':id') }}";
                // Perform AJAX request
                $.ajax({
                    url: url.replace(':id', $(this)[0].dataset.id),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('.label_error').text('')
                        $('#btn-save').attr('disabled', 'disabled')
                    },
                    success: function(response) {
                        if (response.status === 400) {
                            $.each(response.errors, function(field, messages) {
                                $('.error_' + field).text(messages[0])
                            });
                        }

                        if (response.status === 200) {

                            showToast(response.message, 1)
                            $('#edit_product_form')[0].reset();
                            edit_selectize.clear();
                            $('#modal_edit_product').modal('hide')
                            tbl.reload()

                        }
                        $('#btn-save').removeAttr('disabled')
                    },
                    error: function(xhr, status, error) {
                        $('#btn-save').removeAttr('disabled')
                    }
                });

            })

            $('#table-product tbody').on('click', '.btn-delete', function(e) {
                var id = $(this).data('id');
                let link = "{{ route('product.get',':id') }}"
                getRequest(link.replace(':id', id), function(response) {
                    $('.label_error').text('')
                    $('#lbl_product').text(response.name)

                    $('#delete_id').val(id)
                    $('#modal_delete_product').modal('show')
                    console.log(response)

                }, function(xhr, status, error) {
                    showToast(error, 2)
                });
            });

            $('#btn-delete-product').click(function(e) {

                var delete_id = $('#delete_id').val()
                var delete_link = "{{ route('product.delete',':id') }}"
                deleteRequest(delete_link.replace(':id', delete_id), function(response) {
                    // console.log(response)
                    $('#modal_delete_product').modal('hide')
                    tbl.reload()
                    showToast(response.msg, 1)

                }, function(xhr, status, error) {
                    showToast(error, 2)
                });
            })

        })
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Corporate UI Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/corporate-ui-dashboard.min.js?v=1.0.0"></script>
</body>

</html>