// Add graph function
// document
//     .getElementById("getgraph")
//     .addEventListener("change", readGraphURL, true);
// function readGraphURL() {
//     var file = document.getElementById("getgraph").files[0];
//     var graph_reader = new FileReader();
//     graph_reader.onloadend = function() {
//         document.getElementById("addGraphImage").style.backgroundImage =
//             "url(" + graph_reader.result + ")";
//     };
//     if (file) {
//         graph_reader.readAsDataURL(file);
//         // console.log(reader.readAsDataURL(file))
//     } else {
//     }
// }
var days = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday"
];

function changeFormat(params) {
    params.parentNode.parentNode.children[0].textContent = params.innerHTML;
    return;
}
 
// send report
function sendReport(req) {
    document.getElementsByName("body_content")[0].value = oDoc.innerHTML;
    if (req == "save") {
        document.getElementById("send_report").action = "/report/draft";
        document.getElementById("send_report").submit();
        return;
    } else if (req == "schedule") {
        var type = document.getElementsByClassName("active schedule_type")[0].getAttribute('data-val');

        if (type == 'one-time') document.getElementsByName("schedule_date")[0].value = $('span[tabindex="0"]').text();
        
        document.getElementById("send_report").action = "/report/schedule";
        document.getElementById("send_report").submit();
        return;
    }
    document.getElementById("send_report").action = "/report/send";
    document.getElementById("send_report").submit();
    return;
}

function insertImage() {
    var div = document.getElementById("textBox"); // The DIV.
    var fi = document.getElementById("fileid"); // Get the File input.

    var reader = new FileReader();
    reader.onload = function(e) {
        // console.log(e.target.result);
        var img = new Image();
        img.src = e.target.result;
        img.setAttribute("style", "clear:both; margin:10px 0; width: 100%;");

        div.appendChild(img); // Add the images to the DIV.
    };
    reader.readAsDataURL(fi.files[0]);
}

function addRequest(req) {
    var doc = document.getElementById("doc");
    var total_texts = document.getElementById("total_texts");
    var total_metrics = document.getElementById("total_metrics");
    var total_files = document.getElementById("total_files");

    // Create new div, title and desc inputs
    var title = document.createElement("input");
    var desc = document.createElement("input");
    var div = document.createElement("div");
    var required = document.createElement("input");

    // set title and desc attributes
    title.setAttribute("type", "hidden");
    desc.setAttribute("type", "hidden");
    required.setAttribute("type", "hidden");
    if (req == "text") {
        title.setAttribute("name", req + "_title_" + total_texts.value);
        desc.setAttribute("name", req + "_desc_" + total_texts.value);
        required.setAttribute("name", req + "_req_" + total_texts.value);
        title.value = document.getElementById("text_title").value;
        desc.value = document.getElementById("text_desc").value;
        required.value = document.getElementById("text_required").checked;

        div.appendChild(title);
        div.appendChild(desc);
        div.appendChild(required);
        doc.appendChild(div);
        total_texts.value = Number(total_texts.value) + 1;
    } else if (req == "metric") {
        title.setAttribute("name", req + "_title_" + total_metrics.value);
        desc.setAttribute("name", req + "_desc_" + total_metrics.value);
        required.setAttribute("name", req + "_req_" + total_metrics.value);
        title.value = document.getElementById("metric_title").value;
        desc.value = document.getElementById("metric_desc").value;
        required.value = document.getElementById("metric_required").checked;

        var kpis = document.getElementsByClassName("kpi_info");

        for (let i = 0; i < kpis.length; i++) {
            const element = kpis[i];

            var kpi_div = document.createElement("div");

            var kpi_name = document.createElement("input");
            kpi_name.setAttribute("type", "hidden");
            kpi_name.setAttribute(
                "name",
                "kpi_name_" + total_metrics.value + "_" + i
            );
            kpi_name.value = element.children[0].children[0].value;

            var kpi_format = document.createElement("input");
            kpi_format.setAttribute("type", "hidden");
            kpi_format.setAttribute(
                "name",
                "kpi_format_" + total_metrics.value + "_" + i
            );
            kpi_format.value = element.children[1].children[0].textContent;

            kpi_div.appendChild(kpi_name);
            kpi_div.appendChild(kpi_format);

            div.appendChild(kpi_div);
            total_kpi = document.getElementById(
                req + "_" + total_metrics.value
            );
            total_kpi.value = Number(total_kpi.value) + 1;
        }
        var k_div = document.createElement("div");

        k_div.appendChild(title);
        k_div.appendChild(desc);
        k_div.appendChild(required);
        k_div.appendChild(div);
        doc.appendChild(k_div);
        total_metrics.value = Number(total_metrics.value) + 1;

        return;
    } else if (req == "file") {
        title.setAttribute("name", req + "_title_" + total_files.value);
        desc.setAttribute("name", req + "_desc_" + total_files.value);
        required.setAttribute("name", req + "_req_" + total_files.value);
        title.value = document.getElementById("file_title").value;
        desc.value = document.getElementById("file_desc").value;
        required.value = document.getElementById("file_required").checked;

        div.appendChild(title);
        div.appendChild(desc);
        div.appendChild(required);
        doc.appendChild(div);
        total_files.value = Number(total_files.value) + 1;

        return;
    }
}

