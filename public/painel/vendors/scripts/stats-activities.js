var months = document.getElementById('months').value
months = JSON.parse(months)

var year = document.getElementById('year').value
year = JSON.parse(year)

var statsActivities = document.getElementById('statsActivities').value
statsActivities = JSON.parse(statsActivities)

var options = {
	title: {
		text: `Actividade de Vendas Anual, ${year}`
	},
    series: [{
        name: "Qty. Vendida",
        data: statsActivities
    }],
    chart: {
        height: 350,
        type: 'line',
        zoom: {
            enabled: false,
        },
        dropShadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 16,
            opacity: 0.2
        },
        toolbar: {
            show: true
        }
    },
    colors: ['#255cd3'],
    dataLabels: {
        enabled: true,
    },
    stroke: {
        width: [3, 3],
        curve: 'smooth'
    },
    grid: {
        show: true,
    },
    markers: {
        colors: ['#255cd3'],
        size: 5,
        strokeColors: '#ffffff',
        strokeWidth: 2,
        hover: {
            sizeOffset: 2
        }
    },
    xaxis: {
        categories: months,
        labels: {
            style: {
                colors: '#8c9094'
            }
        }
    },
    yaxis: {
        min: 0,
        labels: {
            style: {
                colors: '#8c9094'
            }
		},
		title: {
			text: 'Quantidades'
		}
    },
    legend: {
        position: 'top',
        horizontalAlign: 'left',
        floating: true,
        offsetY: 0,
        labels: {
            useSeriesColors: true
        },
        markers: {
            width: 10,
            height: 10,
        }
    }
};


var chart = new ApexCharts(document.querySelector("#activities-chart"), options);
chart.render();
