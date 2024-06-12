<?php
$ac = "dashboard";
$useAdminSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"Plugins")

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
					      window.location = 'plugins'
				      },
				      (err) => {
				       	alert('Failed to remove plugin: ',err)
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
</div>
@stop