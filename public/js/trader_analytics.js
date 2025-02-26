document.addEventListener('DOMContentLoaded', function () {
    fetch('/stocks/data')
        .then(response => response.json())  
        .then(data => {
            const stockNames = data.map(stock => stock.stock_name);
            const totalAmounts = data.map(stock => stock.total_amount);

            const profitChartCtx = document.getElementById('profitChart').getContext('2d');
            const profitChart = new Chart(profitChartCtx, {
                type: 'bar',
                data: {
                    labels: stockNames, 
                    datasets: [{
                        label: 'Purchase Value',
                        data: totalAmounts, 
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
        })
        .catch(error => {
            console.error('Error fetching stock data:', error);
        });





   const barChartColors = [
    "#FF5733", "#33FF57", "#3357FF", "#FF33A6", "#FFD700",
    "#8A2BE2", "#40E0D0", "#DC143C", "#00CED1", "#7B68EE"
]; 

const portfolioWeightChartCtx = document.getElementById('portfolioWeightChart').getContext('2d');

const portfolioWeightChart = new Chart(portfolioWeightChartCtx, {
    type: 'pie',
    data: {
        labels: ['LBBL', 'SIFC', 'ILI', 'SPDL', 'PFL', 'USHEC', 'CYCL', 'NRM', 'RNLI', 'SONA'],
        datasets: [{
            data: [15, 10, 20, 10, 5, 10, 5, 5, 10, 10],
            backgroundColor: barChartColors
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'right',
                labels: {
                    boxWidth: 15 
                }
            }
        }
    }
});


});
