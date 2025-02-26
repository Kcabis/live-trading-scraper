document.getElementById('sellStockBtn').addEventListener('click', function (e) {
    e.preventDefault();

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

    const totalAmount = sellingPrice * quantity;
    const sebonCommission = (totalAmount * 0.015) / 100; 
    const brokerCommission = calculateBrokerCommission(totalAmount);
    const dpFee = 25; 
    const profit = totalAmount - (wacc * quantity);
    const tax = profit > 0 ? profit * cgtRate : 0; 
    const netProfit = profit - tax;
    const netReceivable = totalAmount - (sebonCommission + brokerCommission + dpFee + tax);

    document.getElementById('confirmTotalAmountDisplay').textContent = totalAmount.toFixed(2);
    document.getElementById('confirmSebonCommissionDisplay').textContent = sebonCommission.toFixed(2);
    document.getElementById('confirmBrokerCommissionDisplay').textContent = brokerCommission.toFixed(2);
    document.getElementById('confirmDpFeeDisplay').textContent = dpFee.toFixed(2);
    document.getElementById('confirmsellingpriceDisplay').textContent = sellingPrice.toFixed(2);
    document.getElementById('confirmtaxDisplay').textContent = tax.toFixed(2);
    document.getElementById('confirmWaccDisplay').textContent = wacc.toFixed(2);
    document.getElementById('ReceivableDisplay').textContent = netReceivable.toFixed(2);

    const profitLossDisplay = document.getElementById('PLDisplay');
    profitLossDisplay.textContent = netProfit.toFixed(2);
    profitLossDisplay.style.color = netProfit > 0 ? "green" : "red";

    document.getElementById('confirmPopup').style.display = 'block';
});

document.querySelector('.close').addEventListener('click', function () {
    document.getElementById('confirmPopup').style.display = 'none';
});

document.getElementById('send').addEventListener('click', function () {
    document.getElementById('hiddenSebonCommission').value = parseFloat(document.getElementById('confirmSebonCommissionDisplay').textContent.trim());
    document.getElementById('hiddenBrokerCommission').value = parseFloat(document.getElementById('confirmBrokerCommissionDisplay').textContent.trim());
    document.getElementById('hiddenDpFee').value = parseFloat(document.getElementById('confirmDpFeeDisplay').textContent.trim());

    document.getElementById('hiddenType').value = document.getElementById('type').value;

    document.getElementById('confirmPopup').style.display = 'none';
    document.getElementById('sellStockForm').submit();
});

document.getElementById('cancelSellStockBtn').addEventListener('click', function () {
    document.getElementById('confirmPopup').style.display = 'none';
});

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
