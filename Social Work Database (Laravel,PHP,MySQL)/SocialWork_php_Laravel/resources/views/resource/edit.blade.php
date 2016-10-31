@extends('layouts.app')

@section('title')
resourceEdit
@stop

@section('content')
<?php
    $resources = ["Food - Soup Kitchen", "Food - Food Bank", "Shelter - Homeless Shelter"];

    $id = $resourceID;
    $type = "Food";
    $sub_type = "Soup Kitchen";
    $description = $resources[$id];

    echo "Type: <input type='text' name='fname' value='$type'>";
    echo "</br>Sub-Type: <input type='text' name='fname' value='$sub_type'>";
    echo "</br>Description: <input type='text' name='fname' value='$description'>";

    echo "</br><button type=\"button\">Move to Archive</button>";
    echo "<button type=\"button\">Save Changes</button>";
    echo 
        "<form action='/resources'>
            <input type='submit' value='Cancel'>
        </form>";
?>
@stop
