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
    const editShareholder=document.getElementById('editShareholder');
    const editPortfolioPopup=document.getElementById('editPortfolioPopup');
    const cancelShareholderBtn = document.getElementById('cancelShareholderBtn');
    const cancelStockBtn =document.getElementById('cancelStockBtn');
    const cancelsellStockBtn =document.getElementById('cancelsellStockBtn');
    const sellconfirmPopup =document.getElementById('sellconfirmPopup');
    const sellconfirmBtn =document.getElementById('sellconfirmBtn');
    const cancelConfirmBtn =document.getElementById('cancelConfirmBtn');


    let shareholders = {}; // Stores all shareholders and their stock portfolios
    let currentStock = null;

    // Sidebar Toggle
    sidebarToggle.addEventListener('click', function () {
        document.querySelector('.sidebar').classList.toggle('collapsed');
    });
    // Open Add Shareholder Popup
    newShareholderBtn.addEventListener('click', function() {
        addShareholderPopup.style.display = 'flex';
    });
    //open edit shareholder popup
    editShareholder.addEventListener('click',function(){
        editPortfolioPopup.style.display="flex";
    });
   // Handle adding new shareholder
   document.getElementById('addShareholderBtn').addEventListener('click', function () {
    const shareholderName = document.getElementById('shareholderName').value.trim();

});
    
    // Close the Add Shareholder Popup when clicking the 'x' or cancel button
    document.querySelectorAll('#addShareholderPopup .close, #cancelShareholderBtn').forEach(function(btn) {
    btn.addEventListener('click', function () {
        addShareholderPopup.style.display = 'none'; // Hide the popup
    });
});
document.querySelectorAll('#editPortfolioPopup .close').forEach(function(btn){
    btn.addEventListener('click',function(){
        editPortfolioPopup.style.display='none';

    });
});


    // Menu item click events
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

    // Handle Shareholder Selection: Load the data for selected shareholder
    shareholderSelect.addEventListener('change', function () {
        const shareholderName = this.value;
        if (shareholderName) {
            displayPortfolio(shareholderName); // Display portfolio when shareholder selected
        }
    });

    // Open Add Stock Popup
    document.getElementById('addStock').addEventListener('click', function () {
        if (!shareholderSelect.value) {
            alert("Please select a shareholder first.");
        } else {
            addStockPopup.style.display = 'flex';
            confirmPopup.style.display='none';
        }
    });
       // Close Add Stock Popup
       document.querySelectorAll('#addStockPopup .close, #cancelStockBtn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            addStockPopup.style.display = 'none'; // Hide the popup
        });
    });

    // Prevent form submission and handle logic manually
    addStockBtn.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent form submission

        const stockName = document.getElementById('stockName').value.trim();
        const purchasePrice = parseFloat(document.getElementById('purchasePrice').value);
        const quantity = parseInt(document.getElementById('quantity').value);
        const buyType = document.getElementById('sel').value;

        if (stockName && !isNaN(purchasePrice) && !isNaN(quantity)) {
            currentStock = { stockName, purchasePrice, quantity, buyType };
            calculateFees(currentStock);
        }
    });

    // Function to calculate fees and show confirmation popup
    function calculateFees(stock) {
        const totalAmount = stock.purchasePrice * stock.quantity;
        let dpFee = 0;
        let sebonCommission = 0;
        let brokerCommission = 0;
    
        // Commission charges only apply for secondary type buys
        if (stock.buyType === "Secondary") { // Secondary type
            sebonCommission = totalAmount * 0.015 / 100; // Sebon commission is 0.015%
            brokerCommission = calculateBrokerCommission(totalAmount); // Calculate broker commission based on total amount
            dpFee=25;
        }
        
        const totalCost = totalAmount + dpFee + sebonCommission + brokerCommission;
        const wacc = totalCost / stock.quantity;
    
    // Set the hidden fields in the form with the calculated data
    document.getElementById('confirmTotalAmountDisplay').textContent = totalAmount.toFixed(2);
    document.getElementById('confirmSebonCommissionDisplay').textContent = sebonCommission.toFixed(2);
    document.getElementById('confirmBrokerCommissionDisplay').textContent = brokerCommission.toFixed(2);
    document.getElementById('confirmDpFeeDisplay').textContent = dpFee.toFixed(2);
    document.getElementById('confirmWaccDisplay').textContent = wacc.toFixed(2);
    document.getElementById('confirmTotalCostDisplay').textContent = totalCost.toFixed(2);

    // Fill hidden form inputs with calculated values
    document.getElementById('confirmTotalAmount').value = totalAmount.toFixed(2);
    document.getElementById('confirmSebonCommission').value = sebonCommission.toFixed(2);
    document.getElementById('confirmBrokerCommission').value = brokerCommission.toFixed(2);
    document.getElementById('confirmDpFee').value = dpFee.toFixed(2);
    document.getElementById('confirmWacc').value = wacc.toFixed(2);
    document.getElementById('confirmTotalCost').value = totalCost.toFixed(2);

        // Store WACC as purchase price for the current stock
        currentStock.purchasePrice = wacc;
        confirmPopup.style.display = 'flex';
        addStockPopup.style.display = 'none';
    }
    // Confirm adding the stock: Update existing stock if present
    confirmBtn.addEventListener('click', function () {
        const shareholderName = shareholderSelect.value;
        const portfolio = shareholders[shareholderName] || { stocks: [] };

        const existingStock = portfolio.stocks.find(stock => stock.stockName === currentStock.stockName);

        if (existingStock) {
            // Update the existing stock by calculating the average price
            const totalQuantity = existingStock.quantity + currentStock.quantity;
            const weightedAveragePrice = ((existingStock.purchasePrice * existingStock.quantity) + (currentStock.purchasePrice * currentStock.quantity)) / totalQuantity;

            existingStock.purchasePrice = weightedAveragePrice;
            existingStock.quantity = totalQuantity;
        } else {
            // Add the new stock
            const wacc = parseFloat(document.getElementById('confirmWacc').textContent);
            currentStock.purchasePrice = wacc;
            portfolio.stocks.push(currentStock);
        }

        shareholders[shareholderName] = portfolio;
        displayPortfolio(shareholderName);
        confirmPopup.style.display = 'none';
        currentStock = null; // Clear current stock
    });
    // Function to display portfolio with updated values
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
    

    // Function to calculate broker commission
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
    // Handle confirmation click event to submit the form
