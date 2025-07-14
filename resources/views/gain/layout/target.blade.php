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


@push('styles')
    <style>
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
    </style>
@endpush