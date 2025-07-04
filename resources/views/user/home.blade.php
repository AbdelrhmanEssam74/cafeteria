@extends('layouts.user.master')

@section('title', 'Elegant Taste Café')

@section('content')

    <!-- Start Hero Section -->
    <div class="hero vh-100"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1445116572660-236099ec97a0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2000&q=80'); background-size: cover; background-position: center; color: white; padding: 120px 0;">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div class="intro-excerpt">
                        <h1 style="font-size: 3rem; font-weight: 700; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Welcome to
                            <span class="d-block" style="color: #d4a762;">Elegant Taste Café</span>
                        </h1>
                        <p class="mb-4 lead" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5); color: rgb(207, 207, 207);">
                            From hot espressos to chilled smoothies, we serve beverages that delight every taste bud. Step
                            into comfort and flavor.</p>
                        <div class="d-flex gap-3">
                            <a href="{{ url('/menu') }}" class="btn btn-primary px-4 py-2"
                                style="background-color: #d4a762; border: none;">View Menu</a>
                            <a href="#" class="btn btn-outline-light px-4 py-2">Order Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center d-none d-lg-block">
                    <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                        alt="Artisan Coffee Cup" class="img-fluid rounded shadow-lg"
                        style="max-height: 400px; border: 3px solid white; transform: rotate(5deg);">
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Product Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">Crafted with excellent material.</h2>
                    <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                        vulputate velit imperdiet dolor tempor tristique.</p>
                    <p><a href="shop.html" class="btn">Explore</a></p>
                </div>

                <div class="col-md-12 col-lg-9">
                    <div class="row">
                        @forelse($products as $product)
                            <div class="col-12 col-md-4 col-lg-3 mb-5">
                                <a class="product-item d-block text-center" href="#">
                                    <img src="{{ asset('assets/images/' . $product->image) }}"
                                        class="img-fluid product-thumbnail mb-3"
                                        style="max-height: 200px; object-fit: cover;">

                                    <h3 class="product-title" style="font-size: 1.2rem;">{{ $product->name }}</h3>
                                    <strong class="product-price d-block mb-2"
                                        style="font-size: 1.1rem;">${{ number_format($product->price, 2) }}</strong>

                                    <span class="icon-cross d-inline-block">
                                        <form class="add-to-cart-form" data-product-id="{{ $product->id }}"
                                            data-product-name="{{ $product->name }}">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="border-0 bg-transparent p-0">
                                                <img src="{{ asset('assets/images/cross.svg') }}" class="img-fluid"
                                                    alt="Add to Cart" style="cursor: pointer;">
                                            </button>
                                        </form>
                                    </span>
                                </a>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <p>No products available.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Section -->

    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section py-5">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="section-title mb-4">Why Choose Our Café</h2>
                    <p class="lead">We're committed to excellence in every cup we serve, using only the finest ingredients
                        and traditional brewing methods.</p>

                    <div class="row mt-5">
                        <div class="col-6 col-md-6 mb-4">
                            <div class="feature">
                                <div class="icon mb-3">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3144/3144456.png" alt="Fast Service"
                                        class="img-fluid" style="height: 50px;">
                                </div>
                                <h3>Quick Service</h3>
                                <p class="small">Your order prepared with care in minutes, perfect for your busy schedule.
                                </p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6 mb-4">
                            <div class="feature">
                                <div class="icon mb-3">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png" alt="Quality Beans"
                                        class="img-fluid" style="height: 50px;">
                                </div>
                                <h3>Premium Beans</h3>
                                <p class="small">Ethically sourced, specialty grade coffee beans from top growing regions.
                                </p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6 mb-4">
                            <div class="feature">
                                <div class="icon mb-3">
                                    <img src="https://cdn-icons-png.flaticon.com/512/2450/2450463.png" alt="Friendly Staff"
                                        class="img-fluid" style="height: 50px;">
                                </div>
                                <h3>Friendly Staff</h3>
                                <p class="small">Our baristas are coffee experts who love making your perfect drink.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6 mb-4">
                            <div class="feature">
                                <div class="icon mb-3">
                                    <img src="https://cdn-icons-png.flaticon.com/512/869/869869.png" alt="Cozy Atmosphere"
                                        class="img-fluid" style="height: 50px;">
                                </div>
                                <h3>Cozy Atmosphere</h3>
                                <p class="small">Relax in our welcoming space designed for comfort and productivity.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap rounded overflow-hidden shadow-lg">
                        <img src="{{ asset('assets/images/rest.jpg') }}"
                            alt="Coffee Shop Interior" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle add to cart forms
            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const productId = this.getAttribute('data-product-id');
                    const productName = this.getAttribute('data-product-name');
                    const button = this.querySelector('button[type="submit"]');
                    const crossImage = this.querySelector('img');
                    const originalSrc = crossImage.src;
                    const originalClass = crossImage.className;

                    // Show loading state
                    crossImage.src =
                        'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMDAgMTAwIj48Y2lyY2xlIGN4PSI1MCIgY3k9IjUwIiByPSI0MCIgc3Ryb2tlPSIjZmZmIiBzdHJva2Utd2lkdGg9IjgiIGZpbGw9Im5vbmUiPjxhbmltYXRlVHJhbnNmb3JtIGF0dHJpYnV0ZU5hbWU9InRyYW5zZm9ybSIgdHlwZT0icm90YXRlIiB2YWx1ZXM9IjAgNTAgNTA7MzYwIDUwIDUwIiBrZXlUaW1lcz0iMDsxIiBkdXI9IjFzIiBiZWdpbj0iMHMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIi8+PC9jaXJjbGU+PC9zdmc+';
                    crossImage.className = originalClass + ' loading-spinner';

                    // AJAX request
                    fetch(`/cart/add/${productId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                quantity: 1
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Show success state (white checkmark)
                                crossImage.src =
                                    'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCI+PHBhdGggZD0iTTkgMTYuMTdMNC44MyAxMmwtMS40MiAxLjQxTDkgMTkgMjEgN2wtMS40MS0xLjQxeiIgZmlsbD0id2hpdGUiLz48L3N2Zz4=';
                                crossImage.className = originalClass + ' success-icon';

                                // Update cart count
                                if (typeof updateCartCount === 'function') {
                                    updateCartCount(data.cart_count);
                                }

                                // Show toast notification
                                if (typeof showToast === 'function') {
                                    showToast(`Added to cart: ${productName}`);
                                }

                                // Reset after 2 seconds
                                setTimeout(() => {
                                    crossImage.src = originalSrc;
                                    crossImage.className = originalClass;
                                }, 2000);
                            } else {
                                throw new Error(data.message || 'Failed to add to cart');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            // Show error state (red X)
                            crossImage.src =
                                'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCI+PHBhdGggZD0iTTE5IDYuNDFMMTcuNTkgNSAxMiAxMC41OSA2LjQxIDUgNSA2LjQxIDEwLjU5IDEyIDUgMTcuNTkgNi40MSAxOSAxMiAxMy40MSAxNy41OSAxOSAxOSAxNy41OSAxMy40MSAxMnoiIGZpbGw9IiNkYzM1NDUiLz48L3N2Zz4=';
                            crossImage.className = originalClass + ' error-icon';
                            setTimeout(() => {
                                crossImage.src = originalSrc;
                                crossImage.className = originalClass;
                            }, 2000);
                        });
                });
            });
        });
    </script>

    <style>
        /* Add these styles to your CSS */
        .loading-spinner {
            filter: brightness(0) invert(1);
            /* Makes spinner white */
            width: 24px !important;
            height: 24px !important;
        }

        .success-icon {
            filter: brightness(0) invert(1);
            /* White checkmark */
            width: 24px !important;
            height: 24px !important;
        }

        .error-icon {
            filter: none;
            /* Keeps original red color from SVG */
            width: 24px !important;
            height: 24px !important;
        }
    </style>

@endsection