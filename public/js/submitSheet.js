function submitSheet() {
    var link = document.getElementById("sheet_link");

    link.value = new RegExp("/spreadsheets/d/([a-zA-Z0-9-_]+)").exec(
        link.value
    )[1];

    document.getElementById("sheet_form").submit();
}

function selectSpreadSheet(e) {
    var tool = e.options[e.selectedIndex].id;
    var spreadSheet = e.options[e.selectedIndex].value;
    var name = e.options[e.selectedIndex].innerHTML;
    // console.log(name)
    // return

    document.getElementById("sheet").classList.add("hide-select");
    document.getElementById("bigSe").classList.add("hide-select");

    $.get("/fetch-sheets/" + spreadSheet + "?tool=" + tool + "&name=" + name, function (data) {
        const first_option = `<option value="">Select sheet</option>`;
        document.getElementById("select_sheet").innerHTML = first_option;

        for (let i = 0; i < data.length; i++) {
            const sheet = data[i];

            const option = document.createElement("option");
            // option.setAttribute(
            //     "onclick",
            //     `selectSheet('${sheet["title"]}', '${spreadSheet}', '${tool}')`
            // );
            option.value = sheet["name"];
            option.text = sheet["name"];

            document.getElementById("select_sheet").appendChild(option);
        }

        document.getElementById("sheet").classList.remove("hide-select");
        document.getElementById("bigSe").classList.remove("hide-select");
    });

    return;
}

function selectSheet(sheetId, spreadSheetId, tool) {
    $.get(
        "/fetch-sheet-data/" +
        sheetId +
        "?tool=" +
        tool +
        "&&spreadsheet=" +
        spreadSheetId,
        function (data) {
            for (let i = 0; i < data[0].length; i++) {
                const col = data[0][i];

                const option = document.createElement("option");
                option.value = col;
                option.text = col;

                document.getElementById("select_column").appendChild(option);
            }

            document.getElementById("bigSe").classList.remove("hide-select");
        }
    );

    return;
}

function selectExcel(id) {
    window.location.href = "/excel_sheets/" + id;

    return;
}

function selectExcelSheet(name, spreadSheet) {
    window.location.href = '/excel/sheet/' + name + '?s=' + spreadSheet;

    return;
}
