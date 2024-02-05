function addHouseToOwned() {
    let selectElement = document.getElementById('house_id');
    let houseId = selectElement.value;
    let selectedText = selectElement.options[selectElement.selectedIndex].text;

    let houseValidationMessage = document.getElementById('house_validation');

    let downpayment = document.getElementById('downpayment').value;
    let downpaymentValidationMessage = document.getElementById('downpayment_validation');
    
    if (!houseId && !downpayment) {
        houseValidationMessage.innerText = 'The house field is required.';
        downpaymentValidationMessage.innerText = 'The downpayment field is required.';
        
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
        houseValidationMessage.innerText = '';
        downpaymentValidationMessage.innerText = '';
    }

    if (houseId && selectedText !== 'Select house' && downpayment && !isNaN(downpayment)) {
        // let i = 1;
        let table = document.getElementById('table_house_to_owned').getElementsByTagName('tbody')[0];

        let row = table.insertRow(table.rows.length);
        let cellOne = row.insertCell(0);
        let cellTwo = row.insertCell(1);
        let cellThree = row.insertCell(2);
        let cellFour = row.insertCell(3);

        cellOne.innerHTML = '<input type="hidden" name="houses[' + table.rows.length + '][house_id]" value="' + houseId + '">';
        cellTwo.innerHTML = selectedText;
        cellThree.innerHTML = downpayment;
        cellFour.innerHTML = '<input type="button" class="btn btn-danger" value="Cancel" onclick="cancelHouse(this)" />';

        cellOne.style.display = 'none';

        selectElement.value = '';
        downpayment.value = '';

        selectElement.focus();
    }
}

function cancelHouse(data) {
    let i = data.parentNode.parentNode.rowIndex;
    document.getElementById('table_house_to_owned').deleteRow(i);
}