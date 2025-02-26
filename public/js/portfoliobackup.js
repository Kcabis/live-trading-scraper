document.addEventListener('DOMContentLoaded', function () {
    const menuItems = document.querySelectorAll('.menu-item');
    const contentSections = document.querySelectorAll('.content-section');
    const shareholderSelect = document.getElementById('shareholderSelect');
    const portfolioBody = document.getElementById('portfolioBody');
    const addStockPopup = document.getElementById('addStockPopup');
    const confirmPopup = document.getElementById('confirmPopup');
    const sellStockPopup = document.getElementById('sellStockPopup');
    const addShareholderPopup = document.getElementById('addShareholderPopup');
    const newShareholderBtn = document.getElementById('addShareholder');
    const confirmBtn = document.getElementById('confirmBtn');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sellStockBtn = document.getElementById('sellStockBtn');
    const addStockBtn = document.getElementById('addStockBtn');
    const cancelShareholderBtn = document.getElementById('cancelShareholderBtn');
    const cancelStockBtn =document.getElementById('cancelStockBtn');
    const cancelsellStockBtn =document.getElementById('cancelsellStockBtn');
    const sellconfirmPopup =document.getElementById('sellconfirmPopup');
    const sellconfirmBtn =document.getElementById('sellconfirmBtn');
    const cancelconfirmBtn =document.getElementById('cancelconfirmBtn');


    let shareholders = {};
    let currentStock = null;

    sidebarToggle.addEventListener('click', function () {
        document.querySelector('.sidebar').classList.toggle('collapsed');
    });
    newShareholderBtn.addEventListener('click', function() {
        addShareholderPopup.style.display = 'flex';
    });

   document.getElementById('addShareholderBtn').addEventListener('click', function () {
    const shareholderName = document.getElementById('shareholderName').value.trim();

    if (shareholderName !== "") {
        if (!shareholders.hasOwnProperty(shareholderName)) {
            shareholders[shareholderName] = { stocks: [] };

            const option = document.createElement('option');
            option.value = shareholderName;
            option.text = shareholderName;
            shareholderSelect.add(option);

            addShareholderPopup.style.display = 'none';
            document.getElementById('shareholderName').value = '';
        } else {
            alert('Shareholder already exists!');
        }
    } else {
        alert('Please enter a shareholder name.');
    }
});
    
    document.querySelectorAll('#addShareholderPopup .close, #cancelShareholderBtn').forEach(function(btn) {
    btn.addEventListener('click', function () {
        addShareholderPopup.style.display = 'none';
    });
});


    menuItems.forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            const targetSectionId = this.getAttribute('data-target');
            contentSections.forEach(section => {
                section.style.display = 'none';
            });
            document.getElementById(targetSectionId).style.display = 'block';
        });
    });

    shareholderSelect.addEventListener('change', function () {
        const shareholderName = this.value;
        if (shareholderName) {
            displayPortfolio(shareholderName); 
        }
    });

    document.getElementById('addStock').addEventListener('click', function () {
        if (!shareholderSelect.value) {
            alert("Please select a shareholder first.");
        } else {
            addStockPopup.style.display = 'flex';
        }
    });
    document.querySelectorAll('#addStockPopup .close, #cancelStockBtn').forEach(function(btn) {
        btn.addEventListener('click', function () {
            addStockPopup.style.display = 'none'; 
        });
    });



    addStockBtn.addEventListener('click', function () {
        
        const stockName = document.getElementById('stockName').value.trim();
        const purchasePrice = parseFloat(document.getElementById('purchasePrice').value);
        const quantity = parseInt(document.getElementById('quantity').value);
        const buyType = document.getElementById('sel').value;

        if (stockName && !isNaN(purchasePrice) && !isNaN(quantity)) {
            currentStock = { stockName, purchasePrice, quantity, buyType };
            calculateFees(currentStock);
        }
    });

    function calculateFees(stock) {
        const totalAmount = stock.purchasePrice * stock.quantity;
        let dpFee = 0;
        let sebonCommission = 0;
        let brokerCommission = 0;
    
        if (stock.buyType === "2") { 
            sebonCommission = totalAmount * 0.015 / 100; 
            brokerCommission = calculateBrokerCommission(totalAmount); 
            dpFee=25;
        }
        
        const totalCost = totalAmount + dpFee + sebonCommission + brokerCommission;
        const wacc = totalCost / stock.quantity;
    
        document.getElementById('confirmTotalAmount').textContent = totalAmount.toFixed(2);
        document.getElementById('confirmSebonCommission').textContent = sebonCommission.toFixed(2);
        document.getElementById('confirmBrokerCommission').textContent = brokerCommission.toFixed(2);
        document.getElementById('confirmDpFee').textContent = dpFee.toFixed(2);
        document.getElementById('confirmWacc').textContent = wacc.toFixed(2);
        document.getElementById('confirmTotalCost').textContent = totalCost.toFixed(2);
    
        currentStock.purchasePrice = wacc;
        confirmPopup.style.display = 'flex';
        addStockPopup.style.display = 'none';
    }
    confirmBtn.addEventListener('click', function () {
        const shareholderName = shareholderSelect.value;
        const portfolio = shareholders[shareholderName] || { stocks: [] };

        const existingStock = portfolio.stocks.find(stock => stock.stockName === currentStock.stockName);

        if (existingStock) {
            const totalQuantity = existingStock.quantity + currentStock.quantity;
            const weightedAveragePrice = ((existingStock.purchasePrice * existingStock.quantity) + (currentStock.purchasePrice * currentStock.quantity)) / totalQuantity;

            existingStock.purchasePrice = weightedAveragePrice;
            existingStock.quantity = totalQuantity;
        } else {
            const wacc = parseFloat(document.getElementById('confirmWacc').textContent);
            currentStock.purchasePrice = wacc;
            portfolio.stocks.push(currentStock);
        }

        shareholders[shareholderName] = portfolio;
        displayPortfolio(shareholderName);
        confirmPopup.style.display = 'none';
        currentStock = null; 
    });
    function displayPortfolio(shareholderName) {
        const portfolio = shareholders[shareholderName];
        portfolioBody.innerHTML = "";

        let totalMarketValue = 0;
        let totalPurchaseValue = 0;
        let totalProfitLoss = 0;

        portfolio.stocks.forEach((stock, index) => {
            const marketValue = stock.ltp ? stock.ltp * stock.quantity : 0;
            const purchaseValue = stock.purchasePrice * stock.quantity;
            const profitLoss = marketValue - purchaseValue;

            totalMarketValue += marketValue;
            totalPurchaseValue += purchaseValue;
            totalProfitLoss += profitLoss;

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${index + 1}</td>
                <td>${stock.stockName}</td>
                <td>${stock.purchasePrice.toFixed(2)}</td>
                <td>${stock.quantity}</td>
                <td>${purchaseValue.toFixed(2)}</td>
                <td><input type="number" step="0.01" value="${stock.ltp || ''}" class="ltp-input" data-index="${index}"></td>
                <td class="market-value">${marketValue.toFixed(2)}</td>
                <td class="profit-loss">${profitLoss.toFixed(2)}</td>
                <td>
                    <button class="edit-stock" data-index="${index}">Edit</button>
                    <button class="remove-stock" data-index="${index}">Remove</button>
                </td>
            `;
            portfolioBody.appendChild(tr);
        });
    }
    

    function calculateBrokerCommission(totalAmount) {
        if (totalAmount <= 2500) {
            return 10;
        } else if (totalAmount <= 50000) {
            return totalAmount * 0.36 / 100;
        } else if (totalAmount <= 500000) {
            return totalAmount * 0.33 / 100;
        } else if (totalAmount <= 2000000) {
            return totalAmount * 0.31 / 100;
        } else {
            return totalAmount * 0.27 / 100;
        }
    }

document.getElementById('sellStock').addEventListener('click', function () {
    if (!shareholderSelect.value) {
        alert("Please select a shareholder first.");
    } else {
        sellStockPopup.style.display = 'flex';
    }
});

document.querySelectorAll('#selStockPopup .close, #cancelSellStockBtn').forEach(function(btn) {
    btn.addEventListener('click', function () {
        sellStockPopup.style.display = 'none'; 
    });
});

sellStockBtn.addEventListener('click', function () {
    const stockName = document.getElementById('stockName').value.trim();
    const sellPrice = parseFloat(document.getElementById('sellingPrice').value);
    const quantity = parseInt(document.getElementById('quantity').value);

    if (!isNaN(sellPrice) && !isNaN(quantity)) {
        const shareholderName = shareholderSelect.value;
        const portfolio = shareholders[shareholderName];

        const stock = portfolio.stocks.find(s => s.stockName === stockName);
        if (stock) {
            if (quantity > stock.quantity) {
                alert("Cannot sell more than the available quantity.");
                return;
            }

            stock.quantity -= quantity;
            if (stock.quantity === 0) {
                portfolio.stocks = portfolio.stocks.filter(s => s !== stock);
            }

            const profit = (sellPrice - stock.purchasePrice) * quantity;
            alert(`Profit from selling ${stockName}: Rs ${profit.toFixed(2)}`);
            displayPortfolio(shareholderName); 
            sellStockPopup.style.display = 'none';
        } else {
            alert("Stock not found.");
        }
    } else {
        alert("Please enter valid selling price and quantity.");
    }
});

    


    document.getElementById('themeToggle').addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
    });

    document.querySelectorAll('.popup .close, #cancelBtn,#addStockPopup, #cancelShareholderBtn, #cancelConfirmBtn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            btn.closest('.popup').style.display = 'none';
        });
    });
document.getElementById('sellStock').addEventListener('click', function () {
    if (!shareholderSelect.value) {
        alert("Please select a shareholder first.");
    } else {
        sellStockPopup.style.display = 'flex';
    }
});

sellStockBtn.addEventListener('click', function () {
    const stockName = document.getElementById('stockName').value.trim();
    const sellPrice = parseFloat(document.getElementById('sellingPrice').value);
    const quantityToSell = parseInt(document.getElementById('quantity').value);

    if (stockName && !isNaN(sellPrice) && !isNaN(quantityToSell)) {
        const shareholderName = shareholderSelect.value;
        const portfolio = shareholders[shareholderName];

        const stockIndex = portfolio.stocks.findIndex(s => s.stockName === stockName);
        const stock = portfolio.stocks[stockIndex];

        if (stock) {
            if (quantityToSell > stock.quantity) {
                alert("Cannot sell more than the available quantity.");
                return;
            }

            stock.quantity -= quantityToSell;
            if (stock.quantity === 0) {
                portfolio.stocks.splice(stockIndex, 1);
            }

            const profit = (sellPrice - stock.purchasePrice) * quantityToSell;
            alert(`Profit from selling ${stockName}: Rs ${profit.toFixed(2)}`);

            displayPortfolio(shareholderName);
            sellStockPopup.style.display = 'none';
            document.getElementById('sellStockForm').reset();
        } else {
            alert("Stock not found in your portfolio!");
        }
    } else {
        alert("Please enter valid selling price and quantity.");
    }
});

function displayPortfolio(shareholderName) {
    const portfolio = shareholders[shareholderName];
    portfolioBody.innerHTML = "";

    let totalMarketValue = 0;
    let totalPurchaseValue = 0;
    let totalProfitLoss=0;

    portfolio.stocks.forEach((stock, index) => {
        const marketValue = stock.ltp ? stock.ltp * stock.quantity : 0;
        const purchaseValue = stock.purchasePrice * stock.quantity;
        const profitLoss = marketValue - purchaseValue;

        totalMarketValue += marketValue;
        totalPurchaseValue += purchaseValue;
        totalProfitLoss += profitLoss;

        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${index + 1}</td>
            <td>${stock.stockName}</td>
            <td>${stock.purchasePrice.toFixed(2)}</td>
            <td>${stock.quantity}</td>
            <td>${purchaseValue.toFixed(2)}</td>
            <td><input type="number" step="0.01" value="${stock.ltp || ''}" class="ltp-input" data-index="${index}"></td>
            <td class="market-value">${marketValue.toFixed(2)}</td>
            <td class="profit-loss">${profitLoss.toFixed(2)}</td>
            <td>
                <button class="edit-stock" data-index="${index}">Edit</button>
                <button class="remove-stock" data-index="${index}">Remove</button>
            </td>
        `;
        portfolioBody.appendChild(tr);
    });

    
}
document.getElementById('stockName').addEventListener('input', function() {
    this.value = this.value.toUpperCase();
});




   
        document.getElementById('cancelsellStockBtn').addEventListener('click', function () {
            sellStockPopup.style.display = 'none';
            sellStockForm.reset(); 
        });
       
       document.querySelector('#sellStockPopup .close').addEventListener('click', function () {
           sellStockPopup.style.display = 'none';
           sellStockForm.reset();
       });
       
       
   });

     

        