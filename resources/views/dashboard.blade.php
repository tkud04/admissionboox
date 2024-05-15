<?php
$ac = "dashboard";
?>
@extends('dashboard_layout')

@section('dashboard-title',"Dashboard")

@section('dashboard-content')
  @if(count($notifications) > 0)
  <div class="row">
        <div class="col-md-12">
         @foreach($notifications as $n)
          @include('components.dashboard-notification',[
            'type' => $n['type'],
            'content' => isset($n['content']) ? $n['content'] : "",
            'xf' => $n['id']
            ])
         @endforeach
        </div>
  </div>
  @endif

  <div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="utf_dashboard_list_box with-icons margin-top-20">
            <h4>Recent Activities</h4>
            <ul>
                <li>
                    <i class="utf_list_box_icon sl sl-icon-layers"></i> Peter Parker Left A Review 5.0 On <strong><a
                            href="#"> Restaurant</a></strong> <a href="#" class="close-list-item"><i
                            class="fa fa-close"></i></a>
                </li>
                <li>
                    <i class="utf_list_box_icon sl sl-icon-star"></i> Your Listing <strong><a href="#">Local
                            Service</a></strong> Has Been Approved<a href="#" class="close-list-item"><i
                            class="fa fa-close"></i></a>
                </li>
                <li>
                    <i class="utf_list_box_icon sl sl-icon-heart"></i> Someone Bookmarked Your <strong><a
                            href="#">Listing</a></strong> Restaurant <a href="#" class="close-list-item"><i
                            class="fa fa-close"></i></a>
                </li>
                <li>
                    <i class="utf_list_box_icon sl sl-icon-star"></i> Your Listing <strong><a href="#">Local
                            Service</a></strong> Has Been Approved<a href="#" class="close-list-item"><i
                            class="fa fa-close"></i></a>
                </li>
                <li>
                    <i class="utf_list_box_icon sl sl-icon-heart"></i> Someone Bookmarked Your <strong><a
                            href="#">Listing</a></strong> Restaurant <a href="#" class="close-list-item"><i
                            class="fa fa-close"></i></a>
                </li>
                <li>
                    <i class="utf_list_box_icon sl sl-icon-layers"></i> Peter Parker Left A Review 5.0 On <strong><a
                            href="#"> Restaurant</a></strong> <a href="#" class="close-list-item"><i
                            class="fa fa-close"></i></a>
                </li>
            </ul>
        </div>
       
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="utf_dashboard_list_box invoices with-icons margin-top-20">
            <h4>All Order Invoices</h4>
            <ul>
                <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong>Premium Plan <span
                            class="paid">Paid</span></strong>
                    <ul>
                        <li><span>Order Number:-</span> 004128641</li>
                        <li><span>Date:-</span> 12 Jan 2022</li>
                    </ul>
                    <div class="buttons-to-right"> <a href="dashboard_invoice.html" class="button gray"><i
                                class="sl sl-icon-printer"></i> Invoice</a> </div>
                </li>
                <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong>Platinum Plan <span
                            class="paid">Paid</span></strong>
                    <ul>
                        <li><span>Order Number:-</span> 004312641</li>
                        <li><span>Date:-</span> 12 Jan 2022</li>
                    </ul>
                    <div class="buttons-to-right"> <a href="dashboard_invoice.html" class="button gray"><i
                                class="sl sl-icon-printer"></i> Invoice</a> </div>
                </li>
                <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong>Platinum Plan <span
                            class="paid">Paid</span></strong>
                    <ul>
                        <li><span>Order Number:-</span> 004312641</li>
                        <li><span>Date:-</span> 12 Jan 2022</li>
                    </ul>
                    <div class="buttons-to-right"> <a href="dashboard_invoice.html" class="button gray"><i
                                class="sl sl-icon-printer"></i> Invoice</a> </div>
                </li>
                <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong>Basic Plan <span
                            class="unpaid">Unpaid</span></strong>
                    <ul>
                        <li><span>Order Number:-</span> 004031281</li>
                        <li><span>Date:-</span> 12 Jan 2022</li>
                    </ul>
                    <div class="buttons-to-right"> <a href="dashboard_invoice.html" class="button gray"><i
                                class="sl sl-icon-printer"></i> Invoice</a> </div>
                </li>
                <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong>Basic Plan <span
                            class="unpaid">Unpaid</span></strong>
                    <ul>
                        <li><span>Order Number:-</span> 004031281</li>
                        <li><span>Date:-</span> 12 Jan 2022</li>
                    </ul>
                    <div class="buttons-to-right"> <a href="dashboard_invoice.html" class="button gray"><i
                                class="sl sl-icon-printer"></i> Invoice</a> </div>
                </li>
                <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong>Basic Plan <span
                            class="unpaid">Unpaid</span></strong>
                    <ul>
                        <li><span>Order Number:-</span> 004031281</li>
                        <li><span>Date:-</span> 12 Jan 2022</li>
                    </ul>
                    <div class="buttons-to-right"> <a href="dashboard_invoice.html" class="button gray"><i
                                class="sl sl-icon-printer"></i> Invoice</a> </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@stop