@extends('layouts.app')

@section('title')
Add New Resource
@stop

@section('content')
<?php
/*
   <h3> Add Resource </h3>
    <hr>


    {!! Form::open(['action' => 'ResourceController@storeResource']) !!}

        {!! Form::label('type','Type: ') !!}
        {!! Form::text('type') !!}
        <br>
        {!! Form::label('subtype','Sub-Type: ') !!}
        {!! Form::text('subtype') !!}
        <br>
        {!! Form::label('description','Description: ') !!}
        {!! Form::text('description') !!}
        <br>

        {!!  Form::submit('Add Resource',['name' => 'add']) !!}
      
    {!! Form::close() !!} 
   <form action="/resources" method="GET">
            <button type="submit" name="cancel">Cancel</button>
        </form> 
*/        
?>

<div class="row">
              <div class="col-md-6 col-md-offset-2 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add New Resource</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form action="/resources/add" method="post" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="type" id="type" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subtype">Sub-Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="subtype" name="subtype" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="description" class="form-control col-md-7 col-xs-12" type="text" name="description">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
                          <form action="/resources/add" method="get">
                                <button type="submit" class="btn btn-danger" name="cancel">Cancel</button>
                            </form>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
@stop