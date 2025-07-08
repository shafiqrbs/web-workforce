<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gain - Healthier Diets for All</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

        .navbar {
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: var(--primary-color) !important;
            font-weight: bold;
            font-size: 1.8rem;
        }

        .navbar-brand i {
            color: var(--primary-color);
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2074&q=80');
            background-size: cover;
            background-position: center;
            height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .hero-content {
            text-align: center;
            color: white;
            z-index: 2;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
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

        .section-padding {
            padding: 80px 0;
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

        /* Feature Cards */
        .feature-cards {
            padding: 60px 0;
            background: var(--light-pink);
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2.5rem 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            border: 3px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            border-color: var(--primary-color);
        }

        .feature-icon {
            font-size: 3.5rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .feature-card h5 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .feature-card p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        /* Workspace Section */
        .workspace-section {
            background: white;
            padding: 100px 0;
        }

        .workspace-content {
            display: flex;
            align-items: center;
            gap: 4rem;
        }

        .workspace-text {
            flex: 1;
            padding-right: 2rem;
        }

        .workspace-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 2rem;
        }

        .workspace-text p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        .workspace-image {
            flex: 1;
            height: 450px;
            background: url('https://images.unsplash.com/photo-1600880292089-90a7e086ee0c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80');
            background-size: cover;
            background-position: center;
            border-radius: 20px;
            position: relative;
        }

        .workspace-image::after {
            content: '';
            position: absolute;
            top: 20px;
            right: 20px;
            bottom: 20px;
            left: 20px;
            border: 3px solid var(--primary-color);
            border-radius: 15px;
        }

        /* Goals Section */
        .goals-section {
            background: var(--light-pink);
            padding: 100px 0;
        }

        .goal-card {
            background: white;
            border-radius: 20px;
            padding: 3rem 2rem;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .goal-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(45deg, var(--primary-color), #e02e4a);
        }

        .goal-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
        }

        .goal-icon {
            font-size: 4rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .goal-card h4 {
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
        }

        .goal-card p {
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.7;
        }

        /* Events Section */
        .events-section {
            background: white;
            padding: 100px 0;
        }

        .events-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .events-header h2 {
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .events-header p {
            font-size: 1.2rem;
            color: var(--text-muted);
        }

        .event-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
        }

        .event-image {
            height: 250px;
            background: url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .event-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(196, 30, 58, 0.8), rgba(224, 46, 74, 0.8));
        }

        .event-content {
            padding: 2rem;
        }

        .event-date {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .event-content h5 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .event-content p {
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        /* Target Groups Section */
        .target-section {
            background: var(--light-pink);
            padding: 100px 0;
        }

        .target-group {
            background: white;
            border-radius: 20px;
            padding: 3rem 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            border: 3px solid transparent;
        }

        .target-group:hover {
            border-color: var(--primary-color);
            transform: translateY(-5px);
        }

        .target-group.active {
            background: linear-gradient(45deg, var(--primary-color), #e02e4a);
            color: white;
            border-color: var(--primary-color);
        }

        .target-group h5 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .target-group p {
            font-size: 1rem;
            line-height: 1.6;
            opacity: 0.9;
        }

        /* News Section */
        .news-section {
            background: white;
            padding: 100px 0;
        }

        .news-card {
            background: white;
            border-radius: 15px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            border-top: 4px solid var(--primary-color);
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .news-card h5 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .news-card p {
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            line-height: 1.6;
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

        /* Achievement Section */
        .achievement-section {
            background: var(--light-pink);
            padding: 100px 0;
        }

        .achievement-item {
            text-align: center;
            padding: 2rem;
        }

        .achievement-number {
            font-size: 4rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: block;
        }

        .achievement-text {
            font-size: 1.2rem;
            color: var(--text-dark);
            font-weight: 500;
        }

        /* Partners Section */
        .partners-section {
            background: white;
            padding: 80px 0;
        }

        .partner-logo {
            background: #4a5d23;
            color: white;
            padding: 15px 30px;
            border-radius: 10px;
            margin: 10px;
            display: inline-block;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .partner-logo:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(74, 93, 35, 0.3);
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

        .map-container {
            height: 500px;
            background: url('https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80');
            background-size: cover;
            background-position: center;
            border-radius: 20px;
            position: relative;
        }

        .map-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 20px;
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

        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
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
        .partners-section {
            background: linear-gradient(135deg, #ea6682 0%, #764ba2 100%);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .partners-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="partners-grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23partners-grid)"/></svg>');
            opacity: 0.3;
        }

        .partners-section .container {
            position: relative;
            z-index: 2;
        }

        .partners-section .section-title {
            color: white;
            font-size: 3rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 60px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .partners-section .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #ff6b6b, #ffd93d);
            border-radius: 2px;
        }

        .partners-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .partners-section .partner-logo {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .partners-section .partner-logo::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s ease;
        }

        .partners-section .partner-logo:hover::before {
            left: 100%;
        }

        .partners-section .partner-logo:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            background: rgba(255, 255, 255, 1);
        }

        .partners-section .partner-logo img {
            max-width: 100%;
            max-height: 80px;
            object-fit: contain;
            filter: grayscale(100%);
            transition: all 0.3s ease;
        }

        .partners-section .partner-logo:hover img {
            filter: grayscale(0%);
            transform: scale(1.1);
        }

        .partners-section .partner-name {
            margin-top: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .partners-section .partner-logo:hover .partner-name {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .partners-section .section-title {
                font-size: 2.5rem;
            }

            .partners-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 20px;
            }

            .partners-section .partner-logo {
                padding: 20px;
            }
        }

        @keyframes partners-float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-5px);
            }
        }

        .partners-section .partner-logo:nth-child(odd) {
            animation: partners-float 3s ease-in-out infinite;
        }

        .partners-section .partner-logo:nth-child(even) {
            animation: partners-float 3s ease-in-out infinite reverse;
        }


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


</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="fas fa-heart me-2"></i>gain
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#events">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#resources">Resources</a>
                </li>
            </ul>
            <button class="btn btn-primary ms-3">Get Started</button>
        </div>
    </div>
</nav>

<section id="home" class="hero-section" style="position: relative; margin-bottom: 120px;">
    <div class="hero-content">
        <h1 class="hero-title">Healthier Diets for All</h1>
        <p class="hero-subtitle">Transforming communities through better nutrition and sustainable food systems</p>
        <button class="btn btn-primary btn-lg">Discover More</button>
    </div>

    <!-- Overlapping Feature Cards -->
    <div class="container"
         style="position: absolute; bottom: -100px; left: 50%; transform: translateX(-50%); width: 100%; z-index: 10;top: 620px;">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5>Sustainability</h5>
                    <p>Building sustainable food systems that protect our planet while ensuring nutritional security for
                        future generations.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5>Accessibility</h5>
                    <p>Making healthy nutrition accessible and affordable for everyone, regardless of their economic
                        background or location.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h5>Innovation</h5>
                    <p>Implementing innovative approaches and cutting-edge solutions to address modern nutrition
                        challenges effectively.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h5>Impact</h5>
                    <p>Creating lasting positive impact on communities through evidence-based nutrition programs and
                        interventions.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Workspace Nutrition Section -->
<section class="workspace-section" style="margin-top: 350px">
    <div class="container">
        <div class="workspace-content">
            <div class="workspace-text">
                <h2 class="workspace-title">Workforce Nutrition</h2>
                <p>We believe that nutrition is food, and food choices should be delicious, affordable, and accessible
                    to everyone. Workforce nutrition helps to meet the health and nutrition needs of employees, which
                    brings happiness and well-being to the workplace.</p>
                <p>Our workplace nutrition services offer regular expertise from qualified nutritionists or registered
                    dietitians on workplace wellbeing, delivered through workshops, seminars, and lunch-and-learn
                    sessions. We focus on creating sustainable nutrition habits that employees can maintain
                    long-term.</p>
                <p>Through our comprehensive approach, we help organizations build healthier, more productive teams
                    while reducing healthcare costs and improving employee satisfaction and retention rates.</p>
            </div>
            <div class="workspace-image"></div>
        </div>
    </div>
</section>

<!-- Goals Section -->
<section id="about" class="goals-section">
    <div class="container">
        <h2 class="section-title">Goal to Achieve</h2>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="goal-card">
                    <div class="goal-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h4>Mission</h4>
                    <p>To promote healthier diets and sustainable food systems that benefit people, communities, and the
                        planet through innovative nutrition solutions and evidence-based interventions.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="goal-card">
                    <div class="goal-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h4>Vision</h4>
                    <p>A world where everyone has access to nutritious, affordable, and sustainable food choices that
                        support optimal health and well-being for all.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="goal-card">
                    <div class="goal-icon">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h4>Core Values</h4>
                    <p>Integrity, sustainability, innovation, and unwavering commitment to improving global nutrition
                        standards and creating lasting positive change.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Events Section -->
<section id="events" class="events-section">
    <div class="container">
        <div class="events-header">
            <h2>Running & Upcoming Events</h2>
            <p>Join us for our latest workshops, seminars, and community nutrition programs</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="event-card">
                    <div class="event-image"></div>
                    <div class="event-content">
                        <div class="event-date">15 May 2024, Sunday</div>
                        <h5>Nutrition Workforce Development Workshop</h5>
                        <p>Building Nutrition Workforce Development, Training and Capacity Building. Join our
                            comprehensive workshop designed to enhance skills and knowledge in nutrition workforce
                            development.</p>
                        <button class="btn btn-primary">Read Details</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="event-card">
                    <div class="event-image"></div>
                    <div class="event-content">
                        <div class="event-date">18 May 2024, Sunday</div>
                        <h5>Nutrition Workforce Development Training</h5>
                        <p>Building Nutrition Workforce Development, Training and Capacity Building. Advanced training
                            program for nutrition professionals focusing on practical implementation strategies.</p>
                        <button class="btn btn-primary">Read Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Target Groups Section -->
<section class="target-section">
    <div class="container">
        <h2 class="section-title">Our Target Groups</h2>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="target-group">
                    <h5>Children</h5>
                    <p>Supporting healthy nutrition habits from early age through school programs and family education
                        initiatives.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="target-group active">
                    <h5>Adults</h5>
                    <p>Workplace nutrition programs and healthy lifestyle interventions designed for working
                        professionals and adults.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="target-group">
                    <h5>Elderly</h5>
                    <p>Specialized nutrition support and programs tailored for senior citizens and elderly community
                        members.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="news-section">
    <div class="container">
        <h2 class="section-title">Latest From Our Newsroom</h2>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="news-card">
                    <h5>Corporate leaders discuss workforce nutrition</h5>
                    <p>Leading companies share their strategies for employee wellness and nutrition programs. Discover
                        how top organizations are investing in their workforce health.</p>
                    <button class="btn btn-outline-primary">Read More</button>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="news-card">
                    <h5>Corporate leaders discuss workforce nutrition</h5>
                    <p>Innovative approaches to workplace nutrition programs and their impact on employee productivity
                        and satisfaction. Learn about cutting-edge solutions.</p>
                    <button class="btn btn-outline-primary">Read More</button>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="news-card">
                    <h5>Corporate leaders discuss workforce nutrition</h5>
                    <p>Building sustainable nutrition solutions for the future workforce. Explore how companies are
                        creating long-term health and wellness strategies.</p>
                    <button class="btn btn-outline-primary">Read More</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Achievement Section -->
<section class="achievement-section">
    <div class="container">
        <h2 class="section-title">Achievement</h2>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="achievement-item">
                    <span class="achievement-number">33</span>
                    <div class="achievement-text">Programs Completed</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="achievement-item">
                    <span class="achievement-number">243</span>
                    <div class="achievement-text">Participants Reached</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="achievement-item">
                    <span class="achievement-number">8</span>
                    <div class="achievement-text">Partner Organizations</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="partners-section">
    <div class="container">
        <h2 class="section-title">Our Partners and Stakeholders</h2>
        <div class="partners-grid">
            <div class="partner-logo">
                <img src="https://logo.clearbit.com/microsoft.com" alt="Microsoft">
                <div class="partner-name">Microsoft</div>
            </div>
            <div class="partner-logo">
                <img src="https://logo.clearbit.com/google.com" alt="Google">
                <div class="partner-name">Google</div>
            </div>
            <div class="partner-logo">
                <img src="https://logo.clearbit.com/amazon.com" alt="Amazon">
                <div class="partner-name">Amazon</div>
            </div>
            <div class="partner-logo">
                <img src="https://logo.clearbit.com/apple.com" alt="Apple">
                <div class="partner-name">Apple</div>
            </div>
            <div class="partner-logo">
                <img src="https://logo.clearbit.com/meta.com" alt="Meta">
                <div class="partner-name">Meta</div>
            </div>
            <div class="partner-logo">
                <img src="https://logo.clearbit.com/ibm.com" alt="IBM">
                <div class="partner-name">IBM</div>
            </div>
            <div class="partner-logo">
                <img src="https://logo.clearbit.com/salesforce.com" alt="Salesforce">
                <div class="partner-name">Salesforce</div>
            </div>
            <div class="partner-logo">
                <img src="https://logo.clearbit.com/adobe.com" alt="Adobe">
                <div class="partner-name">Adobe</div>
            </div>
            <div class="partner-logo">
                <img src="https://logo.clearbit.com/oracle.com" alt="Oracle">
                <div class="partner-name">Oracle</div>
            </div>
            <div class="partner-logo">
                <img src="https://logo.clearbit.com/netflix.com" alt="Netflix">
                <div class="partner-name">Netflix</div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact-section">
    <div class="container">
        <h2 class="section-title">We're Here to Help You</h2>
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="contact-form">
                    <h4>Get in touch</h4>
                    <p>We'd love to hear from you. Drop us a line if you have any questions!</p>
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Your Name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="Your Email">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" placeholder="Your Phone">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" placeholder="Subject">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="Your Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="image-container">
                    <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                         alt="Contact Us">
                    <div class="image-overlay"></div>
                    <div class="contact-info">
                        <h5>Contact Information</h5>
                        <div class="contact-item">
                            <span>hello@company.com</span>
                        </div>
                        <div class="contact-item">
                            <span>+1 (555) 123-4567</span>
                        </div>
                        <div class="contact-item">
                            <span>123 Business St, City, State 12345</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Map Section -->
<section class="map-section">
    <div class="container-fluid p-0">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.902206497298!2d90.39151507504318!3d23.750893088926955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8bd5573426b%3A0xb30e844a4282e4e1!2sDhaka%2C%20Bangladesh!5e0!3m2!1sen!2sbd!4v1701549241517!5m2!1sen!2sbd"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <a class="navbar-brand d-flex align-items-center mb-3" href="#">
                    <i class="fas fa-heart me-2"></i>gain
                </a>
                <p class="mb-4">Transforming communities through better nutrition and sustainable food systems. Building
                    healthier futures for all.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-2">
                <h6>Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#events">Events</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-2">
                <h6>Services</h6>
                <ul class="list-unstyled">
                    <li><a href="#">Workforce Nutrition</a></li>
                    <li><a href="#">Community Programs</a></li>
                    <li><a href="#">Training & Workshops</a></li>
                    <li><a href="#">Consultation</a></li>
                    <li><a href="#">Research</a></li>
                </ul>
            </div>
            <div class="col-lg-2">
                <h6>Resources</h6>
                <ul class="list-unstyled">
                    <li><a href="#">Publications</a></li>
                    <li><a href="#">Guidelines</a></li>
                    <li><a href="#">Tools</a></li>
                    <li><a href="#">Case Studies</a></li>
                    <li><a href="#">News</a></li>
                </ul>
            </div>
            <div class="col-lg-2">
                <h6>Support</h6>
                <ul class="list-unstyled">
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Sitemap</a></li>
                </ul>
            </div>
        </div>
        <hr class="my-4" style="border-color: #333;">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <p class="mb-0">&copy; 2024 Gain. All rights reserved.</p>
            </div>
            <div class="col-lg-6 text-lg-end">
                <p class="mb-0">Made with <i class="fas fa-heart text-danger"></i> for better nutrition</p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JavaScript -->
<script>
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Navbar background change on scroll
    window.addEventListener('scroll', function () {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
            navbar.style.backdropFilter = 'blur(10px)';
        } else {
            navbar.style.backgroundColor = 'white';
            navbar.style.backdropFilter = 'none';
        }
    });

    // Form submission handling
    document.querySelector('form').addEventListener('submit', function (e) {
        e.preventDefault();
        alert('Thank you for your message! We will get back to you soon.');
        this.reset();
    });
</script>

</body>
</html>