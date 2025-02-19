document.addEventListener('DOMContentLoaded', function () {
    // Fetch data from the new API endpoint
    fetch('/stocks/data')  // This is the new route you added
        .then(response => response.json())  // Parse the JSON response
        .then(data => {
            // Extract stock names and total amounts from the response
            const stockNames = data.map(stock => stock.stock_name);
            const totalAmounts = data.map(stock => stock.total_amount);

            // Data for Profit of Individual Stocks Chart (now dynamic)
            const profitChartCtx = document.getElementById('profitChart').getContext('2d');
            const profitChart = new Chart(profitChartCtx, {
                type: 'bar',
                data: {
                    labels: stockNames,  // Use stock names as labels
                    datasets: [{
                        label: 'Purchase Value',
                        data: totalAmounts,  // Use total amounts as data
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

    // Placeholder for Portfolio Weight Chart (We'll handle it next)




   // Data for Portfolio Weight Chart
   const barChartColors = [
    "#FF5733", "#33FF57", "#3357FF", "#FF33A6", "#FFD700",
    "#8A2BE2", "#40E0D0", "#DC143C", "#00CED1", "#7B68EE"
]; // Bar chart colors

const portfolioWeightChartCtx = document.getElementById('portfolioWeightChart').getContext('2d');

const portfolioWeightChart = new Chart(portfolioWeightChartCtx, {
    type: 'pie',
    data: {
        labels: ['LBBL', 'SIFC', 'ILI', 'SPDL', 'PFL', 'USHEC', 'CYCL', 'NRM', 'RNLI', 'SONA'],
        datasets: [{
            data: [15, 10, 20, 10, 5, 10, 5, 5, 10, 10],
            backgroundColor: barChartColors // Apply same color scheme as bar chart
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'right', // Adjust legend position for better visibility
                labels: {
                    boxWidth: 15 // Makes legend color indicators smaller
                }
            }
        }
    }
});


});
