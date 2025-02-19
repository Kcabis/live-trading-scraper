document.getElementById('sellStockBtn').addEventListener('click', function (e) {
    e.preventDefault();

    // Fetch input values
    const sellingPrice = parseFloat(document.getElementById('sellingPrice').value);
    const quantity = parseInt(document.getElementById('quantity').value);
    const wacc = parseFloat(document.getElementById('wacc').value);
    const cgtRate = parseFloat(document.getElementById('type').value) / 100;
    const availableQuantity = parseInt(document.getElementById('availableQuantity').value);

    if (quantity > availableQuantity) {
        alert("Error: Not enough quantity available to sell.");
        return;
    }

    if (isNaN(sellingPrice) || isNaN(quantity) || isNaN(wacc) || isNaN(cgtRate)) {
        alert("Please fill all fields with valid numbers.");
        return;
    }

    // Perform calculations
    const totalAmount = sellingPrice * quantity;
    const sebonCommission = (totalAmount * 0.015) / 100; // 0.015% of total amount
    const brokerCommission = calculateBrokerCommission(totalAmount);
    const dpFee = 25; 
    const profit = totalAmount - (wacc * quantity);
    const tax = profit > 0 ? profit * cgtRate : 0; 
    const netProfit = profit - tax;
    const netReceivable = totalAmount - (sebonCommission + brokerCommission + dpFee + tax);

    // Update confirmation popup fields
    document.getElementById('confirmTotalAmountDisplay').textContent = totalAmount.toFixed(2);
    document.getElementById('confirmSebonCommissionDisplay').textContent = sebonCommission.toFixed(2);
    document.getElementById('confirmBrokerCommissionDisplay').textContent = brokerCommission.toFixed(2);
    document.getElementById('confirmDpFeeDisplay').textContent = dpFee.toFixed(2);
    document.getElementById('confirmsellingpriceDisplay').textContent = sellingPrice.toFixed(2);
    document.getElementById('confirmtaxDisplay').textContent = tax.toFixed(2);
    document.getElementById('confirmWaccDisplay').textContent = wacc.toFixed(2);
    document.getElementById('ReceivableDisplay').textContent = netReceivable.toFixed(2);

    // Update profit/loss display
    const profitLossDisplay = document.getElementById('PLDisplay');
    profitLossDisplay.textContent = netProfit.toFixed(2);
    profitLossDisplay.style.color = netProfit > 0 ? "green" : "red";

    // Show confirmation popup
    document.getElementById('confirmPopup').style.display = 'block';
});

document.querySelector('.close').addEventListener('click', function () {
    document.getElementById('confirmPopup').style.display = 'none';
});

document.getElementById('send').addEventListener('click', function () {
    document.getElementById('hiddenSebonCommission').value = parseFloat(document.getElementById('confirmSebonCommissionDisplay').textContent.trim());
    document.getElementById('hiddenBrokerCommission').value = parseFloat(document.getElementById('confirmBrokerCommissionDisplay').textContent.trim());
    document.getElementById('hiddenDpFee').value = parseFloat(document.getElementById('confirmDpFeeDisplay').textContent.trim());

    // Ensure type field is correctly sent
    document.getElementById('hiddenType').value = document.getElementById('type').value;

    document.getElementById('confirmPopup').style.display = 'none';
    document.getElementById('sellStockForm').submit();
});

document.getElementById('cancelSellStockBtn').addEventListener('click', function () {
    document.getElementById('confirmPopup').style.display = 'none';
});

// Function to Calculate Broker Commission
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
