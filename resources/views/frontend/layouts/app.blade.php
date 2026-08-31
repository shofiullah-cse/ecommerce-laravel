<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'My E-commerce')
    </title>

    <meta
        name="description"
        content="@yield('meta_description', 'My online store')"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f8f9fa;
        }

        .product-card {
            transition: 0.2s;
        }

        .product-card:hover {
            transform: translateY(-4px);
        }

        .product-image {
            height: 220px;
            object-fit: cover;
        }

        .category-card {
            transition: 0.2s;
        }

        .category-card:hover {
            transform: translateY(-3px);
        }

    </style>

    @stack('styles')

</head>

<body>

    @include('frontend.partials.header')

    <main>

        @yield('content')

    </main>

    @include('frontend.partials.footer')


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

    @stack('scripts')

</body>

</html>