function focusOut(e) {
    var val = e.value.toLowerCase();

    if (e.id == "file_title")
        document.getElementById("file_desc").value = "Upload " + val;

    return;
}

function addKPI() {
    var kpi_info = document.getElementById("kpi_info");

    if (kpi_info.children.length >= 10) {
        alert("You can't create more than 10 KPIs");
        return;
    }
    var new_kpi =
        '<div class="col-12 mb-3 kpi_info" style="padding-left: 0px"><div class="col-sm-5 mt-3 float-left" style="padding-left: 0px"><input type="text" class="form-control" placeholder="Enter KPI name" ></div>';
    new_kpi +=
        '<div class="col-sm-3 mt-3 float-left"><button class="btn btn-secondary dropdown-toggle btn-sm btn-kpi-format" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Currency</button>';
    new_kpi += `<div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#!" onclick="changeFormat(this)">Currency</a>`;
    new_kpi += `<a class="dropdown-item" href="#!" onclick="changeFormat(this)">Number</a></div></div><div class="col-sm-4 mt-3 float-left text-right" style="padding-right: 0px">`;
    new_kpi +=
        '<input type="text" class="form-control " placeholder="Enter value" style="padding-right: 0px" disabled ></div></div>';

    kpi_info.innerHTML += new_kpi;
    return;
}

function removeLastKPI() {
    var kpi_info = document.getElementById("kpi_info");

    if (kpi_info.children.length <= 1) {
        alert("You must have at least one KPI");
        return;
    }

    kpi_info.removeChild(kpi_info.children[kpi_info.children.length - 1]);
    return;
}

function onSubmit(e) {
    // e.action = "/reports/create";
    // e.method = "post"
    document.getElementsByName("body_content")[0].value = oDoc.innerHTML;

    console.log(
        oDoc.innerHTML,
        document.getElementsByName("body_content")[0].value,
        e
    );
}

