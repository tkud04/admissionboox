<?php
$ac = "dashboard";
$ibl = true;
?>


<?php $__env->startSection('dashboard-title',"Invoice"); ?>

<?php $__env->startSection('dashboard-styles'); ?>
<link rel="stylesheet" href="css/invoice.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-content'); ?>
<a href="javascript:window.print()" class="print-button">Print Invoice</a> 
<!-- Invoice -->
<div id="invoice"> 
  <div class="row">
    <div class="col-md-6">
      <div id="logo"><a href="index_1.html"><img src="images/logo.png" alt=""></a></div>
    </div>
    <div class="col-md-6">
      <p id="details"> 
	    <strong>Order Number:-</strong> 0043128641<br>
		<strong>Email:-</strong> support@example.com<br>
        <strong>Phone Number:-</strong> +1 (0123) 456 7890
      </p>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-12">
      <h2 class="invoice_title">U-Listing Invoice</h2>
    </div>
    <div class="col-md-6">
      <p><strong>Billed To:</strong><br>
        1789 Williamson Plaza, Maggieberg,<br> MT 878, United States
      </p>
    </div>
    <div class="col-md-6 fl_right"> 
      <p><strong>Shipped To:</strong><br>
        267 Suzanne Throughway, Breannabury,<br> OR 45801, United States
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
        22 January 2022
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/application-invoice.blade.php ENDPATH**/ ?>