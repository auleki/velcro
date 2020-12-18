var sources = document.getElementsByClassName("source");
for (var i = 0; i < sources.length; i++) {
    var source = sources[i];
    //ource.addEventListener('click', select(source))
}

function fetchMetrics(e) {
    var param = e.value;
    var source = param.split("_")[0];
    var tool = param.split("_")[1];
    var name = param.split("_")[2];
    // console.log(source, tool, name);
    // return

    var select = document.getElementById("metric");
    select.innerHTML = "";
    var opt = document.createElement("option");
    var txt = document.createTextNode("Select your metric");
    opt.appendChild(txt);
    select.appendChild(opt);
    $.get(
        "/api/fetch_metrics?source=" +
            source +
            "&tool=" +
            tool +
            "&name=" +
            name,
        function(data) {
            // console.log(data);
            // return;
            document
                .getElementById("metrics-cont")
                .classList.remove("hide-metrics");
            for (let i = 0; i < data.length; i++) {
                const each = data[i];
                var node = document.createElement("OPTION"); // Create a <li> node
                if (tool == "google") {
                    var textnode = document.createTextNode(each["name"]); // Create a text node
                    node.appendChild(textnode);
                    node.setAttribute(
                        "value",
                        each["column_name"] + "_" + each["row"]
                    );
                    node.setAttribute("data-row", each["row"]);
                    // const option = `<option
                    //     value="${each['column_name']}"
                    //     onclick="selectMetric('${each["column_name"]}', '${each["row"]}')"
                    //     >
                    //     ${each["name"]}
                    //     </option>`;
                    // console.log(option)
                    select.appendChild(node);
                } else if (tool == "excel") {
                    var textnode = document.createTextNode(each); // Create a text node
                    node.appendChild(textnode);
                    node.setAttribute("value", each);
                    node.setAttribute("data-row", each);
                    select.appendChild(node);
                }
            }

            return;
        }
    );
}

function selectMetric(e) {
    // console.log(metric.getAttribute('data-row'));
    // console.log(metric)
    var metric = e.options[e.selectedIndex];
    var metric_source = metric.parentNode.getAttribute("data-group");
    // return
    // var param = e.options[e.selectedIndex].id;
    // var spreadSheet = param.split('_')[0];
    // var tool = param.split('_')[1];
    var name = metric.innerHTML.split("amp;").join("");
    // return
    var card = document.createElement("DIV");
    var header = document.createElement("div");
    var flex = document.createElement("div");
    var body = document.createElement("div");
    var cog = document.createElement("I");
    var times = document.createElement("I");
    var cog_div = document.createElement("div");
    var times_div = document.createElement("div");
    var input = document.createElement("input");
    var row = document.createElement("input");
    var source = document.createElement("input");

    input.type = "hidden";
    input.value = metric.value;

    row.type = "hidden";
    row.value = metric.getAttribute("data-row");

    card.classList.add("card", "mt-3");
    card.style.background = "#EEEEEE";

    header.classList.add("card-header");

    flex.classList.add("d-flex", "justify-content-end");

    cog.classList.add("fas", "fa-cog");
    times.classList.add("fas", "fa-times", "ml-2");
    times.setAttribute("onclick", "removeMetric(this)");
    cog.setAttribute("onclick", 'metricSettings("color_' + metric.value + '")');
    times_div.appendChild(times);
    cog_div.appendChild(cog);

    source.value = metric_source;
    source.type = "hidden";
    body.classList.add("card-body", "mt-n4", "selected-metric");
    body.style.paddingTop = "0rem";
    var text_div = document.createElement("div");
    body.style.color = "#333333";
    var text = document.createTextNode(name);
    var color_div = document.createElement("div");
    color_div.style.fontSize = "14px";
    color_div.style.lineHeight = "18px";
    var color_text = document.createTextNode("Color");
    var color = document.createElement("input");
    color.setAttribute("type", "color");
    color.value = "#7AEF1F";
    color.style.height = "16px";
    color.style.width = "30px";
    color.style.marginLeft = "10px";
    color.id = "color_" + metric.value;
    color.disabled = true;
    color_div.appendChild(color_text);
    color_div.appendChild(color);

    text_div.appendChild(text);
    text_div.style.marginBottom = ".5rem";
    body.appendChild(text_div);
    body.appendChild(color_div);
    flex.appendChild(cog_div);
    flex.appendChild(times_div);

    header.appendChild(flex);

    card.appendChild(input);
    card.appendChild(source);
    card.appendChild(header);
    card.appendChild(body);
    card.appendChild(row);
    // var selected ='<div class="card" style="background:  #EEEEEE;">< div class="card-header " ><div class="d-flex justify-content-end"><i class="fas fa-cog"></i><i class="fas fa-times ml-2"></i></div></div><div class="card-body mt-n4">' + metric.innerHTML + '</div></div>'
    // console.log(card);

    document.getElementById("selected_metric").appendChild(card);
    return;
}

function removeMetric(e) {
    var child = e.parentNode.parentNode.parentNode.parentNode;
    var parent = document.getElementById("selected_metric");
    var i = 0;
    while ((child = child.previousSibling) != null) i++;

    // console.log(i);
    parent.removeChild(parent.childNodes[i]);

    return;
}

function metricSettings(id) {
    event.preventDefault();
    var elem = document.getElementById(id);
    elem.disabled = false;
    // console.log(elem)
    elem.click();
    // elem.disabled = true;
    return
}
