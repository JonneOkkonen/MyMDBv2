function OnLoadPagination(data) {
    CreatePages(data.last_page);
    SetActive(GetCookie("page"), data.last_page);
}

/*
    Page Selector Item Template:
    <li class="page-item active">
        <a class="page-link" name="1" onclick="ChangePage(this.name)">1</a>
    </li>
*/
function CreatePages(count) {
    let selector = document.getElementById("pageSelector");
    // Set selector to start position
    let template = `
        <li class="page-item"id="previous">
            <a class="page-link" onclick="Previous()">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <li class="page-item" id="next">
            <a class="page-link" onclick="Next()">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    `;
    selector.innerHTML = template;
    let next = document.getElementById("next");
    for(let i = 1; i <= count; i++) {
        let li = document.createElement("li");
        li.setAttribute("class", "page-item");
        let a = `
            <a class="page-link" id="${i}" onclick="ChangePage(this.id)">${i}</a>
        `; 
        li.innerHTML = a;
        selector.insertBefore(li, next);
    }
}

// Set Correct Page Item to Active
function SetActive(index, lastIndex) {
    // Disable back button
    if(index == 1) document.getElementById("previous").className += " disabled";
    let items = document.getElementById("pageSelector").childNodes;
    for(let i = 3; i <= lastIndex + 2;i++) {
        if(items[i].childNodes[1].id == index) {
            items[i].className += " active";
        }
    }
    if(index == lastIndex) document.getElementById("next").className += " disabled";
}

// Go to Previous page
function Previous() {
    ChangePage(GetCookie("page") - 1);
}

// Go to Next page
function Next() {
    ChangePage(parseInt(GetCookie("page")) + parseInt(1));
}