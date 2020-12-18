function addMetricParam(e, param, metric) {
    if (e.checked == false)
        document.getElementById("select_all_param").checked = false;

    $.get(
        "/api/metric_param?param=" +
            param +
            "&metric=" +
            metric +
            "&checked=" +
            e.checked,
        function(data) {
            console.log(data);
        }
    );
}

function selectAllParams(e, metric) {
    var checked = e.checked;
    var params = document.getElementsByClassName("metrics_param");

    for (let i = 0; i < params.length; i++) {
        const el = params[i];

        if (checked == true) el.checked = true;
        else el.checked = false;
        var param = el.getAttribute("name");
        $.get(
            "/api/metric_param?param=" +
                param +
                "&metric=" +
                metric +
                "&checked=" +
                checked,
            function(data) {
                console.log(data);
            }
        );
    }
}

function selectMetric(
    name,
    index,
    column,
    spreadsheetId,
    toolId,
    sheetId,
    row
) {
    window.location.href =
        "/select-metric-data?name=" +
        name +
        "&i=" +
        index +
        "&col=" +
        column +
        "&spreadsheetId=" +
        spreadsheetId +
        "&sheetId=" +
        sheetId +
        "&toolId=" +
        toolId +
        "&length=" +
        row;

    return;
}
