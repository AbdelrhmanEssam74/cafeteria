<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon-1.png') }}">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <title>@yield('title', 'Furni')</title>

    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    {{--    font awesome links --}}
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-light.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-light.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-light.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @yield('styles')

</head>

<body>

    @if (auth()->check() && auth()->user()->role === 'admin')
        <div class="d-flex" style="min-height: 100vh;">
            @yield('navbar')
            <div class="flex-grow-1 p-4">
                @yield('content')
            </div>
        </div>
    @else
        <!-- Navbar -->
        @yield('navbar')
        <!-- Main Content -->
        <main class="">
            @yield('content')
        </main>
        {{-- Footer --}}
        @yield('footer')
    @endif

    <!-- JS Files -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @yield('script')

    <script>
        // Update cart count in navbar
        function updateCartCount(count) {
            const cartCountElement = document.querySelector('.cart-count');
            if (cartCountElement) {
                cartCountElement.textContent = count;
                if (count > 0) {
                    cartCountElement.style.display = '';
                } else {
                    cartCountElement.style.display = 'none';
                }
            }
        }

        // Initialize cart count on page load
        document.addEventListener('DOMContentLoaded', function() {
            const initialCount = {{ array_sum(array_column(session('cart') ?? [], 'quantity')) }};
            updateCartCount(initialCount);
        });

        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'position-fixed bottom-0 end-0 p-3';
            toast.innerHTML = `
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }
    </script>

</body>

</html>
