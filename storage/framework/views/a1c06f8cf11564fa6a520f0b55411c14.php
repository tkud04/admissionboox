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
  <script src="lib/ckeditor/ckeditor.js"></script>

  <script>

	 const clearValidations = () => {
          $('#se-admission-validation').hide()
          $('#se-type-validation').hide()
          $('#na-session-validation').hide()
          $('#na-term-validation').hide()
          $('#na-class-validation').hide()
          $('#na-end-date-validation').hide()
        }


        $(() => {
                CKEDITOR.replace('se-2-content')
                $('#logs-loading').hide()
                $('#mailer-results').hide()
        })
    

    $(document).ready(() =>{
       
      $('#se-btn-2-back').click((e) => {
        e.preventDefault()
        window.location = 'send-email'
                
      })

      
      $('#se-btn-2').click((e) => {
        e.preventDefault()
        clearValidations()
         const admissionId = $('#xf1').val(), emailType = $('#xf2').val(),
         se2Classes = $('input.se-2-leads:checked'), se2Lead = $('#se-2-lead').val(),
         subject = $('#se-2-subject').val(),  content = CKEDITOR.instances['se-2-content'].getData()
         
       

         const v = (emailType === 'group' && se2Classes.length < 1) ||
                   (emailType === 'single' && se2Lead === '') || 
                   subject === '' || content === '' 

                     console.log({
                        emailType,
                        se2Classes: se2Classes.length,
                        se2Lead,
                        subject,
                        content,
                        v})

         if(v){
           if(emailType === 'group' || se2Classes.length < 1) $('#se-2-leads-validation').fadeIn()
           if(emailType === 'single' ||se2Lead === '') $('#se-2-lead-validation').fadeIn()
           if(subject === '') $('#se-2-subject-validation').fadeIn()
           if(content === '') $('#se-2-content-validation').fadeIn()
         }
         else{
          $('#se-buttons-div').hide()

          const classValues = []

          if(emailType === 'single'){
            classValues.push(se2Lead)
          }
          else if(emailType === 'group'){
            se2Classes.each((i,elem) => {
            classValues.push(elem.getAttribute('data-value'))
           })
          }
          
           bomb({
            ll: classValues,
            subject,
            msg: content
           },() => {
            alert('Email(s) sent!')
            window.location = 'send-email'
           },
           (err) => {
            alert('failed to send email: ',err)

            $('#logs-loading').hide()
            $('#mailer-results').hide()
            $('#se-buttons-div').fadeIn()
           })
         }
         
         
      })
    })
		
	
  </script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('dashboard-content'); ?>

<div class="row"> 
   <div>
    <input type="hidden" id="xf1" value="<?php echo e($admissionId); ?>"/>
    <input type="hidden" id="xf2" value="<?php echo e($emailType); ?>"/>
   </div>
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
               <div class="col-md-12" id="se-2-lead-div">
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
               <?php echo $__env->make('components.form-validation', ['id' => "se-2-subject-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               <h5>Subject</h5>
                  <input type="text" class="input-text" id="se-2-subject" placeholder="Subject">
               </div>
               <div class="col-md-12" style="margin-top: 10px;">
               <?php echo $__env->make('components.form-validation', ['id' => "se-2-content-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               <h5>Your Message</h5>
                 <textarea id="se-2-content" rows="10" cols="80" placeholder="Your message">
                   
                 </textarea>
               </div>
              
               <div class="col-md-12" style="margin-top: 10px">
                <div id="logs-loading"></div>
                <div id="mailer-results"></div>
               </div>
               <div class="col-md-12" style="margin-top: 10px;" id="se-buttons-div">
              
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