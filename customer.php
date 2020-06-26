<?php
require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('models/customer.php');

//Instantiate Customer
$customer = new Customer();

//Get Customer
$customers = $customer->getCustomers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>View Customers</title>
</head>
<body>
    <div class="container mt-4">
       <h2>Customers</h2>
       <table class="table table-striped">
           <thead>
            <th>Customer ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date</th>

          </thead>
          <tbody>
          
          <?php foreach($customers as $c): ?>
            <tr>
             <td> <?php  echo $c->id;  ?> </td>
             <td> <?php  echo $c->first_name;  ?> <?php  echo $c->last_name;  ?></td>
             <td> <?php  echo $c->email  ?> </td>
             <td> <?php  echo $c->created_at  ?> </td>

          </tr>

          <?php endforeach; ?>
         </tbody>
       </table>
       <br>
       <p> <a href="index.php"> Pay Page</a> </p>
    </div>
</body>
</html>