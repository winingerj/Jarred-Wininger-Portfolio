@extends('layouts.app')

@section('title')
userList
@stop

@section('content')
<a href="/users/add">Add New User</a>
<?php
   /* function printUser($user)
    {
        echo "Name: $user->name";
        echo "</br>Email: $user->email";
        echo "</br>Permissions Level: ";
        echo $user->getRoleFormatted();
        echo "</br><a href='/users/$user->id'>Details</a>";        
    }
    */
?>

    

    <!-- page content -->
          <div class="">
          <div class="clearfix"></div>
             <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                <div class="x_title">
                    <h2>User List</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                              <th style="width: 1%">#</th>
                              <th style="width: 20%">Role</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Settings</th>
                            </tr>
                          </thead>
                         <tbody> 
                            <!-- Query the User database table -->
                             <?php 
                                function printUser($user)
                                {
                                    echo "<td> #</td>";
                                    echo "<td> $user->role </td>";
                                    echo "<td> $user->name </td>";
                                    echo "<td> $user->email </td>";
                                   
                                    echo
                                      "<td>
                                        <a href='/users/$user->id' class=\"btn btn-primary btn-xs\"><i class=\"fa fa-folder\"></i> View </a>
                                        <a href='/users/$user->id/edit' class=\"btn btn-info btn-xs\"><i class=\"fa fa-pencil\"></i> Edit </a>
                                      </td>";
                                }
                            ?>
                              <!-- Loop through the db -->
                              @foreach ($users as $userToShow)
                                @if ( Auth::user()->hasRole($userToShow->getRole()) && Auth::user()->getRole() != $userToShow->getRole()) 
                                 <tr>
                                
                                    <?php printUser($userToShow); ?>
                                 
                                    
                                </tr>
                                
                                @endif
                              @endforeach
                              
                           </tbody>
                          </table>
                         </div>
                        </div>
                      </div>
                     </div>
                    </div>
@stop
