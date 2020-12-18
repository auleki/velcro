<div class="report-tool-box">
  <!-- <div class="inputSearch" style="top:0rem;width:100%;margin-top:-4rem">
    <input type="search" placeholder="Search reports" id="inputSearch">
    <img src="{{ asset('css/icons/grsearch.svg') }}" >
  </div> -->

  <div class="report-icons-container" style="width:100%;height:1rem">
    <div style="margin-left:1rem;width:3rem;float:left">
      <input type="checkbox" id="reportChecked" onclick="allReport(this)">
    </div>
    <div style="margin-left:1rem;width:3rem;float:left">
      <img src="/css/icons/repDown.png" alt="" title="Archive selected report" onclick="archiveReport()">
    </div>
    <div style="margin-left:1rem;width:3rem;float:left" title="Upload selected report" onclick="uploadReportToCloud()">
      <img src="/css/icons/repUp.png" alt="">
    </div>
    <div style="margin-left:1rem;width:1rem;float:left">
      <img src="/css/icons/line.png" alt="">
    </div>
    <div style="float:left" id="selectedReport">

    </div>
  </div>

  <!-- Main screen tags -->
  <div class="report-icons-container" style="width:100%">
    <ul class="nav nav-tabs nav-lg repStatus repMain" role="tablist" style="margin-top:1rem">
      <li class="{{$active == 'all' ? 'active' : ''}}" role="presentation">
        <a class="repTitle"  href="/reports">
          <img src="{{ asset('css/icons/repAll1.svg') }}">ALL</a>
      </li>
      <li class="{{$active == 'sent' ? 'active' : ''}}" role="presentation">
        <a class="repTitle"  href="/sent_report">
          <img src="{{ asset('css/icons/repSent.svg') }}">SENT</a>
      </li>
      <li class="{{$active == 'received' ? 'active' : ''}}" role="presentation">
        <a class="repTitle" href="/received_report">
          <img src="{{ asset('css/icons/repRec.svg') }}">RECEIVED</a>
      </li>
      <li class="{{$active == 'scheduled' ? 'active' : ''}}" role="presentation">
        <a class="repTitle" href="/scheduled_report">
          <img src="{{ asset('css/icons/repSch.svg') }}">SCHEDULED</a>
      </li>
      <li class="{{$active == 'draft' ? 'active' : ''}}" role="presentation">
        <a class="repTitle" href="/draft_report">
          <img src="{{ asset('css/icons/repDra.svg') }}">DRAFT</a>
      </li>
    </ul>
  </div>
</div>

<!-- <script>
$(document).ready(function(){
  $("#inputSearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tableBody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script> -->
