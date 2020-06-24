<?php
require_once('vendor/autoload.php');

\Stripe\Stripe::setApikey('sk_test_51Gwc4FHBESvVtDwqvQmXdgGSzzOVtsPeGJP6eHkBhsj19pv6NEiLLr2DDu5N4oHkJGeqowG6itZ7lwFfaAPST4u80036UQqa0B');


//Sanitize POST Array
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

$first_name = $POST['first_name'];
$last_name = $POST['last_name'];
$email = $POST['email'];
$token = $POST['stripeToken'];

//Create Customer In Stripe
$customer = \Stripe\Customer::create(array(
    "email"=>$email,
    "source"=>$token
));

//Charge Customer
$charge = \Stripe\Charge::create(array(
    "amount"=>5000,
    "currency"=>"usd",
    "description"=>"Intro to OOP PHP Course",
    "customer"=>$customer->id
));

//Redirect to success
header('Location:success.php?tid='.$charge->id.'&product='.$charge->description);


?>