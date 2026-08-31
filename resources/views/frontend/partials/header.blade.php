<nav class="navbar navbar-expand-lg bg-dark navbar-dark">

    <div class="container">

        <a
            class="navbar-brand fw-bold"
            href="{{ route('home') }}"
        >
            My Store
        </a>


        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar"
        >
            <span class="navbar-toggler-icon"></span>
        </button>


        <div
            class="collapse navbar-collapse"
            id="mainNavbar"
        >

            <ul class="navbar-nav me-auto">

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="{{ route('home') }}"
                    >
                        Home
                    </a>

                </li>

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="{{ route('shop') }}"
                    >
                        Shop
                    </a>

                </li>

            </ul>


            <form
                action="{{ route('shop') }}"
                method="GET"
                class="d-flex me-3"
            >

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control me-2"
                    placeholder="Search products..."
                >

                <button
                    class="btn btn-light"
                    type="submit"
                >
                    Search
                </button>

            </form>


            @php
                $cart = session('cart', []);
                $cartCount = collect($cart)->sum('quantity');
            @endphp

            <a
                href="{{ route('cart.index') }}"
                class="btn btn-outline-light"
            >
                Cart ({{ $cartCount }})
            </a>

        </div>

    </div>

</nav>