<?php
$ac = "dashboard";
$useAdminSidebar = true;
?>


<?php $__env->startSection('dashboard-title',"Clubs"); ?>

<?php $__env->startSection('dashboard-styles'); ?>
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-scripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-content'); ?>



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
                      <p><?php echo e($c['club_name']); ?>  <i>(<?php echo e($c['club_value']); ?>)</i></p>
                     
                    </td>
					<td>
						<div>
                          <i class="im <?php echo e($c['icon']); ?>" style="font-size: 40px;"></i>
                        </div>
					</td>
					<td><?php echo e($c['date']); ?></td>
					<td><a href="#" onclick="confirmDeleteClub('<?php echo e($cid); ?>'); return false;" class="button gray"><i class="fa fa-trash"></i> </a></td>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/repos/admissionboox/resources/views/clubs.blade.php ENDPATH**/ ?>