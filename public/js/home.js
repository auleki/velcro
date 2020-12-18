function setActive(e, id) {
  e.preventDefault;
  var tabs = document.getElementsByClassName('company-tab');

  for (var i = 0; i < tabs.length; i++) {
    if (tabs[i].classList.contains('active')) {
      tabs[i].classList.remove('active');

      break;
    }
  }

  e.classList.add('active');

  console.log(id)

  return
}

function submit(id) {
  document.getElementById(id).submit();

  return;
}

$('#company').on('change', function (evt, params) {
  // console.log(evt, params);
  // console.log($('.kpi_div ul'))
  // return
  $('#spinner').removeClass('hide-spinner')
  var company = params.selected;
  // console.log(company)
  // return company
  $.get('/fetch-company-kpis/' + company, function (data) {
    var select = $('#kpis');
    select.html('');
    select.trigger("chosen:updated");
    // console.log(data);
    // return
    if (data.sheets) {
      var optgroup_sheets = document.createElement('optgroup')
      optgroup_sheets.label = data.sheets.name;
      data.sheets.data.forEach(sheet => {
        // console.log(sheet)
        var opt = document.createElement('option');
        opt.textContent = sheet.name;
        opt.value = sheet.column_name + '_' + sheet.row;
        optgroup_sheets.append(opt);
      });
      select.append(optgroup_sheets)
    }
    
    if (data.reports) {
      var optgroup_reports = document.createElement('optgroup')
      optgroup_reports.label = data.reports.name;
      data.reports.data.forEach(report => {
        // console.log(report)
        var opt = document.createElement('option');
        opt.value = report;
        opt.textContent = report;
        optgroup_reports.append(opt);
      });
      select.append(optgroup_reports)
    }
    
    // select.selectpicker('refresh');
    select.trigger("chosen:updated");
    $('#spinner').addClass('hide-spinner')

    return;
  })
});

function deleteCompany(id) {
  window.location.href = '/company/remove-compared/' + id;

  return
}

function showContactTable(event) {
  var x = event.keyCode;

  if (x == 50) {
    $('#contact_table').show();
  } else if (x == 32) {
    $('#contact_table').hide()
  }
  // console.log(x)
  return
}

function selectContact(e) {
  var name = e.getAttribute('data-name');
  var id = e.getAttribute('data-id');
  var input = document.getElementById('note_text');
  input.value += name + ' ';
  input.focus();

  $('#contact_name').val(id);
  $('#contact_table').hide();
  // console.log(e, attr)

  return;
}

function showPlaceholder(id) {
  $('#logo_' + id).hide();
  $('#placeholder_' + id).show();
  return
}

function selectFund(id, company) {
  $.get('/select-fund-group/' + company + '&selected=' + id, function (data) {
    console.log(data)
  })
}

function changeFund(e) {
  var id = e.id;

  window.location.href = '/home?fund=' + id;

  return
}

function searchTable(e) {
  var year = e.value;
  // console.log(year, $(".data-search-" + year))
  $(".data-search-" + year).show();
  $(".activity-summary-table").not(".data-search-" + year).hide();

  return;
}

function searchByQuarter(e) {
  var qtr = e.value;
  if (qtr == 'all') {
    $(".activity-summary-table").show();
    return
  }
  // console.log(year, $(".data-search-" + year))
  $(".data-quarter-" + qtr).show();
  $(".activity-summary-table").not(".data-quarter-" + qtr).hide();

  return;
}

function openExit(e) {
  console.log(e.checked)
  var id = e.id;
  var checked = e.checked;

  $.get('/company/exit/' + id + '?status=' + checked);

  return;
}