@extends('layouts.app')

@section('title')
userEdit
@stop

@section('content')
 Name: {{$user->name}}

{!! Form::open(['action' => 'ProfileController@updateProfile']) !!}
 
         {!! Form::label('email','Email: ') !!}
         {!! Form::text('email', $user->email) !!}
         
       <br>
         {!!  Form::submit('Save') !!}
     {!! Form::close() !!} 
    <form action="/profile" method="GET">
             <button type="submit" name="cancel">Cancel</button>
         </form>


@stop
