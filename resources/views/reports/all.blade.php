<?php
use Carbon\Carbon;

?>
@extends('layouts.reports ')
@section('styles')

@stop
@section('content')

<style>
  .sidebar a {
    color: #ffffff;

  }

  @media (max-width: 700px){
      .repMobParent{
          margin-left: 0px !important;
      }
  }
</style>
        <div class="">
          @include('inc.messages')
        </div>
        <section class="header searchContact">
          <div class="rep">Reports</div>
          <a href="/reports/create" class="btn btn-primary searchContact repTopBtn">New Report</a>
        </section>

        <section class="message">
          @include('reports.search_field')
          <!-- Mobile view tags -->
          <div class="repMobParent">
            <ul class="navbar-nav repStatus repMobile">
              <li class="nav-item dropdown repMobActive">
                <a id="navbarDropdown" class="nav-link dropdown-toggle repTitle" href="/reports" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>ALL
                </a>
                <div class="dropdown-menu repMobDropdown" style="background:#ffffff" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item repTitle" href="/sent_report">SENT</a>
                  <a class="dropdown-item repTitle" href="/received_report">RECEIVED</a>
                  <a class="dropdown-item repTitle" href="/scheduled_report">SCHEDULED</a>
                  <a class="dropdown-item repTitle" href="/draft_report">DRAFT</a>
                </div>
              </li>
            </ul>
            <!-- <a href="/reports/create" ><img src="{{ asset('css/icons/repMobCreate.png') }}" /></a> -->
          </div>
          <table id="table_id" class="display table table-hover table-responsive">
            <thead style="background:transparent; color:transparent; display: none; width: 100%">
              <td></td>
              <td style="width:20%"></td>
              <td style="width:30%"></td>
              <td style="width:40%"></td>
              <td style="width:10%"></td>
            </thead>
            <tbody id="tableBody" class="repMainTable" style="width:100%; display:block">

            @forelse ($reports as $report)
              <tr style="width:100%; display:block">
                <td class="tdt"><input type="checkbox" class="report-checkbox" name="" value="{{$report->id}}_{{$report->type}}" onclick="selectCheckbox(this)"></td>
                <td style="width:20%" onclick="window.location.href = '/report/view/{{$report->type}}?q={{$report->id}}'">{{ $report->report_title }}
                  @if($report->new_report)
                  <span class="badge badge-pill badge-success" style="margin-left:10px;top:0px;left:0px;padding-right:0.6em;padding-left:0.6em;padding-top:0.25em;padding-bottom:0.4em">
                    New
                  </span>
                  @endif
                </td>
                <td style="width:30%" onclick="window.location.href = '/report/view/{{$report->type}}?q={{$report->id}}'">{{ $report->recipient }}</td>
                <td style="width:40%" onclick="window.location.href = '/report/view/{{$report->type}}?q={{$report->id}}'">{{ $report->message }}</td>
                <td style="width:10%" onclick="window.location.href = '/report/view/{{$report->type}}?q={{$report->id}}'">{{ Carbon::parse($report->time)->diffForHumans() }}</td>
              </tr>
            @empty
            <p class="empty_report">There are no reports</p>
            @endforelse

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
@stop