function newRequest(param) {
    var parent = document.getElementById(param + "-request");
    var num = document.getElementsByClassName(param + "-request").length;
    var reqd =
        document.getElementById(param + "_required").checked == "true"
            ? "checked"
            : "";
    var title = document.getElementById(param + "_title").value;
    var desc = document.getElementById(param + "_desc").value;
    // console.log(reqd);
    if (param == "text") {
        var html = `<div class="col section mb-5 mt-5 text-request"><div class="row"><p>Text Title</p><p class="ml-auto "> Required </p><label class="switch mt-1 ml-2">`;
        html += `<input type="checkbox" name="text_req_${num}" ${reqd}><span class="slider round"></span></label></div><div class="form-group align-form">`;
        html += `<input type="text" name="text_title_${num}" value="${title}" placeholder="Enter text title" class="p-3 form-control" ></div><div class="form-group align-form">`;
        html += `<p> Description</p><textarea name="text_desc_${num}" placeholder="Enter text description" class="form-control text-wrap">${desc}</textarea></div>`;
        html += `<div class="base-kpi row ml-n3 mt-3"><a href="#!" class="text-info ml-auto" onclick="removeRequest('text', ${num})" title="Delete request">`;
        html += `Remove request </a ></div></div>`;

        parent.innerHTML += html;
        var total_texts = document.getElementsByClassName("text-request")
            .length;
        document.getElementById("total_texts").value = total_texts;
    } else if (param == "metric") {
        var kpi_info_main = document.getElementsByClassName("kpi_info_main")
            .length;
        var html = `<div class="col section mb-5 metric-request"><div class="row"><p> Metric title</p><p class="ml-auto "> Required </p><label class="switch mt-1 ml-2">`;
        html += `<input type="checkbox" name="metric_req_${num}" checked="${reqd}"><span class="slider round"></span></label></div><div class="form-group align-form  ">`;
        html += `<input type="text" name="metric_title_${num}" value="${title}" class="p-3 form-control" ></div><div class="form-group align-form"><p> Description</p>`;
        html += `<textarea name="metric_desc_${num}" id="" class="form-control text-wrap">${desc}</textarea></div><div class="kpi headed row align-form">`;
        html += `<div class="col-12" style="padding-left: 0px"><div class="col-sm-5 float-left" style="padding-left: 0px"><p>KPI name</p></div>`;
        html += `<div class="col-sm-4 float-left"><p>Format</p></div><div class="col-sm-3 float-left text-right" style="padding-right: 0px"><p>KPI Value</p></div></div>`;

        var kpis = document.getElementsByClassName("kpi_info");
        // console.log(kpis.length)
        // return

        for (let i = 0; i < kpis.length; i++) {
            const kpi = kpis[i];
            // console.log(kpi.children[0].children[0])
            var kpi_html = `<div class="col-12 mb-3 kpi_info_main" style="padding-left: 0px"><div class="col-sm-5 float-left" style="padding-left: 0px">`;
            kpi_html += `<input type="text" class="form-control" name="kpi_name_${kpi_info_main}_${i}" value="${kpi.children[0].children[0].value}" >`;
            kpi_html += `</div><div class="col-sm-3 float-left"><button class="btn btn-secondary btn-sm" type="button"> `;
            kpi_html += `${kpi.children[1].children[0].textContent}</button></div><div class="col-sm-4 float-left text-right" style="padding-right: 0px">`;
            kpi_html += `<input type="text" class="form-control " name="kpi_value_${kpi_info_main}_${i}" placeholder="Enter KPI value" style="padding-right: 0px" ></div></div>`;
            // console.log(kpi_html)
            var kpi_format = document.createElement("input");
            kpi_format.setAttribute("type", "hidden");
            kpi_format.setAttribute(
                "name",
                "kpi_format_" + kpi_info_main + "_" + i
            );
            kpi_format.value = kpi.children[1].children[0].textContent;
            document.getElementById("doc").appendChild(kpi_format);
            html += kpi_html;
        }

        html += `<div class="base-kpi row ml-n3 mt-3" style="width: 100%"><a href="#!" class="text-info" onclick="addKPI()"> <i class="fas fa-plus"></i> Add KPI</a>`;
        html += `<a href="#!" class="text-info ml-auto" onclick="addKPI()"> <i class="fas fa-trash-alt "></i> </a></div></div>`;

        parent.innerHTML += html;
        var metric_inp = document.createElement("input");
        metric_inp.id = param + "_" + num;
        metric_inp.setAttribute("name", param + "_" + num);
        metric_inp.setAttribute("type", "hidden");
        console.log(kpis.length);
        document.getElementById("doc").appendChild(metric_inp);
        document.getElementById(param + "_" + num).value = kpis.length;
        console.log(document.getElementById(param + "_" + num));
        // document.getElementById.value = kpis.length;
        var total_metrics = document.getElementsByClassName("metric-request")
            .length;
        document.getElementById("total_metrics").value = total_metrics;
    }
    return;
}

function removeRequest(param, id) {
    var parent = document.getElementById(param + "-request");

    // if (parent.children.length > 1) {
    var child = document.getElementById(param + "_" + id);

    parent.removeChild(parent.childNodes[parent.children.length]);
    // }

    return;
}

