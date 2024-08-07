<?php
$ac = "dashboard";
$useAdminSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"Admin Dashboard")

@section('dashboard-styles')
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop

@section('dashboard-scripts')
  <script src="lib/datatables/datatables.min.js"></script>

  <script>
	
	 const confirmDeletePlugin = (pid) => {
            confirmAction(pid, 
			    (xf) => {
					removePlugin(xf,
				      () => {
					    alert('Plugin removed')
					    window.location = 'dashboard'
				       },
				      (err) => {
					    alert('Failed to remove plugin: ',err)
				      }
			        )
				})
        
        }

		const confirmDeleteSender = (sid) => {
			confirmAction(sid, 
			    (xf) => {
					removeSender(xf,
				      () => {
					    alert('Sender removed')
					    window.location = 'dashboard'
				       },
				      (err) => {
					    alert('Failed to remove sender: ',err)
				      }
			        )
				})
        }

		const confirmDeleteFacility = (sid) => {
			confirmAction(sid, 
			    (xf) => {
					removeFacility(xf,
				      () => {
					    alert('Facility removed')
					    window.location = 'dashboard'
				       },
				      (err) => {
					    alert('Failed to remove facility: ',err)
				      }
			        )
				})
        
        }
		
		const confirmDeleteClub = (sid) => {
			confirmAction(sid, 
			    (xf) => {
					removeCLub(xf,
				      () => {
					    alert('Club removed')
					    window.location = 'dashboard'
				       },
				      (err) => {
					    alert('Failed to remove club: ',err)
				      }
			        )
				})
        }

	$(() => {
		$('.admissionboox-table').dataTable()
	})
  </script>
