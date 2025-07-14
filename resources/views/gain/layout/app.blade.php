<?php
if (!isset($seo)) {
    $seo = (object)array('seo_title' => $siteSetting->site_name, 'seo_description' => $siteSetting->site_name, 'seo_keywords' => $siteSetting->site_name, 'seo_other' => '');
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__($siteSetting->site_name) }}</title>
    <meta name="Description" content="{!! $seo->seo_description !!}">
    <meta name="Keywords" content="{!! $seo->seo_keywords !!}">
    <link rel="shortcut icon" href="{{asset('assets/images/logo.png')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --primary-color: #c41e3a;
            --secondary-color: #f8f9fa;
            --light-pink: #fdf7f7;
            --text-dark: #333;
            --text-muted: #6c757d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
        }

        .navbar-brand i {
            color: var(--primary-color);
        }


        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), #e02e4a);
            border: none;
            padding: 15px 40px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(196, 30, 58, 0.4);
        }

        .section-title {
            font-size: 2.8rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            color: var(--text-dark);
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--primary-color);
        }







        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }




        /* Contact Section */
        .contact-section {
            background: var(--light-pink);
            padding: 100px 0;
        }

        .contact-form {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .contact-form h4 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .contact-form p {
            color: var(--text-muted);
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .form-control {
            padding: 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(196, 30, 58, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }


        /* Footer */
        .footer {
            background: #1a1a1a;
            color: white;
            padding: 60px 0 30px;
        }

        .footer h5, .footer h6 {
            color: white;
            margin-bottom: 1.5rem;
        }

        .footer .navbar-brand {
            color: var(--primary-color) !important;
            font-size: 2rem;
        }

        .footer a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--primary-color);
        }

        .footer .list-unstyled li {
            margin-bottom: 0.5rem;
        }

        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            color: white;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(196, 30, 58, 0.4);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .workspace-content {
                flex-direction: column;
                gap: 2rem;
            }

            .workspace-text {
                padding-right: 0;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>

    <style>
        @keyframes pulse {
            0% {
                transform: translate(-50%, -50%) scale(1);
                box-shadow: 0 4px 15px rgba(196, 30, 58, 0.4);
            }
            50% {
                transform: translate(-50%, -50%) scale(1.1);
                box-shadow: 0 6px 20px rgba(196, 30, 58, 0.6);
            }
            100% {
                transform: translate(-50%, -50%) scale(1);
                box-shadow: 0 4px 15px rgba(196, 30, 58, 0.4);
            }
        }
    </style>


    <style>



        .image-container {
            position: relative;
            height: 100%;
            min-height: 500px;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            transform: translateY(0);
            transition: all 0.4s ease;
        }

        .image-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4);
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .image-container:hover img {
            transform: scale(1.05);
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(240, 147, 251, 0.3), rgba(245, 87, 108, 0.3));
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .image-container:hover .image-overlay {
            opacity: 1;
        }

        .contact-info {
            position: absolute;
            bottom: 30px;
            left: 30px;
            right: 30px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.4s ease;
        }

        .image-container:hover .contact-info {
            transform: translateY(0);
            opacity: 1;
        }

        .contact-info h5 {
            color: #333;
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        .contact-info p {
            color: #666;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .contact-info .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .contact-info .contact-item::before {
            content: '📧';
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .contact-info .contact-item:nth-child(2)::before {
            content: '📞';
        }

        .contact-info .contact-item:nth-child(3)::before {
            content: '📍';
        }

        @media (max-width: 768px) {
            .contact-section .section-title {
                font-size: 2.5rem;
            }

            .contact-form {
                padding: 30px 20px;
                margin-bottom: 30px;
            }

            .image-container {
                min-height: 300px;
            }

            .contact-info {
                position: static;
                transform: none;
                opacity: 1;
                margin-top: 20px;
            }
        }

        @keyframes contact-pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.02);
            }
        }

        .contact-form .btn-primary:focus {
            animation: contact-pulse 0.6s ease;
        }
    </style>

    @stack('styles')

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<body>

<div class="boxed_wrapper">
    @yield('content1')
    @include('gain.layout.footer')

    <button class="scroll-top scroll-to-target" data-target="html">
        <span class="fas fa-angle-up"></span>
    </button>
</div>


<!-- jequery plugins -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

<script>
    // Add this CSS to your existing styles
    const scrollToTopCSS = `
.scroll-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: var(--primary-color);
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    font-size: 18px;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 9999;
    box-shadow: 0 4px 15px rgba(196, 30, 58, 0.4);
}

.scroll-top.show {
    opacity: 1;
    visibility: visible;
}

.scroll-top:hover {
    background: #a01729;
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(196, 30, 58, 0.6);
}

.scroll-top span {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}

@media (max-width: 768px) {
    .scroll-top {
        bottom: 20px;
        right: 20px;
        width: 45px;
        height: 45px;
    }
}
`;

    // Add the CSS to the page
    const styleSheet = document.createElement('style');
    styleSheet.textContent = scrollToTopCSS;
    document.head.appendChild(styleSheet);

    // JavaScript functionality
    document.addEventListener('DOMContentLoaded', function() {
        const scrollTopBtn = document.querySelector('.scroll-top');

        // Show/hide scroll button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) { // Show after scrolling 300px
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });

        // Smooth scroll to top when button is clicked
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });

</script>

</body>

