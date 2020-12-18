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
          @include('reports.search_field')
          <!-- Mobile view tags -->
          <div class="repMobParent">
            <ul class="navbar-nav repStatus repMobile">
              <li class="nav-item dropdown repMobActive">
                <a id="navbarDropdown" class="nav-link dropdown-toggle repTitle" href="/sent_report" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>SENT
                </a>
                <div class="dropdown-menu repMobDropdown" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item repTitle" href="/reports">ALL</a>
                  <a class="dropdown-item repTitle" href="/received_report">RECEIVED</a>
                  <a class="dropdown-item repTitle" href="/scheduled_report">SCHEDULED</a>
                  <a class="dropdown-item repTitle" href="/draft_report">DRAFT</a>
                </div>
              </li>
            </ul>
            <a href="/new_report" ><img src="{{ asset('css/icons/repMobCreate.png') }}" /></a>
          </div>

          <table id="table_id" class="table table-hover">
            <thead>
              <tr style="background:#E5E5E5">
                <td ><input type="checkbox" name="" value=""></td>
                <td >Sent on</td>
                <td >Name</td>
                <td>To</td>
              </tr>
            </thead>
            <tbody class="repMainTable" id="tableBody" style="width:100vw">

            @forelse ($reports as $report)
              <tr>
                <td><input type="checkbox" name="" value=""></td>
                <td onclick="window.location.href='/report/recipients/{{$report->id}}'">{{ $report->date }}</td>
                <td onclick="window.location.href='/report/recipients/{{$report->id}}'">{{ $report->title }}
                  @if($report->new_report)
                  <span class="badge badge-pill badge-success" style="margin-left:10px;top:0px;left:0px;padding-right:0.6em;padding-left:0.6em;padding-top:0.25em;padding-bottom:0.4em">
                    New
                  </span>
                  @endif
                </td>
                <!-- <td onclick="window.location.href = '/report/view/{{$report->type}}?q={{$report->id}}'">{{ $report->recipients }}</td> -->
                <td onclick="window.location.href='/report/recipients/{{$report->id}}'">{{ $report->message }} </td>
                <td onclick="window.location.href='/report/recipients/{{$report->id}}'"> </td>
                <td onclick="window.location.href='/report/recipients/{{$report->id}}'">{{ $report->message }} </td>
              </tr>
            @empty
            <p class="empty_report">There are no sent reports</p>
            @endforelse

            </tbody>
            <tbody class="repMobTable" style="width:100vw">
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
