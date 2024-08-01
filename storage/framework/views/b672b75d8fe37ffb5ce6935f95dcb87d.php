<?php
$ac = "classes";
$useSidebar = true;
?>


<?php $__env->startSection('dashboard-title',"Classes"); ?>

<?php $__env->startSection('dashboard-styles'); ?>
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-scripts'); ?>
  <script src="lib/datatables/datatables.min.js"></script>

  <script>

	 const confirmDeleteClass = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            removeSchoolClass(xf,
				      () => {
			       		alert('Class removed')
					      window.location = 'classes'
				      },
				      (err) => {
				       	alert('Failed to remove class: ',err)
				      }
			       )
           })
        
        }

    $(document).ready(() =>{
      $('#sort-select').change(() => {
         const val = $('#sort-select').val()

         console.log('status to be sorted: ',val)
      })
    })
		
	
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-content'); ?>

<div class="row"> 
        <div class="col-lg-12 col-md-12">
          <div class="utf_dashboard_list_box margin-top-0">
			   
            <h4><i class="sl sl-icon-list"></i> Classes</h4>
            <ul>
              <?php
               if(count($schoolClasses) > 0)
               {
                  foreach($schoolClasses as $c)
                  {
                    $xf = $c['id'];

              ?>
                    <li>
                      <i style="margin-right: 10px; font-size: 40px;" class="fa fa-school"></i> <?php echo e($c['class_name']); ?>

                      <div style="margin-left: 20px;">
                         <a href="#" onclick="confirmDeleteClass('<?php echo e($xf); ?>'); return false;"><i class="fa fa-trash"></i></a>
                      </div>
                   </li>
              <?php
                  }
             
               }
               else
               {
              ?>
               <div style="margin-top: 60px;">
              <p class="text-center"><i class="im im-icon-Student-Hat" style="font-size: 200px;"></i></p>
               <p class="text-center">
                   There are no classes on record.
                </p>

                <div class="text-center" style="margin-top: 10px;">
                  <?php echo $__env->make('components.button',[
                     'href' => url('add-school-class'),
                     'title' => 'Add new class',
                     'classes' => 'margin-top-20'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
               </div>
                
              <?php
               }
              ?>
            
             
            </ul>
          </div>
		      <div class="clearfix"></div>
         
        </div>
       
      </div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/my-classes.blade.php ENDPATH**/ ?>