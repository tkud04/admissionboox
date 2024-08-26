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
	
	 const confirmUpdateSchoolStatus = (data={xf:'',ss:''}) => {
            confirmAction(data, 
			    (dt={xf:'',ss:''}) => {
					updateSchoolStatus(dt,
				      () => {
					    alert('Status updated')
					    window.location = 'dashboard'
				       },
				      (err) => {
					    alert('Failed to update school status: ',err)
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
            <h4>Recent Updates</h4>
            <ul>
        <?php
         if(count($notifications) > 0)
         {
           foreach($notifications as $ru){
        ?>
         @include('components.recent-updates-widget',$ru)
        <?php
         }
        }
        else
        {
        ?>
         <li><i class="utf_list_box_icon sl sl-icon-eyeglass"></i> No new updates yet. </strong>
      </li>
        <?php
        }
       ?>
      
      </ul>
        </div>
       
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="utf_dashboard_list_box invoices with-icons margin-top-20">
            <h4>Recent Applications</h4>
			<ul>
        <?php
         if(count($schoolApplications) > 0)
         {
         foreach($schoolApplications as $sa)
         {
          $iid = "shdj3";
          $iu = url('application-invoice')."?xf=".$iid;
          $u = $sa['user'];
          $a = $schoolApplication['admission'];
          $term = ['name' => "", 'value' => '0'];

          foreach($terms as $t)
                    {
                      if($t['value'] === $a['term_id']) $term = $t;
                    }
        ?>
      <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong>{{$a['session']}} <span
          class="paid">Paid</span></strong>
        <ul>
        <li>
          <p>
            <span>Applicant:-</span> {{$u['fname']}} {{$u['lname']}}<br>
            <span>Term selected:-</span>{{$schoolApplication['term']}}
          </p>
        </li>
        </ul>
        <div class="buttons-to-right"> <a href="{{$iu}}" target="_blank" class="button gray"><i
          class="sl sl-icon-printer"></i> Invoice</a> </div>
      </li>
       <?php
         }
        }
        else
        {
        ?>
         <li><i class="utf_list_box_icon sl sl-icon-eyeglass"></i> No applications yet. <a href="{{url('school-admissions')}}">View admissions</a></strong>
      </li>
        <?php
        }
       ?>
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
					<th>Date Added</th>
					<th>Owner</th>
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
						$surl = $school['url'];
						$vu = url('school')."?xf=".$surl;
						$ss = $school['status'];
						$ss2 = $ss === 'pending' ? 'active' : 'pending';
						$uuText = $ss === 'pending' ? 'Approve' : 'Pend';
                 ?>
				  <tr>
					<td><img alt="{{$school['name']}}" class="img-fluid rounded-circle shadow-lg" src="{{$school['logo']}}" width="50" height="50"></td>
					<td>{{$school['name']}}</td>
					<td>{{$school['date']}}</td>
					<td>{{$owner['name']}}</td>
					<td><span class="badge badge-pill badge-primary text-uppercase">{{$ss}}</span></td>
					<td>
						<a href="{{$vu}}" class="button gray"><i class="fa fa-eye"></i> View</a>
						<a href="#" class="button gray" onClick="confirmUpdateSchoolStatus({xf:'{{$surl}}',ss:'{{$ss2}}'})"><i class="fa fa-edit"></i> {{$uuText}}</a>
					</td>
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