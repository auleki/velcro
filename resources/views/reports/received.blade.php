<?php
use Carbon\Carbon;

?>
@extends('layouts.reports')
@section('styles')

@stop
@section('content')

        <section class="header searchContact">
          <div class="rep">Reports</div>
          <a href="/reports/create" class="btn btn-primary searchContact repTopBtn">New Report</a>
        </section>

        <section class="message">
          <!-- Main screen tags -->
          @include('reports.search_field')
          <!-- Mobile view tags -->
          <div class="repMobParent" style="margin-left:0px">
            <ul class="navbar-nav repStatus repMobile">
              <li class="nav-item dropdown repMobActive">
                <a id="navbarDropdown" class="nav-link dropdown-toggle repTitle" href="/received_report" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>RECEIVED
                </a>
                <div class="dropdown-menu repMobDropdown" style="background:#ffffff"  aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item repTitle" href="/reports">ALL</a>
                  <a class="dropdown-item repTitle" href="/sent_report">SENT</a>
                  <a class="dropdown-item repTitle" href="/scheduled_report">SCHEDULED</a>
                  <a class="dropdown-item repTitle" href="/draft_report">DRAFT</a>
                </div>
              </li>
            </ul>
            <!-- <a href="/new_report" ><img src="{{ asset('css/icons/repMobCreate.png') }}" /></a> -->
          </div>

          <table id="table_id" class="display table table-hover table-responsive" cellspacing="0">
            <thead style="background:transparent; color:transparent;display:none">
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </thead>
            <tbody id="tableBody" class="" style="width:100vw">

            @foreach($reports as $report)
              <tr style="{{ $report->status != 'viewed' ? 'background-color: rgba(0,0,0,.05)' : '' }}">
                <td class="tdt"><input type="checkbox" class="report-checkbox" name="report_{{$report->id}}" value="{{$report->id}}_received"  onclick="selectCheckbox(this)"></td>
                <td class="tdRepTitle" onclick="window.location.href = '/received_report/{{$report->id}}?from_name=Reports'">{{ $report->title }}</td>
                <td class="tdName" onclick="window.location.href = '/received_report/{{$report->id}}?from_name=Reports'">{{ $report->from }}</td>
                <td class="tdMsg" onclick="window.location.href = '/received_report/{{$report->id}}?from_name=Reports'">{{ $report->message }}</td>
                <td class="tdTime" onclick="window.location.href = '/received_report/{{$report->id}}?from_name=Reports'">{{ $report->date }}</td>
              </tr>
              @endforeach

            </tbody>
            <!-- <tbody class="repMobTable" style="width:100vw">
              <tr style="display:flex!important; justify-content:flex-start;">
                <td class="tdt" style="display:flex!important; justify-content:flex-start; margin-top:1rem">
                  <input type="checkbox" name="" value=""></td>
                <td data-search="Tiger Nixon" class="tdDept" style="display:flex!important; flex-direction:column; width:90vw; margin-right:0.5rem">
                  <div class="" style="display:flex!important; justify-content:space-between">
                    <div class="conEmailPhone">T. Nixon</div>
                    <div class="">Timestamp</div>
                  </div>
                  <div class="">System Arc</div>
                  <div class="">Message.... Message.... Message....</div>
                </td>
              </tr>
            </tbody> -->
          </table>

        </section>

        <script>
        function openReport(id) {
          window.location.href = "/received_report/" + id;
        }
        </script>

@stop
