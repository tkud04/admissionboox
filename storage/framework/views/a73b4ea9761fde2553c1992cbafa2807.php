<?php
$ac = "classes";
$useSidebar = true;
?>


<?php $__env->startSection('dashboard-title',"New FAQ"); ?>

<?php $__env->startSection('dashboard-styles'); ?>
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-scripts'); ?>
  <script src="lib/datatables/datatables.min.js"></script>

  <script>
   const clearValidations = () => {
    $('#ac-name-validation').hide()
    $('#ac-value-validation').hide()
   }

    $(document).ready(() =>{
      

      $('#fa-btn').click((e) => {
         e.preventDefault()
         clearValidations()
         const q = $('#fa-question').val(), a = $('#fa-answer').val(),
               v = q === '' || a === ''
        
        if(v){
          if(q === '') $('#fa-question-validation').fadeIn()
          if(a === '') $('#fa-answer-validation').fadeIn()
        }
        else{
          $('#fa-btn').hide()
              $('#fa-loading').fadeIn()
              
              const fd = new FormData()
              fd.append('question',q)
              fd.append('answer',a)
              addSchoolFaq(fd,
              (data) => {
                
                $('#fa-loading').hide()
              $('#fa-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('FAQ Added!')
                    window.location = 'school-faqs'
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#fa-loading').hide()
                $('#fa-btn').fadeIn()
                alert(`Failed to add faq: ${err}`)
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
             <h3><i class="sl sl-icon-book-open"></i>Add FAQ</h3>
          </div>

          <div class="utf_submit_section">
          <div class="row with-forms">
               
               <div class="col-md-6">
                 <?php echo $__env->make('components.form-validation', ['id' => "fa-question-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <h5>Question</h5>
                 <input type="text" class="input-text" name="address" id="fa-question">
               </div>

               <div class="col-md-6">
                 <?php echo $__env->make('components.form-validation', ['id' => "fa-answer-validation"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <h5>Answer</h5>
                 <input type="text" class="input-text" name="value" id="fa-answer">
               </div>


               <div class="col-md-12">
                  <?php echo $__env->make('components.generic-loading', ['message' => 'Processing', 'id' => "fa-loading"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <?php echo $__env->make('components.button',[
                     'href' => '#',
                     'title' => 'Add new faq',
                     'classes' => 'margin-top-20',
                     'id' => 'fa-btn'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               </div>
           
            </div>
          </div>
        </div>
        
     </div>
       
</div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/new-faq.blade.php ENDPATH**/ ?>