document.getElementById('send').addEventListener('click', function () {
    document.getElementById('addStockForm').submit(); // Submit the form to save data
});

// Cancel confirmation
document.getElementById('cancelConfirmBtn').addEventListener('click', function () {
    confirmPopup.style.display = 'none'; // Hide confirmation popup
});

    // Open Sell Stock Popup
document.getElementById('sellStock').addEventListener('click', function () {
    if (!shareholderSelect.value) {
        alert("Please select a shareholder first.");
    } else {
        sellStockPopup.style.display = 'flex';
    }
});

// Close the sellStock Popup when clicking the 'x' or cancel button
document.querySelectorAll('#selStockPopup .close, #cancelSellStockBtn').forEach(function(btn) {
    btn.addEventListener('click', function () {
        sellStockPopup.style.display = 'none'; // Hide the popup
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
                // Remove stock if quantity is 0
                portfolio.stocks = portfolio.stocks.filter(s => s !== stock);
            }

            const profit = (sellPrice - stock.purchasePrice) * quantity;
            alert(`Profit from selling ${stockName}: Rs ${profit.toFixed(2)}`);
            displayPortfolio(shareholderName); // Ensure this function exists and updates the UI
            sellStockPopup.style.display = 'none';
        } else {
            alert("Stock not found.");
        }
    } else {
        alert("Please enter valid selling price and quantity.");
    }
});

    // document.querySelectorAll('#sellStockPopup, #cancelsellStockBtn,#sellStockBtn').forEach(function(btn) {
    //     btn.addEventListener('click', function () {
    //         sellStockPopup.style.display = 'none'; // Hide the popup
    //     });
    // });


    // Theme Toggle
    document.getElementById('themeToggle').addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
    });

    // Close any other popup when clicking the 'x' or Cancel buttons for other popups
    document.querySelectorAll('.popup .close, #cancelBtn,#addStockPopup, #cancelShareholderBtn, #cancelConfirmBtn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            btn.closest('.popup').style.display = 'none';
        });
    });
    //sell stock logic
    // Open Sell Stock Popup
