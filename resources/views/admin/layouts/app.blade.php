<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Admin Panel')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @stack('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="d-flex min-vh-100">

        {{-- Sidebar --}}
        <aside
            class="bg-dark text-white p-3"
            style="width: 250px;"
        >

            <h4 class="mb-4">
                E-Commerce
            </h4>

            <ul class="nav flex-column gap-1">

                <li class="nav-item">
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="nav-link text-white"
                    >
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="nav-link text-white"
                    >
                        Categories
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('admin.brands.index') }}"
                        class="nav-link text-white"
                    >
                        Brands
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="#"
                        class="nav-link text-white"
                    >
                        Products
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="#"
                        class="nav-link text-white"
                    >
                        Orders
                    </a>
                </li>

                <li class="nav-item mt-3">

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-danger w-100"
                        >
                            Logout
                        </button>

                    </form>

                </li>

            </ul>

        </aside>


        {{-- Main Content --}}
        <main class="flex-grow-1">

            {{-- Topbar --}}
            <nav class="navbar navbar-light bg-white border-bottom px-4">

                <span class="navbar-brand mb-0 h1">
                    @yield('page_title', 'Dashboard')
                </span>

                <span>
                    {{ auth()->user()->name }}
                </span>

            </nav>


            {{-- Content --}}
            <div class="p-4">

                @yield('content')

            </div>

        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    @stack('scripts')

</body>

</html>