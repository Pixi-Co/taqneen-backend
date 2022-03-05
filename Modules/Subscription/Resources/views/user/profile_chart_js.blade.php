<script>
    var options = {
        annotations: {
            xaxis: [{
                //x: new Date("28 Apr 2014").getTime(),
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
            data: [
                @if (isset($resource['data']))
                @foreach ($resource['data'] as $item) 
                    {{ $item }}, 
                @endforeach
                @endif
            ],
        }, ],
        title: {
            text: '{{ isset($title)? $title : '' }}',
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
                    formatter: (seriesName) => " ",
                },
            },
        },
        labels: [
            @if (isset($resource['labels']))
            @foreach ($resource['labels'] as $item) 
                '{{ $item }}', 
            @endforeach
            @endif
        ],
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
            type: "text",
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
    }

    var chart_m_{{ $id }} = new ApexCharts(document.querySelector("#chart_m_{{ $id }}"), options);

    chart_m_{{ $id }}.render();
</script>
