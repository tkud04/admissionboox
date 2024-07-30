<?php
$ac = "admissions";
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
          $('#na-session-validation').hide()
          $('#na-term-validation').hide()
          $('#na-class-validation').hide()
          $('#na-end-date-validation').hide()
        }


    

    $(document).ready(() =>{
       

      $('#se-btn-2-back').click((e) => {
        e.preventDefault()
        window.location = 'send-email'
                
      })

      
      $('#se-btn-2').click((e) => {
        e.preventDefault()
        clearValidations()
         const naSession = $('#na-session').val(), naTerm = $('#na-term').val(),
         naClasses = $('input.na-classes:checked'), naEndDate = $('#na-end-date').val()
         
         //console.log({naSession,naTerm,naClass,naEndDate})

         const v = naSession === 'none' || naTerm === 'none' || naClasses.length < 1 || naEndDate === ''

         if(v){
           if(naSession === 'none') $('#na-session-validation').fadeIn()
           if(naTerm === 'none') $('#na-term-validation').fadeIn()
           if(naClasses.length < 1) $('#na-class-validation').fadeIn()
           if(naEndDate === '') $('#na-end-date-validation').fadeIn()
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
   
     <div class="col-lg-12 col-md-12" id="send-email-div-2">
       <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
             <h3><i class="sl sl-icon-book-open"></i> Email Options</h3>
          </div>
       
        <div class="utf_submit_section">
          <div class="row with-forms">
               <?php
                if($emailType === 'single')
                {
               ?>
               <div class="col-md-6" id="se-2-lead-div">
                 <?php echo $__env->make('components.form-validation', ['id' => "se-2-lead-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <h5>Select Applicant</h5>
                 <select id="se-2-lead" class="selectpicker default" data-selected-text-format="count"
                    title="Select applicant" tabindex="-98">
                     <option class="bs-title-option" value="none">Select applicant</option>
                    <?php
                      foreach($leads['applicants'] as $l)
                      {
                    ?>
                       <option  value="<?php echo e($l['email']); ?>"><?php echo e($l['name']); ?></option>
                    <?php
                      }
                    ?>
                 </select>
               </div>
               <?php
                }
                else if($emailType === 'group')
                {
               ?>
               <div class="col-md-12">
                 <?php echo $__env->make('components.form-validation', ['id' => "se-2-leads-validation",'style' => "margin-top: 10px;",'message' => 'Select at least 1 applicant'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <h5>Select Applicants</h5>
                 <div class="checkboxes in-row amenities_checkbox">
                   <ul>
                   <?php
                    for ($i = 0; $i < count($leads['applicants']); $i++) {
                     $l = $leads['applicants'][$i];     
                   ?>
                     <li>
                      <input id="check-class-<?php echo e($i); ?>" type="checkbox" class="se-2-leads" data-value="<?php echo e($l['email']); ?>">
                      <label for="check-class-<?php echo e($i); ?>">
                      <?php echo e($l['name']); ?></label>
                     </li>
                    <?php
                     }
                    ?>
                   </ul>
                 </div>
               </div>
               <?php
                }
               ?>
              
               <div class="col-md-12">
               <?php echo $__env->make('components.generic-loading', ['message' => 'Sending email(s)', 'id' => "na-loading"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                   <?php echo $__env->make('components.button',[
                     'href' => '#',
                     'id' => 'se-btn-2',
                     'title' => 'Send',
                     'classes' => 'margin-top-20'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                     <?php echo $__env->make('components.button',[
                     'href' => '#',
                     'id' => 'se-btn-2-back',
                     'title' => 'Go back',
                     'classes' => 'margin-top-20'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               </div>
           
            </div>
          </div>
          </div>
     </div>
       
</div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/send-email-email-options.blade.php ENDPATH**/ ?>