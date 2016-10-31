@extends('layouts.app')

@section('title')
userEdit
@stop

@section('content')

           
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Edit User</h2>
        
                  
<br>       </div>       


    {!! Form::open(array('action' => array('UserController@updateUser',$user->id), 'class' => 'form-horizontal form-label-left')) !!}
        <br>
        <div class="form-group">
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ID
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="id" value = "{{$user->id}}" required="required" class="form-control col-md-7 col-xs-12" readonly>
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Level  
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" value = "{{$user->role}}" required="required" class="form-control col-md-7 col-xs-12" readonly>
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" value = "{{$user->name}}" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email  
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="email" name="email" value = "{{ $user->email}}" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                    


      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <input type="submit" class="btn btn-success" name="save" value="Save Changes">
        
                            <input type="submit" class="btn btn-danger" name="delete" value="Delete Account">
        
        
                            <input type="submit"  class="btn btn-primary"name="cancel" value="Cancel">
                        </div>
                    </div>
        </div>
        
{!! Form::close() !!} 

</div>
    </div>




<?php

/*

    echo "ID: {$user->id}";
    echo "</br>Level: {$user->role}";
    echo "</br>Name: <input type='text' name='name' value='{$user->name}'>";
    echo "</br>Email: <input type='text' name='email' value='{$user->email}'>";

    echo "</br></br><button type=\"button\">Delete</button>";
    echo "<button type=\"button\">Save Changes</button>";
    echo 
        "<form action='/users'>
            <input type='submit' value='Cancel'>
        </form>";*/
?>
@stop
