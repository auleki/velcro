function selectFilter(e) {
    var val = e.value.toLowerCase();

    var p = document.createElement("p");
    p.classList.add("mt-1");
    p.classList.add("ml-3");
    p.classList.add("float-right");
    p.setAttribute("tag", val);
    p.innerHTML = e.value;
    var icon = document.createElement("i");
    icon.classList.add("fas");
    icon.classList.add("ml-3");
    icon.classList.add("fa-times");
    icon.classList.add("pointer");
    icon.setAttribute("onclick", "removeFilter(this)");
    p.appendChild(icon);
    document.getElementById("show_filter").appendChild(p);
    document.getElementById("clear_all").style.display = "block";

    var selected = document.getElementById("show_filter").children;
    var selected_arr = [];
    for (let j = 0; j < selected.length; j++) {
        const elm = selected[j];
        selected_arr.push(elm.getAttribute("tag"));
    }
    filter(selected_arr);
    return;
}

function removeFilter(e) {
    var tag = e.parentNode.getAttribute("tag");

    var selected = document.getElementById("show_filter").children;
    var selected_arr = [];
    for (let j = 0; j < selected.length; j++) {
        const elm = selected[j];
        // console.log(elm.getAttribute("tag"), tag);
        if (elm.getAttribute("tag") != tag)
            selected_arr.push(elm.getAttribute("tag"));
    }

    for (let m = 0; m < selected.length; m++) {
        const elmt = selected[m];
        if (elmt.getAttribute("tag") == tag) elmt.parentNode.removeChild(elmt);
    }
    // console.log(selected_arr);

    filter(selected_arr);
}

function filter(selected_arr) {
    var company_list = document.getElementsByClassName("company_card");
    if (selected_arr.length == 0) {
        for (var i = 0; i < company_list.length; i++) {
            var company = company_list[i];
            company.classList.remove("hide-company");
        }
        document.getElementById("clear_all").style.display = "none";
        return;
    }

    for (var i = 0; i < company_list.length; i++) {
        var company = company_list[i];
        var company_data = company.getAttribute("data-tags").toLowerCase();
        for (let k = 0; k < selected_arr.length; k++) {
            const element = selected_arr[k];
            if (company_data.indexOf(element) < 0) {
                company.classList.add("hide-company");
                break;
            } else {
                company.classList.remove("hide-company");
            }
        }
    }

    return;
}

function clearAll() {
    var selected = document.getElementById("show_filter");

    while (selected.firstChild) {
        selected.removeChild(selected.lastChild);
    }
    filter([]);
    return;
}

function searchCompany(e) {
    var search = e.value.toLowerCase();
    var companies = document.getElementsByClassName("company_card");

    for (let i = 0; i < companies.length; i++) {
        const c = companies[i];

        var name = c.getAttribute("data-name").toLowerCase();

        if (name.indexOf(search) < 0) {
            c.style.display = "none";
        } else {
            c.style.display = "block";
        }
    }

    return;
}
