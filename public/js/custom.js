// Function for adding house data of client to owned into table in client/create
function addHouseToOwned() {
    // Fetch house id field and its text
    let selectHouseElement = document.getElementById('house_id');
    let houseId = selectHouseElement.value;
    let selectedHouseText = selectHouseElement.options[selectHouseElement.selectedIndex].text;

    // Fetch house message text
    let houseValidationMessage = document.getElementById('house_validation');
    
    // Create validation message for house and return; to stop running the code
    if (!houseId) {
        houseValidationMessage.innerText = 'The house field is required.';
        return;
    } else {
        houseValidationMessage.innerText = '';
    }

    // If house is not empty, the data will be added into table
    if (houseId && selectedHouseText !== 'Select house') {
        // Fetch table
        let table = document.getElementById('table_house_to_owned').getElementsByTagName('tbody')[0];

        // Insert one row and define cells of row
        let row = table.insertRow(table.rows.length);
        let cellOne = row.insertCell(0);
        let cellTwo = row.insertCell(1);
        let cellThree = row.insertCell(2);

        // Insert value of data in input in table eveytime row adds. Show selected payment method, selected house,
        // downpayment and button cancel
        cellOne.innerHTML = '<input type="hidden" name="houses[' + table.rows.length + '][house_id]" value="' + houseId + '" />';
        cellTwo.innerHTML = selectedHouseText;
        cellThree.innerHTML = '<input type="button" class="btn btn-danger" value="Cancel" onclick="cancelHouse(this)" />';

        // Hide primary id of data
        cellOne.style.display = 'none';

        // Set the house field back to default
        selectHouseElement.value = '';

        // Focus back on house field
        selectHouseElement.focus();
    }
}

// Function for canceling or removing data of house from table in client/create
function cancelHouse(data) {
    // Fetch and remove row from table
    let i = data.parentNode.parentNode.rowIndex;
    document.getElementById('table_house_to_owned').deleteRow(i);
}