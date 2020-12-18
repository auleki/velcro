function createChart(el, board = "dashboard") {
    document.getElementById("spinner").classList.remove("hide-spinner");
    var dashboard = el.getAttribute("data-dashboard");
    var chart_title = document.getElementById("chart_title").value;
    var chart_type = document.getElementById("chart_type").value;
    var metrics = document.getElementsByClassName("selected-metric");
    var selected_metrics = [];
    var metric_names = [];
    var metric_colors = [];
    var selected_metric_row = [];
    var metric_source = [];

    for (let i = 0; i < metrics.length; i++) {
        const val = metrics[i].parentNode.children[0].value.split("_")[0];
        const src = metrics[i].parentNode.children[1].value;
        const name = metrics[i].textContent.split("Color")[0];
        const color = metrics[i].children[1].children[0].value
            .split("#")
            .join("");
        const pos = metrics[i].parentNode.lastChild.value;

        selected_metrics.push(val);
        metric_names.push(name);
        metric_colors.push(color);
        selected_metric_row.push(pos);
        metric_source.push(src);
        // metric_colors += '_' + color + '_';
    }
    // console.log(selected_metrics)
    // console.log(metric_source, selected_metrics, metric_colors, metric_names, dashboard, selected_metric_row);
    // return
    var base = "/add_metrics";
    if (board == "fund") {
        base = "/add_fund_metrics";
        dashboard = el.getAttribute("data-fund");
    }
    $.get(
        base +
            "?chart_title=" +
            chart_title +
            "&chart_type=" +
            chart_type +
            "&metric_source=" +
            metric_source +
            "&selected_metrics=" +
            selected_metrics +
            "&metric_colors=" +
            metric_colors +
            "&dashboard=" +
            dashboard +
            "&metrics_row=" +
            selected_metric_row +
            "&metric_names=" +
            metric_names,

        function(data) {
            // return;
            // Get labels
            var labels = [];

            // Get datasets
            var datasets = [];

            if (metric_source[0].split("_")[1] == "google") {
                for (let m = 0; m < selected_metrics.length; m++) {
                    // var metric = selected_metrics[m];
                    const dataArr = [];

                    for (let n = 0; n < data[m].length; n++) {
                        const res = data[m][n];

                        if (m <= 0) {
                            if (n == 0 || n == 12 || n == 24) {
                                const label = res["date"];
                                labels.push(label);
                            } else {
                                const label = res["date"].split(" ")[0];
                                labels.push(label);
                            }
                        }

                        var value = res["value"].split("$")[
                            res["value"].split("$").length - 1
                        ];

                        // console.log(value)
                        var number = Number(value.split(",").join(""));
                        // console.log(value,number)

                        dataArr.push(number);

                        // dataArr.push(value);
                    }

                    var dataset = {
                        minBarLength: 9,
                        label: metric_names[m],
                        data: dataArr,
                        backgroundColor: "#" + metric_colors[m],
                        borderWidth: 1
                    };

                    // console.log(dataArr)
                    datasets.push(dataset);
                }
            } else if (metric_source[0].split("_")[1] == "excel") {
                for (let m = 0; m < selected_metrics.length; m++) {
                    var metric = selected_metrics[m];
                    const dataArr = [];

                    for (let n = 0; n < data[m].length; n++) {
                        const res = data[m][n];
                        if (m <= 0) {
                            if (n == 0 || n == 12 || n == 24) {
                                const label = res["date"];
                                labels.push(label);
                            } else {
                                const label = res["date"].split(" ")[0];
                                labels.push(label);
                            }
                        }
                        var str = res["value"].toString();
                        var value = str.split("$")[str.split("$").length - 1];

                        // console.log(value)
                        var number = Number(value.split(",").join(""));
                        // console.log(value,number)

                        dataArr.push(number);

                        // dataArr.push(value);
                    }

                    var dataset = {
                        minBarLength: 9,
                        label: metric_names[m],
                        data: dataArr,
                        backgroundColor: "#" + metric_colors[m],
                        borderWidth: 1
                    };

                    // console.log(dataset, labels)
                    datasets.push(dataset);
                }
            }

            // console.log(labels, datasets);

            var ctx = document
                .getElementById("add_chart_canvas")
                .getContext("2d");
            myChart = new Chart(ctx, {
                type: chart_type,
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    scales: {
                        yAxes: [
                            {
                                ticks: {
                                    beginAtZero: true,
                                    stacked: true
                                }
                            }
                        ]
                    }
                }
            });

            document.getElementById("chart_title_p").textContent = chart_title;

            document.getElementById("spinner").classList.add("hide-spinner");

            if (board == "fund") {
                window.location.href = "/home";
            } else {
                window.location.href = "/dashboard";
            }

            return;
        }
    );

    // window.location.href = '/dashboard';
    return;
}

function getRandomColor() {
    var letters = "0123456789ABCDEF";
    var color = "#";
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
