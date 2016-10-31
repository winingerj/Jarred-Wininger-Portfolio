@extends('layouts.app')

@section('title')
<?php
    echo $user->name;
?>
@stop

@section('content')
<h2> User Details</h2>
<hr>

    ID: {{$user->id}}</br>
    Name: {{$user->name}}</br>
    Email: {{$user->email}}</br>
    Permissions Level: {{$user->getRoleFormatted()}}</br>
    <form action='/users/{{$user->id}}/edit'>
            <input type='submit' value='Edit' class = "tn btn-success">
    </form>
@stop
