@extends('layouts.app')

@section('title')
userAdd
@stop

@section('content')
     


     <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Add User</h2>
        
                  
<br>       </div>       


    {!! Form::open(array('action' => array('UserController@storeUser'), 'class' => 'form-horizontal form-label-left')) !!}
        <br>
        <div class="form-group">
                        
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">First Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="firstname" type="text" id="firstname"  required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastname">Last Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="lastname" type="text" id="lastname"  required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email  
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="username" type="text" id="username" name="username"  required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Role</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         {!! Form::select('level',array( '5' => 'Waiting' , '4' => 'Worker', '3' =>'GA', '2' =>'Admin'),null,array('class' => 'form-control')) !!}

                        </div>
                      </div>
                    


      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <input type="submit" class="btn btn-success" name="save" value="Add User">        
                     <form action="/userList" method="GET">
                            <input type="submit"  class="btn btn-primary"name="cancel" value="Cancel" formnovalidate>
                    </form>
                        </div>
                    </div>
        </div>
        
{!! Form::close() !!} 

</div>
    </div>




























@stop
