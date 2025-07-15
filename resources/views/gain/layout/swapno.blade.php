<div class="container my-5">
    <div class="row g-0 custom-card shadow-lg">
        <!-- Left Column: Image -->
        <div class="col-md-6">
            <img
                    src="{{asset('assets/swapno.png')}}"
                    alt="Event Image"
                    class="img-fluid w-100 h-100 object-fit-cover"
            />
        </div>

        <!-- Right Column: Information Panel -->
        <div class="col-md-6 info-panel">
            <img
                    src="{{asset('assets/swapno-logo.png')}}"
                    alt="Swapno Logo"
                    class="info-icon"
            />
            <h2 class="info-heading">
                Strengthening Workers’ Access to Pertinent Nutrition Opportunities
            </h2>
            <p class="info-text">
                SWAPNO is a pioneering effort under the Workforce Nutrition Programme,
                focused on improving nutrition outcomes for garment workers in Bangladesh.
            </p>
            <a href="{{route('cms','swapno')}}" class="btn btn-swapno">
                The Swapno Project →
            </a>
        </div>
    </div>
</div>


@push('styles')
    <style>
        .custom-card {
            border-radius: 16px;
            overflow: hidden;
        }

        .info-panel {
            background-color: #66001e;
            color: #fff;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .info-icon {
            width: 60px;
            height: 60px;
            margin-bottom: 20px;
        }

        .info-heading {
            font-size: 1.75rem;
            font-weight: 600;
            line-height: 1.4;
        }

        .info-text {
            font-size: 1rem;
            margin: 15px 0 30px;
            line-height: 1.6;
        }

        .btn-swapno {
            background-color: #c31947;
            border: none;
            padding: 12px 24px;
            font-size: 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-swapno:hover {
            background-color: #a61239;
        }

        @media (max-width: 768px) {
            .info-panel {
                padding: 30px 20px;
                text-align: center;
            }
        }
    </style>

@endpush

