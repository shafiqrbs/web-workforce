{{--
<section class="map-section">
    <div class="container-fluid p-0">
        <div class="map-inner">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1241.9555807693464!2d90.41628481685511!3d23.793893402878314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7a980d472c5%3A0x98d6de7269465292!2sGlobal%20Alliance%20for%20Improved%20Nutrition%20(GAIN)%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1716888027368!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>
--}}


<section class="map-section">
    <div class="container-fluid p-0">
        <div class="header">
            <h1>AREA COVERAGE</h1>
        </div>

        <div class="content">
            <div class="intro-text">
                WAVE Foundation has been implementing its projects and programs in 34 Districts & 5 Divisions.
            </div>

            <div class="districts-grid">
                <div class="district-card">Khulna</div>
                <div class="district-card">Barishal</div>
                <div class="district-card">Chuadanga</div>
                <div class="district-card">Jessore</div>
                <div class="district-card">Laxmipur</div>
                <div class="district-card">Dhaka</div>
                <div class="district-card">Barguna</div>
            </div>


            <button class="view-more-btn">View More</button>

            <div class="map-container" id="chartdiv"></div>
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
        .map-badge {
            display: inline-flex;
            align-items: center;
            background-color: #c41e3a;
            color: #ffffff;
            border-radius: 999px;
            padding: 6px 14px 6px 10px;
            font-size: 13px;
            font-weight: bold;
            animation: blink 1.8s infinite ease-in-out;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        }

        .map-badge .icon {
            background-color: #ffffff;
            color: #c41e3a;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            font-size: 12px;
        }

        /* Blinking animation */
        @keyframes blink {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.75; }
            100% { transform: scale(1); opacity: 1; }
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

        .intro-text {
            text-align: center;
            margin-bottom: 40px;
            font-size: 1.2em;
            color: #333;
            font-weight: 500;
        }

        .districts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-bottom: 40px;
        }

        .district-card {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            font-weight: 500;
            color: #666;
        }

        .district-card:hover {
            border-color: #c41e3a;
            background: #c41e3a;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(196, 30, 58, 0.3);
        }

        .view-more-btn {
            display: block;
            margin: 30px auto;
            padding: 15px 40px;
            background: white;
            border: 2px solid #c41e3a;
            color: #c41e3a;
            border-radius: 25px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .view-more-btn:hover {
            background: #c41e3a;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(196, 30, 58, 0.3);
        }

        .map-container {
            height: 600px;
            width: 100%;
            margin-top: 30px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2em;
            }

            .districts-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 10px;
            }

            .map-container {
                height: 500px;
            }
        }
    </style>