function allReport(e) {
    var inputs = document.getElementsByClassName("report-checkbox");
    var checkbox = 0;
    if (e.checked) {
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].checked = true;
            checkbox += 1;
        }
        // console.log(checkbox);
        document.getElementById("selectedReport").textContent =
            checkbox + " selected";
    } else {
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].checked = false;
        }

        document.getElementById("selectedReport").textContent = "";
    }

    return;
}

function selectCheckbox(e) {
    var inputs = document.getElementsByClassName("report-checkbox");
    var checked = 0;

    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].checked) {
            checked += 1;
        }
    }

    if (checked > 0)
        document.getElementById("selectedReport").textContent =
            checked + " selected";
    else document.getElementById("selectedReport").textContent = "";

    document.getElementById("reportChecked").checked = false;

    return;
}

function downloadReport() {
    var inputs = document.getElementsByClassName("report-checkbox");
    var all_reports = [];

    for (let i = 0; i < inputs.length; i++) {
        const inp = inputs[i];
        if (inp.checked) {
            // console.log(inp.value)
            all_reports.push(inp.value);
        }
    }

    if (all_reports.length > 0) {
        window.location.href = "/downloadPDF/report?id=" + all_reports;
    }
    return;
}

function archiveReport() {
    var inputs = document.getElementsByClassName("report-checkbox");
    var all_reports = [];

    for (let i = 0; i < inputs.length; i++) {
        const inp = inputs[i];
        if (inp.checked) {
            // console.log(inp.value)
            all_reports.push(inp.value);
        }
    }

    if (all_reports.length > 0) {
        window.location.href = "/archive-report/report?id=" + all_reports;
    }
    return;
}

function uploadReportToCloud() {
    var inputs = document.getElementsByClassName("report-checkbox");
    var all_reports = [];

    for (let i = 0; i < inputs.length; i++) {
        const inp = inputs[i];
        if (inp.checked) {
            // console.log(inp.value)
            all_reports.push(inp.value);
        }
    }
    // console.log(inputs)
    // console.log(all_reports);
    // return
    if (all_reports.length > 0) {
        window.location.href = "/upload-to-cloud/report?id=" + all_reports;
    }
    return;
}

function scheduleSummary() {
    var type = document.getElementsByClassName("active schedule_type")[0].getAttribute('data-val')
    // console.log(type)
    // return
    document.getElementsByName("schedule_type")[0].value = type;
    var hr = $("#one_time_hour").val();
    var mn = $("#one_time_minute").val();
    var am_pm = $('[name="am_pm"]:checked').val();
    var summary = "";

    if (type == "one-time") {
        var date = $('span[tabindex="0"]').text();
        if (date == "1" || date == "21" || date == "31") {
            date += "st";
        } else if (date == "2" || date == "22") {
            date += "nd";
        } else if (date == "3" || date == "23") {
            date += "rd";
        } else {
            date += "th";
        }
        summary = "On the " + date + " at " + hr + ":" + mn + am_pm;
        $("#summary_span").text(summary);
        $("#summary_block").show();
    } else if (type == "recurring") {
        var recur = $("#recurring").val();
        // var period_name = $('#period_name').text();
        var period = $("#period").val();
        var schedule_date = $("#schedule_date").val();
        if (period == "monthly") {
            if (recur == 1) {
                recur += " month";
            } else {
                recur += " months";
            }

            var date_arr = schedule_date.split("_");
            var date = "";
            var index = date_arr.indexOf("");

            if (index > -1) {
                date_arr.splice(index, 1);
            }
            date_arr.sort(function(a, b) {
                return a - b;
            });
            // console.log(date_arr)
            for (let i = 0; i < date_arr.length; i++) {
                let each = date_arr[i];
                // console.log(each)
                if (each.length > 0) {
                    if (each == "1" || each == "21" || each == "31") {
                        each += "st";
                    } else if (each == "2" || each == "22") {
                        each += "nd";
                    } else if (each == "3" || each == "23") {
                        each += "rd";
                    } else {
                        each += "th";
                    }

                    if (date_arr.length > 1 && date_arr.length == i + 1) {
                        date += "and " + each;
                    } else if (date_arr.length <= 1) date += each + " ";
                    else date += each + ", ";
                }
                // console.log(each)
            }
            // console.log(date)
            summary =
                "Every " +
                recur +
                " on the " +
                date +
                " at " +
                hr +
                ":" +
                mn +
                am_pm;
        } else if (period == "weekly") {
            var d = document
                .getElementsByClassName("selected_day")[0]
                .getAttribute("data-val");

            if (recur == 1) {
                recur += " week";
            } else {
                recur += " weeks";
            }

            summary =
                "Every " + recur + " on " + d + " at " + hr + ":" + mn + am_pm;
        } else {
            if (recur == 1) {
                recur += " day";
            } else {
                recur += " days";
            }

            summary = "Every " + recur + " at " + hr + ":" + mn + am_pm;
        }

        $("#summary_span").text(summary);
        $("#summary_block").show();
    }
    // console.log(type);
    return;
}