document.getElementById('sellStock').addEventListener('click', function () {
    if (!shareholderSelect.value) {
        alert("Please select a shareholder first.");
    } else {
        sellStockPopup.style.display = 'flex';
    }
});

// Handle selling stock
sellStockBtn.addEventListener('click', function () {
    const stockName = document.getElementById('stockName').value.trim();
    const sellPrice = parseFloat(document.getElementById('sellingPrice').value);
    const quantityToSell = parseInt(document.getElementById('quantity').value);

    if (stockName && !isNaN(sellPrice) && !isNaN(quantityToSell)) {
        const shareholderName = shareholderSelect.value;
        const portfolio = shareholders[shareholderName];

        // Find the stock in the portfolio
        const stockIndex = portfolio.stocks.findIndex(s => s.stockName === stockName);
        const stock = portfolio.stocks[stockIndex];

        if (stock) {
            if (quantityToSell > stock.quantity) {
                alert("Cannot sell more than the available quantity.");
                return;
            }

            // Deduct quantity or remove stock if quantity is zero
            stock.quantity -= quantityToSell;
            if (stock.quantity === 0) {
                portfolio.stocks.splice(stockIndex, 1); // Remove stock from portfolio if quantity is zero
            }

            const profit = (sellPrice - stock.purchasePrice) * quantityToSell;
            alert(`Profit from selling ${stockName}: Rs ${profit.toFixed(2)}`);

            // Update UI and reset form
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

// Function to display updated portfolio in table and update dashboard
function displayPortfolio(shareholderName) {
    const portfolio = shareholders[shareholderName];
    portfolioBody.innerHTML = ""; // Clear existing rows

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

    // // Update total values in the dashboard
    // document.getElementById('portfolioValue').textContent = totalMarketValue.toFixed(2);
    // document.getElementById('currentInvestment').textContent = totalPurchaseValue.toFixed(2);
}
document.getElementById('stockName').addEventListener('input', function() {
    this.value = this.value.toUpperCase();
});




   
        // Handle closing the popup when "Cancel" is clicked
        document.getElementById('cancelsellStockBtn').addEventListener('click', function () {
            sellStockPopup.style.display = 'none';
            sellStockForm.reset(); // Clear the form
        });
       
           // Optional: Close the popup when the close icon (X) is clicked
       document.querySelector('#sellStockPopup .close').addEventListener('click', function () {
           sellStockPopup.style.display = 'none';
           sellStockForm.reset();
       });

       // Handle dropdown toggle for the profile icon
const profileImage = document.getElementById('profileImage');
const profileDropdown = document.getElementById('profileDropdown');

// Toggle the dropdown visibility on hover
profileImage.addEventListener('mouseenter', () => {
    profileDropdown.style.display = 'block';
});

profileImage.addEventListener('mouseleave', () => {
    setTimeout(() => {
        profileDropdown.style.display = 'none';
    }, 200); // Delay to prevent flickering
});

// Ensure dropdown remains visible while hovering over it
profileDropdown.addEventListener('mouseenter', () => {
    profileDropdown.style.display = 'block';
});

profileDropdown.addEventListener('mouseleave', () => {
    profileDropdown.style.display = 'none';
});
document.getElementById("profileImage").addEventListener("click", function () {
    document.getElementById("imageUploadModal").style.display = "flex";
});

document.getElementById("editProfileButton").addEventListener("click", function () {
    document.getElementById("imageUploadModal").style.display = "flex";
});

document.getElementById("closeModal").addEventListener("click", function () {
    document.getElementById("imageUploadModal").style.display = "none";
});

document.getElementById("saveImageButton").addEventListener("click", function () {
    const fileInput = document.getElementById("imageInput");
    const profileImage = document.getElementById("profileImage");

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            profileImage.src = e.target.result;
            document.getElementById("imageUploadModal").style.display = "none";
        };
        reader.readAsDataURL(fileInput.files[0]);
    } else {
        alert("Please select an image!");
    }
});


       
       
   });