@extends('layouts.app')

@section('title')
<?php
    echo $user->name;
?>
@stop

@section('content')
<h3>My Profile</h3>
<hr>
    
    Name: {{$user->name}}</br>
    Email: {{$user->email}}</br>
    </br>
    <form action='/profile/edit'>
            <input type='submit' value='Edit'>
    </form>
@stop
