@extends('layouts.user.master')

@section('title', 'Contact')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero vh-100" style="background-color: #f8f5f0;">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div class="intro-excerpt">
                        <h1 style="color: #3a2e1f; font-weight: 700;">Visit Us Today</h1>
                        <p class="mb-4 lead" style="color: #6d5c4b;">We'd love to hear from you! Whether you have questions
                            about our coffee, want to book an event, or just want to say hello, our team is ready to assist
                            you.</p>
                        <div class="d-flex gap-3">
                            <a href="#contact-form" class="btn btn-primary px-4"
                                style="background-color: #d4a762; border: none;">Send Message</a>
                            <a href="#location" class="btn btn-outline-dark px-4">Our Location</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-img-wrap">
                        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                            alt="Café interior with people enjoying coffee" class="img-fluid rounded shadow-lg"
                            style="border: 8px solid white;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->


    <!-- Start Contact Form Section -->
    <div class="untree_co-section bg-light py-5" id="contact-form">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <h2 class="section-title mb-3" style="color: #3a2e1f;">Get In Touch</h2>
                    <p class="lead" style="color: #6d5c4b;">Have questions about our coffee? Want to book an event? We're
                        here to help!</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <!-- Contact Info Cards -->
                    <div class="row mb-5 g-4">
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm text-center p-3">
                                <div class="icon-container mb-3" style="color: #d4a762;">
                                    <i class="fas fa-map-marker-alt fa-2x"></i>
                                </div>
                                <h5 class="mb-2">Our Location</h5>
                                <p class="mb-0">123 Coffee Street<br>Brew City, BC 12345</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm text-center p-3">
                                <div class="icon-container mb-3" style="color: #d4a762;">
                                    <i class="fas fa-envelope fa-2x"></i>
                                </div>
                                <h5 class="mb-2">Email Us</h5>
                                <p class="mb-0">hello@brewhaven.com<br>bookings@brewhaven.com</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm text-center p-3">
                                <div class="icon-container mb-3" style="color: #d4a762;">
                                    <i class="fas fa-phone-alt fa-2x"></i>
                                </div>
                                <h5 class="mb-2">Call Us</h5>
                                <p class="mb-0">+1 (555) 123-4567<br>Mon-Fri: 8AM-6PM</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="card shadow-sm border-0 p-4 p-md-5">
                        <form id="contactForm" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-group">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-group">
                                    <label for="message" class="form-label">Your Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-4 py-2"
                                    style="background-color: #d4a762; border: none;">
                                    <i class="fas fa-paper-plane me-2"></i> Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Modal -->
        <div class="modal fade" id="contactSuccessModal" tabindex="-1" aria-labelledby="contactSuccessModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="contactSuccessModalLabel">
                            <i class="fas fa-check-circle me-2"></i> Message Sent!
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center p-4">
                        <div class="mb-4">
                            <i class="fas fa-envelope-open-text text-success" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="mb-3">Thank You!</h4>
                        <p>We've received your message and will contact you shortly.</p>
                        <p class="text-muted small">You'll hear from us within 24 hours.</p>
                    </div>
                    <div class="modal-footer justify-content-center border-0">
                        <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal">
                            <i class="fas fa-coffee me-2"></i> Back to Café
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Contact Form Section -->

    <style>
        .icon-container {
            width: 60px;
            height: 60px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(212, 167, 98, 0.1);
            border-radius: 50%;
        }

        .form-control {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-control:focus {
            border-color: #d4a762;
            box-shadow: 0 0 0 0.25rem rgba(212, 167, 98, 0.25);
        }

        /* Add to your existing styles */
        .modal-content {
            border-radius: 10px;
            overflow: hidden;
            border: none;
        }

        .modal-header {
            border-bottom: none;
            padding: 1.5rem;
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-footer {
            border-top: none;
            padding: 1rem 1.5rem 1.5rem;
        }

        .bg-success {
            background-color: #3a2e1f !important;
        }

        .btn-success {
            background-color: #d4a762 !important;
            border-color: #d4a762 !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contactForm = document.getElementById('contactForm');

            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const submitButton = this.querySelector('button[type="submit"]');
                    const originalText = submitButton.innerHTML;

                    // Show loading state
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Sending...';
                    submitButton.disabled = true;

                    // Simulate form submission (replace with actual AJAX in production)
                    setTimeout(() => {
                        // Show success modal
                        const successModal = new bootstrap.Modal(document.getElementById(
                            'contactSuccessModal'));
                        successModal.show();

                        // Reset form and button
                        contactForm.reset();
                        submitButton.innerHTML = originalText;
                        submitButton.disabled = false;
                    }, 1500);
                });
            }
        });
    </script>
@endsection