@endpush
{{--
@push('scripts')
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/geodata/bangladeshLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

    <script>
        window.addEventListener("load", function () {
            if (typeof am4core === "undefined") return;

            am4core.useTheme(am4themes_animated);

            var chart = am4core.create("chartdiv", am4maps.MapChart);
            chart.geodata = am4geodata_bangladeshLow;
            chart.projection = new am4maps.projections.Miller();

            chart.zoomControl = new am4maps.ZoomControl();
            chart.seriesContainer.draggable = true;
            chart.chartContainer.wheelable = true;

            // Map polygons
            var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
            polygonSeries.useGeodata = true;
            polygonSeries.mapPolygons.template.tooltipText = "{name}";
            polygonSeries.mapPolygons.template.fill = am4core.color("#2d8659");
            polygonSeries.mapPolygons.template.stroke = am4core.color("#ffffff");

            const districts = [
                { title: "Khulna", latitude: 22.8456, longitude: 89.5403 },
                { title: "Barishal", latitude: 22.7010, longitude: 90.3535 },
                { title: "Chuadanga", latitude: 23.6401, longitude: 88.8410 },
                { title: "Jashore", latitude: 23.1667, longitude: 89.2167 },
                { title: "Laxmipur", latitude: 22.9447, longitude: 90.8282 },
                { title: "Dhaka", latitude: 23.8103, longitude: 90.4125 },
                { title: "Barguna", latitude: 22.1596, longitude: 90.1251 },
                { title: "Pirojpur", latitude: 22.5791, longitude: 89.9759 },
                { title: "Sandwip", latitude: 22.5083, longitude: 91.4500 }
            ];

            // Markers series
            var imageSeries = chart.series.push(new am4maps.MapImageSeries());

            districts.forEach((d) => {
                let marker = imageSeries.mapImages.create();
                marker.latitude = d.latitude;
                marker.longitude = d.longitude;

                // Container
                let container = marker.createChild(am4core.Container);
                container.layout = "horizontal";
                container.padding(8, 12, 8, 8);
                container.background = new am4core.RoundedRectangle();
                container.background.cornerRadius(20, 20, 20, 20);
                container.background.fill = am4core.color("#c41e3a");
                container.background.fillOpacity = 1;
                container.background.strokeOpacity = 0;
                container.verticalCenter = "middle";
                container.horizontalCenter = "middle";
                container.nonScaling = true;

                // Blinking circle
                let pulse = container.createChild(am4core.Circle);
                pulse.radius = 10;
                pulse.fill = am4core.color("#ffffff");
                pulse.strokeWidth = 0;
                pulse.marginRight = 8;
                animatePulse(pulse);

                // Short icon/text inside circle
                let iconLabel = container.createChild(am4core.Label);
                iconLabel.text = '<i class="fas fa-location-arrow"></i>';
                iconLabel.fontSize = 12;
                iconLabel.fill = am4core.color("#c41e3a");
                iconLabel.horizontalCenter = "middle";
                iconLabel.verticalCenter = "middle";
                iconLabel.marginRight = 4;

                // District Name
                let districtLabel = container.createChild(am4core.Label);
                districtLabel.text = d.title;
                districtLabel.fontSize = 13;
                districtLabel.fontWeight = "bold";
                districtLabel.fill = am4core.color("#ffffff");
                districtLabel.verticalCenter = "middle";
            });

            // Blinking effect
            function animatePulse(target) {
                target.animate({ property: "scale", from: 1, to: 2 }, 1000, am4core.ease.cubicOut)
                    .events.on("animationended", function (event) {
                    animatePulse(event.target.object);
                });

                target.animate({ property: "opacity", from: 1, to: 0 }, 1000, am4core.ease.cubicOut);
            }
        });
    </script>
@endpush
--}}


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

            // District data
            const districtData = [
                { title: "Khulna", latitude: 22.8456, longitude: 89.5403 },
                { title: "Barishal", latitude: 22.7010, longitude: 90.3535 },
                { title: "Chuadanga", latitude: 23.6401, longitude: 88.8410 },
                { title: "Jashore", latitude: 23.1667, longitude: 89.2167 },
                { title: "Laxmipur", latitude: 22.9447, longitude: 90.8282 },
                { title: "Dhaka", latitude: 23.8103, longitude: 90.4125 },
                { title: "Barguna", latitude: 22.1596, longitude: 90.1251 },
                { title: "Pirojpur", latitude: 22.5791, longitude: 89.9759 },
                { title: "Sandwip", latitude: 22.5083, longitude: 91.4500 }
            ];

            // Marker series
            var imageSeries = chart.series.push(new am4maps.MapImageSeries());

            districtData.forEach(function (district) {
                var image = imageSeries.mapImages.create();
                image.latitude = district.latitude;
                image.longitude = district.longitude;

                // Blinking circle (pulse) – DO NOT set nonScaling = true here!
                var pulse = image.createChild(am4core.Circle);
                pulse.radius = 8;
                pulse.fill = am4core.color("#ff0000");
                pulse.opacity = 0.4;
                pulse.zIndex = -1;
                pulse.tooltipText = district.title;
                pulse.interactionsEnabled = false;

                animatePulse(pulse);

                // Static marker
                var circle = image.createChild(am4core.Circle);
                circle.radius = 8;
                circle.fill = am4core.color("#ff0000");
                circle.stroke = am4core.color("#ffffff");
                circle.strokeWidth = 2;
                circle.nonScaling = true;
                circle.tooltipText = district.title;

                // Label
                var label = image.createChild(am4core.Label);
                label.text = district.title;
                label.fontSize = 12;
                label.fontWeight = "bold";
                label.horizontalCenter = "left";
                label.verticalCenter = "middle";
                label.dx = 12;
                label.fill = am4core.color("#000000");
                label.nonScaling = true;
            });

            // Animate blinking
            function animatePulse(target) {
                target.animate({ property: "scale", from: 1, to: 2 }, 1000, am4core.ease.sinOut)
                    .events.on("animationended", function (event) {
                    animatePulse(event.target.object);
                });

                target.animate({ property: "opacity", from: 0.4, to: 0 }, 1000, am4core.ease.sinOut);
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".district-card").forEach(function (card) {
                card.addEventListener("click", function () {
                    console.log("Clicked:", this.textContent);
                });
            });

            const btn = document.querySelector(".view-more-btn");
            if (btn) {
                btn.addEventListener("click", () => {
                    alert("Load more districts...");
                });
            }
        });
    </script>
@endpush

