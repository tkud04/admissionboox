<?php
$useSidebar = $hasCompletedSignup;
$ac = "dashboard";
?>
@extends('dashboard_layout')

@section('dashboard-title',$school['name'])


 @section('scripts')
 @if(!$hasCompletedSignup)
 <script>
    $(document).ready(() => {
        Swal.fire({
            icon: 'warning',
            title: `Complete your school information`,
            html: `<p>Your school information is yet to be complete. Please fill out the rest of the information required in order to use AdmissionBoox!</p>`
        })
        .then((result) => {
             if (result.value) {
             //window.location = "dashboard";				
             }
           });
    })
 </script>
 @endif

 <script>

    const handleResourcesUpload = (e) => {
      console.log('Form event: ',e)
      return false
    }

    const initElems = () => {
        
    }

    $(document).ready(() => {
        initElems()
        $('#update-school-info-resources').submit(e => {
            e.preventDefault()
            console.log('form: ',$('#update-school-info-resources'))
        })
    })
 </script>
 @stop


@section('dashboard-content')
  @if($hasCompletedSignup)
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
@else
<div class="row"> 
        <div class="col-lg-12 col-md-12">
          <div class="utf_dashboard_list_box margin-top-0">
            <h4 class="gray">Update School Information</h4>
            
            <div class="utf_dashboard_list_box-static"> 
              <div class="my-profile">
              <div class="row with-forms">				
				<div class="col-md-12">
					<div class="form-group lis-relative">
						Your school profile is yet to be complete. Please fill out the required information to continue.
					</div>
				</div>
			  </div>
			    <div class="row with-forms">
                <div class="add_utf_listing_section margin-top-45"> 
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-folder-alt"></i> Resources</h3>
              </div>
              <p>Upload relevant resources; for example, school prospectus, etc</p>
                    @include('components.form-validation', ['id' => "update-school-info-resources-validation"])
              <form action="api/usr" class="dropzone"></form>
              
              <div class="utf_add_listing_part_headline_part margin-top-15">
                <h3><i class="sl sl-icon-energy"></i> Clubs</h3>
              </div>
              		  
              	  
             </div> 
					
					<div class="col-md-12">
                         @include('components.generic-loading', ['message' => 'Updating your password', 'id' => "update-school-info-loading"])
						<button class="button btn_center_item margin-top-15" id="update-school-info-btn">Change Password</button>
					</div>
				</div>
              </div>
            </div>
          </div>
        </div>
 </div>
@endif
@stop