<footer class="bg-dark text-white mt-5">

    <div class="container py-5">

        <div class="row">

            <div class="col-md-4">

                <h5>
                    My Store
                </h5>

                <p class="text-white-50">
                    Your trusted online shopping store.
                </p>

            </div>


            <div class="col-md-4">

                <h5>
                    Quick Links
                </h5>

                <ul class="list-unstyled">

                    <li>
                        <a
                            href="{{ route('home') }}"
                            class="text-white-50 text-decoration-none"
                        >
                            Home
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('shop') }}"
                            class="text-white-50 text-decoration-none"
                        >
                            Shop
                        </a>
                    </li>

                </ul>

            </div>


            <div class="col-md-4">

                <h5>
                    Contact
                </h5>

                <p class="text-white-50 mb-1">
                    Email: info@example.com
                </p>

                <p class="text-white-50">
                    Phone: +880 1XXXXXXXXX
                </p>

            </div>

        </div>

    </div>


    <div class="border-top border-secondary">

        <div class="container py-3">

            <p class="mb-0 text-center text-white-50">
                © {{ date('Y') }} My Store. All rights reserved.
            </p>

        </div>

    </div>

</footer>