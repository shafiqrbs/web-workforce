
<section class="achievement-section">
    <div class="container">
        <h2 class="section-title fade-in-up">Achievement</h2>
        <div class="row g-4">
            {{--@if(sizeof($achievements['financialPartnerGroup'])>0)
                @foreach($achievements['financialPartnerGroup'] as $group)
                    <div class="col-lg-4">
                        <div class="achievement-item fade-in-up">
                            <span class="achievement-number counter-animation" data-target="{{$group['total'] ?? 0}}">{{$group['total'] ?? 0}}</span>
                            <div class="achievement-text">{{$group['partner_group']}}</div>
                        </div>
                    </div>
                @endforeach()
            @endif--}}

            <div class="col-lg-4">
                <div class="achievement-item achievement-item-background fade-in-up">
                    <span class="achievement-number counter-animation" data-target="5">5</span>
                    <div class="achievement-text">On Boarded Factories</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="achievement-item achievement-item-background fade-in-up">
                    <span class="achievement-number counter-animation" data-target="3"3></span>
                    <div class="achievement-text">Fair Price Shop</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="achievement-item achievement-item-background fade-in-up">
                    <span class="achievement-number counter-animation" data-target="9">9</span>
                    <div class="achievement-text">Factories</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="achievement-item achievement-item-background fade-in-up">
                    <span class="achievement-number counter-animation" data-target="0">0</span>
                    <div class="achievement-text">Baseline Survey</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="achievement-item achievement-item-background fade-in-up">
                    <span class="achievement-number counter-animation" data-target="0">0</span>
                    <div class="achievement-text">Champaign</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="achievement-item achievement-item-background fade-in-up">
                    <span class="achievement-number counter-animation" data-target="0">0</span>
                    <div class="achievement-text">Community Nutrition Center</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="achievement-item achievement-item-background fade-in-up">
                    <span class="achievement-number counter-animation" data-target="5">5</span>
                    <div class="achievement-text">Community Nutrition Center</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="achievement-item achievement-item-background fade-in-up">
                    <span class="achievement-number counter-animation" data-target="10">10</span>
                    <div class="achievement-text">NIC Nutrition Improve Center</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="achievement-item achievement-item-background fade-in-up">
                    <span class="achievement-number counter-animation" data-target="400">400</span>
                    <div class="achievement-text">TEER Educators</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="achievement-item achievement-item-background fade-in-up">
                    <span class="achievement-number counter-animation" data-target="2">2</span>
                    <div class="achievement-text">School</div>
                </div>
            </div>

        </div>
    </div>
</section>

@push('styles')
    <style>
        /* Achievement Section */
        .achievement-section {
            background: var(--light-pink);
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .achievement-item-background{
            background: #dbcfcf0d !important;
        }

        .achievement-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(233, 30, 99, 0.05) 0%, rgba(233, 30, 99, 0.1) 100%);
            pointer-events: none;
        }

        .section-title {
            text-align: center;
            color: var(--primary-color);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--primary-color);
            border-radius: 2px;
        }

        .achievement-item {
            text-align: center;
            padding: 2.5rem 1.5rem;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .achievement-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(45deg, var(--primary-color), #ff6b9d);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .achievement-item:hover::before {
            transform: translateX(0);
        }

        .achievement-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .achievement-number {
            font-size: 4rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: block;
            text-shadow: 0 2px 10px rgba(233, 30, 99, 0.2);
            position: relative;
        }

        .achievement-text {
            font-size: 1.2rem;
            color: var(--text-dark);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Animation classes */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in-up.animate {
            opacity: 1;
            transform: translateY(0);
        }

        .counter-animation {
            display: inline-block;
            transition: all 0.3s ease;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .achievement-number {
                font-size: 3rem;
            }

            .achievement-text {
                font-size: 1rem;
            }

            .achievement-item {
                padding: 2rem 1rem;
            }
        }
    </style>
@endpush


@push('scripts')
    <script>
        // Intersection Observer for scroll-triggered animations
        const observerOptions = {
            threshold: 0.3,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');

                    // If this is the achievement section, start counters
                    if (entry.target.classList.contains('achievement-section')) {
                        startCounters();
                    }
                }
            });
        }, observerOptions);

        // Observe fade-in elements
        document.querySelectorAll('.fade-in-up').forEach(el => {
            observer.observe(el);
        });

        // Observe the achievement section
        observer.observe(document.querySelector('.achievement-section'));

        // Counter animation function
        function animateCounter(element, target, duration = 2000) {
            const start = 0;
            const startTime = performance.now();

            function updateCounter(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);

                // Easing function for smooth animation
                const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                const current = Math.floor(start + (target - start) * easeOutQuart);

                element.textContent = current;

                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target; // Ensure final value is exact
                }
            }

            requestAnimationFrame(updateCounter);
        }

        // Start all counters
        function startCounters() {
            const counters = document.querySelectorAll('.counter-animation');

            counters.forEach((counter, index) => {
                const target = parseInt(counter.getAttribute('data-target'));

                // Add slight delay between counters for staggered effect
                setTimeout(() => {
                    animateCounter(counter, target, 2000);
                }, index * 200);
            });
        }

        // Add some extra visual effects
        document.addEventListener('DOMContentLoaded', () => {
            // Add staggered animation delays
            document.querySelectorAll('.achievement-item').forEach((item, index) => {
                item.style.transitionDelay = `${index * 0.2}s`;
            });
        });
    </script>
@endpush