@extends('layouts.app')

@section('title')
<?php
    echo $provider->name;
?>
@stop

@section('content')
<hr>
    Name: {{$provider->name}}</br>
    Address: <div>{{$provider->street}}</br>
    {{$provider->city}}, {{$provider->state}} {{$provider->zip}}</br>
    {{$provider->county}}</div>
    Phone number: {{$provider->phone}}</br>
    Email: {{$provider->email}}</br>
    <?php
        if($provider->web!="")
            echo "<a href=\"$provider->web\">Web address</a></br>";
    ?>
    Contact: {{$provider->contact_f_name}} {{$provider->contact_l_name}}</br>
    Location constraint: {{$provider->location}}</br>
    Populaion constraint: {{$provider->population}}</br>
    Hours: {{$provider->office_hours}}</br>
    Archived?: {{$provider->flag_archived}}</br>
    Outdated?: {{$provider->flag_out_of_date}}</br>
    {{$provider->flag_comment}}</br>
    Description: {{$provider->description}}</br>
    <form action='/providers/{{$provider->id}}/edit'>
            <input type='submit' value='Edit'>
    </form>
@stop
