<?php
$ac = "dashboard";
$ibl = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"Invoice")

@section('dashboard-styles')
<link rel="stylesheet" href="css/invoice.css">
@stop

@section('dashboard-content')
<a href="javascript:window.print()" class="print-button">Print Invoice</a> 
<?php
  $a = $schoolApplication['admission'];
  $u = $schoolApplication['user'];
  $sa = $school['address'];
?>
<!-- Invoice -->
<div id="invoice"> 
  <div class="row">
    <div class="col-md-6">
      <div id="logo"><a href="{{url('dashboard')}}"><img src="images/logo.png" alt=""></a></div>
    </div>
    <div class="col-md-6">
      <p id="details"> 
	    <strong>Name:-</strong> {{$u['fname']}} {{$u['lname']}}<br>
		<strong>Email:-</strong> {{$u['email']}}<br>
        <strong>Phone Number:-</strong> {{$u['phone']}}
      </p>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-12">
      <h2 class="invoice_title">Invoice</h2>
    </div>
    <div class="col-md-6">
      <p><strong>Vendor:</strong><br>
        {{$school['name']}}
      </p>
    </div>
    <div class="col-md-6 fl_right"> 
      <p><strong>Product:</strong><br>
      {{$a['session']}}<br>
      {{$sa['school_address']}}, {{$sa['school_state']}}
      </p>
    </div>
	<div class="col-md-6">
      <p><strong>Payment Method:</strong><br>
        Visa ending **** 2222<br>
		support@example.com
      </p>
    </div>
    <div class="col-md-6 fl_right"> 
      <p><strong>Order Date:</strong><br>
      {{$schoolApplication['date']}}
      </p>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-12">
      <table class="margin-top-20">
        <tr>
          <th>Item</th>
          <th>Quantity</th>
          <th>Hour</th>
          <th>Price</th>
        </tr>
        <tr>
          <td>Basic Plan</td>
          <td>1</td>
          <td>5</td>
          <td>$29.00</td>
        </tr>
		<tr>
          <td>Business Plan</td>
          <td>3</td>
          <td>7</td>
          <td>$49.00</td>
        </tr>
		<tr>
          <td>Premium Plan</td>
          <td>6</td>
          <td>12</td>
          <td>$69.00</td>
        </tr>
      </table>
    </div>
    <div class="col-md-12">
      <table id="totals">
		<tr>
          <th>Shipping</th>
          <th><span>$13.00</span></th>
        </tr>
		<tr>
          <th>Total Pay</th>
          <th><span>$160.00</span></th>
        </tr>
      </table>
    </div>
  </div>
</div>      
@stop