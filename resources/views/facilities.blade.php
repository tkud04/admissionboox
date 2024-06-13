<?php
$ac = "dashboard";
$useAdminSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"Facilities")

@section('dashboard-styles')
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop

@section('dashboard-scripts')
  <script src="lib/datatables/datatables.min.js"></script>

  <script>

	 const confirmDeleteFacility = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            removeFacility(xf,
				      () => {
			       		alert('Facility removed')
					      window.location = 'facilities'
				      },
				      (err) => {
				       	alert('Failed to remove facility: ',err)
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



  <div class="row">
   
      <div class="col-lg-12 col-md-12 mb-4">
		  <div class="utf_dashboard_list_box table-responsive recent_booking">
			<h4>Facilities</h4>
			<div class="dashboard-list-box table-responsive invoices with-icons">
			  <table class="table table-hover admissionboox-table">
				<thead>
				  <tr>
					<th>Name</th>
					<th>Icon</th>
					<th>Date Added</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody>
				<?php
                  if(isset($facilities) && count($facilities) > 0)
                  {
                    foreach($facilities as $f)
                    {
                       $fid = $f['id'];
						$ru = url('remove-facility')."?xf={$f['id']}";
                 ?>
				  <tr>
					<td>
                      <p>{{$f['facility_name']}}  <i>({{$f['facility_value']}})</i></p>
                     
                    </td>
					<td>
						<div>
                          <i class='im ${v}' style="font-size: 40px;"></i>
                        </div>
					</td>
					<td>{{$f['date']}}</td>
					<td><a href="#" onclick="confirmDeleteFacility('{{$fid}}'); return false;" class="button gray"><i class="fa fa-trash"></i> </a></td>
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