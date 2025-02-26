document.addEventListener('DOMContentLoaded', function () {
    const updateButton = document.getElementById('updateButton');
    const confirmPopup = document.getElementById('confirmPopup');
    const closePopup = document.getElementById('closePopup');
    const sendButton = document.getElementById('send');
    const cancelConfirmBtn = document.getElementById('cancelConfirmBtn');

    updateButton.addEventListener('click', function () {
        const price = parseFloat(document.getElementById('price').value);
        const quantity = parseFloat(document.getElementById('quantity').value);
        const action = document.getElementById('action').value;

        const totalAmount = price * quantity;
        const brokerCommission = totalAmount * 0.005; 
        const sebonFee = totalAmount * 0.0015; 
        let wacc = 0;  
        let capitalGainTax = 0;
        let profitLoss = 0;
        let netReceivable = 0;
        let netPayable = 0;

        if (action === 'sell') {
            wacc = parseFloat(document.getElementById('confirmWacc').value) || 0;
            const purchasePrice = wacc * quantity; 
            profitLoss = totalAmount - purchasePrice;
            capitalGainTax = profitLoss * 0.1; 
            netReceivable = totalAmount - brokerCommission - sebonFee - capitalGainTax;
        } else {
           
            wacc = (totalAmount + brokerCommission + sebonFee) / quantity;
            netPayable = totalAmount + brokerCommission + sebonFee;
        }

        document.getElementById('confirmTotalAmount').value = totalAmount;
        document.getElementById('confirmCapitalGainTax').value = capitalGainTax;
        document.getElementById('confirmNetReceivable').value = netReceivable;
        document.getElementById('confirmProfitLoss').value = profitLoss;
        document.getElementById('confirmWacc').value = wacc;
        document.getElementById('confirmNetPayable').value = netPayable;

        document.getElementById('confirmTotalAmountDisplay').textContent = totalAmount.toFixed(2);
        document.getElementById('confirmCapitalGainTaxDisplay').textContent = capitalGainTax.toFixed(2);
        document.getElementById('confirmNetReceivableDisplay').textContent = netReceivable.toFixed(2);
        document.getElementById('confirmWaccDisplay').textContent = wacc.toFixed(2);
        document.getElementById('confirmNetPayableDisplay').textContent = netPayable.toFixed(2);

        const profitLossDisplay = document.getElementById('confirmProfitLossDisplay');
        profitLossDisplay.textContent = profitLoss.toFixed(2);
        if (profitLoss > 0) {
            profitLossDisplay.style.color = "green"; 
        } else if (profitLoss < 0) {
            profitLossDisplay.style.color = "red"; 
        } else {
            profitLossDisplay.style.color = "black"; 
        }

        confirmPopup.style.display = 'block';
    });

    closePopup.addEventListener('click', function () {
        confirmPopup.style.display = 'none';
    });

    cancelConfirmBtn.addEventListener('click', function () {
        confirmPopup.style.display = 'none';
    });

    sendButton.addEventListener('click', function () {
        document.getElementById('editTransactionForm').submit();
    });
});
