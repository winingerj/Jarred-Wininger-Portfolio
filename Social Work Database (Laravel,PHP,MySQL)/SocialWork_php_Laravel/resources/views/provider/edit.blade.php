@extends('layouts.app')

@section('title')
<?php
    $providers = ["St. Mary's", "Unicef", "Tots without Yachts"];
    $provider = $providers[$providerID];
    echo $provider
?>
@stop

@section('content')
<?php
    $providers = ["St. Mary's", "Unicef", "Tots without Yachts"];
    $provider = $providers[$providerID];

    $id = $providerID;
    $name = $provider;
    $street = "23 North Roan St";
    $city = "Johnson City";
    $county = "Washington";
    $zip = "75601";
    $state = "TN";
    $phone = "4237375555";
    $email = "help@weHelp.com";
    $web = "http://weHelp.com";
    $contact_f_name = "Bob";
    $contact_l_name = "Jenkins";
    $location_constraint = "Washington County";
    $population_constraint = "Unwed teenage mothers with 3 or 5 children, widows with 2 or 6 childrem ages 4-12";
    $office_hours = "2 days a month, generally witin a fortnight of the full moon";
    $resource_type = "FOOD";
    $resource_subtype = "Soup Kitchen";
    $resource_description = "Soup and sandwiches";
    $flag = false;
    $flag_comment = true;
    $description = "Very helpful";
    $language = "ENGLISH";
    $language_description = "Spanish speaker available Mondays.";

    echo "Name: <input type='text' name='fname' value='$name'>";
    echo "</br>street: <input type='text' name='fname' value='$street'>";
    echo "</br>city: <input type='text' name='fname' value='$city'>";
    echo "</br>state: <input type='text' name='fname' value='$state'>";
    echo "</br>zip: <input type='text' name='fname' value='$zip'>";
    echo "</br>county: <input type='text' name='fname' value='$county'>";
    echo "</br>Phone number: <input type='text' name='fname' value='$phone'>";
    echo "</br>Email: <input type='text' name='fname' value='$email'>";
    echo "</br>Web Address: <input type='text' name='fname' value='$web'>";
    echo "</br>Contact: <input type='text' name='fname' value='$contact_f_name $contact_l_name'>";
    echo "</br>Location constraint: <input type='text' name='fname' value='$location_constraint'>";
    echo "</br>Populaion constraint: <input type='text' name='fname' value='$population_constraint'>";
    echo "</br>Hours: <input type='text' name='fname' value='$office_hours'>";
    echo "</br>Resounce type: <input type='text' name='fname' value='$resource_type'>";
    echo "</br>Resourse subtype: <input type='text' name='fname' value='$resource_subtype'>";
    echo "</br>Resource description: <input type='text' name='fname' value='$resource_description'>";
    echo "</br>Flag: <input type='text' name='fname' value='$flag'>";
    echo "</br>Flag Comment: <input type='text' name='fname' value='$flag_comment'>";
    echo "</br>Description: <input type='text' name='fname' value='$description'>";
    echo "</br>Language: <input type='text' name='fname' value='$language'>";
    echo "</br>Language details: <input type='text' name='fname' value='$language_description'>";
    echo "</br><button type=\"button\">Move to Archive</button>";
    echo "<button type=\"button\">Save Changes</button>";
    echo 
        "<form action='/providers/$id'>
            <input type='submit' value='Cancel'>
        </form>";
?>
@stop
