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

    const leads = [
        <?php
 foreach($schoolAdmissions as $sa)
 {
    ?>
     {
        admissionId: "<?php echo e($sa['id']); ?>",
        applicants: [
    <?php
      $applicants = $sa['applications'];

      foreach($applicants as $applicant)
      {
        $applicantName =  $u['fname'].' '.$u['lname'];
        $applicantEmail = $u['email'];
    ?>
      {name: "<?php echo e($applicantName); ?>", email: "<?php echo e($applicantEmail); ?>"},
    <?php
      }
    ?>
    //Test data
    {name: 'Tpbi Kay',email: 'kudayisitobi@gmail.com'},
    {name: 'Test User 2',email: 'kkudayisitobi@gmail.com'},
    {name: 'Test User 3',email: 'tobi.kudayisi@vfdtech.ng'},
        ]
     }
    <?php
 }
?>
    ]

    console.log('leads: ',leads)

	 const clearValidations = () => {
          $('#se-admission-validation').hide()
          $('#se-type-validation').hide()
          $('#na-session-validation').hide()
          $('#na-term-validation').hide()
          $('#na-class-validation').hide()
          $('#na-end-date-validation').hide()
        }

    const populateLeads = () => {
        $('#se-2-lead').selectpicker()
    }

        $(() => {
            populateLeads()
          $('#send-email-div-2').hide()
        })

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
            $('#se-val-1').val(admissionId)
            $('#se-val-2').val(emailType)
            populateLeads()

          $('#send-email-div-1').hide()
          $('#send-email-div-2').fadeIn()
         }         
      })

      $('#se-btn-2-back').click((e) => {
        e.preventDefault()
        $('#send-email-div-2').hide()
        $('#send-email-div-1').fadeIn()
                
      })

      $('#se-val-1').change(() => {
        const val = $('#se-val-1').val()

        if(val === 'single'){
          $('#se-2-leads').hide()
          $('#se-2-lead').fadeIn()
        }
        else if(val === 'group'){
            $('#se-2-lead').hide()
            $('#se-2-leads').fadeIn()
        }
      })

      $('#se-admission').change(() => {
        const val = $('#se-admission').val()

        const selectedAdmission = leads.find(i => i.admissionId === val)
        console.log('selected admission: ',selectedAdmission)
        if(selectedAdmission !== null || typeof selectedAdmission !== 'undefined'){
            const se2Lead = document.querySelector('#se-2-lead')
            for(const k of selectedAdmission?.applicants){
              se2Lead.options[se2Lead.options.length] = new Option(k.name,k.email)
            }
        }

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
    <div>
        <input type hidden id="se-val-1" value=""/>
        <input type hidden id="se-val-2" value=""/>
    </div>
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
                        ['label' => 'Single', 'value' => "Send email to one applicant"],
                        ['label' => 'Group', 'value' => "Send email to applicant group"],
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

     <div class="col-lg-12 col-md-12" id="send-email-div-2">
       <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
             <h3><i class="sl sl-icon-book-open"></i> Email Options</h3>
          </div>
       
        <div class="utf_submit_section">
          <div class="row with-forms">
               <div class="col-md-6" id="se-2-lead-div">
                 <?php echo $__env->make('components.form-validation', ['id' => "se-2-lead-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <h5>Select Applicant</h5>
                 <select id="se-2-lead" class="selectpicker default" data-selected-text-format="count"
                    title="Select session" tabindex="-98">
                     <option class="bs-title-option" value="none">Select applicant</option>
                    
                 </select>
               </div>
               <div class="col-md-6">
                 <?php echo $__env->make('components.form-validation', ['id' => "se-2-leads-validation",'style' => "margin-top: 10px;",'message' => 'Select at least 1 applicant'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <h5>Select Applicants</h5>
                 <div class="checkboxes in-row amenities_checkbox">
                   <ul>
                   <?php
                    for ($i = 0; $i < count($applicants); $i++) {
                     $a = $applicants[$i];     
                   ?>
                     <li>
                      <input id="check-class-<?php echo e($i); ?>" type="checkbox" class="se-2-leads" data-value="<?php echo e($a['email']); ?>">
                      <label for="check-class-<?php echo e($i); ?>">
                      <?php echo e($a['name']); ?></label>
                     </li>
                    <?php
                     }
                    ?>
                   </ul>
                 </div>
               </div>
              
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
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/send-email.blade.php ENDPATH**/ ?>