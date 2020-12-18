<?php
use Carbon\Carbon;
use App\Services\Color;

?>
@extends('layouts.reports ')
@section('styles')

@stop
@section('content')

<style>
  /* .sidebar a {
    color: #ffffff; 
  } */

  .view_report {
    background: linear-gradient(359.72deg, #F5F6F9 10.29%, #FFFFFF 99.27%);

    /* secondary button border */
    border: 1px solid #D5DCE6;
    box-sizing: border-box;
    border-radius: 4px;
    font-size: 14px;
    line-height: 18px;
    text-align: center;
    letter-spacing: 0.05em;

    color: #333333;
  }

  .view_report {
    color: #333333;
    padding: 4px;
    margin-left: 1rem
  }

  .view_report:hover {
    color: #333333;
    text-decoration: none !important
  }

  body {
    background: #ffffff !important;
  }

  thead {
    background: #ffffff !important;
    border-bottom: 0.75px solid #CCCCCC;
  }

  a:hover {
    text-decoration: underline
  }

  .spacer {
    height: .25rem
  }
</style>
  <section style="margin-left:1rem; margin-top:1rem">
    <div>
      <img src="/css/icons/stroke.png" alt="">
      <a href="/sent_report" style="color:#1B63DC;margin-left:.25rem">Reports</a>
    </div>

    <div class="ml-4 mt-5">
      <div class="ml-4 mt-5">
        <div style="margin-right:2rem"><span style="font-size:38px">{{$report->report_title}}</span> <a href="/report/view/sent?q={{$report->id}}" class="view_report">View report</a></div>
      </div>
    </div>

    <div class="ml-4 mt-5">
      <p class="ml-4 mt-5" style="color:#333333;margin-bottom:0px;font-size:20px">Recipients</p>
      <table class="table table-borderless table-responsive">
        <thead>
          <tr>
            <td></td>
            <td  style="width:40%"></td>
            <td style="text-align:center">Delivered</td>
            <td style="text-align:center">Opened</td>
            <td >Response</td>
          </tr>
        </thead>
        <tbody>
          @foreach($recipients as $recipient)
          <?php
          $fname = $recipient->contact()->first()->fname;
          $lname = $recipient->contact()->first()->lname;
          $delivered = $recipient->delivered ? 'delivered':'dot';
          $opened = $recipient->opened ? 'delivered':'dot';
          $received = $recipient->received_report()->first();
          $contact_id = $recipient->contact()->first()->id;
          ?>
          <tr class="spacer"></tr>
          <tr>
            <td style="height:10px;width:10px;border-radius:50%;background:{{Color::random_color()}};color:#ffffff;">{{$fname[0]}}{{$lname[0]}}</td>
            <td>{{$fname}} {{$lname}}
              @if($received && $received->status == 'new')
              <span class="badge badge-pill badge-success" style="margin-left:10px;top:0px;left:0px;padding-right:0.6em;padding-left:0.6em;padding-top:0.25em;padding-bottom:0.4em;float:right">
                New
              </span>
              @endif
            </td>
            <td style="text-align:center"><img src="/css/icons/{{$delivered}}.png" alt="" style="{{$recipient->delivered?'width:16px;height:14px':'width:5px;height:2px'}}"></td>
            <td style="text-align:center"><img src="/css/icons/{{$opened}}.png" alt="" style="{{$recipient->opened?'width:16px;height:14px':'width:5px;height:2px'}}"></td>
            <td>
              @if($received)
              <a href="/received_report/{{$recipient->received_report()->first()->id}}?from_name=Recipients" style="color:#1B63DC">View</a>
              @else
              <span style="color:#B8B8B8">None</span> 
              @endif
              <a href="/report/resend/{{$recipient->id}}?contact={{$contact_id}}&report={{$report->id}}" style="color:#1B63DC;margin-left:.25rem">Resend</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
@stop
