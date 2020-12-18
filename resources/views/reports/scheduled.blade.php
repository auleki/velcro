@extends('layouts.reports')
@section('content') 
  <section class="header searchContact">
    <div class="rep">Reports</div>
    <a href="/reports/create" class="btn btn-primary searchContact repTopBtn">New Report</a>
  </section>

  <section class="message">
    @include('reports.search_field   ')
    <!-- Mobile view tags -->
    <div class="repMobParent" style="margin-left:0px">
      <ul class="navbar-nav repStatus repMobile">
        <li class="nav-item dropdown repMobActive">
          <a id="navbarDropdown" class="nav-link dropdown-toggle repTitle" href="/scheduled_report" role="button"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>SCHEDULED
          </a>
          <div class="dropdown-menu repMobDropdown" style="background:#ffffff"  aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item repTitle" href="/reports">ALL</a>
            <a class="dropdown-item repTitle" href="/sent_report">SENT</a>
            <a class="dropdown-item repTitle" href="/received_report">RECEIVED</a>
            <a class="dropdown-item repTitle" href="/draft_report">DRAFT</a>
          </div>
        </li>
      </ul>
      <!-- <a href="/new_report" ><img src="{{ asset('css/icons/repMobCreate.png') }}" /></a> -->
    </div>
    <table id="table_id" class="display table table-hover table-responsive" cellspacing="0">
      <thead class="tdSchHead">
        <td></td>
        <td>To</td>
        <td>Type</td>
        <td>Message</td>
        <td>Next send date</td>
        <td>Actions</td>
      </thead>
      <tbody id="tableBody" class="repMainTable" style="width:100vw">
        @foreach ($reports as $report)
        <tr style="width:100%">
          <td><input type="checkbox" name="" value=""></td>
          <td class="tdDept conEmailPhone">{{$report->recipients}} recipient{{$report->recipients > 1? 's':''}}</td>
          <td class="tdName">{!! $report->type == 'recurring'? '<img src="/css/icons/resend.png" style="height: 15px;width: 15px;"></img>' : ''  !!}{{$report->schedule}}</td>
          <td class="tdName">{{ $report->message }}</td>
          <td class="tdName">{{ $report->date }}</td>
          <td class="tdSettings"><img src="{{ asset('css/icons/action.png') }}" style="height: auto;width: auto;" /></td>
        </tr>
        @endforeach
      </tbody>
      <tbody class="repMobTable tdSchBody" style="width:100vw">
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
      </tbody>
    </table>
  </section>

  @stop
