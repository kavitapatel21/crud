<html><head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
</head>

<?php
/**
 * Template Name:form
 */
?>

<div style="width:50%;margin-left: 389px;margin-top: 80px">
	<form method="post" action="" id="myform">	 
  <div class="form-group">
      <label for="fullname">Full Name</label>
      <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name">
    </div>
  <div class="form-group">
    <label for="email">E-mail<span>(required)</span></label>
    <input type="email" class="form-control" name="email" id="email" placeholder="E-mail">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
  <div class="success" style="color:green"></div> 
</div>
</html>