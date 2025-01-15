document.addEventListener('DOMContentLoaded', function () {
    // Data for Profit of Individual Stocks Chart
    const profitChartCtx = document.getElementById('profitChart').getContext('2d');
    const profitChart = new Chart(profitChartCtx, {
        type: 'bar',
        data: {
            labels: ['LBBL', 'SIFC', 'ILI', 'SPDL', 'PFL', 'USHEC', 'CYCL', 'NRM', 'RNLI', 'SONA'],
            datasets: [{
                label: 'Profit Value',
                data: [50000, 40000, 30000, -40000, 60000, -50000, 20000, 10000, 30000, 5000],
                backgroundColor: '#00bcd4',
                borderColor: '#0097a7',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Data for Portfolio Weight Chart
    const portfolioWeightChartCtx = document.getElementById('portfolioWeightChart').getContext('2d');
    const portfolioWeightChart = new Chart(portfolioWeightChartCtx, {
        type: 'pie',
        data: {
            labels: ['LBBL', 'SIFC', 'ILI', 'SPDL', 'PFL', 'USHEC', 'CYCL', 'NRM', 'RNLI', 'SONA'],
            datasets: [{
                data: [15, 10, 20, 10, 5, 10, 5, 5, 10, 10],
                backgroundColor: [
                    '#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff',
                    '#ff9f40', '#8dd3c7', '#fb8072', '#80b1d3', '#fdb462'
                ]
            }]
        },
        options: {
            responsive: true
        }
    });
});
