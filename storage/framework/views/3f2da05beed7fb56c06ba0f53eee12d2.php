<?php
$ac = "admissions";
$useSidebar = true;
?>


<?php $__env->startSection('dashboard-title',"New Admission Session"); ?>

<?php $__env->startSection('dashboard-styles'); ?>
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-scripts'); ?>
  <script src="lib/datatables/datatables.min.js"></script>

  <script>

	 const clearValidations = () => {
          $('#na-session-validation').hide()
          $('#na-term-validation').hide()
          $('#na-class-validation').hide()
          $('#na-end-date-validation').hide()
          $('#na-application-fee-validation').hide()
        }

    $(document).ready(() =>{
      $('#na-btn').click((e) => {
        e.preventDefault()
        clearValidations()
         const naSession = $('#na-session').val(), naTerm = $('#na-term').val(),
         naClasses = $('input.na-classes:checked'), naEndDate = $('#na-end-date').val(),
         naApplicationFee = $('#na-application-fee').val()
         
         //console.log({naSession,naTerm,naClass,naEndDate})

         const v = naSession === 'none' || naTerm === 'none' || naClasses.length < 1 || 
                   naEndDate === '' || naApplicationFee === ''

         if(v){
           if(naSession === 'none') $('#na-session-validation').fadeIn()
           if(naTerm === 'none') $('#na-term-validation').fadeIn()
           if(naClasses.length < 1) $('#na-class-validation').fadeIn()
           if(naEndDate === '') $('#na-end-date-validation').fadeIn()
           if(naApplicationFee === '') $('#na-application-fee-validation').fadeIn()
         }
         else{
          $('#na-btn').hide()
          $('#na-loading').fadeIn()
          const classValues = []
          naClasses.each((i,elem) => {
            classValues.push(elem.getAttribute('data-value'))
           })
           const fd = new FormData()
              fd.append('xf',"<?php echo e($school['id']); ?>")
              fd.append('session',naSession)
              fd.append('term',naTerm)
              fd.append('end_date',naEndDate)
              fd.append('application_fee',naApplicationFee)
              fd.append('classes',JSON.stringify(classValues))

              addAdmissionSession(fd,
              (data) => {
                
                $('#na-loading').hide()
              $('#na-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('Admission session created!')
                    window.location = `school-admissions`
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#na-loading').hide()
              $('#na-btn').fadeIn()
                alert(`Failed to add admission: ${err}`)
              }
            )
         }
         
         
      })
    })
		
	
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-content'); ?>

<div class="row"> 
     <div class="col-lg-12 col-md-12">
       <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
             <h3><i class="sl sl-icon-book-open"></i> Basic Information</h3>
          </div>
       
        <div class="utf_submit_section">
          <div class="row with-forms">
               <div class="col-md-6">
                 <?php echo $__env->make('components.form-validation', ['id' => "na-session-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <h5>Admission Session</h5>
                 <select id="na-session" class="selectpicker default" data-selected-text-format="count" data-size="<?php echo e(count($availableSessions)); ?>"
                    title="Select session" tabindex="-98">
                     <option class="bs-title-option" value="none">Select session</option>
                     <?php
                      foreach($availableSessions as $s)
                       {
                     ?>
                       <option value="<?php echo e($s); ?>"><?php echo e($s); ?> session</option>
                     <?php
                       }
                     ?>
                 </select>
               </div>
               <div class="col-md-6">
                 <?php echo $__env->make('components.form-validation', ['id' => "na-term-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <h5>Admission Term</h5>
                 <select id="na-term" class="selectpicker default" data-selected-text-format="count" data-size="<?php echo e(count($terms)); ?>"
                    title="Select term" tabindex="-98">
                     <option class="bs-title-option" value="none">Select term</option>
                     <?php
                      foreach($terms as $t)
                       {
                     ?>
                       <option value="<?php echo e($t['value']); ?>"><?php echo e($t['name']); ?></option>
                     <?php
                       }
                     ?>
                 </select>
               </div>
               <div class="col-md-6">
                 <?php echo $__env->make('components.form-validation', ['id' => "na-class-validation",'style' => "margin-top: 10px;",'message' => 'Select at least 1 class'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <h5>Classes Available</h5>
                 <div class="checkboxes in-row amenities_checkbox">
          <ul>
            <?php
             for ($i = 0; $i < count($schoolClasses); $i++) {
               $class = $schoolClasses[$i];     
            ?>
              <li>
               <input id="check-class-<?php echo e($i); ?>" type="checkbox" class="na-classes" data-value="<?php echo e($class['id']); ?>">
               <label for="check-class-<?php echo e($i); ?>">
               <?php echo e($class['class_name']); ?></label>
              </li>
            <?php
           }
            ?>
          </ul>
          </div>
               </div>
              
               <div class="col-md-6">
                 <?php echo $__env->make('components.form-validation', ['id' => "na-end-date-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <h5>End Date</h5>
                 <input type="date" class="input-text" name="address" id="na-end-date">
               </div>
               <div class="col-md-6">
                 <?php echo $__env->make('components.form-validation', ['id' => "na-application-fee-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <h5>Application Fee</h5>
                 <input type="text" class="input-text" name="address" id="na-application-fee" value="">
               </div>

               <div class="col-md-12">
               <?php echo $__env->make('components.generic-loading', ['message' => 'Creating admission session', 'id' => "na-loading"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                   <?php echo $__env->make('components.button',[
                     'href' => '#',
                     'id' => 'na-btn',
                     'title' => 'Submit',
                     'classes' => 'margin-top-20'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               </div>
           
            </div>
          </div>
          </div>
     </div>
       
</div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/new-admission.blade.php ENDPATH**/ ?>