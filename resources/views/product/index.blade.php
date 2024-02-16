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


        .product-preview {
            margin-top: 5px;
            width: auto;
            height: auto;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #product-preview img {
            max-width: 100%;
            max-height: 200px;
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
                                                    <th width="15%" class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Description</th>
                                                    <th width="15%" class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Categories</th>
                                                    <th width="10%" class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Price</th>
                                                    <th width="10%" class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Date created</th>
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
    <!--   Core JS Files   -->
    @include('partials.core_js')
    <script>
        let columns = [{
                data: 'photo',
                name: 'photo'
            }, {
                data: 'name',
                name: 'name'
            }, {
                data: 'description',
                name: 'description'
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

        $(document).ready(function() {

            turn_selectize('#category_ids')
            var selectize = $('#category_ids')[0].selectize;
            var selectedValues = selectize.getValue();

            $('#btn-add-product').click(function(e) {
                $('.label_error').text('')
                $('#product-input').val('');
                imagePreview.innerHTML = ''
                $('#modal_add_product').modal('show')
            })

            $('#add_product_form').on('submit', function(e) {
                e.preventDefault()
                // Create FormData object
                var formData = new FormData(this);
                formData.append('category_ids', selectedValues);
                console.log(formData)
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

        })
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Corporate UI Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/corporate-ui-dashboard.min.js?v=1.0.0"></script>
</body>

</html>