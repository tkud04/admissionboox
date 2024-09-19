<?php
$ac = "";
$useSidebar = true;
?>


<?php $__env->startSection('dashboard-title',"FAQs"); ?>

<?php $__env->startSection('dashboard-styles'); ?>
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-scripts'); ?>
  <script src="lib/datatables/datatables.min.js"></script>

  <script>

	 const confirmRemoveFaq = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            removeFaq(xf,
				      () => {
			       		alert('FAQ removed!')
					      window.location = 'school-faqs'
				      },
				      (err) => {
				       	alert('Failed to remove faq: ',err)
				      }
			       )
           })
        
        }

      

        const hideValidationErrors = () => {
          $('#f-question').hide()
          $('#f-answer').hide()
        }
		
	
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-content'); ?>

<div class="row">
   
   <div class="col-lg-12 col-md-12 mb-4">
       <div class="utf_dashboard_list_box table-responsive recent_booking">
         <h4>FAQs</h4>
         <div class="dashboard-list-box table-responsive invoices with-icons">
           <table class="table table-hover admissionboox-table">
             <thead>
               <tr>
                 <th>Question</th>
                 <th>Answer</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>
             <?php
               $faqs = $school['faqs'];
               if(isset($faqs) && count($faqs) > 0)
               {
                 foreach($faqs as $f)
                 {
                    $fid = $f['id'];
                     $vu = url('school-faq')."?xf=".$fid;
              ?>
               <tr>
                 <td><?php echo e($f['faq_question']); ?></td>
                 <td>
                     <?php echo e($f['faq_answer']); ?>

                 </td>
                 <td>
                    <a href="<?php echo e($vu); ?>" class="button gray"><i class="fa fa-eye"></i> </a>
                    <a href="#" onclick="confirmRemoveFaq('<?php echo e($fid); ?>'); return false;" class="button gray"><i class="fa fa-trash"></i> </a>
                   
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
</div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/my-faqs.blade.php ENDPATH**/ ?>