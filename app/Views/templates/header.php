<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<title></title>
</head>
<body>
  <?php
      $uri = service('uri');
  ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container">
  <a class="navbar-brand" href="/dashboard">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <?php if (session()->get('isLoggedIn')): ?>
   <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link"  href="/income">Income</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/expenses">Expenses</a>
      </li>

    </ul>
    <form class="nav-item ">
      <a class="nav-link" href="/logout">Logout</a>
    </form>
    </div>
  <?php else: ?>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?= ($uri->getSegment(1) == '' ? 'active' : null) ?>">
        <a class="nav-link" href="/login">login</a>
      </li>
      <li class="nav-item <?= ($uri->getSegment(1) == 'register' ? 'active' : null) ?>">
        <a class="nav-link" href="/register">Register</a>
      </li>

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <button class=" my-2 my-sm-0" type="text"><h5> <?= session()->get('firstname') ?></h5></button>
    </form>
    </div>

  
   
  <?php endif ?>
  </div>
</nav>