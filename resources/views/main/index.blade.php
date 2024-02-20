<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">

    @php
    $logo = DB::table('system_settings')->where('setting_name', 'SYSTEM_LOGO')->first();
    $sys_name = DB::table('system_settings')->where('setting_name', 'SYSTEM_NAME')->first();

    @endphp

    @if($logo)
    <link rel="icon" type="image/png" href="{{ asset($logo->value) }}">

    @else
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">

    @endif
    <title>
        {{ $sys_name->value ?? '' }}
    </title>

    <!-- Google Font -->
    @include('main_partials.core_css')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    @include('main_partials.hamburger')
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    @include('main_partials.header')

    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    @include('main_partials.hero')

    <!-- Hero Section End -->

    <!-- Categories Section Begin -->

    <!-- Categories Section End -->

    @include('main_partials.featured')

    @include('main_partials.banner')

    @include('main_partials.latest_product')




    @include('main_partials.footer')

    @include('main_partials.core_js')


</body>

</html>