@stop

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

  @if(isset($dashboardStats))
    @include('components.admin-dashboard-stats',['dashboardStats' => $dashboardStats])
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
            <h4>Subscriptions</h4>
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
    <div class="col-lg-12 col-md-12 mb-4">
		  <div class="utf_dashboard_list_box table-responsive recent_booking">
			<h4>Schools</h4>
			<div class="dashboard-list-box table-responsive invoices with-icons">
			  <table class="table table-hover admissionboox-table">
				<thead>
				  <tr>
					<th>Image</th>
					<th>Name</th>
					<th>Booking Date</th>
					<th>Payment Type</th>
					<th>Status</th>
					<th>More</th>
				  </tr>
				</thead>
				<tbody>
                 <?php
                  if(isset($schools))
                  {
                    foreach($schools as $school)
                    {
                        $info = $school['info'];
                        $resources = $school['resources'];
                        $facilities = $school['facilities'];
                        $clubs = $school['clubs'];
                        $owner = $school['owner'];
                 ?>
				  <tr>
					<td><img alt="{{$school['name']}}" class="img-fluid rounded-circle shadow-lg" src="{{$school['logo']}}" width="50" height="50"></td>
					<td>{{$school['name']}}</td>
					<td>12 Jan 2022</td>
					<td>Paypal</td>
					<td><span class="badge badge-pill badge-primary text-uppercase">Booked</span></td>
					<td><a href="dashboard_bookings.html" class="button gray"><i class="fa fa-eye"></i> View</a></td>
				  </tr>
				 <?php
                    }
                  }
                 ?>
				</tbody>
			  </table>
			</div>
		  </div>
		</div>
        <div class="col-lg-6 col-md-6 mb-4">
		  <div class="utf_dashboard_list_box table-responsive recent_booking">
			<h4>Plugins</h4>
			<div class="dashboard-list-box table-responsive invoices with-icons">
			  <table class="table table-hover admissionboox-table">
				<thead>
				  <tr>
					<th>Name</th>
					<th>Content</th>
					<th>Date Added</th>
					<th>Status</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody>
				<?php
                  if(isset($plugins) && count($plugins) > 0)
                  {
                    foreach($plugins as $p)
                    {
                       $pid = $p['id'];
						$ru = url('remove-plugin')."?xf={$p['id']}";
                 ?>
				  <tr>
					<td>{{$p['name']}}</td>
					<td>
						<div style="background: #efefef; border-radius: 2px;">{{$p['value']}}</div>
					</td>
					<td>{{$p['date']}}</td>
					<td>{{$p['status']}}</td>
					<td><a href="#" onclick="confirmDeletePlugin('{{$pid}}'); return false;" class="button gray"><i class="fa fa-trash"></i> </a></td>
				  </tr>
				<?php
					}
				}
				
				?>
				</tbody>
			  </table>
			</div>
		  </div>
		</div>
        <div class="col-lg-6 col-md-6 mb-4">
		  <div class="utf_dashboard_list_box table-responsive recent_booking">
			<h4>STMP</h4>
			<div class="dashboard-list-box table-responsive invoices with-icons">
			  <table class="table table-hover admissionboox-table">
				<thead>
				  <tr>
					<th>Sender Name</th>
					<th>Server</th>
					<th>Current?</th>
					<th>Date Added</th>
					<th>Status</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody>
				<?php
                  if(isset($senders) && count($senders) > 0)
                  {
                    foreach($senders as $s)
                    {
                       $sid =  $s['id'];
						$ru = url('remove-sender')."?xf={$s['id']}";
                 ?>
				  <tr>
					<td>{{$s['sn']}}</td>
					<td>{{$s['ss']}}</td>
					<td>{{$s['current']}}</td>
					<td>{{$s['date']}}</td>
					<td>{{$s['status']}}</td>
					<td><a href="#" onclick="confirmDeleteSender('{{$sid}}'); return false;" class="button gray"><i class="fa fa-trash"></i> </a></td>
				  </tr>
				<?php
					}
				}
				?>
				</tbody>
			  </table>
			</div>
		  </div>
		</div>
		<div class="col-lg-6 col-md-6 mb-4">
		  <div class="utf_dashboard_list_box table-responsive recent_booking">
			<h4>Facilities</h4>
			<div class="dashboard-list-box table-responsive invoices with-icons">
			  <table class="table table-hover admissionboox-table">
				<thead>
				  <tr>
					<th>Name</th>
					<th>Value</th>
					<th>Icon</th>
					<th>Date Added</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody>
				<?php
                  if(isset($facilities) && count($facilities) > 0)
                  {
                    foreach($facilities as $facility)
                    {
						$f = $facility['facility'];
                       $fid = $f['id'];
					   $fname = $f['facility_name'];
					   $fvalue = $f['facility_value'];
					   $ficon = $f['icon'];
					   $fdate = $f['date'];
					   $ru = url('remove-facility')."?xf={$fid}";
                 ?>
				
				  <tr>
					<td>{{$fname}}</td>
					<td>{{$fvalue}}</td>
					<td><i class="im {{$ficon}}" style="font-size: 20px;"></i></td>
					<td>{{$fdate}}</td>
					<td><a href="#" onclick="confirmDeletefacility('{{$fid}}'); return false;" class="button gray"><i class="fa fa-trash"></i> </a></td>
				  </tr>
				<?php
					}
				}
				
				?>
				</tbody>
			  </table>
			</div>
		  </div>
		</div>
		<div class="col-lg-6 col-md-6 mb-4">
		  <div class="utf_dashboard_list_box table-responsive recent_booking">
			<h4>Clubs</h4>
			<div class="dashboard-list-box table-responsive invoices with-icons">
			  <table class="table table-hover admissionboox-table">
				<thead>
				  <tr>
					<th>Name</th>
					<th>Value</th>
					<th>Image</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody>
				<?php
                  if(isset($clubs) && count($clubs) > 0)
                  {
                    foreach($clubs as $c)
                    {
						$cnamee = $c['club_name'];
						$cvalue = $c['club_value'];
						$cicon = $c['icon'];
                       $cid = $c['id'];
						$ru = url('remove-club')."?xf={$c['id']}";
                 ?>
				  <tr>
					<td>club_name</td>
					<td>{{$cvalue}}</td>
					<td><i class="im {{$cicon}}" style="font-size: 20px;"></i></td>
					<td><a href="#" onclick="confirmDeleteClub('{{$cid}}'); return false;" class="button gray"><i class="fa fa-trash"></i> </a></td>
				  </tr>
				<?php
					}
				}
				
				?>
				</tbody>
			  </table>
			</div>
		  </div>
		</div>
</div>
@stop