function setRecurring(e) {
    var recurring = document.getElementById("recurring");
    var period = document.getElementById("period_name");
    if (e.value == "monthly") {
        recurring.innerHTML = `<option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>`;

        period.textContent = "Month";
        $("#app").hide();
        $("#app_week").hide();
        $("#choose_days").show();
    } else if (e.value == "daily") {
        recurring.innerHTML = `<option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>`;

        period.textContent = "Day";
        $("#app").hide();
        $("#app_week").hide();
        $("#choose_days").hide();
    } else {
        recurring.innerHTML = `<option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                                <option value="51">51</option>
                                <option value="52">52</option>`;

        period.textContent = "Week";
        $("#app").hide();
        $("#app_week").show();
        $("#choose_days").hide();
    }

    scheduleSummary("recurring");
}

function selectDay(e) {
    // console.log(e.attributes['data-val'].value);
    var selected = document.getElementsByClassName("selected_day");

    if (selected.length > 0) selected[0].classList.remove("selected_day");

    e.classList.add("selected_day");

    document.getElementsByName("selected_day")[0].value =
        e.attributes["data-val"].value;

    scheduleSummary("recurring");

    return;
}

function selectScheduleType(e) {
    var all = document.getElementsByClassName("schedule_type");

    for (let i = 0; i < all.length; i++) {
        const each = all[i];
        each.classList.remove("active");
    }

    e.classList.add("active");

    if (e.innerHTML == "Recurring") {
        $("#set_schedule").show();
        $("#app").hide();
        $("#choose_days").show();
        scheduleSummary("recurring");
    } else {
        $("#set_schedule").hide();
        $("#app").show();
        $("#choose_days").hide();
        scheduleSummary("one-time");
    }
}

function selectMultipleDates(e) {
    // console.log(e.innerHTML)
    var dates = document.getElementsByName("schedule_date")[0];

    if (e.classList.contains("selected_multiple_date")) {
        e.classList.remove("selected_multiple_date");

        var arr = dates.value.split("_");
        // console.log(arr)

        var index = arr.indexOf(e.innerHTML);

        if (index > -1) {
            arr.splice(index, 1);
        }

        var val = "";
        for (let i = 0; i < arr.length; i++) {
            const each = arr[i];

            if (each.length > 0) val += "_" + each;
        }

        dates.value = val;
    } else {
        e.classList.add("selected_multiple_date");

        dates.value += "_" + e.innerHTML;
    }
    // console.log(dates.value)

    scheduleSummary("recurring");
    return;
}

var today = new Date();
var date = today.getDate();
var attr = "[data-val=" + date + "]";

$(attr).addClass("selected_multiple_date");
$("#schedule_date").val(date);

var day = days[today.getDay()];
var day_attr = "[data-val=" + day + "]";
$(day_attr).addClass("selected_day");

function resendReport(e) {
    var contact = e.getAttribute('data-contact');
    var report = e.getAttribute('data-report');
    var id = e.getAttribute('data-id');

    $.get('/report/resend/' + id + '?contact=' + contact + '&report=' + report);

    return;
}

function viewReport(e) {
    var id = e.getAttribute('data-received');

    window.location.href = '/received_report/' + id;

    return;
}
