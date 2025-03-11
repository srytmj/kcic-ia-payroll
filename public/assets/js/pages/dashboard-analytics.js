"use strict";
$(document).ready(function () {
    setTimeout(function () {
        floatchart();
    }, 100);
});

function floatchart() {
    // [ premiumeconomy-class ] start
    $(function () {
        var options = {
            chart: {
                type: "area",
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            dataLabels: {
                enabled: false,
            },
            colors: ["#4680ff"],
            fill: {
                type: "solid",
                opacity: 0.3,
            },
            markers: {
                size: 3,
                opacity: 0.9,
                colors: "#fff",
                strokeColor: "#4680ff",
                strokeWidth: 2,
                hover: {
                    size: 7,
                },
            },
            stroke: {
                curve: "straight",
                width: 3,
            },
            series: [
                {
                    name: "series1",
                    data: [
                        25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41,
                        89, 63, 54, 25, 66, 41, 89,
                    ],
                },
            ],
            tooltip: {
                fixed: {
                    enabled: false,
                },
                x: {
                    show: false,
                },
                y: {
                    title: {
                        formatter: function (seriesName) {
                            return "Premium Economy ";
                        },
                    },
                },
                marker: {
                    show: false,
                },
            },
        };
        var chart = new ApexCharts(
            document.querySelector("#premiumeconomy-class"),
            options
        );
        chart.render();
    });
    // [ premiumeconomy-class ] end

    // [ business-class ] start
    $(function () {
        var options = {
            chart: {
                type: "area",
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            dataLabels: {
                enabled: false,
            },
            colors: ["#9ccc65"],
            fill: {
                type: "solid",
                opacity: 0.3,
            },
            markers: {
                size: 3,
                opacity: 0.9,
                colors: "#fff",
                strokeColor: "#9ccc65",
                strokeWidth: 2,
                hover: {
                    size: 7,
                },
            },
            stroke: {
                curve: "straight",
                width: 3,
            },
            series: [
                {
                    name: "series1",
                    data: [
                        25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41,
                        89, 63, 54, 25, 66, 41, 89, 63, 25, 44, 12,
                    ],
                },
            ],
            tooltip: {
                fixed: {
                    enabled: false,
                },
                x: {
                    show: false,
                },
                y: {
                    title: {
                        formatter: function (seriesName) {
                            return "Premium Economy ";
                        },
                    },
                },
                marker: {
                    show: false,
                },
            },
        };
        var chart = new ApexCharts(
            document.querySelector("#business-class"),
            options
        );
        chart.render();
    });
    // [ business-class ] end

    // [ first-class ] start
    $(function () {
        var options = {
            chart: {
                type: "area",
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            dataLabels: {
                enabled: false,
            },
            colors: ["#ffba57"],
            fill: {
                type: "solid",
                opacity: 0.3,
            },
            markers: {
                size: 3,
                opacity: 0.9,
                colors: "#fff",
                strokeColor: "#ffba57",
                strokeWidth: 2,
                hover: {
                    size: 7,
                },
            },
            stroke: {
                curve: "straight",
                width: 3,
            },
            series: [
                {
                    name: "series1",
                    data: [
                        25, 44, 12, 36, 9, 54, 25, 66, 41, 89, 25, 66, 41, 89,
                        63, 54, 25, 66, 41, 89, 63,
                    ],
                },
            ],
            tooltip: {
                fixed: {
                    enabled: false,
                },
                x: {
                    show: false,
                },
                y: {
                    title: {
                        formatter: function (seriesName) {
                            return "First Class ";
                        },
                    },
                },
                marker: {
                    show: false,
                },
            },
        };
        var chart = new ApexCharts(
            document.querySelector("#first-class"),
            options
        );
        chart.render();
    });
    // [ first-class ] end

    // [ realtime-visit-chart ] start
    $(function () {
        var data = [];
        var currentIndex = 0;

        function fetchData() {
            fetch("penjualan/hari") // Ganti dengan URL API yang sesuai
                .then((response) => response.json())
                .then((result) => {
                    data = result.map((item) => ({
                        x: new Date(item.purchase_date).getTime(),
                        y: item.total_tiket_terjual,
                    }));

                    // Sort biar urutan tanggal tetap naik
                    data.sort((a, b) => a.x - b.x);

                    if (data.length > 0) {
                        startChart();
                    }
                })
                .catch((error) => console.error("Error fetching data:", error));
        }

        function startChart() {
            var options = {
                chart: {
                    height: 290,
                    type: "area",
                    animations: {
                        enabled: true,
                        easing: "linear",
                        dynamicAnimation: { speed: 2000 },
                    },
                    toolbar: { show: false },
                    zoom: { enabled: false },
                },
                dataLabels: { enabled: false },
                stroke: { curve: "smooth" },
                series: [{ name: "Total Tiket Terjual", data: [] }],
                colors: ["#ff5252"],
                fill: { type: "solid", opacity: 0 },
                markers: { size: 0 },
                xaxis: { type: "datetime" },
                yaxis: { max: 100 },
                legend: { show: false },
            };

            var chart = new ApexCharts(
                document.querySelector("#realtime-visit-chart"),
                options
            );
            chart.render();

            function updateChart() {
                if (currentIndex >= data.length) {
                    currentIndex = 0; // Reset ke awal kalau udah mentok
                }

                chart.updateSeries([{ data: data.slice(0, currentIndex + 1) }]);
                currentIndex++;
            }

            setInterval(updateChart, 2000);
        }

        fetchData();
    });
    // [ realtime-visit-chart ] end

    // [ seo-anlytics51 ] start
    $(function () {
        var options = {
            chart: {
                type: "area",
                height: 35,
                sparkline: {
                    enabled: true,
                },
            },
            dataLabels: {
                enabled: false,
            },
            colors: ["#4680ff"],
            fill: {
                type: "solid",
                opacity: 0,
            },
            grid: {
                padding: {
                    left: 5,
                    right: 5,
                },
            },
            markers: {
                size: 3,
                opacity: 0.9,
                colors: "#4680ff",
                strokeColor: "#4680ff",
                strokeWidth: 1,
                hover: {
                    size: 4,
                },
            },
            stroke: {
                curve: "straight",
                width: 2,
            },
            series: [
                {
                    name: "series1",
                    data: [
                        25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41,
                        89,
                    ],
                },
            ],
            tooltip: {
                fixed: {
                    enabled: false,
                },
                x: {
                    show: false,
                },
                y: {
                    title: {
                        formatter: function (seriesName) {
                            return "Site Analysis :";
                        },
                    },
                },
                marker: {
                    show: false,
                },
            },
        };
        var chart = new ApexCharts(
            document.querySelector("#seo-anlytics51"),
            options
        );
        chart.render();
    });
    // [ seo-anlytics51 ] end

    // [ traffic-chart1 ] start
    $(function () {
        function fetchData() {
            fetch("penjualan/seat-class") // Ganti dengan URL API yang sesuai
                .then((response) => response.json())
                .then((result) => {
                    let series = result.map((item) => item.total_tiket_terjual);
                    let labels = result.map((item) => item.seat_class);

                    updateChart(series, labels);
                })
                .catch((error) => console.error("Error fetching data:", error));
        }

        function updateChart(series, labels) {
            var options = {
                chart: {
                    height: 250,
                    type: "donut",
                },
                dataLabels: {
                    enabled: true,
                    dropShadow: { enabled: false },
                },
                series: series,
                labels: labels,
                colors: ["#4680ff", "#0e9e4a", "#ff5252", "#f39c12"], // Tambahin warna kalau seat class lebih dari 3
                legend: {
                    show: true,
                    position: "bottom",
                },
            };

            var chart = new ApexCharts(
                document.querySelector("#traffic-chart1"),
                options
            );
            chart.render();
        }

        fetchData();
    });
    // [ traffic-chart1 ] end
    // [ seo-chart1 ] start
    $(function () {
        var options = {
            chart: {
                type: "area",
                height: 40,
                sparkline: {
                    enabled: true,
                },
            },
            dataLabels: {
                enabled: false,
            },
            colors: ["#4680ff"],
            fill: {
                type: "solid",
                opacity: 0.3,
            },
            markers: {
                size: 2,
                opacity: 0.9,
                colors: "#4680ff",
                strokeColor: "#4680ff",
                strokeWidth: 2,
                hover: {
                    size: 4,
                },
            },
            stroke: {
                curve: "straight",
                width: 3,
            },
            series: [
                {
                    name: "series1",
                    data: [9, 66, 41, 89, 63, 25, 44, 12, 36, 20, 54, 25, 9],
                },
            ],
            tooltip: {
                fixed: {
                    enabled: false,
                },
                x: {
                    show: false,
                },
                y: {
                    title: {
                        formatter: function (seriesName) {
                            return "Visits :";
                        },
                    },
                },
                marker: {
                    show: false,
                },
            },
        };
        var chart = new ApexCharts(
            document.querySelector("#seo-chart1"),
            options
        );
        chart.render();
    });
    // [ seo-chart1 ] end

    // [ seo-chart2 ] start
    $(function () {
        var options = {
            chart: {
                type: "bar",
                height: 40,
                sparkline: {
                    enabled: true,
                },
            },
            dataLabels: {
                enabled: false,
            },
            colors: ["#9ccc65"],
            plotOptions: {
                bar: {
                    columnWidth: "60%",
                },
            },
            series: [
                {
                    data: [
                        25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41,
                        89, 63,
                    ],
                },
            ],
            xaxis: {
                crosshairs: {
                    width: 1,
                },
            },
            tooltip: {
                fixed: {
                    enabled: false,
                },
                x: {
                    show: false,
                },
                y: {
                    title: {
                        formatter: function (seriesName) {
                            return "Bounce Rate :";
                        },
                    },
                },
                marker: {
                    show: false,
                },
            },
        };
        var chart = new ApexCharts(
            document.querySelector("#seo-chart2"),
            options
        );
        chart.render();
    });
    // [ seo-chart2 ] end

    // [ seo-chart3 ] start
    $(function () {
        var options = {
            chart: {
                type: "area",
                height: 40,
                sparkline: {
                    enabled: true,
                },
            },
            dataLabels: {
                enabled: false,
            },
            colors: ["#ff5252"],
            fill: {
                type: "solid",
                opacity: 0,
            },
            markers: {
                size: 2,
                opacity: 0.9,
                colors: "#ff5252",
                strokeColor: "#ff5252",
                strokeWidth: 2,
                hover: {
                    size: 4,
                },
            },
            stroke: {
                curve: "straight",
                width: 3,
            },
            series: [
                {
                    name: "series1",
                    data: [9, 66, 41, 89, 63, 25, 44, 12, 36, 20, 54, 25, 9],
                },
            ],
            tooltip: {
                fixed: {
                    enabled: false,
                },
                x: {
                    show: false,
                },
                y: {
                    title: {
                        formatter: function (seriesName) {
                            return "Products :";
                        },
                    },
                },
                marker: {
                    show: false,
                },
            },
        };
        var chart = new ApexCharts(
            document.querySelector("#seo-chart3"),
            options
        );
        chart.render();
    });
    // [ seo-chart3 ] end
}
