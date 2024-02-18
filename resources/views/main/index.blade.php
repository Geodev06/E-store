<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $settings['sys_name']}}</title>

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