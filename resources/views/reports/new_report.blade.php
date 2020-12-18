<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>New Report</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <link rel="stylesheet" href="/vendor/chosen/chosen.min.css">
      <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
      <!-- Styles -->

      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
      <link href="{{ asset('css/sample.css') }}" rel="stylesheet">
      <link href="{{ asset('css/report.css') }}" rel="stylesheet">
      <link href="{{ asset('css/tooltip.css') }}" rel="stylesheet">
      <link href="{{ asset('css/contactTable.css') }}" rel="stylesheet">

      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      <link ‎href="https://fonts.googleapis.com/css?family=europa:200,600" rel="stylesheet">

      <script type="text/javascript">
        var oDoc, sDefTxt;

        function initDoc() {
          oDoc = document.getElementById("textBox");
          sDefTxt = oDoc.innerHTML;
          // if (document.compForm.switchMode.checked) { setDocMode(true); }
        }

        function formatDoc(sCmd, sValue) {
          document.execCommand(sCmd, false, sValue);
          oDoc.focus();
        }

        function validateMode() {
          // if (!document.compForm.switchMode.checked) { return true; }
          alert("Uncheck \"Show HTML\".");
          oDoc.focus();
          return false;
        }

        function setDocMode(bToSource) {
          var oContent;
          if (bToSource) {
            oContent = document.createTextNode(oDoc.innerHTML);
            oDoc.innerHTML = "";
            var oPre = document.createElement("pre");
            oDoc.contentEditable = false;
            oPre.id = "sourceText";
            oPre.contentEditable = true;
            oPre.appendChild(oContent);
            oDoc.appendChild(oPre);
            document.execCommand("defaultParagraphSeparator", false, "div");
          } else {
            if (document.all) {
              oDoc.innerHTML = oDoc.innerText;
            } else {
              oContent = document.createRange();
              oContent.selectNodeContents(oDoc.firstChild);
              oDoc.innerHTML = oContent.toString();
            }
            oDoc.contentEditable = true;
          }
          oDoc.focus();
        }

        function printDoc() {
          // if (!validateMode()) { return; }
          var oPrntWin = window.open("", "_blank", "width=450,height=470,left=400,top=100,menubar=yes,toolbar=no,location=no,scrollbars=yes");
          oPrntWin.document.open();
          oPrntWin.document.write("<!doctype html><html><head><title>Print<\/title><\/head><body onload=\"print();\">" + oDoc.innerHTML + "<\/body><\/html>");
          oPrntWin.document.close();
        }
      </script>


      <script src="{{ asset('js/app.js') }}" defer></script>
  </head>
  <style>

  .btn-secondary:hover{
    color: #000000;
  }

  .addImageFile{
    background-image:url('');
    background-size: cover;
    background-position: center;
    height: 250px; width: 100%;
    border: 1px solid #bbb;
  }

  .addHeaderFile{
    background-image:url('');
    background-size: cover;
    background-position: center;
    height: 150px; width: 100%;
    border: 1px solid #bbb;
  }

  .btn-editor{
    border: none;

    box-shadow: border-box;
    margin-left: .4em !important;
  }
  .wholeContent{
    width: 82%;
    margin-left: 3rem;
  }

  .text-info{
    color: #19B9FD !important;

  }
  .editor{
      position: relative;
      left: 33ch;
      top: 5em;

  }
  .editor .title {
    padding: 1.3em;
    font-size: 1.6em;
  }

  div.editable {
    height: 400px;
    border: 1px solid #ccc;
    padding: 5px;

    overflow:hidden;
  }

  .container1{
    height:400px;
    overflow:auto;
    width: 100%
  }

  .container2 {
    min-height:100%;
    display:table;
    width: 100%
  }

  textarea{
    font-size: 1.2rem !important;
  }

  .schedule_type, .schedule_type:hover {
    color: #666666
  }

  span[tabindex="0"] {
    background: #19B9FD !important;
    color: #FFFFFF !important;
  }

  .events{
    position: relative;
  }

  select.schedule-form-control{
    width: 5rem;
    height: 25px !important;
    font-size: 15px;
    padding-top: 0px;
    padding-bottom: 0px
  }

  .chosen-container {
    width: 100% !important
  }

  .multiple_row {
    background: #FFFFFF;
    /* modal/dialog box border */
    border: 1px solid #E5E5E5;
    box-sizing: border-box;
    border-radius: 4px;
  }

  .multiple_dates {
    font-family: Europa;
    font-size: 14px;
    line-height: 18px;
    text-align: center;
    cursor: pointer;
    color: #333333;
    width: 14%;
  }

  /* .multiple_dates:hover {
    background: rgba(25, 185, 253, 0.25);
    border: 1px solid rgba(25, 185, 253, 0.25);
    box-sizing: border-box;
    border-radius: 20px;
    cursor: pointer
  } */

  .selected_multiple_date {
    background: #19B9FD;
    border: 1px solid #19B9FD;
    box-sizing: border-box;
    border-radius: 50%;
    color: #ffffff;
    text-align: center
  }

  .week_day {
    background: #FFFFFF;
    border: 1px solid #AAAAAA;
    box-sizing: border-box;
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.15);
    width:30px;
    height: 30px;
    border-radius: 50%;
    text-align: center;
    line-height: 30px;
    float: left
  }

  .week_day:hover, .multiple_dates:hover {
    background: rgba(25, 185, 253, 0.25);
    border: 1px solid rgba(25, 185, 253, 0.25);
    box-sizing: border-box;
    border-radius: 50%;
    cursor: pointer
  }

  .selected_day {
    background: #19B9FD;
    color: #fff
  }

  .active {
    color: #333333 !important
  }

  </style>


                          <?php
                              $selected = 'selected="selected"';
                              $h = date('h') + 1;
                              $m = date('i');
                              $d = date('d');
                              $a = date('a');
                              $ends = array('th','st','nd','rd','th','th','th','th','th','th');

                              if (($d %100) >= 11 && ($d%100) <= 13)
                                $d .= 'th';
                              else
                                $d .= $ends[$d % 10];
                          ?>
  <body onload="initDoc();">
    <div class="wrapper">

      @include('layouts.sidebar')
    </div>
        <main class="wholeContent">
          <div class="mt-3">
            <div class="row">
              <p class="text-info mt-2"><a class="text-info" href="/reports"> Back </a> </p>

              <div class="ml-auto mr-5 row">
                <p class=" ml-auto mr-3 mt-2"><a class="text-info" href="#!" onclick="sendReport('save')"> Save & Close </a></p>
                <div class="btn-group ml-auto" role="group" aria-label="Button group with nested dropdown">
                  <button type="submit" onclick="sendReport('send')" class="btn btn-primary btnNow" name="status" value="sent" data-toggle="tooltip" data-placement="left" title="Send report now">Send Now</button>
                  <!-- <div class="btn-group" role="group" aria-label="Button group with nested dropdown"> -->
                    <!-- <button type="submit" class="btn btn-primary btnNow mobileHide "  data-toggle="tooltip" data-placement="left" title="Send report now">Send now</button> -->
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-primary  mobileHide  dropdown-toggle" title="Schedule report" data-toggle="modal" data-target="#scheduleReport"></button>
                    </div>
                  <!-- </div> -->
                </div>
              </div>
            </div>
          </div>

          <div class="editor">
              <form name="compForm" method="post" class="form-group " id="send_report" enctype="multipart/form-data">
              @csrf
                <input type="hidden" name="body_content" id="body">
                <input type="hidden" name="schedule_date" id="schedule_date">
                <input type="hidden" name="schedule_type">
                <input type="hidden" name="selected_day">
                <div class="col-6 mb-5">
                    <input type="text" name="title" class="form-control title" placeholder="Add a subject title">
                    @if ($errors->has('title'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                      </span>
                    @endif
                    <!-- <div class="col-6 mb-5"> -->
                      <textarea name="message" class="form-control mt-4" cols="10" placeholder="Add email message here" rows="3"></textarea>
                    <!-- </div> -->
                    <div class="btn-toolbar mt-2 mb-2 float-right" role="toolbar" aria-label="Toolbar with button groups">
                      <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button type="button" class="btn rounded-circle btn-editor " title="Insert Chart">
                          <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 25.4C19.8483 25.4 25.4 19.8483 25.4 13C25.4 6.15167 19.8483 0.600006 13 0.600006C6.15167 0.600006 0.600006 6.15167 0.600006 13C0.600006 19.8483 6.15167 25.4 13 25.4Z" fill="white" stroke="#333333" stroke-width="1.2"/>
                            <path d="M18.3207 18.5491H8.52788C7.80974 18.5491 7.22217 17.9615 7.22217 17.2434V7.45056H8.52788V17.2434H18.3207V18.5491Z" fill="#333333"/>
                            <path d="M10.2905 14.4361L9.37646 13.5221L13.0977 9.80086L15.0563 11.7594L17.8636 8.95215L18.7776 9.86615L15.0563 13.5874L13.0977 11.6289L10.2905 14.4361Z" fill="#333333"/>
                            </svg>

                        </button>
                        <button type="button" class="btn rounded-circle btn-editor" title="Insert Image" id="addimage">
                          <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 25.4C19.8483 25.4 25.4 19.8483 25.4 13C25.4 6.15167 19.8483 0.600006 13 0.600006C6.15167 0.600006 0.600006 6.15167 0.600006 13C0.600006 19.8483 6.15167 25.4 13 25.4Z" fill="white" stroke="#333333" stroke-width="1.2"/>
                            <path d="M7.70396 7.58325C6.98031 7.58325 6.37988 8.19732 6.37988 8.93742V17.0624C6.37988 17.8025 6.98031 18.4166 7.70396 18.4166H18.2965C19.0202 18.4166 19.6206 17.8025 19.6206 17.0624V8.93742C19.6206 8.19732 19.0202 7.58325 18.2965 7.58325H7.70396ZM7.70396 8.93742H18.2965V17.0624H7.70396V8.93742ZM11.6762 10.2916C11.5006 10.2916 11.3322 10.3629 11.208 10.4899C11.0839 10.6169 11.0141 10.7891 11.0141 10.9687C11.0141 11.1482 11.0839 11.3205 11.208 11.4474C11.3322 11.5744 11.5006 11.6458 11.6762 11.6458C11.8518 11.6458 12.0202 11.5744 12.1443 11.4474C12.2685 11.3205 12.3382 11.1482 12.3382 10.9687C12.3382 10.7891 12.2685 10.6169 12.1443 10.4899C12.0202 10.3629 11.8518 10.2916 11.6762 10.2916ZM14.6553 12.3228L12.3382 15.0312L10.6831 13.3385L8.88062 15.7083H17.138L14.6553 12.3228Z" fill="#333333"/>
                            </svg>
                        </button>
                        <button type="button" class="btn rounded-circle btn-editor" title="Insert File" id="addfiles">
                          <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 25.4C19.8483 25.4 25.4 19.8483 25.4 13C25.4 6.15167 19.8483 0.600006 13 0.600006C6.15167 0.600006 0.600006 6.15167 0.600006 13C0.600006 19.8483 6.15167 25.4 13 25.4Z" fill="white" stroke="#333333" stroke-width="1.2"/>
                            <path d="M15.7576 9.71683V16.5446C15.7576 17.6411 14.868 18.6391 13.579 18.8591C11.8071 19.1618 10.2423 18.0357 10.2423 16.6109V8.47786C10.2423 7.82391 10.7765 7.21591 11.551 7.10889C12.5374 6.97298 13.3939 7.60658 13.3939 8.40367V15.2978C13.3939 15.479 13.2166 15.6261 12.9999 15.6261C12.7833 15.6261 12.606 15.479 12.606 15.2978V9.71683C12.606 9.3544 12.253 9.06025 11.8181 9.06025C11.3832 9.06025 11.0302 9.3544 11.0302 9.71683V15.2013C11.0302 16.0601 11.77 16.844 12.7951 16.9307C13.973 17.0305 14.9697 16.259 14.9697 15.2978V8.52054C14.9697 7.1496 13.7697 5.92311 12.1325 5.79048C10.2533 5.63815 8.6665 6.86924 8.6665 8.40367V16.4501C8.6665 18.3351 10.3156 20.0212 12.5658 20.2044C15.1493 20.4152 17.3334 18.7212 17.3334 16.6109V9.71683C17.3334 9.3544 16.9804 9.06025 16.5455 9.06025C16.1106 9.06025 15.7576 9.3544 15.7576 9.71683Z" fill="#333333"/>
                            </svg>
                        </button>
                        <button type="button" class="btn rounded-circle btn-editor " title="Insert Link" onclick="var sLnk=prompt('Write the URL here','http:\/\/');if(sLnk&&sLnk!=''&&sLnk!='http://'){formatDoc('createlink',sLnk)}">
                          <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 25.4C19.8483 25.4 25.4 19.8483 25.4 13C25.4 6.15167 19.8483 0.600006 13 0.600006C6.15167 0.600006 0.600006 6.15167 0.600006 13C0.600006 19.8483 6.15167 25.4 13 25.4Z" fill="white" stroke="#333333" stroke-width="1.2"/>
                            <path d="M9.06065 9.71692C7.1415 9.71692 5.60674 11.3637 5.7932 13.3216C5.95603 15.0287 7.48676 16.2826 9.20171 16.2826H11.0304C11.3928 16.2826 11.6869 15.9885 11.6869 15.626C11.6869 15.2636 11.3928 14.9695 11.0304 14.9695H9.17221C8.10595 14.9695 7.14995 14.1705 7.0948 13.1049C7.03505 11.969 7.93792 11.0301 9.06065 11.0301H11.0304C11.3928 11.0301 11.6869 10.7359 11.6869 10.3735C11.6869 10.0111 11.3928 9.71692 11.0304 9.71692H9.06065ZM14.9698 9.71692C14.6073 9.71692 14.3132 10.0111 14.3132 10.3735C14.3132 10.7359 14.6073 11.0301 14.9698 11.0301H16.8279C17.8942 11.0301 18.8502 11.829 18.9053 12.8946C18.9651 14.0305 18.0622 14.9695 16.9395 14.9695H14.9698C14.6073 14.9695 14.3132 15.2636 14.3132 15.626C14.3132 15.9885 14.6073 16.2826 14.9698 16.2826H16.9395C18.8586 16.2826 20.3934 14.6358 20.2069 12.6779C20.0441 10.9708 18.5134 9.71692 16.7984 9.71692H14.9698ZM10.3738 12.3432C10.0114 12.3432 9.71722 12.6373 9.71722 12.9998C9.71722 13.3622 10.0114 13.6563 10.3738 13.6563H15.6263C15.9887 13.6563 16.2829 13.3622 16.2829 12.9998C16.2829 12.6373 15.9887 12.3432 15.6263 12.3432H10.3738Z" fill="#333333"/>
                            </svg>

                        </button>
                        <button type="button" class="btn rounded-circle btn-editor " title="Insert Header" onclick="formatDoc('formatblock', 'h4');">
                          <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 25.4C19.8483 25.4 25.4 19.8483 25.4 13C25.4 6.15167 19.8483 0.600006 13 0.600006C6.15167 0.600006 0.600006 6.15167 0.600006 13C0.600006 19.8483 6.15167 25.4 13 25.4Z" fill="white" stroke="#333333" stroke-width="1.2"/>
                            <path d="M8.9165 7.75V18.25H10.6665V13.5833H15.3332V18.25H17.0832V7.75H15.3332V11.8333H10.6665V7.75H8.9165Z" fill="#333333"/>
                            </svg>

                        </button>
                      </div>
                    </div>
                </div>
                <div class="col-6 editor-body">
                  @if ($errors->has('content'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('content') }}</strong>
                      </span>
                    @endif
                  <!-- <textarea name="content" class="form-control" id="body_content" cols="30" placeholder="Add content here" rows="10"></textarea> -->

                      <div class="form-control editable" id="textBox" contenteditable=true></div>
                      <input type="file" name="body_image" id="fileid" onchange="insertImage()" hidden>
                      <input type="file" name="files" id="files" onchange="handleFiles(this.files)" multiple hidden>
                    <!-- </div>
                  </div> -->

                </div>

                <input type="hidden" name="total_metrics" id="total_metrics" value="0">
                <input type="hidden" name="total_files" id="total_files" value="0">
                <input type="hidden" name="total_texts" id="total_texts" value="0">
                <input type="hidden" name="metric_1" id="metric_1" value="0">
                <input type="hidden" name="metric_2" id="metric_2" value="0">
                <input type="hidden" name="metric_3" id="metric_3" value="0">
                <input type="hidden" name="metric_4" id="metric_4" value="0">
                <input type="hidden" name="metric_5" id="metric_5" value="0">
                <input type="hidden" name="metric_6" id="metric_6" value="0">
                <input type="hidden" name="metric_7" id="metric_7" value="0">
                <input type="hidden" name="metric_8" id="metric_8" value="0">
                <input type="hidden" name="metric_9" id="metric_9" value="0">
                <input type="hidden" name="metric_0" id="metric_0" value="0">
                <div id="doc"></div>

                {{-- Modals --}}
                    <!-- add text request -->
                <div class="modal fade" id="scheduleReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <!-- <h5 class="modal-title" id="exampleModalLabel">Add Text Request</h5> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="container events">

                          <div class="nav">
                              <ul class="nav nav-tabs">
                                  <li class="nav-item">
                                    <a class="nav-link active schedule_type" href="#!" onclick="selectScheduleType(this)" data-val="one-time">One-time</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link schedule_type" href="#!" onclick="selectScheduleType(this)" data-val="recurring">Recurring</a>
                                    </li>
                                </ul>
                          </div>

                          <div class="row mt-5" id="set_schedule" style="display:none">
                            <p class="ml-3 mt-2"> Repeat: </p>
                            <select name="period" id="period" class="form-control ml-3 schedule-form-control" onchange="setRecurring(this)" style="width: 7rem" autocomplete="off">
                                <option value="monthly"> Monthly</option>
                                <option value="weekly">Weekly</option>
                                <option value="daily">Daily</option>
                            </select>
                            <p class="ml-3 mt-2"> Every: </p>
                            <select name="recurring" id="recurring" class="form-control schedule-form-control ml-3" onchange="scheduleSummary('recurring')" autocomplete="off">
                                <option value="1">1</option>
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
                              </select>
                            <p class="ml-3 mt-2" id="period_name"> Month </p>

                          </div>
                          <div id='app' class="mt-5">
                              <p> Choose dates</p>
                              <!-- <input id="datetimepicker" type="text" > -->
                              <v-calendar></v-calendar>

                          </div>
                          <div class="row mt-3" id="choose_days" style="display:none">
                            <p class="ml-3 mt-2" style="width:100%"> On the: </p>
                            <div class="row ml-3 multiple_row">
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="1" style="margin-top:1rem">1</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="2" style="margin-top:1rem">2</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="3" style="margin-top:1rem">3</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="4" style="margin-top:1rem">4</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="5" style="margin-top:1rem">5</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="6" style="margin-top:1rem">6</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="7" style="margin-top:1rem">7</p>
                              <br>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="8">8</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="9">9</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="10">10</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="11">11</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="12">12</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="13">13</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="14">14</p>
                              <br>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="15">15</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="16">16</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="17">17</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="18">18</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="19">19</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="20">20</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="21">21</p>
                              <br>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="22">22</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="23">23</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="24">24</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="25">25</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="26">26</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="27">27</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="2">28</p>
                              <br>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="29">29</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="30">30</p>
                              <p class="multiple_dates" onclick="selectMultipleDates(this)" data-val="31">31</p>
                            </div>
                          </div>

                          <div class="row mt-5" id="app_week" style="display:none">
                            <p class="ml-3 mt-2"> On: </p>
                            <div class="text-center ml-3">
                              <p class="week_day" onclick="selectDay(this)" data-val="Sunday">Su</p>
                              <p class="week_day" onclick="selectDay(this)" data-val="Monday">Mo</p>
                              <p class="week_day" onclick="selectDay(this)" data-val="Tuesday">Tu</p>
                              <p class="week_day" onclick="selectDay(this)" data-val="Wednesday">We</p>
                              <p class="week_day" onclick="selectDay(this)" data-val="Thursday">Th</p>
                              <p class="week_day" onclick="selectDay(this)" data-val="Friday">Fr</p>
                              <p class="week_day" onclick="selectDay(this)" data-val="Saturday">Sa</p>
                            </div>
                          </div>
                          <div class="row mt-5">
                              <p class="ml-3"> At: </p>
                              <!-- <input type="number" min="1" max="12" class="form-control schedule-form-control ml-3" placeholder="12"> -->
                              <select name="hour" id="one_time_hour" class="form-control schedule-form-control ml-3" onchange="scheduleSummary()" autocomplete="off">
                                <option value="1" {{$h == "1"? $selected:''}}>1</option>
                                <option value="2" {{$h == "2"? $selected:''}}>2</option>
                                <option value="3" {{$h == "3"? $selected:''}}>3</option>
                                <option value="4" {{$h == "4"? $selected:''}}>4</option>
                                <option value="5" {{$h == "5"? $selected:''}}>5</option>
                                <option value="6" {{$h == "6"? $selected:''}}>6</option>
                                <option value="7" {{$h == "7"? $selected:''}}>7</option>
                                <option value="8" {{$h == "8"? $selected:''}}>8</option>
                                <option value="9" {{$h == "9"? $selected:''}}>9</option>
                                <option value="10" {{$h == "10"? $selected:''}}>10</option>
                                <option value="11" {{$h == "11"? $selected:''}}>11</option>
                                <option value="12" {{$h == "12"? $selected:''}}>12</option>
                              </select>
                              <p class="ml-3"> : </p>
                              <!-- <input type="number" min="0" max="59" class="ml-3 form-control schedule-form-control" placeholder="00"> -->
                              <select name="minute" id="one_time_minute" class="form-control schedule-form-control ml-3" onchange="scheduleSummary()" autocomplete="off">
                                <option value="00" {{$m == "0"? $selected:''}}>00</option>
                                <option value="01" {{$m == "1"? $selected:''}}>01</option>
                                <option value="02" {{$m == "2"? $selected:''}}>02</option>
                                <option value="03" {{$m == "3"? $selected:''}}>03</option>
                                <option value="04" {{$m == "4"? $selected:''}}>04</option>
                                <option value="05" {{$m == "5"? $selected:''}}>05</option>
                                <option value="06" {{$m == "6"? $selected:''}}>06</option>
                                <option value="07" {{$m == "7"? $selected:''}}>07</option>
                                <option value="08" {{$m == "8"? $selected:''}}>08</option>
                                <option value="09" {{$m == "9"? $selected:''}}>09</option>
                                <option value="10" {{$m == "10"? $selected:''}}>10</option>
                                <option value="11" {{$m == "11"? $selected:''}}>11</option>
                                <option value="12" {{$m == "12"? $selected:''}}>12</option>
                                <option value="13" {{$m == "13"? $selected:''}}>13</option>
                                <option value="14" {{$m == "14"? $selected:''}}>14</option>
                                <option value="15" {{$m == "15"? $selected:''}}>15</option>
                                <option value="16" {{$m == "16"? $selected:''}}>16</option>
                                <option value="17" {{$m == "17"? $selected:''}}>17</option>
                                <option value="18" {{$m == "18"? $selected:''}}>18</option>
                                <option value="19" {{$m == "19"? $selected:''}}>19</option>
                                <option value="20" {{$m == "20"? $selected:''}}>20</option>
                                <option value="21" {{$m == "21"? $selected:''}}>21</option>
                                <option value="22" {{$m == "22"? $selected:''}}>22</option>
                                <option value="23" {{$m == "23"? $selected:''}}>23</option>
                                <option value="24" {{$m == "24"? $selected:''}}>24</option>
                                <option value="25" {{$m == "25"? $selected:''}}>25</option>
                                <option value="26" {{$m == "26"? $selected:''}}>26</option>
                                <option value="27" {{$m == "27"? $selected:''}}>27</option>
                                <option value="28" {{$m == "28"? $selected:''}}>28</option>
                                <option value="29" {{$m == "29"? $selected:''}}>29</option>
                                <option value="30" {{$m == "30"? $selected:''}}>30</option>
                                <option value="31" {{$m == "31"? $selected:''}}>31</option>
                                <option value="32" {{$m == "32"? $selected:''}}>32</option>
                                <option value="33" {{$m == "33"? $selected:''}}>33</option>
                                <option value="34" {{$m == "34"? $selected:''}}>34</option>
                                <option value="35" {{$m == "35"? $selected:''}}>35</option>
                                <option value="36" {{$m == "36"? $selected:''}}>36</option>
                                <option value="37" {{$m == "37"? $selected:''}}>37</option>
                                <option value="38" {{$m == "38"? $selected:''}}>38</option>
                                <option value="39" {{$m == "39"? $selected:''}}>39</option>
                                <option value="40" {{$m == "40"? $selected:''}}>40</option>
                                <option value="41" {{$m == "41"? $selected:''}}>41</option>
                                <option value="42" {{$m == "42"? $selected:''}}>42</option>
                                <option value="43" {{$m == "43"? $selected:''}}>43</option>
                                <option value="44" {{$m == "44"? $selected:''}}>44</option>
                                <option value="45" {{$m == "45"? $selected:''}}>45</option>
                                <option value="46" {{$m == "46"? $selected:''}}>46</option>
                                <option value="47" {{$m == "47"? $selected:''}}>47</option>
                                <option value="48" {{$m == "48"? $selected:''}}>48</option>
                                <option value="49" {{$m == "49"? $selected:''}}>49</option>
                                <option value="50" {{$m == "50"? $selected:''}}>50</option>
                                <option value="51" {{$m == "51"? $selected:''}}>51</option>
                                <option value="52" {{$m == "52"? $selected:''}}>52</option>
                                <option value="53" {{$m == "53"? $selected:''}}>53</option>
                                <option value="54" {{$m == "54"? $selected:''}}>54</option>
                                <option value="55" {{$m == "55"? $selected:''}}>55</option>
                                <option value="56" {{$m == "56"? $selected:''}}>56</option>
                                <option value="57" {{$m == "57"? $selected:''}}>57</option>
                                <option value="58" {{$m == "58"? $selected:''}}>58</option>
                                <option value="59" {{$m == "59"? $selected:''}}>59</option>
                              </select>
                              <!-- <form action=""> -->
                              <div class="mt-2">
                                  <input  type="radio" class="ml-3" name="am_pm" value="am" onclick="scheduleSummary()" {{$a == 'am'? 'checked':''}} autocomplete="off">
                                  <label > am </label>
                                  <input type="radio" class="ml-3" name="am_pm"  value="pm" onclick="scheduleSummary()" {{$a == 'pm'? 'checked':''}} autocomplete="off">
                                  <label> pm </label>
                              </div>
                              <!-- </form> -->
                          </div>
                          <p class="mt-3"id="summary_block">  Summary: <span class="font-weight-bold" id="summary_span">On the {{$d}} at {{$h}}:{{$m}}{{$a}} </span></p>

                          <div class="mt-3">
                              <p> Choose contacts</p>
                              <div >
                                <select name="contacts[]" id="" class="form-control mobileHide mt-5 shadow chosen-select" data-placeholder="Type in email address or add persons or tags from your contacts" multiple style="width: 50%">
                                  @for($i=0;$i<count($contacts);$i++)
                                  <option value="{{$contacts[$i]['id']}}">
                                    {{ $contacts[$i]["fname"] }} {{$contacts[$i]["lname"] }} ({{$contacts[$i]["tags"]}})
                                  </option>
                                  @endfor
                                </select>
                              </div>
                          </div>

                          <hr>

                          <div class="d-flex footer justify-content-end">
                              <button class="btn btn-default mr-3" data-dismiss="modal" aria-label="Close"> Cancel </button>
                              <button class="btn btn-primary" onclick="sendReport('schedule')"> Schedule send</button>
                          </div>

                          <div style="height: 2rem"></div>
                        </div>
                      </div>
                      <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary "  data-dismiss="modal" aria-label="Close">Close</button>
                        <button type="button" class="btn btn-primary "  data-dismiss="modal" aria-label="Close" onclick="addRequest('text')">Add</button>
                      </div> -->
                    </div>
                  </div>
                </div>

                    <!-- add text request -->
                <div class="modal fade" id="addText" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Text Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <p> Text title</p>
                          <p class="ml-auto "> Required </p>
                          <label class="switch mt-1 ml-2">
                            <input type="checkbox" id="text_required" name="text_required">
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <div class="form-group align-form  ">
                          <input type="text" name="text_title" id="text_title" placeholder="Enter text title" class="p-3 form-control" >
                        </div>

                        <div class="form-group align-form">
                          <p> Description</p>
                          <textarea name="text_description" id="text_desc" class="form-control text-wrap">
                          </textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary "  data-dismiss="modal" aria-label="Close">Close</button>
                        <button type="button" class="btn btn-primary "  data-dismiss="modal" aria-label="Close" onclick="addRequest('text')">Add</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Add Metrics -->
                <div class="modal fade" id="addMetrics" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Metric</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <p> Metric title</p>
                          <p class="ml-auto "> Required </p>
                          <label class="switch mt-1 ml-2">
                            <input type="checkbox" id="metric_required" name="metric_required">
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <div class="form-group align-form  ">
                          <input type="text" name="metric_subject" id="metric_title" placeholder="Enter metrics subject" class="p-3 form-control" >
                        </div>

                        <div class="form-group align-form">
                          <p> Description</p>
                          <textarea name="metric_description" id="metric_desc" class="form-control text-wrap">
                          </textarea>
                        </div>

                        <div class="kpi headed row align-form">
                          <div class="col-12" style="padding-left: 0px">
                            <div class="col-sm-5 float-left" style="padding-left: 0px"><p>KPI name</p></div>
                            <div class="col-sm-4 float-left"><p>Format</p></div>
                            <div class="col-sm-3 float-left text-right" style="padding-right: 0px"><p>KPI Value</p></div>
                          </div>


                          <div id="kpi_info">
                            <div class="col-12 mb-3 kpi_info" style="padding-left: 0px">
                              <div class="col-sm-5 float-left" style="padding-left: 0px">
                                <input type="text" class="form-control" placeholder="Enter KPI name" >
                              </div>
                              <div class="col-sm-3 float-left">
                                <button class="btn btn-secondary dropdown-toggle btn-sm btn-kpi-format" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Currency
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="#!" onclick="changeFormat(this)">Currency</a>
                                  <a class="dropdown-item" href="#!" onclick="changeFormat(this)">Number</a>
                                </div>
                              </div>
                              <div class="col-sm-4 float-left text-right" style="padding-right: 0px">
                                <input type="text" class="form-control " placeholder="Enter value" style="padding-right: 0px" disabled >
                              </div>
                            </div>
                          </div>

                          <!-- <div class="col-12 mb-3 kpi_info" style="padding-left: 0px">
                            <input type="hidden" name="kpi_format_1" value="Currency">
                            <div class="col-sm-5 float-left" style="padding-left: 0px">
                              <input type="text" class="form-control" name="kpi_name_1" value="Enter KPI name" >
                            </div>
                            <div class="col-sm-3 float-left">
                              <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Currency
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#!" onclick="changeFormat('Currency', 'kpi_format_1')">Currency</a>
                                <a class="dropdown-item" href="#!" onclick="changeFormat('Number', 'kpi_format_1')">Number</a>
                              </div>
                            </div>
                            <div class="col-sm-4 float-left text-right" style="padding-right: 0px">
                              <input type="text" class="form-control " name="kpi_value_1" value="Enter value" style="padding-right: 0px" >
                            </div>
                          </div> -->
                        </div>

                        <div class="base-kpi row ml-n3 mt-3">
                          <a href="#!" class="text-info" onclick="addKPI()"> <i class="fas fa-plus"></i> Add KPI</a>
                          <a href="#!" class="text-info ml-auto" data-tooltip="Delete KPI" onclick="removeLastKPI()"> <i class="fas fa-trash-alt "></i> </a>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary "  data-dismiss="modal" aria-label="Close">Close</button>
                        <button type="button" class="btn btn-primary "  data-dismiss="modal" aria-label="Close" onclick="addRequest('metric')">Add</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Upload file -->
                <div class="modal fade" id="uploadFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addKpi">Upload File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <p> File title</p>
                          <p class="ml-auto"> Required </p>
                          <label class="switch mt-1 ml-2">
                            <input type="checkbox" id="file_required" name="file_required" >
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <div class="form-group align-form  ">
                          <input type="text" name="file_name" id="file_title" placeholder="Pitch deck" style="font-size: 1.3rem" class="p-4 form-control" onfocusout="focusOut(this)">
                        </div>
                        <div class="form-group align-form">
                          <p> Upload prompt</p>
                          <textarea name="file_description" id="file_desc" class="form-control text-wrap" placeholder="Upload pitch deck" ></textarea>
                        </div>

                        <!-- <div class="upload ml-n3 mobileHide">
                          <button type="button" class="form-control btn-secondary ml-3" style></button>
                        </div>    -->
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary  " class="close" data-dismiss="modal" aria-label="Close">Close</button>
                        <button type="button" class="btn btn-primary  " class="close" data-dismiss="modal" aria-label="Close" onclick="addRequest('file')">Add</button>
                      </div>
                    </div>
                  </div>
                </div>

              </form>

              <div class="row ml-5 mt-5 ">
                <button class="btn btn-secondary " data-toggle="modal" data-target="#addText"> Add text request</button>
                <button class="btn btn-secondary ml-2" data-toggle="modal" data-target="#addMetrics"> Add metrics request</button>
                <button class="btn btn-secondary ml-2"  data-toggle="modal" data-target="#uploadFile"> Add file request</button>
              </div>
          </div>
        </main>

        <!-- <script src="/js/jquery.datetimepicker.full.min.js"></script> -->

    <script src='https://unpkg.com/vue/dist/vue.js'></script>

    <script src='https://unpkg.com/v-calendar@next'></script>
    <script>
      new Vue({
        el: '#app',
        data: {
          // Data used by the date picker
          mode: 'single',
          selectedDate: null,
        }
      })
    </script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script> -->

    <script src="/vendor/chosen/chosen.jquery.min.js"></script>
  <script src="{{ asset('js/iziToast.js') }}"></script>
  <script src="/js/reports.js"></script>
  @include('vendor.lara-izitoast.toast')
    <script>
      // console.log({{date('a')}})
      $(".chosen-select").chosen();
    </script>

    <!-- <script>
      jQuery('#datetimepicker').datetimepicker({
        format:'d.m.Y',
        timepicker: false,
        inline:true,
        lang:'ru'
      });
    </script> -->

    <script>
      document.getElementById('addimage').addEventListener('click', openDialog);
      document.getElementById('addfiles').addEventListener('click', multipleFileDialog);

      function openDialog() {
        document.getElementById('fileid').click();
      }
      function multipleFileDialog() {
        document.getElementById('files').click();
      }

    </script>
  </body>
</html>
