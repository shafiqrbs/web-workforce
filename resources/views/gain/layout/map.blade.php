
<section class="map-section">
    <div class="container-fluid p-0">
        <div class="header">
            <h1>AREA COVERAGE</h1>
        </div>
        <div class="content">
            <div class="row">
                <!-- Map Container -->
                <div class="col-lg-8 col-md-12">
                    <div class="map-container" id="chartdiv"></div>
                </div>

                <!-- Statistics Table -->
                <div class="col-lg-4 col-md-12">
                    <div class="statistics-panel">
                        <h3>Coverage Statistics</h3>
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number">64</div>
                                    <div class="stat-label">Total Districts</div>
                                    <div class="stat-detail">8 Administrative Divisions</div>
                                </div>
                            </div>

                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number">495</div>
                                    <div class="stat-label">Total Upazilas/Thanas</div>
                                    <div class="stat-detail">Sub-district level administration</div>
                                </div>
                            </div>

                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number">4,571</div>
                                    <div class="stat-label">Total Unions</div>
                                    <div class="stat-detail">Rural administrative units</div>
                                </div>
                            </div>

                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number">87,319</div>
                                    <div class="stat-label">Total Villages</div>
                                    <div class="stat-detail">Smallest administrative units</div>
                                </div>
                            </div>

                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-city"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number">329</div>
                                    <div class="stat-label">Total Municipalities</div>
                                    <div class="stat-detail">Urban local government</div>
                                </div>
                            </div>

                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-landmark"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number">12</div>
                                    <div class="stat-label">City Corporations</div>
                                    <div class="stat-detail">Major urban centers</div>
                                </div>
                            </div>

                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-chart-area"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number">147,570</div>
                                    <div class="stat-label">Total Area (km²)</div>
                                    <div class="stat-detail">Including water bodies</div>
                                </div>
                            </div>

                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-user-friends"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number">165M+</div>
                                    <div class="stat-label">Total Population</div>
                                    <div class="stat-detail">As per latest census</div>
                                </div>
                            </div>
                        </div>

                        <!-- Administrative Divisions -->
                        <div class="divisions-info">
                            <h4>Administrative Divisions</h4>
                            <div class="division-list">
                                <div class="division-item">
                                    <span class="division-dot dhaka"></span>
                                    <span>Dhaka Division</span>
                                    <small>13 Districts</small>
                                </div>
                                <div class="division-item">
                                    <span class="division-dot chittagong"></span>
                                    <span>Chittagong Division</span>
                                    <small>11 Districts</small>
                                </div>
                                <div class="division-item">
                                    <span class="division-dot rajshahi"></span>
                                    <span>Rajshahi Division</span>
                                    <small>8 Districts</small>
                                </div>
                                <div class="division-item">
                                    <span class="division-dot khulna"></span>
                                    <span>Khulna Division</span>
                                    <small>10 Districts</small>
                                </div>
                                <div class="division-item">
                                    <span class="division-dot barisal"></span>
                                    <span>Barisal Division</span>
                                    <small>6 Districts</small>
                                </div>
                                <div class="division-item">
                                    <span class="division-dot sylhet"></span>
                                    <span>Sylhet Division</span>
                                    <small>4 Districts</small>
                                </div>
                                <div class="division-item">
                                    <span class="division-dot rangpur"></span>
                                    <span>Rangpur Division</span>
                                    <small>8 Districts</small>
                                </div>
                                <div class="division-item">
                                    <span class="division-dot mymensingh"></span>
                                    <span>Mymensingh Division</span>
                                    <small>4 Districts</small>
                                </div>
                            </div>
                        </div>

                        {{--<button class="view-details-btn">
                            <i class="fas fa-chart-bar"></i>
                            View Detailed Report
                        </button>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .header {
            background: linear-gradient(135deg, #c41e3a 0%, #8b1e3f 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M20,20 Q40,10 60,20 Q80,30 100,20 L100,0 L0,0 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: 100% 100%;
        }

        .header h1 {
            font-size: 2.5em;
            font-weight: bold;
            letter-spacing: 2px;
            position: relative;
            z-index: 1;
        }

        .content {
            padding: 40px 20px;
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        }

        .map-container {
            height: 700px;
            width: 100%;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background: white;
        }

        /* Statistics Panel Styles */
        .statistics-panel {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            height: 700px;
            overflow-y: auto;
        }

        .statistics-panel h3 {
            font-size: 1.8em;
            font-weight: bold;
            color: #333;
            margin-bottom: 25px;
            text-align: center;
            border-bottom: 3px solid #c41e3a;
            padding-bottom: 10px;
        }

        .stats-grid {
            display: grid;
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
            padding: 15px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            border-left: 4px solid #c41e3a;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(196, 30, 58, 0.2);
        }

        .stat-icon {
            background: #c41e3a;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 1.1em;
            flex-shrink: 0;
        }

        .stat-info {
            flex: 1;
        }

        .stat-number {
            font-size: 1.6em;
            font-weight: bold;
            color: #c41e3a;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.85em;
            color: #333;
            font-weight: 600;
            margin: 3px 0;
        }

        .stat-detail {
            font-size: 0.75em;
            color: #666;
            font-style: italic;
        }

        /* Administrative Divisions */
        .divisions-info {
            margin-bottom: 25px;
        }

        .divisions-info h4 {
            font-size: 1.3em;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e9ecef;
        }

        .division-list {
            max-height: 250px;
            overflow-y: auto;
        }

        .division-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            margin-bottom: 5px;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .division-item:hover {
            background: #f8f9fa;
            transform: translateX(5px);
        }

        .division-item > span:first-of-type {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .division-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .division-dot.dhaka { background: #dc2626; }
        .division-dot.chittagong { background: #2563eb; }
        .division-dot.rajshahi { background: #16a34a; }
        .division-dot.khulna { background: #ca8a04; }
        .division-dot.barisal { background: #9333ea; }
        .division-dot.sylhet { background: #c2410c; }
        .division-dot.rangpur { background: #0891b2; }
        .division-dot.mymensingh { background: #be185d; }

        .division-item span:nth-child(2) {
            font-weight: 500;
            color: #333;
            flex: 1;
            margin-left: 5px;
        }

        .division-item small {
            color: #666;
            font-size: 0.8em;
            font-weight: 500;
        }

        /* View Details Button */
        .view-details-btn {
            width: 100%;
            background: linear-gradient(135deg, #c41e3a 0%, #8b1e3f 100%);
            color: white;
            border: none;
            padding: 15px 20px;
            border-radius: 10px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .view-details-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(196, 30, 58, 0.4);
        }

        /* Responsive Design */
        @media (max-width: 991px) {
            .statistics-panel {
                margin-top: 30px;
                height: auto;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2em;
            }

            .map-container {
                height: 500px;
            }

            .statistics-panel {
                height: auto;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/geodata/bangladeshLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <script>
        window.addEventListener("load", function () {
            if (typeof am4core === "undefined") {
                console.error("amCharts not loaded.");
                return;
            }
            createAmChartsMap();
        });

        function createAmChartsMap() {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4maps.MapChart);
            chart.geodata = am4geodata_bangladeshLow;
            chart.projection = new am4maps.projections.Miller();

            // Allow zoom & pan
            chart.zoomControl = new am4maps.ZoomControl();
            chart.seriesContainer.draggable = true;
            chart.chartContainer.wheelable = true;

            // Background Bangladesh map
            var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
            polygonSeries.useGeodata = true;
            polygonSeries.mapPolygons.template.tooltipText = "{name}";
            polygonSeries.mapPolygons.template.fill = am4core.color("#2d8659");
            polygonSeries.mapPolygons.template.stroke = am4core.color("#ffffff");

            // District data with all 64 districts
            const districtData = [
                { title: "Bagerhat", latitude: 22.6517, longitude: 89.7850 },
                { title: "Bandarban", latitude: 22.1953, longitude: 92.2184 },
                { title: "Barguna", latitude: 22.0953, longitude: 90.1121 },
                { title: "Barisal", latitude: 22.7010, longitude: 90.3535 },
                { title: "Bhola", latitude: 22.6859, longitude: 90.6482 },
                { title: "Bogura", latitude: 24.8512, longitude: 89.3697 },
                { title: "Brahmanbaria", latitude: 23.9571, longitude: 91.1110 },
                { title: "Chandpur", latitude: 23.2333, longitude: 90.6711 },
                { title: "Chapainawabganj", latitude: 24.5964, longitude: 88.2776 },
                { title: "Chattogram", latitude: 22.3569, longitude: 91.7832 },
                { title: "Chuadanga", latitude: 23.6401, longitude: 88.8410 },
                { title: "Comilla", latitude: 23.4607, longitude: 91.1809 },
                { title: "Cox's Bazar", latitude: 21.4272, longitude: 92.0058 },
                { title: "Dhaka", latitude: 23.8103, longitude: 90.4125 },
                { title: "Dinajpur", latitude: 25.6217, longitude: 88.6354 },
                { title: "Faridpur", latitude: 23.6070, longitude: 89.8420 },
                { title: "Feni", latitude: 22.9417, longitude: 91.4016 },
                { title: "Gaibandha", latitude: 25.3288, longitude: 89.5289 },
                { title: "Gazipur", latitude: 23.9999, longitude: 90.4203 },
                { title: "Gopalganj", latitude: 23.0056, longitude: 89.8266 },
                { title: "Habiganj", latitude: 24.3756, longitude: 91.4155 },
                { title: "Jamalpur", latitude: 24.9375, longitude: 89.9370 },
                { title: "Jashore", latitude: 23.1667, longitude: 89.2167 },
                { title: "Jhalokathi", latitude: 22.6413, longitude: 90.2114 },
                { title: "Jhenaidah", latitude: 23.5450, longitude: 89.1726 },
                { title: "Joypurhat", latitude: 25.0940, longitude: 89.0203 },
                { title: "Khagrachari", latitude: 23.1193, longitude: 91.9847 },
                { title: "Khulna", latitude: 22.8456, longitude: 89.5403 },
                { title: "Kishoreganj", latitude: 24.4340, longitude: 90.7869 },
                { title: "Kurigram", latitude: 25.8054, longitude: 89.6362 },
                { title: "Kushtia", latitude: 23.9013, longitude: 89.1205 },
                { title: "Lakshmipur", latitude: 22.9447, longitude: 90.8282 },
                { title: "Lalmonirhat", latitude: 25.9170, longitude: 89.4500 },
                { title: "Madaripur", latitude: 23.1650, longitude: 90.1893 },
                { title: "Magura", latitude: 23.4873, longitude: 89.4198 },
                { title: "Manikganj", latitude: 23.8615, longitude: 90.0003 },
                { title: "Meherpur", latitude: 23.7622, longitude: 88.6317 },
                { title: "Moulvibazar", latitude: 24.4829, longitude: 91.7779 },
                { title: "Munshiganj", latitude: 23.5501, longitude: 90.5296 },
                { title: "Mymensingh", latitude: 24.7471, longitude: 90.4203 },
                { title: "Naogaon", latitude: 24.8250, longitude: 88.9417 },
                { title: "Narayanganj", latitude: 23.6238, longitude: 90.5000 },
                { title: "Narsingdi", latitude: 23.9190, longitude: 90.7176 },
                { title: "Natore", latitude: 24.4206, longitude: 88.9888 },
                { title: "Netrokona", latitude: 24.8860, longitude: 90.7289 },
                { title: "Nilphamari", latitude: 25.9310, longitude: 88.8560 },
                { title: "Noakhali", latitude: 22.8236, longitude: 91.0973 },
                { title: "Pabna", latitude: 24.0000, longitude: 89.2500 },
                { title: "Panchagarh", latitude: 26.3411, longitude: 88.5540 },
                { title: "Patuakhali", latitude: 22.3596, longitude: 90.3296 },
                { title: "Pirojpur", latitude: 22.5791, longitude: 89.9759 },
                { title: "Rajbari", latitude: 23.7151, longitude: 89.5875 },
                { title: "Rajshahi", latitude: 24.3745, longitude: 88.6042 },
                { title: "Rangamati", latitude: 22.7324, longitude: 92.2985 },
                { title: "Rangpur", latitude: 25.7466, longitude: 89.2500 },
                { title: "Satkhira", latitude: 22.7085, longitude: 89.0715 },
                { title: "Shariatpur", latitude: 23.2423, longitude: 90.4348 },
                { title: "Sherpur", latitude: 25.0200, longitude: 90.0156 },
                { title: "Sirajganj", latitude: 24.4539, longitude: 89.7000 },
                { title: "Sunamganj", latitude: 25.0715, longitude: 91.3990 },
                { title: "Sylhet", latitude: 24.8949, longitude: 91.8687 },
                { title: "Tangail", latitude: 24.2513, longitude: 89.9167 },
                { title: "Thakurgaon", latitude: 26.0418, longitude: 88.4285 }
            ];

            // Featured districts (major cities) - THESE WILL BLINK
            const featuredDistricts = [
                "Dhaka", "Chattogram", "Khulna", "Rajshahi", "Sylhet",
                "Barisal", "Rangpur", "Mymensingh", "Cox's Bazar", "Gazipur"
            ];

            // Marker series for all districts
            var imageSeries = chart.series.push(new am4maps.MapImageSeries());

            districtData.forEach(function (district) {
                var image = imageSeries.mapImages.create();
                image.latitude = district.latitude;
                image.longitude = district.longitude;

                const isFeatured = featuredDistricts.includes(district.title);

                if (isFeatured) {
                    // FEATURED DISTRICTS - BLINKING PULSE
                    var pulse = image.createChild(am4core.Circle);
                    pulse.radius = 12;
                    pulse.fill = am4core.color("#c41e3a");
                    pulse.opacity = 0.4;
                    pulse.zIndex = -1;
                    pulse.tooltipText = district.title + " (Featured District)";
                    pulse.interactionsEnabled = false;
                    animatePulse(pulse);

                    // Featured marker (larger, red)
                    var circle = image.createChild(am4core.Circle);
                    circle.radius = 8;
                    circle.fill = am4core.color("#c41e3a");
                    circle.stroke = am4core.color("#ffffff");
                    circle.strokeWidth = 2;
                    circle.nonScaling = true;
                    circle.tooltipText = district.title + " (Featured District)";

                    // Label for featured districts (bold)
                    var label = image.createChild(am4core.Label);
                    label.text = district.title;
                    label.fontSize = 11;
                    label.fontWeight = "bold";
                    label.horizontalCenter = "left";
                    label.verticalCenter = "middle";
                    label.dx = 12;
                    label.fill = am4core.color("#1a1a1a");
                    label.nonScaling = true;
                    label.background = new am4core.RoundedRectangle();
                    label.background.fill = am4core.color("#ffffff");
                    label.background.fillOpacity = 0.9;
                    label.background.cornerRadius(4, 4, 4, 4);
                    label.padding(3, 6, 3, 6);
                } else {
                    // REGULAR DISTRICTS - NO BLINKING
                    var circle = image.createChild(am4core.Circle);
                    circle.radius = 5;
                    circle.fill = am4core.color("#0066cc");
                    circle.stroke = am4core.color("#ffffff");
                    circle.strokeWidth = 1;
                    circle.nonScaling = true;
                    circle.tooltipText = district.title;

                    // Label for regular districts (normal)
                    var label = image.createChild(am4core.Label);
                    label.text = district.title;
                    label.fontSize = 9;
                    label.fontWeight = "500";
                    label.horizontalCenter = "left";
                    label.verticalCenter = "middle";
                    label.dx = 8;
                    label.fill = am4core.color("#333333");
                    label.nonScaling = true;
                    label.background = new am4core.RoundedRectangle();
                    label.background.fill = am4core.color("#ffffff");
                    label.background.fillOpacity = 0.7;
                    label.background.cornerRadius(2, 2, 2, 2);
                    label.padding(2, 4, 2, 4);
                }
            });

            // Animate blinking for FEATURED districts only
            function animatePulse(target) {
                target.animate({ property: "scale", from: 1, to: 2.5 }, 1500, am4core.ease.sinOut)
                    .events.on("animationended", function (event) {
                    animatePulse(event.target.object);
                });
                target.animate({ property: "opacity", from: 0.4, to: 0 }, 1500, am4core.ease.sinOut);
            }
        }

        // Add click handlers for interactive elements
        document.addEventListener("DOMContentLoaded", function () {
            // Division item click handlers
            document.querySelectorAll(".division-item").forEach(function (item) {
                item.addEventListener("click", function () {
                    const divisionName = this.querySelector('span:nth-child(2)').textContent.trim();
                    console.log("Clicked division:", divisionName);
                    // You can add more functionality here
                });
            });

            // View details button
            const viewDetailsBtn = document.querySelector(".view-details-btn");
            if (viewDetailsBtn) {
                viewDetailsBtn.addEventListener("click", function () {
                    alert("Loading detailed report...");
                    // You can redirect to a detailed report page or open a modal
                });
            }
        });
    </script>
@endpush
