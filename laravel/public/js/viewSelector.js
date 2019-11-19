    // Get Current View from Session
    var currentView = sessionStorage.getItem("currentView");

    // Set View if session variable is null
    if(currentView == null) currentView = "grid";

    // Set right view to active
    document.getElementById(currentView + "Selector").className = "nav-item active tabItem";
    document.getElementById(currentView + "View").className = "tab-pane fade in active"

    function Select(item) {
        sessionStorage.setItem("currentView", item);
    }