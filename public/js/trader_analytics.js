document.addEventListener('DOMContentLoaded', function () {
    // Fetch data from both API endpoints
    Promise.all([
        fetch('/stocks/data').then(response => response.json()),
        fetch('/transactions/data').then(response => response.json())
    ])
    .then(([stocksData, transactionsData]) => {
        // Extract stock names and total amounts from stocks data (for Bar Chart)
        const stockNames = stocksData.map(stock => stock.stock_name);
        const totalAmounts = stocksData.map(stock => stock.total_amount);

        // Extract stock names and profit/loss from transactions (for Pie Chart)
        const transactionStockNames = transactionsData.map(transaction => transaction.stock_name);
        const transactionProfits = transactionsData.map(transaction => transaction.profit_loss);

        // Bar Chart (Keep as it is)
        const profitChartCtx = document.getElementById('profitChart').getContext('2d');
        new Chart(profitChartCtx, {
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

        // Pie Chart for Profit/Loss from Transactions
        const barChartColors = [
            "#FF5733", "#33FF57", "#3357FF", "#FF33A6", "#FFD700",
            "#8A2BE2", "#40E0D0", "#DC143C", "#00CED1", "#7B68EE"
        ]; 

        const portfolioWeightChartCtx = document.getElementById('portfolioWeightChart').getContext('2d');
        new Chart(portfolioWeightChartCtx, {
            type: 'pie',
            data: {
                labels: transactionStockNames, // Use stock names from transactions
                datasets: [{
                    data: transactionProfits, // Use profit/loss from transactions
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

    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });
});
