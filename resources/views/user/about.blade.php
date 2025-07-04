@extends('layouts.user.master')

@section('title', 'About Us')

@section('content')

    <!-- Start Hero Section -->
    <div class="hero vh-100" style="background-color: #f8f5f0;">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div class="intro-excerpt">
                        <h1 style="color: #3a2e1f; font-weight: 700;">Our Coffee Story</h1>
                        <p class="mb-4 lead" style="color: #6d5c4b;">Founded in 2010, Brew Haven began as a small neighborhood
                            café with a passion for exceptional coffee. Today, we continue that tradition, sourcing the
                            finest beans and crafting each cup with care.</p>
                        <div class="d-flex gap-3">
                            <a href="/menu" class="btn btn-primary px-4"
                                style="background-color: #d4a762; border: none;">View Menu</a>
                            <a href="/contact" class="btn btn-outline-dark px-4">Visit Us</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-img-wrap">
                        <img src="https://images.unsplash.com/photo-1453614512568-c4024d13c247?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                            alt="Coffee beans and tools" class="img-fluid rounded shadow-lg"
                            style="border: 8px solid white;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section py-5">
        <div class="container mt-3">
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
                        <img src="https://images.unsplash.com/photo-1445116572660-236099ec97a0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
                            alt="Coffee Shop Interior" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->

    <!-- Start Team Section -->
    <div class="untree_co-section bg-light py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6 mx-auto text-center">
                    <h2 class="section-title mb-3" style="color: #3a2e1f;">Meet Our Barista Team</h2>
                    <p class="lead" style="color: #6d5c4b;">The passionate artisans behind your perfect cup</p>
                </div>
            </div>

            <div class="row justify-content-center">

                <!-- Barista 1 -->
                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('assets/images/person_3.jpg') }}" class="card-img-top" alt="Head Barista">
                        <div class="card-body text-center">
                            <h3 class="h5">Alex Morgan</h3>
                            <span class="d-block text-muted mb-3">Head Barista</span>
                            <p>With 8 years of experience, Alex creates award-winning espresso blends and trains our team.
                            </p>
                            <div class="social-links">
                                <a href="#" class="text-muted me-2"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="text-muted"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Barista 2 -->
                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('assets/images/person_4.jpg') }}" class="card-img-top" alt="Coffee Roaster">
                        <div class="card-body text-center">
                            <h3 class="h5">Jamie Chen</h3>
                            <span class="d-block text-muted mb-3">Coffee Roaster</span>
                            <p>Our bean expert who travels worldwide to source and roast the perfect coffee beans.</p>
                            <div class="social-links">
                                <a href="#" class="text-muted me-2"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="text-muted"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Barista 3 -->
                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('assets/images/person_1.jpg') }}" class="card-img-top" alt="Pastry Chef">
                        <div class="card-body text-center">
                            <h3 class="h5">Maria Rodriguez</h3>
                            <span class="d-block text-muted mb-3">Pastry Chef</span>
                            <p>Creates our delicious pastries and desserts that perfectly complement our coffee.</p>
                            <div class="social-links">
                                <a href="#" class="text-muted me-2"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="text-muted"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Barista 4 -->
                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('assets/images/person_2.jpg') }}" class="card-img-top"
                            alt="Customer Experience">
                        <div class="card-body text-center">
                            <h3 class="h5">Taylor Smith</h3>
                            <span class="d-block text-muted mb-3">Customer Experience</span>
                            <p>Ensures every visit to our café is memorable with warm hospitality and service.</p>
                            <div class="social-links">
                                <a href="#" class="text-muted me-2"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="text-muted"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Team Section -->

    <!-- Start Testimonial Slider -->
    <div class="testimonial-section before-footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h2 class="section-title">Testimonials</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-slider-wrap text-center">

                        <div id="testimonial-nav">
                            <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                            <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                        </div>

                        <div class="testimonial-slider">

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">

                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio
                                                    quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate
                                                    velit imperdiet dolor tempor tristique. Pellentesque habitant morbi
                                                    tristique senectus et netus et malesuada fames ac turpis egestas.
                                                    Integer convallis volutpat dui quis scelerisque.&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="{{ asset('assets/images/person_2.jpg') }}" alt="Maria Jones"
                                                        class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Maria Jones</h3>
                                                <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- END item -->

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">

                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio
                                                    quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate
                                                    velit imperdiet dolor tempor tristique. Pellentesque habitant morbi
                                                    tristique senectus et netus et malesuada fames ac turpis egestas.
                                                    Integer convallis volutpat dui quis scelerisque.&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="{{ asset('assets/images/person_1.jpg') }}" alt="Maria Jones"
                                                        class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Maria Jones</h3>
                                                <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- END item -->

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">

                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio
                                                    quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate
                                                    velit imperdiet dolor tempor tristique. Pellentesque habitant morbi
                                                    tristique senectus et netus et malesuada fames ac turpis egestas.
                                                    Integer convallis volutpat dui quis scelerisque.&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="{{ asset('assets/images/person_4.jpg') }}" alt="Maria Jones"
                                                        class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Maria Jones</h3>
                                                <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- END item -->

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial Slider -->
@endsection