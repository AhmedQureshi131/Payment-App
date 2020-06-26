<?php
require_once('vendor/autoload.php');
require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('models/customer.php');
require_once('models/transaction.php');


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

// Instantiate Customer
$customer = new Customer();

//Customer Data
$customerData = [
  'id' => $charge->customer,
  'first_name' => $first_name,
  'last_name' => $last_name,
  'email' => $email
];
//Add Customer To DB
$customer->addCustomer($customerData);

// Instantiate Customer
$transaction = new Transaction();

//Customer Data
$transactionData = [
  'id' => $charge->id,
  'customer_id' => $charge->customer,
  'product' => $charge->description,
  'amount' => $charge->amount,
  'currency' => $charge->currency,
  'status' => $charge->status,

];
//Add Customer To DB
$transaction->addTransaction($transactionData);
//Redirect to success
header('Location:success.php?tid='.$charge->id.'&product='.$charge->description);


?>