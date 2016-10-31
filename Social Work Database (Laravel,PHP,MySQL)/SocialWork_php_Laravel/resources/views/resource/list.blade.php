@extends('layouts.app')

@section('title')
resourceList
@stop

@section('content')


 <!-- page content -->
        <!-- <h3><a href="/resources/add"><i class="fa fa-files-o"></i>Add New Resource</a></h3> -->
          <div class="">
          <div class="clearfix"></div>
             <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                <div class="x_title">
                    <h2>Resources</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                              <th style="width: 1%">#</th>
                              <th style="width: 20%">Type</th>
                              <th>Sub-type</th>
                              <th>Description</th>
                              <th>Settings</th>
                            </tr>
                          </thead>
                         <tbody> 
                            <!-- Query the RESOURCE database table -->
                             <?php 
                                function printResource($resource)
                                {
                                    echo "<td> #</td>";
                                    echo "<td> $resource->type </td>";
                                    echo "<td> $resource->subtype </td>";
                                    echo "<td> $resource->description </td>";
                                    //echo "<td><input type=\"checkbox\" name=\"Needs Attention\"></td>";
                                    //todo: remove first <a> tag below 
                                    echo
                                      "<td>
                                        <a href=\"#\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-folder\"></i> View </a>
                                        <a href=\"#\" class=\"btn btn-info btn-xs\"><i class=\"fa fa-pencil\"></i> Edit </a>
                                        <a href=\"#\" class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash-o\"></i> Delete </a>
                                      </td>";
                                }
                            ?>
                              <!-- Loop through the db -->
                              @foreach ($resources as $r)
                                <tr>
                                    <?php printResource($r); ?>
                                </tr>
                              @endforeach
                           </tbody>
                          </table>
                         </div>
                        </div>
                      </div>
                     </div>
                    </div>
                  
        <!-- /page content -->
    <!-- TODO: this next section needs to be in a resource.blade.php file 
         under the layouts folder instead of the following hard coded -->

@stop