<?php
$ac = "email";
$useSidebar = true;
?>


<?php $__env->startSection('dashboard-title',"Send Email"); ?>

<?php $__env->startSection('dashboard-styles'); ?>
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-scripts'); ?>
  <script src="lib/datatables/datatables.min.js"></script>

  <script>

  

	 const clearValidations = () => {
          $('#se-admission-validation').hide()
          $('#se-type-validation').hide()
        }


    $(document).ready(() =>{
        $('#se-btn-1').click((e) => {
        e.preventDefault()
        clearValidations()
         const admissionId = $('#se-admission').val(), emailType = $('#se-type').val()

         const v = admissionId === 'none' || emailType === 'none'

         if(v){
           if(admissionId === 'none') $('#se-admission-validation').fadeIn()
           if(emailType === 'none') $('#se-type-validation').fadeIn()
         }
         else{
            window.location = `send-email?xf1=${admissionId}&xf2=${emailType}`
         }         
      })
    
    })
		
	
  </script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('dashboard-content'); ?>

<div class="row"> 
     <div class="col-lg-12 col-md-12" id="send-email-div-1">
       <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
             <h3><i class="sl sl-icon-book-open"></i> Get Audience</h3>
          </div>

          <div class="utf_submit_section">
             <div class="row with-forms">
                 <div class="col-md-6">
                     <?php echo $__env->make('components.form-validation', ['id' => "se-admission-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                     <h5>Admission</h5>
                     <select id="se-admission" class="selectpicker default" data-selected-text-format="count" data-size="<?php echo e(count($schoolAdmissions)); ?>" title="Select session" tabindex="-98">
                     <option class="bs-title-option" value="none">Select admission</option>
                     <?php
                      foreach($schoolAdmissions as $a)
                       {
                     ?>
                       <option value="<?php echo e($a['id']); ?>"><?php echo e($a['session']); ?> session</option>
                     <?php
                       }
                     ?>
                    </select>
                 </div>

                 <div class="col-md-6">
                     <?php echo $__env->make('components.form-validation', ['id' => "se-type-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                     <h5>Type</h5>
                     <select id="se-type" class="selectpicker default" data-selected-text-format="count" data-size="2" title="Select session" tabindex="-98">
                     <option class="bs-title-option" value="none">Email type</option>
                     <?php
                     $typpes = [
                        ['value' => 'single', 'label' => "Send email to one applicant"],
                        ['value' => 'group', 'label' => "Send email to applicant group"],
                     ];
                      foreach($typpes as $t)
                       {
                     ?>
                       <option value="<?php echo e($t['value']); ?>"><?php echo e($t['label']); ?></option>
                     <?php
                       }
                     ?>
                    </select>
                 </div>

                 <div class="col-md-12">
                   <?php echo $__env->make('components.button',[
                     'href' => '#',
                     'id' => 'se-btn-1',
                     'title' => 'Next',
                     'classes' => 'margin-top-20'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               </div>
             </div>
          </div>
       </div>
     </div>
       
</div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/send-email-get-audience.blade.php ENDPATH**/ ?>