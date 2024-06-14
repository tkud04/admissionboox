<?php
$ac = "dashboard";
$useAdminSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"Clubs")

@section('dashboard-styles')
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop

@section('dashboard-scripts')
  <script src="lib/datatables/datatables.min.js"></script>

  <script>

	 const confirmDeleteClub = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            removeClub(xf,
				      () => {
			       		alert('Club removed')
					      window.location = 'clubs'
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



  <div class="row">
   
      <div class="col-lg-12 col-md-12 mb-4">
		  <div class="utf_dashboard_list_box table-responsive recent_booking">
			<h4>Clubs</h4>
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
                  if(isset($clubs) && count($clubs) > 0)
                  {
                    foreach($clubs as $c)
                    {
                       $cid = $c['id'];
						$ru = url('remove-club')."?xf={$c['id']}";
                 ?>
				  <tr>
					<td>
                      <p>{{$c['club_name']}}  <i>({{$c['club_value']}})</i></p>
                     
                    </td>
					<td>
						<div>
                          <i class="im {{$c['icon']}}" style="font-size: 40px;"></i>
                        </div>
					</td>
					<td>{{$c['date']}}</td>
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