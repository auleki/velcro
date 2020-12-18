<?php
use Carbon\Carbon;

?>

<style>
    table.dataTable thead .sorting_asc:after, .sorting:after{
         content: "" !important;  
    }
    table.dataTable thead .sorting_asc,  {
        background-image: none !important;
    }

    tr{
        margin-bottom: 5rem;
    }
</style>
@extends('layouts.reports')
@section('styles')

@stop
@section('content')
        <section class="header searchContact">
          <div class="rep">Reports</div>
          <a href="/reports/create" class="btn btn-primary searchContact repTopBtn">New Report</a>
        </section>

        <section class="message">
          @include('reports.search_field   ')
          <!-- Mobile view tags -->
          <div class="repMobParent" style="margin-left:0px
          ">
            <ul class="navbar-nav repStatus repMobile">
              <li class="nav-item dropdown repMobActive">
                <a id="navbarDropdown" class="nav-link dropdown-toggle repTitle" href="/sent_report" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>SENT
                </a>
                <div class="dropdown-menu repMobDropdown" style="background:#ffffff" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item repTitle" href="/reports">ALL</a>
                  <a class="dropdown-item repTitle" href="/received_report">RECEIVED</a>
                  <a class="dropdown-item repTitle" href="/scheduled_report">SCHEDULED</a>
                  <a class="dropdown-item repTitle" href="/draft_report">DRAFT</a>
                </div>
              </li>
            </ul>
            <!-- <a href="/new_report" ><img src="{{ asset('css/icons/repMobCreate.png') }}" /></a> -->
          </div>

          <table id="table_id" class="table table-hover table-responsive">
            <thead style="background: #f8f8f8">
                <tr>
                    <th class="tdt" scope="col"><input type="checkbox" name="" value=""></th>
                    <th scope="col">Sent on</th>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                    <th scope="col"> To</th>
                </tr>
            </thead>
            <tbody  >

                @foreach ($reports as $report)
                <tr class="">
                    <td class="tdt"><input type="checkbox" name="" value=""></th>
                    <td onclick="window.location.href='/report/recipients/{{$report->id}}'" style="">{{ $report->date }} </td>
                    <td onclick="window.location.href='/report/recipients/{{$report->id}}'">{{ $report->title }}</td>
                    <td>{!! $report->new_report ? '<span class="badge badge-danger rounded-pill">New</span>':'' !!}</td>
                    <td onclick="window.location.href='/report/recipients/{{$report->id}}'"> {{ $report->recipients }} </td>
                </tr>
                @endforeach

            </tbody>
          </table>

        </section>

      @stop
