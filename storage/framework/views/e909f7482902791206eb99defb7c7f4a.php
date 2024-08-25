<?php
$ac = "dashboard";
$useAdminSidebar = true;
?>


<?php $__env->startSection('dashboard-title',"Plugins"); ?>

<?php $__env->startSection('dashboard-styles'); ?>
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-scripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-content'); ?>



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
					<td><?php echo e($p['name']); ?></td>
					<td>
						<div style="background: #efefef; border-radius: 2px;"><?php echo e($p['value']); ?></div>
					</td>
					<td><?php echo e($p['date']); ?></td>
					<td><?php echo e($p['status']); ?></td>
					<td><a href="#" onclick="confirmDeletePlugin('<?php echo e($pid); ?>'); return false;" class="button gray"><i class="fa fa-trash"></i> </a></td>
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
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/plugins.blade.php ENDPATH**/ ?>