$(document).ready(function() {


    var options = {
        series: [42, 47, 52, 58, 65],
        chart: {
            width: 380,
            type: "polarArea",
            toolbar: {
                //show: true
            },
        },
        labels: ["Brand A", "Brand B", "Brand C", "Brand D", "Brand E"],
        fill: {
            opacity: 1,
        },
        stroke: {
            width: 1,
            colors: undefined,
        },
        yaxis: {
            show: false,
        },
        legend: {
            position: "bottom",
        },
        plotOptions: {
            polarArea: {
                rings: {
                    strokeWidth: 0,
                },
                spokes: {
                    strokeWidth: 0,
                },
            },
        },
        theme: {
            monochrome: {
                enabled: true,
                shadeTo: "light",
                shadeIntensity: 0.6,
            },
        },
    };

    var chart = new ApexCharts(document.querySelector("#repairChart1"), options);
    chart.render();

    var options = {
        series: [42, 47, 52, 58, 65],
        chart: {
            width: 380,
            type: "polarArea",
            toolbar: {
                //show: true
            },
        },
        labels: ["Device A", "Device B", "Device C", "Device D", "Device E"],
        colors: ["#41bc85", "#58D49D", "#6BE7B0", "#A2EBCA", "#A8EFCF"],
        color: [],
        fill: {
            opacity: 1,
        },
        stroke: {
            width: 1,
            colors: undefined,
        },
        yaxis: {
            show: false,
        },
        legend: {
            position: "bottom",
        },
        plotOptions: {
            polarArea: {
                rings: {
                    strokeWidth: 0,
                },
                spokes: {
                    strokeWidth: 0,
                },
            },
        },
        theme: {
            monochrome: {
                // enabled: true,
                shadeTo: "light",
                shadeIntensity: 0.6,
            },
        },
    };

    var chart1 = new ApexCharts(document.querySelector("#repairChart2"), options);
    chart1.render();

    // // sale report pie charts
    var chart = new ApexCharts(document.querySelector("#saleReportPieChart1"), options);
    chart.render();


    var saleChart1 = new ApexCharts(document.querySelector("#saleReportPieChart1"), options);
    var saleChart2 = new ApexCharts(document.querySelector("#saleReportPieChart2"), options);
    var saleChart3 = new ApexCharts(document.querySelector("#saleReportPieChart3"), options);
    var saleChart4 = new ApexCharts(document.querySelector("#saleReportPieChart4"), options);
    var saleChart5 = new ApexCharts(document.querySelector("#saleReportPieChart5"), options);
    saleChart1.render();
    saleChart2.render();
    saleChart3.render();
    saleChart4.render();
    saleChart5.render();

    var options = {
        series: [{
            name: 'Inflation',
            data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2]
        }],
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                dataLabels: {
                    position: 'top', // top, center, bottom
                },
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function(val) {
                return val + "%";
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#304758"]
            }
        },

        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            position: 'top',
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                fill: {
                    type: 'gradient',
                    gradient: {
                        colorFrom: '#D8E3F0',
                        colorTo: '#BED1E6',
                        stops: [0, 100],
                        opacityFrom: 0.4,
                        opacityTo: 0.5,
                    }
                }
            },
            tooltip: {
                enabled: true,
            }
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                formatter: function(val) {
                    return val + "%";
                }
            }

        },
        colors: ["#41bc85"],
        title: {
            // text: 'Monthly Inflation in Argentina, 2002',
            floating: true,
            offsetY: 330,
            align: 'center',
            style: {
                color: '#444'
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#column_chart"), options);
    chart.render();



    var saleChart1 = new ApexCharts(document.querySelector("#column_chart1"), options);
    var saleChart2 = new ApexCharts(document.querySelector("#column_chart2"), options);
    var saleChart3 = new ApexCharts(document.querySelector("#column_chart3"), options);
    var saleChart4 = new ApexCharts(document.querySelector("#column_chart4"), options);
    var saleChart5 = new ApexCharts(document.querySelector("#column_chart5"), options);
    saleChart1.render();
    saleChart2.render();
    saleChart3.render();
    saleChart4.render();
    saleChart5.render();



    //   repair chart

    var options = {
        series: [{
            name: 'Device model',
            data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5, 13, 9, 17, 2, 7, 5]
        }],
        chart: {
            height: 350,
            type: 'line',

        },

        stroke: {
            width: 7,
            curve: 'smooth'
        },
        xaxis: {
            show: false
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                gradientToColors: ['#41bc85'],
                shadeIntensity: 1,
                type: 'horizontal',
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100, 100, 100]
            },
        },
        markers: {
            size: 4,
            colors: ["#FFA41B"],
            strokeColors: "#fff",
            strokeWidth: 2,
            hover: {
                size: 7,
            }
        },

    };

    var chart = new ApexCharts(document.querySelector("#repairChart3"), options);
    chart.render();

    // sale report charts
    var saleChart1 = new ApexCharts(document.querySelector("#saleReportChart1"), options);
    var saleChart2 = new ApexCharts(document.querySelector("#saleReportChart2"), options);
    var saleChart3 = new ApexCharts(document.querySelector("#saleReportChart3"), options);
    var saleChart4 = new ApexCharts(document.querySelector("#saleReportChart4"), options);
    var saleChart5 = new ApexCharts(document.querySelector("#saleReportChart5"), options);
    saleChart1.render();
    saleChart2.render();
    saleChart3.render();
    saleChart4.render();
    saleChart5.render();

    //************************* chart 1 ********************
    var options = {
        annotations: {
            xaxis: [{
                x: new Date("28 Apr 2014").getTime(),
                borderColor: "#bfc5cc",
                fillColor: "#bfc5cc",
                opacity: 1,
                strokeDashArray: 0,
                label: {
                    borderColor: "#bfc5cc",
                    style: {
                        color: "#fff",
                        fontSize: "12px",
                        lineHeight: "12px",
                        background: "#bfc5cc",
                    },
                    offsetX: -57,
                    offsetY: 30,
                    orientation: "horizontal",
                    text: "🐂 BOT 2",
                    textAnchor: "left",
                },
            }, ],
        },
        chart: {
            toolbar: {
                show: false,
                offsetX: 0,
                offsetY: 0,
                tools: {
                    download: true,
                    selection: true,
                    zoom: true,
                    zoomin: true,
                    zoomout: true,
                    pan: true,
                    reset: true | '<img src="/static/icons/reset.png" width="20">',
                    customIcons: []
                },
                export: {
                    csv: {
                        filename: 'sales',
                        columnDelimiter: ',',
                        headerCategory: 'category',
                        headerValue: 'value',
                        dateFormatter(timestamp) {
                            return new Date(timestamp).toDateString()
                        }
                    },
                    svg: {
                        filename: undefined,
                    },
                    png: {
                        filename: undefined,
                    }
                },
                autoSelected: 'zoom'
            },
            zoom: {
                enabled: true,
                type: 'x',
                autoScaleYaxis: false,
                zoomedArea: {
                    fill: {
                        color: '#90CAF9',
                        opacity: 0.4
                    },
                    stroke: {
                        color: '#0D47A1',
                        opacity: 0.4,
                        width: 1
                    }
                }
            },
            animations: {
                enabled: true,
            },
            fontFamily: "Roboto, sans-serif",
            // zoom: {
            //     autoScaleYaxis: true,
            //     enabed: true,
            //     type: 'x',
            // },
            height: 350,
            type: "area",
            id: "ctxinternalchart",
        },
        colors: ["#41BC85"],
        stroke: {
            width: [2, 1],
        },
        fill: {
            // type: 'gradient',
            // gradient: {
            //     shadeIntensity: 1,
            //     opacityFrom: 0.7,
            //     opacityTo: 1,
            //     stops: [0, 90, 100]
            // }
        },
        dataLabels: {
            enabled: false,
        },
        grid: {
            padding: {
                right: 0,
                left: 0,
            },
            borderColor: "#f9f9f9",
        },
        series: [{
            data: salesOverviewData,
        }, ],
        title: {
            text: undefined,
            align: "left",
            offsetX: -6,
        },
        tooltip: {
            x: {
                format: "MMM d yyyy",
            },
            y: {
                formatter: function(val) {
                    return val.toFixed(2);
                },
                title: {
                    formatter: (seriesName) => __currency,
                },
            },
        },
        labels: salesOverviewLabels,
        xaxis: {
            crosshairs: {
                show: true,
                width: 1,
                position: "front",
                opacity: 1,
                stroke: {
                    color: "#bfc5cc",
                    width: 1,
                    dashArray: 2,
                },
                dropShadow: {
                    enabled: false,
                    top: 0,
                    left: 0,
                    blur: 1,
                    opacity: 0.4,
                },
            },
            labels: {
                format: "MMM yyyy",
                style: {
                    colors: "#666",
                },
            },
            tickAmount: 4,
            tickPlacement: "on",
            tooltip: {
                enabled: false,
            },
            type: "datetime",
        },
        yaxis: {
            tickAmount: 4,
            forceNiceScale: true,
            labels: {
                formatter: function(val, index) {
                    return val.toFixed(0);
                },
                style: {
                    colors: "#666",
                },
            },
            opposite: is_rtl
        },
        style: {
            direction: 'rtl'
        },
    };
    var chart = new ApexCharts(document.querySelector("#chart1"), options);
    chart.render();

    // <!-- ------- chart js pie script -------------- -->

    if (document.getElementById('myChart')) {
        var myData = [65, 15, 20];
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: "pie",
            data: {
                labels: topSellerProductLabels,
                datasets: [{
                    data: topSellerProductData,
                    backgroundColor: ["#41BC85", "#ff7043", "#54B5E8"],
                    borderWidth: 5,
                }, ],
            },
            options: {
                responsive: true,
                title: {
                    display: false,
                    text: "Chart.js Line Chart",
                },
                plugins: {
                    legend: {
                        display: false,
                        hidden: true,
                    }
                }
            },
        });
    }


    // <!-- ------- chart js pie script -------------- -->

    if (document.getElementById("myChartMembership")) {

        var myData = [65, 15, 20];
        var ctx = document.getElementById("myChartMembership");
        var myChart = new Chart(ctx, {
            type: "pie",
            data: {
                labels: topSellerMemberShipLabels,
                datasets: [{
                    data: topSellerMemberShipData,
                    backgroundColor: ["#41BC85", "#ff7043", "#54B5E8"],
                    borderWidth: 5,
                }, ],
            },
            options: {
                responsive: true,
                title: {
                    display: false,
                    text: "Chart.js Line Chart",
                },
                plugins: {
                    legend: {
                        display: false,
                        hidden: true,
                    }
                }
            },
        });
    }

    //  repair chart

    // <!-- ------- chart js doughnut script -------------- -->

    var ctx = document.getElementById("myChart2");
    var myChart = new Chart(ctx, {
        type: "doughnut",
        data: {
            datasets: [{
                data: topSellerCategoryData,
                backgroundColor: ["#41BC85", "#ff7043", "#54B5E8"],
                borderWidth: 5,
                borderColor: "#fff",
            }, ],
        },
        options: {
            responsive: true,
            cutoutPercentage: 75,
            title: {
                display: false,
                text: "Chart.js Line Chart",
            },
        },
    });

    // Get the chart's base64 image string
    // var image = myChart.toBase64Image();
    // console.log(image);

    // document.getElementById('menu1').onclick = function() {
    //   // Trigger the download
    //   var a = document.createElement('a');
    //   a.href = myChart.toBase64Image();
    //   a.download = 'my_file_name.png';
    //   a.click();
    // }

    // chart bars
    var options = {
        series: [{
                name: "Net Profit",
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
            },
            {
                name: "Revenue",
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
            },
            {
                name: "Free Cash Flow",
                data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
            },
        ],
        chart: {
            type: "bar",
            height: 350,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "55%",
                endingShape: "rounded",
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: 2,
            colors: ["transparent"],
        },
        xaxis: {
            categories: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "July",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
            labels: {
                style: {
                    fontSize: "5px",
                },
            },
        },
        yaxis: {},
        fill: {
            opacity: 1,
            colors: ["#41BC85", "#54B5E8", "#ff7043"],
        },

        tooltip: {
            y: {
                formatter: function(val) {
                    return "$ " + val + " thousands";
                },
            },
        },
    };

    var chart = new ApexCharts(document.querySelector("#chart2"), options);
    chart.render();

    /* ********************* *chart js line script ***************** */
    /*var optionsSalesReport = {
        chart: {
            height: 350,
            type: "line",
            stacked: false
        },
        dataLabels: {
            enabled: false
        },
        colors: ["#FF1654", "#247BA0"],
        series: [{
                name: "sales report of this month",
                data: salesReportData1
            },
            {
                name: "sales report of last month",
                data: salesReportData2
            }
        ],
        stroke: {
            width: [4, 4]
        },
        plotOptions: {
            bar: {
                columnWidth: "20%"
            }
        },
        xaxis: {
            categories: salesReportLabels1
        },
        yaxis: [{
                axisTicks: {
                    show: true
                },
                axisBorder: {
                    show: true,
                    color: "#FF1654"
                },
                labels: {
                    enabled: false,
                    style: {
                        colors: "#FF1654"
                    }
                },
            },
            {
                opposite: true,
                axisTicks: {
                    show: true
                },
                axisBorder: {
                    show: true,
                    color: "#247BA0"
                },
                labels: {
                    enabled: false,
                    style: {
                        colors: "#247BA0"
                    }
                },
            }
        ],
        tooltip: {
            shared: false,
            intersect: true,
            x: {
                show: false
            }
        },
        legend: {
            horizontalAlign: "left",
            offsetX: 40
        }
    };

    var chart = new ApexCharts(document.querySelector("#chartLine1"), optionsSalesReport);
    chart.render();
*/

    /* chart js line script */
    var ctx8 = document.getElementById("chartLine1");
    new Chart(ctx8, {
        type: "line",
        data: {
            labels: salesReportLabels1,
            datasets: [{
                    data: salesReportData1,
                    borderColor: "#ff7043",
                    borderWidth: 1,
                    fill: false,
                },
                {
                    data: salesReportData2,
                    borderColor: "#43bb8d",
                    borderWidth: 1,
                    fill: false,
                },
            ],
        },
        options: {
            maintainAspectRatio: false,
            rtl: is_rtl,
            legend: {
                display: false,
                labels: {
                    display: false,
                },
                rtl: is_rtl
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        fontSize: 10,
                        max: 80,
                    },
                    rtl: is_rtl
                }, ],
                xAxes: [{
                    ticks: {
                        beginAtZero: true,
                        fontSize: 11,
                        max: 80,
                    },
                }, ],
            },
        },
    });

    /**************************** other chart */


    new Chart(document.getElementById("mixed-chart"), {
        type: 'bar',
        data: {
            labels: ["70", "30", "25", "50"],
            datasets: [{
                label: "Africa",
                type: "line",
                borderColor: "#54b4ec",
                data: [50, 221, 150, 200],
                fill: false
            }]
        },
        options: {

            scales: {
                xAxes: [{
                    display: false
                }],
                yAxes: [{
                    display: false
                }]
            },
            legend: { display: false }
        }
    });

    new Chart(document.getElementById("mixed-chart2"), {
        type: 'bar',
        data: {
            labels: ["70", "30", "25", "50"],
            datasets: [{
                label: "Africa",
                type: "line",
                borderColor: "#54b4ec",
                data: [50, 221, 150, 200],
                fill: false
            }]
        },
        options: {

            scales: {
                xAxes: [{
                    display: false
                }],
                yAxes: [{
                    display: false
                }]
            },
            legend: { display: false }
        }
    });

});