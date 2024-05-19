<?php
$void = 'javascript:void(0)';
$ac = "dashboard";
?>

@extends('dashboard_layout')

@section('dashboard-title',"Set Password")

@section('dashboard-content')
<div class="row"> 
        <div class="col-lg-12 col-md-12">
          <div class="utf_dashboard_list_box margin-top-0">
            <h4 class="gray"><i class="sl sl-icon-key"></i> Change Password</h4>
            <div class="utf_dashboard_list_box-static"> 
              <div class="my-profile">
			    <div class="row with-forms">
					<div class="col-md-4">
						<label>Current Password</label>						
						<input type="text" class="input-text" name="password" placeholder="*********" value="">
					</div>
					<div class="col-md-4">
						<label>New Password</label>						
						<input type="text" class="input-text" name="password" placeholder="*********" value="">
					</div>
					<div class="col-md-4">
						<label>Confirm New Password</label>
						<input type="text" class="input-text" name="password" placeholder="*********" value="">
					</div>
					<div class="col-md-12">
						<button class="button btn_center_item margin-top-15">Change Password</button>
					</div>
				</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="footer_copyright_part">Copyright © 2022 All Rights Reserved.</div>
        </div>
      </div>
@stop