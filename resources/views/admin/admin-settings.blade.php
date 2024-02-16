<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.meta')
    @include('partials.head')
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/corporate-ui-dashboard.css?v=1.0.0" rel="stylesheet" />

    <style>
        #banner-preview {
            margin-top: 5px;
            width: auto;
            height: auto;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #banner-preview img {
            max-width: 100%;
            max-height: 200px;
        }

        #sys_logo-preview {
            margin-top: 5px;
            width: auto;
            height: auto;

            border-radius: 5px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #sys_logo-preview img {
            max-width: 100%;
            max-height: 200px;
        }
        .saved_images {
            max-width: 100%;
            max-height: 200px;

        }
    </style>
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

            @if(session('msg_save'))
            <script>
                showToast("{{ session('msg_save') }}", 1)
            </script>
            @endif
            <div class="container-fluid">
                <div class="col-12 my-2">
                    <div class="card shadow-xs border mb-4 pb-3">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0 font-weight-semibold text-lg">System information</h6>
                            <p class="text-sm mb-1">Here you will find setting for your store.</p>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <form role="form" id="sign_in_form" enctype="multipart/form-data" action="{{ route('save_store_info') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Store Name</label>
                                        <input type="text" class="form-control" name="system_name" placeholder="Enter the name of your store" aria-label="System name" value="{{ $settings['sys_name'] }}">
                                        @error('system_name')
                                        <label for="" class="label_error"> {{ $message }} </label>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Store Logo</label>
                                        <input type="file" class="form-control" name="sys_logo" id="sys_logo-input" accept=".jpg, .jpeg, .png" >
                                        <div id="sys_logo-preview"></div>

                                        @if($settings['sys_logo'])
                                        <img src="{{ asset($settings['sys_logo']) }}" alt="" srcset="" class="saved_images">
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label>Store Banner Image</label>
                                        <input type="file" class="form-control" name="store_banner" id="banner-input" accept=".jpg, .jpeg, .png">
                                        <div id="banner-preview"></div>

                                        @if($settings['sys_banner'])
                                        <img src="{{ asset($settings['sys_banner']) }}" alt="" srcset="" class="saved_images">
                                        @endif
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-dark  mt-4 mb-3" id="btn-signin">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @include('partials.admin-footer')
        </div>
    </main>

    <!--   Core JS Files   -->
    @include('partials.core_js')
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        const fileInput = document.getElementById('banner-input');
        const imagePreview = document.getElementById('banner-preview');

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

        const fileInput1 = document.getElementById('sys_logo-input');
        const imagePreview1 = document.getElementById('sys_logo-preview');

        fileInput1.addEventListener('change', function() {
            const file1 = this.files[0];
            if (file1) {
                const reader1 = new FileReader();
                reader1.onload = function(e) {
                    const img1 = document.createElement('img');
                    img1.src = e.target.result;
                    imagePreview1.innerHTML = '';
                    imagePreview1.appendChild(img1);
                }
                reader1.readAsDataURL(file1);
            } else {
                imagePreview1.innerHTML = 'No image selected';
            }
        });
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Corporate UI Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/corporate-ui-dashboard.min.js?v=1.0.0"></script>
</body>

</html>