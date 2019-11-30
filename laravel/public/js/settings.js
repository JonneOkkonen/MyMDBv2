function OnLoad() {
    let data = document.getElementById('typeList').value
    let items = data.split(';');
    for(let item of items) {
        AddTypeToList(item);
    }
}

// Add Type to list
function AddTypeToList(item) {
    if(item != "") {
        $("#typelist").append("<li>" + item + "  <span class='deleteButton'><b>X</b></span></li>");
    }
}

// Convert TypeList to CSV
function ConvertToCSV() {
    let list = document.getElementById("typelist").childNodes;
    let csv = "";
    for(let item of list) {
        csv += (item.innerHTML).split('  <span')[0] + ";";
    }
    // Delete extra semicolon from end
    csv = csv.slice(0, -1);
    // Set CSV to hidden typeList so it can be saved to database
    document.getElementById('typeList').value = csv;
}