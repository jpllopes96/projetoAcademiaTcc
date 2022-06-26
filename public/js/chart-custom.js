
const colors = [
    '#4dc9f6',
    '#f67019',
    '#f53794',
    '#537bc4',
    '#acc236',
    '#166a8f',
    '#00a950',
    '#58595b',
    '#8549ba'
];

/**
 * 
 * @param chartData {
            labels: ['item1', 'item2'],
            data: [10, 10],
            backgroundColor: "#0d6efd",
            title: 'Title',
            elementId: 'id-element'
        } 
 */
function chartCustomTypeLine(chartData) {
    let data = {
        labels: chartData.labels,
        datasets: [{
            label: chartData.title,
            data: chartData.data,
            // borderColor: 'rgba(60,141,188,0.8)',
            // pointRadius: false,
            // pointColor: '#3b8bba',
            // pointStrokeColor: 'rgba(60,141,188,1)',
            // pointHighlightFill: '#fff',
            // pointHighlightStroke: 'rgba(60,141,188,1)',
            backgroundColor: chartData.backgroundColor,
            fill: true,
            tension: 0.4,
        }],
    };
    let config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                    }
                },
                y: {
                    grid: {
                        display: true
                    }
                },
            }
        }
    };

    let myChart = new Chart(
        document.getElementById(chartData.elementId),
        config
    );
}


function chartCustomTypeDoughnut(chartData) {
    let chart = new Chart(document.getElementById(chartData.elementId), {
        type: 'doughnut',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: '',
                data: chartData.data,
                borderWidth: 1,
                backgroundColor: colors,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false,
                }
            },
        }
    });
}


function chartCustomTypeBar(chartData) {

    let chart = new Chart(document.getElementById(chartData.elementId), {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: '',
                data: chartData.data,
                backgroundColor: colors,
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: false,
                },
            }
        }
    });
}