<?php
$ac = "admissions";
$useSidebar = true;
?>


<?php $__env->startSection('dashboard-title',"{$admission['session']} Session"); ?>

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
        }

        const confirmDeployForm = (fid) => {
            confirmAction(fid, 
			    (xf) => {
            const payload = {
              id: xf,
              status: '<?= $admissionForm['status'] === 'pending' ? 'active' : 'pending'?>'
            }
            updateAdmissionForm(payload,
				      () => {
			       		alert('Form updated!')
					       window.location.reload()
				      },
				      (err) => {
				       	alert('Failed to update form: ',err)
				      }
			       )
           },'Are you sure?')
        
        }

    $(document).ready(() =>{
      $('#na-btn').click((e) => {
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
              fd.append('xf',"<?php echo e($admission['form_id']); ?>")
              fd.append('session',naSession)
              fd.append('term',naTerm)
              fd.append('end_date',naEndDate)
              fd.append('classes',JSON.stringify(classValues))

              updateAdmissionSession(fd,
              (data) => {
                
                $('#na-loading').hide()
              $('#na-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('Admission session updated!')
                    window.location = `school-admission?xf=<?php echo e($admission['id']); ?>`
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#na-loading').hide()
              $('#na-btn').fadeIn()
                alert(`Failed to update admission: ${err}`)
              }
            )
         }
         
         
      })

      $('#df-btn').click((e) => {
        e.preventDefault()
        confirmDeployForm("<?php echo e($admission['form_id']); ?>")
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
                     <option class="bs-title-option" value="none" >Select session</option>
                     <?php
                      foreach($availableSessions as $s)
                       {
                         $v = $s === $admission['session'] ? " selected" : "";
                     ?>
                       <option value="<?php echo e($s); ?>"<?php echo e($v); ?>><?php echo e($s); ?> session</option>
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
                        $v = $t['value'] === $admission['term_id'] ? " selected" : "";
                     ?>
                       <option value="<?php echo e($t['value']); ?>"<?php echo e($v); ?>><?php echo e($t['name']); ?></option>
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
               $isChecked = in_array($class,$acList);
               $checkedString = $isChecked ? ' checked' : '';
            ?>
              <li>
               <input id="check-class-<?php echo e($i); ?>" type="checkbox" class="na-classes" data-value="<?php echo e($class['id']); ?>" <?php echo e($checkedString); ?>>
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
                 <input type="date" class="input-text" name="address" id="na-end-date" value="<?php echo e($admission['end_date']); ?>">
               </div>

               <div class="col-md-12">
               <?php echo $__env->make('components.generic-loading', ['message' => 'Updating admission session', 'id' => "na-loading"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

          <div class="add_utf_listing_section margin-top-45">
            <div class="utf_add_listing_part_headline_part">
               <h3><i class="sl sl-icon-book-open"></i> Admission Form</h3>
            </div>

            <?php
              if($admission['form_id'] === '')
              {

              
            ?>
              <p>You have not created an admission form for this session. Click the button below to create one.</p>
              <?php echo $__env->make('components.button',[
                     'href' => url('add-school-admission-form').'?xf='.$admission['id'],
                     'id' => 'nf-btn',
                     'title' => 'Create form',
                     'classes' => 'margin-top-20'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php
              }
              else
              {
            ?>
              <p> Click 'Edit form' to view/edit your admission form. Click 'Publish/Unpublish form' to deploy your admission form.</p>
              <?php echo $__env->make('components.button',[
                     'href' => url('school-admission-form').'?xf='.$admission['id'],
                     'id' => 'na-btn',
                     'title' => 'Edit form',
                     'classes' => 'margin-top-20'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('components.button',[
                     'href' => '#',
                     'id' => 'df-btn',
                     'title' => $admissionForm['status'] === 'active' ? 'Unpublish form' : 'Publish form',
                     'classes' => 'margin-top-20'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php
              }
            ?>
            <p></p>
          </div>
     </div>
       
</div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/my-admission.blade.php ENDPATH**/ ?>