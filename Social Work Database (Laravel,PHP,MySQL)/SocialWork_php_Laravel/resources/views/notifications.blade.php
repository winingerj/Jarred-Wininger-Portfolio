@extends('layouts.app')

@section('title')
Providers List
@stop

@section('head')
<!-- PNotify -->
    <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
@stop

@section('content')
<?php
    function printProvider($provider)
    {
       
        if($provider->flag_out_of_date)
            {echo "<td> Yes </td>";}
        else
            {echo "<td> No </td>";}
        echo "<td> $provider->name </td>";
        echo "<td> $provider->phone </td>";
        echo "<td> $provider->description </td>";
            //Note: By coincidence, all the descriptions are short right now,
            //but there will probably be long in the future
        echo "<td> ";
            foreach($provider->resources as $resource)
            {
                echo $resource->type;
                echo " - ";
                echo $resource->subtype;
                echo "</br>";
            }
        echo " </td>";
        echo "<td> $provider->county </td>";
        echo "<td> <a href='/providers/$provider->id' class=\"btn btn-primary btn-xs\"><i class=\"fa fa-folder\"></i> View </a>";
        echo " <a href='/providers/$provider->id' class=\"btn btn-warning btn-xs\"><i class=\"fa fa-folder\"></i> Edit </a>";
        echo " <a href='/providers/$provider->id' class=\"btn btn-danger btn-xs\"><i class=\"fa fa-folder\"></i> Delete </a> </td>";
        echo "<td><button type=\"button\" class=\"btn btn-round btn-info\"><i class=\"fa fa-plus\"></i></button></td>";
    }
?>

@if (Auth::user()->hasRole('GA'))
  <a href="/providers/add">Add New Provider</a>
@endif
<br>
<br>
  <div class="">
  <div class="clearfix"></div>
     <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
        <div class="x_title">
            <h2>Providers</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
          <table id="datatable" class="table table-striped nowrap">
            <thead>
                <tr>
                  <th>Flagged</th>
                  <th>Name</th>
                  <th>Phone number</th>
                  <th>Description</th>
                  <th>Resources</th>
                  <th>County</th>
                  <th>Settings</th>
                  <th>Add to Cart</th>
                </tr>
              </thead>
             <tbody>
             @foreach ($providers as $provider)
                 <tr>
                     <?php printProvider($provider); ?>
                 </tr>
             @endforeach
       </tbody>
      </table>
     </div>
    </div>
  </div>
 </div>
</div>
@stop

@section('scripts')
<!-- Datatables -->
    <script src="/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="/vendors/jszip/dist/jszip.min.js"></script>
    <script src="/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="/vendors/pdfmake/build/vfs_fonts.js"></script>
<!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>
    <!-- /PNotify -->
@stop
