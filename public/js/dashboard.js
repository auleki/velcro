var dashboards = document.getElementsByClassName("dashboard-list");

var activate = document.getElementsByClassName("activate")[0];

// console.log(dashboards)

// for (let i = 0; i < dashboards.length; i++) {
//   const each = dashboards[i];

//   each.addEventListener('click', changeDashboard())
// }

function changeDashboard(el, type = "web") {
    if (type == "mobile") {
        document.getElementById("mobile_dashboard").textContent = el.innerHTML;
    }
    if (type == "web") el.classList.add("activate");
    var id = el.getAttribute("data-tab");
    var dashboard_id = el.getAttribute("data-id");

    // console.log(el, id, dashboard_id)
    document.getElementById(id).classList.remove("dashboard-body");
    var add_chart = document.getElementsByClassName("add_chart");

    for (let j = 0; j < add_chart.length; j++) {
        const element = add_chart[j];
        element.setAttribute("href", "/add_chart/" + dashboard_id);
    }
    // console.log(dashboards)
    // if (type == "web") {
        for (let i = 0; i < dashboards.length; i++) {
            const dash = dashboards[i];
            const attr = dash.getAttribute("data-tab");
            // console.log(attr, id)
            if (attr != id) {
                dash.classList.remove("activate");

                document.getElementById(attr).classList.add("dashboard-body");
            }
        }
    // }

    document
        .getElementById("create_chart")
        .setAttribute("data-dashboard", dashboard_id);
    return;
}

function deleteChart(chartId, id) {
    $.get("/charts/delete/" + id, function(data) {
        var chart = document.getElementById(chartId);
        var parent = chart.parentNode;

        var i = 0;
        while ((chart = chart.previousSibling) != null) i++;

        parent.removeChild(parent.childNodes[i]);
    });

    return;
}

function editChart(id) {
    return;
    //   var href = document.getElementById('add_chart').getAttribute('href');

    //   console.log(id, href);

    //   window.location.href = href + '/?chart=' + id;
}

function deleteDashboard(id) {
    window.location.href = "/dashboards/delete/" + id;

    return;
}
