document.addEventListener('DOMContentLoaded', function () {
    // DOM Elements
    const menuItems = document.querySelectorAll('.menu-item');
    const contentSections = document.querySelectorAll('.content-section');
    const shareholderSelect = document.getElementById('shareholderSelect');
    const portfolioBody = document.getElementById('portfolioBody');
    const addStockPopup = document.getElementById('addStockPopup');
    const confirmPopup = document.getElementById('confirmPopup');
    const sellStockPopup = document.getElementById('sellStockPopup');
    const addShareholderPopup = document.getElementById('addShareholderPopup');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const newShareholderBtn = document.getElementById('addShareholder');
    const addStockBtn = document.getElementById('addStockBtn');
    const confirmBtn = document.getElementById('confirmBtn');
    const sellStockBtn = document.getElementById('sellStockBtn');

    let shareholders = {}; // Object to store shareholders and their stocks
    let currentStock = null;

    // Sidebar Toggle
    sidebarToggle.addEventListener('click', () => {
        document.querySelector('.sidebar').classList.toggle('collapsed');
    });

    // Menu Navigation
    menuItems.forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            const targetSectionId = this.getAttribute('data-target');
            contentSections.forEach(section => (section.style.display = 'none'));
            document.getElementById(targetSectionId).style.display = 'block';
        });
    });

    // Adding a New Shareholder
    newShareholderBtn.addEventListener('click', () => {
        addShareholderPopup.style.display = 'flex';
    });

    document.getElementById('addShareholderBtn').addEventListener('click', function () {
        const shareholderName = document.getElementById('shareholderName').value.trim();
        if (shareholderName && !shareholders[shareholderName]) {
            shareholders[shareholderName] = { stocks: [] };

            const option = document.createElement('option');
            option.value = shareholderName;
            option.text = shareholderName;
            shareholderSelect.add(option);

            addShareholderPopup.style.display = 'none';
            document.getElementById('shareholderName').value = '';
        } else {
            alert(shareholderName ? 'Shareholder already exists!' : 'Enter a valid name.');
        }
    });

    document.getElementById('cancelShareholderBtn').addEventListener('click', () => {
        addShareholderPopup.style.display = 'none';
    });

    // Adding a Stock
    document.getElementById('addStock').addEventListener('click', function () {
        if (!shareholderSelect.value) {
            alert('Please select a shareholder first.');
        } else {
            addStockPopup.style.display = 'flex';
        }
    });

    addStockBtn.addEventListener('click', function () {
        const stockName = document.getElementById('stockName').value.trim();
        const purchasePrice = parseFloat(document.getElementById('purchasePrice').value);
        const quantity = parseInt(document.getElementById('quantity').value);
        const buyType = document.getElementById('sel').value;

        if (stockName && !isNaN(purchasePrice) && !isNaN(quantity)) {
            currentStock = { stockName, purchasePrice, quantity, buyType };
            calculateFees(currentStock);
        } else {
            alert('Enter valid stock details.');
        }
    });

    function calculateFees(stock) {
        const totalAmount = stock.purchasePrice * stock.quantity;
        const dpFee = stock.buyType === '2' ? 25 : 0;
        const sebonCommission = stock.buyType === '2' ? totalAmount * 0.015 / 100 : 0;
        const brokerCommission = stock.buyType === '2' ? calculateBrokerCommission(totalAmount) : 0;
        const totalCost = totalAmount + dpFee + sebonCommission + brokerCommission;
        const wacc = totalCost / stock.quantity;

        currentStock.purchasePrice = wacc;

        // Populate confirmation popup
        document.getElementById('confirmTotalAmount').textContent = totalAmount.toFixed(2);
        document.getElementById('confirmSebonCommission').textContent = sebonCommission.toFixed(2);
        document.getElementById('confirmBrokerCommission').textContent = brokerCommission.toFixed(2);
        document.getElementById('confirmDpFee').textContent = dpFee.toFixed(2);
        document.getElementById('confirmWacc').textContent = wacc.toFixed(2);
        document.getElementById('confirmTotalCost').textContent = totalCost.toFixed(2);

        confirmPopup.style.display = 'flex';
        addStockPopup.style.display = 'none';
    }

    confirmBtn.addEventListener('click', function () {
        const shareholderName = shareholderSelect.value;
        const portfolio = shareholders[shareholderName];

        const existingStock = portfolio.stocks.find(s => s.stockName === currentStock.stockName);
        if (existingStock) {
            existingStock.quantity += currentStock.quantity;
            existingStock.purchasePrice =
                ((existingStock.purchasePrice * existingStock.quantity) +
                    (currentStock.purchasePrice * currentStock.quantity)) /
                (existingStock.quantity + currentStock.quantity);
        } else {
            portfolio.stocks.push(currentStock);
        }

        displayPortfolio(shareholderName);
        confirmPopup.style.display = 'none';
        currentStock = null;
    });

    // Display Portfolio
    function displayPortfolio(shareholderName) {
        const portfolio = shareholders[shareholderName];
        portfolioBody.innerHTML = '';

        portfolio.stocks.forEach((stock, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${index + 1}</td>
                <td>${stock.stockName}</td>
                <td>${stock.purchasePrice.toFixed(2)}</td>
                <td>${stock.quantity}</td>
                <td><input type="number" step="0.01" value="${stock.ltp || ''}" class="ltp-input" data-index="${index}"></td>
                <td>
                    <button class="edit-stock" data-index="${index}">Edit</button>
                    <button class="remove-stock" data-index="${index}">Remove</button>
                </td>
            `;
            portfolioBody.appendChild(tr);
        });
    }

    // Function to Calculate Broker Commission
    function calculateBrokerCommission(totalAmount) {
        if (totalAmount <= 2500) return 10;
        if (totalAmount <= 50000) return totalAmount * 0.36 / 100;
        if (totalAmount <= 500000) return totalAmount * 0.33 / 100;
        if (totalAmount <= 2000000) return totalAmount * 0.31 / 100;
        return totalAmount * 0.27 / 100;
    }
});
