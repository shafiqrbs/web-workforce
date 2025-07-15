<section class="partners-section">
    <div class="container">
        <h2 class="section-title">Our Partners and Stakeholders</h2>
        <div class="partners-grid">
            @foreach($financialPartner as $partner)
                <div class="partner-logo">
                    @if($img = $partner['profile_image'])
                        {{ ImgUploader::print_image("financial_partner/mid/$img") }}
                    @else
                        <img src="{{asset('assets/no-image.jpeg')}}" alt="">
                    @endif
                    <div class="partner-name">{{$partner['name']}}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>


@push('styles')
    <style>
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
    </style>
@endpush