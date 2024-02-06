// Function for adding house data of client to owned into table in client/create
function addHouseToOwned() {
    // Fetch payment method id field and its text
    let selectPaymentMethodElement = document.getElementById('payment_method_id');
    let paymentMethodId = selectPaymentMethodElement.value;
    let selectedPaymentMethodText = selectPaymentMethodElement.options[selectPaymentMethodElement.selectedIndex].text;

    // Fetch payment method message text
    let paymentMethodValidationMessage = document.getElementById('payment_method_validation');

    // Fetch house id field and its text
    let selectHouseElement = document.getElementById('house_id');
    let houseId = selectHouseElement.value;
    let selectedHouseText = selectHouseElement.options[selectHouseElement.selectedIndex].text;

    // Fetch house message text
    let houseValidationMessage = document.getElementById('house_validation');

    // Fetch downpayment value and message text
    let downpayment = document.getElementById('downpayment').value;
    let downpaymentValidationMessage = document.getElementById('downpayment_validation');
    
    // Create validation message for payment method, house and downpayment
    // return; to stop running the code
    if (!paymentMethodId && !houseId && !downpayment) {
        paymentMethodValidationMessage.innerText = 'The payment method field is required.';
        houseValidationMessage.innerText = 'The house field is required.';
        downpaymentValidationMessage.innerText = 'The downpayment field is required.';
        
        return;
    } else if (!paymentMethodId) { 
        paymentMethodValidationMessage = 'The payment method field is required.';
        return;
    } else if (!houseId) {
        houseValidationMessage.innerText = 'The house field is required.';
        return;
    } else if (!downpayment) { 
        downpaymentValidationMessage.innerText = 'The downpayment field is required.';
        return;
    } else if (isNaN(downpayment)) { 
        downpaymentValidationMessage.innerText = 'The downpayment field must be a number.';
        return;
    } else {
        paymentMethodValidationMessage.innerText = '';
        houseValidationMessage.innerText = '';
        downpaymentValidationMessage.innerText = '';
    }

    // If payment method, house and downpayment is not empty, the data will be added into table
    if (paymentMethodId && selectedPaymentMethodText !== 'Select payment method' && houseId &&
        selectedHouseText !== 'Select house' && downpayment && !isNaN(downpayment)) {
        // Fetch table
        let table = document.getElementById('table_house_to_owned').getElementsByTagName('tbody')[0];

        // Insert one row and define cells of row
        let row = table.insertRow(table.rows.length);
        let cellOne = row.insertCell(0);
        let cellTwo = row.insertCell(1);
        let cellThree = row.insertCell(2);
        let cellFour = row.insertCell(3);
        let cellFive = row.insertCell(4);
        let cellSix = row.insertCell(5);
        let cellSeven = row.insertCell(6);

        // Insert value of data in input in table eveytime row adds. Show selected payment method, selected house,
        // downpayment and button cancel
        cellOne.innerHTML = '<input type="hidden" name="houses[' + table.rows.length + '][house_id]" value="' + houseId + '" />';
        cellTwo.innerHTML = selectedPaymentMethodText;
        cellThree.innerHTML = '<input type="hidden" name="payment_methods[' + table.rows.length + '][payment_method_id]" value="' + paymentMethodId + '">';
        cellFour.innerHTML = selectedHouseText;
        cellFive.innerHTML = downpayment;
        cellSix.innerHTML = '<input type="hidden" name="houses[' + table.rows.length + '][downpayment]" value="' + downpayment + '" />';
        cellSeven.innerHTML = '<input type="button" class="btn btn-danger" value="Cancel" onclick="cancelHouse(this)" />';

        // Hide primary id of data
        cellOne.style.display = 'none';
        cellThree.style.display = 'none';
        cellSix.style.display = 'none';

        // Set the fields back to default
        selectPaymentMethodElement.value = '';
        selectHouseElement.value = '';
        downpayment.value = '';

        // Focus back on payment method field
        selectPaymentMethodElement.focus();
    }
}

// Function for canceling or removing data of house from table in client/create
function cancelHouse(data) {
    // Fetch and remove row from table
    let i = data.parentNode.parentNode.rowIndex;
    document.getElementById('table_house_to_owned').deleteRow(i);
}