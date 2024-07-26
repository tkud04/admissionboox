<?php
$ac = "admissions";
$useSidebar = true;
?>


<?php $__env->startSection('dashboard-title',"Edit Form - {$admission['session']} Session"); ?>

<?php $__env->startSection('dashboard-styles'); ?>
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-scripts'); ?>
  <script src="lib/datatables/datatables.min.js"></script>

  <script>
     let fbafOptions = []

     const removeFbafOption = (id) => {
      let ret = []
      if(fbafOptions.length > 0){
        for(const o of fbafOptions){
         if(o.id === id){}
         else{
          ret.push(o)
         }
        }
      }
      fbafOptions = ret
      renderOptions()
     }

     const renderOptions = () => {
       let ret = ``
      if(fbafOptions.length > 0){
        for(const o of fbafOptions){
          ret += `<p>Name: <b>${o.name}</b>, Value: <b>${o.value}</b>  <a href="#" onclick="removeFbafOption('${o.id}'); return false;">Remove <i class="fa fa-trash"></i></a></p>`
        }
      }
      $('#fbaf-options-list').html(ret)
     }

     const confirmRemoveFormSection = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            removeFormSection(xf,
				      () => {
			       		alert('Form section removed')
					       window.location = `school-admission-form?xf=<?php echo e($admission['form_id']); ?>`
				      },
				      (err) => {
				       	alert('Failed to remove admission: ',err)
				      }
			       )
           })
        
        }

        const confirmRemoveFormField = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            removeFormField(xf,
				      () => {
			       		alert('Form section removed')
					       window.location = `school-admission-form?xf=<?php echo e($admission['form_id']); ?>`
				      },
				      (err) => {
				       	alert('Failed to remove admission: ',err)
				      }
			       )
           })
        
        }

	 const clearFbasValidations = () => {
          $('#fbas-title-validation').hide()
          $('#fbas-description-validation').hide()
        }

        const clearFbafValidations = () => {
          $('#fbaf-title-validation').hide()
          $('#fbaf-title-validation').hide()
          $('#fbaf-description-validation').hide()
        }

        $(() => {
		      $('.admissionboox-table').dataTable()
          $('#options-div').hide()

          $('#preview-div').hide()
	      })

    $(() =>{
      $('#fbas-btn').click((e) => {
        e.preventDefault()
        clearFbasValidations()
        const fbasTitle = $('#fbas-title').val(), fbasDescription = $('#fbas-description').val(),
        v = fbasTitle === '' || fbasDescription === ''

        if(v){
          if(fbasTitle === '') $('#fbas-title-validation').fadeIn()
          if(fbasDescription === '') $('#fbas-description-validation').fadeIn()
        }
        else{
            $('#fbas-btn').hide()
            $('#fbas-loading').fadeIn()
            const fd = new FormData()
            fd.append('form_id',"<?php echo e($admission['form_id']); ?>")
            fd.append('title',fbasTitle)
            fd.append('description',fbasDescription)

            addFormSection(fd,
              (data) => {
                
                $('#fbas-loading').hide()
              $('#fbas-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('Form section added!')
                    window.location = `school-admission-form?xf=<?php echo e($admission['form_id']); ?>`
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#fbas-loading').hide()
              $('#fbas-btn').fadeIn()
                alert(`Failed to add form section: ${err}`)
              }
            )
        }
      })

      $('#fbaf-type').change(() => {
        const option = $('#fbaf-type').val(),
             v = option === 'select' || option === 'radio' || option === 'checkbox'

        if(v){
          $('#options-div').fadeIn()
        }
        else{
          $('#options-div').hide()
        }
      })

      $('#fbaf-add-option-btn').click((e) => {
        e.preventDefault()
        $('#fbaf-add-option-name-validation').hide()
        $('#fbaf-add-option-value-validation').hide()

        const name = $('#fbaf-add-option-name').val(), value = $('#fbaf-add-option-value').val(),
              v = name === '' || value === ''

        if(v){
           if(name === '') $('#fbaf-add-option-name-validation').fadeIn()
           if(value === '') $('#fbaf-add-option-value-validation').fadeIn()
        }
        else{
          fbafOptions.push({
            id: `option-${fbafOptions.length}`,
            name,
            value
          })
          $('#fbaf-add-option-name').val('')
          $('#fbaf-add-option-value').val('')
          renderOptions()
        }
      })

      $('#fbaf-btn').click((e) => {
        e.preventDefault()
        clearFbasValidations()
        const fbafTitle = $('#fbaf-title').val(), fbafDescription = $('#fbaf-description').val(),
              fbafSection = $('#fbaf-section').val(), fbafType = $('#fbaf-type').val(), 
              fbafBsLength = $('#fbaf-bslength').val(),
               v = fbafTitle === '' || fbafDescription === '' || fbafSection === 'none' ||
                   fbafType === 'none' || fbafBsLength === ''

        if(v){
          if(fbafTitle === '') $('#fbaf-title-validation').fadeIn()
          if(fbafDescription === '') $('#fbaf-description-validation').fadeIn()
          if(fbafSection === 'none') $('#fbaf-section-validation').fadeIn()
          if(fbafType === 'none') $('#fbaf-type-validation').fadeIn()
          if(fbafBsLength === '') $('#fbaf-bslength-validation').fadeIn()
        }
        else{
            $('#fbaf-btn').hide()
            $('#fbaf-loading').fadeIn()
            const fd = new FormData()
            fd.append('form_id',"<?php echo e($admission['form_id']); ?>")
            fd.append('section_id',fbafSection)
            fd.append('title',fbafTitle)
            fd.append('description',fbafDescription)
            fd.append('type',fbafType)
            fd.append('bs_length',fbafBsLength)
            fd.append('options',JSON.stringify(fbafOptions))

            addFormField(fd,
              (data) => {
                
                $('#fbaf-loading').hide()
              $('#fbaf-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('Form field added!')
                    window.location = `school-admission-form?xf=<?php echo e($admission['form_id']); ?>`
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#fbaf-loading').hide()
              $('#fbaf-btn').fadeIn()
                alert(`Failed to add form field: ${err}`)
              }
            )
        }
      })

      $('#fb-preview-btn').click((e) => {
        e.preventDefault()
        $('#edit-div').hide()
         $('#preview-div').fadeIn()
      })

      $('#fb-preview-back-btn').click((e) => {
        e.preventDefault()
        $('#preview-div').hide()
         $('#edit-div').fadeIn()
      })
    })
		
	
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-content'); ?>

<div class="row"> 
     <div class="col-lg-12 col-md-12" id="edit-div">
       <div class="add_utf_listing_section margin-top-45">
            <div class="utf_add_listing_part_headline_part">
               <h3><i class="sl sl-icon-book-open"></i> About Form Builder</h3>
            </div>
            <p>Documentation for the form builder would be displayed here</p>
        </div>

        <?php echo $__env->make('components.button',[
                     'href' => '#',
                     'id' => 'fb-preview-btn',
                     'title' => 'Preview form',
                     'classes' => 'margin-top-20'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
             <h3><i class="sl sl-icon-book-open"></i> Form Components</h3>
          </div>
       
         <div class="utf_submit_section">
          <div class="row with-forms">
               <div class="col-md-12">
               <div class="dashboard-list-box table-responsive invoices with-icons">
			  <table class="table table-hover admissionboox-table">
				<thead>
				  <tr>
					<th>Component</th>
					<th>Details</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody id="fb-components-tbody">
          <?php
            foreach($formSections as $fs)
            {
              $xf = $fs['id'];
          ?>
           <tr>
            <td>Section</td>
            <td>
              <p>Title: <?php echo e($fs['title']); ?></p>
              <p>Description: <?php echo e($fs['description']); ?></p>
            </td>
            <td>
              <a href="#" onclick="confirmRemoveFormSection('<?php echo e($xf); ?>')">Remove <i class="fa fa-trash"></i></a>
            </td>
           </tr>
          <?php
              foreach($fs['form_fields'] as $ff)
              {
                $xy = $ff['id'];
          ?>
           <tr>
             <td>Type</td>
             <td>
              <p>Title: <?php echo e($ff['title']); ?></p>
              <p>Description: <?php echo e($ff['description']); ?></p>
            </td>
            <td>
              <a href="#" onclick="confirmRemoveFormField('<?php echo e($xy); ?>')">Remove <i class="fa fa-trash"></i></a>
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
          </div>

          <div class="add_utf_listing_section margin-top-45">
            <div class="utf_add_listing_part_headline_part">
               <h3><i class="sl sl-icon-book-open"></i> Add Form Section</h3>
            </div>

            <div class="utf_submit_section">
               <div class="row with-forms">
               <div class="col-md-12" id="fb-add-component-div">
                  <div class="row with-forms">
                  
                   <div class="col-md-6">
                    <h5>Title</h5>
                    <?php echo $__env->make('components.form-validation', ['id' => "fbas-title-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <input type="text" class="input-text" name="fbas-title" id="fbas-title" placeholder="Title">
                   </div>
                   <div class="col-md-6">
                    <h5>Description</h5>
                    <?php echo $__env->make('components.form-validation', ['id' => "fbas-description-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <input type="text" class="input-text" name="fbas-description" id="fbas-description" placeholder="Description">
                   </div>
                  
                  </div>
               </div>

               <div class="col-md-12">
               <?php echo $__env->make('components.generic-loading', ['message' => 'Adding section', 'id' => "fbas-loading"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               <?php echo $__env->make('components.button',[
                     'href' => '#',
                     'id' => 'fbas-btn',
                     'title' => 'Add section',
                     'classes' => 'margin-top-20'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               </div>
               </div>
            </div>
           
          </div>

          <div class="add_utf_listing_section margin-top-45">
            <div class="utf_add_listing_part_headline_part">
               <h3><i class="sl sl-icon-book-open"></i> Add Form Field</h3>
            </div>

            <div class="utf_submit_section">
               <div class="row with-forms">
               <div class="col-md-12" id="fbaf-div">
                  <div class="row with-forms">
                  <div class="col-md-6">
                   <?php echo $__env->make('components.form-validation', ['id' => "fbaf-section-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                   <h5>Section</h5>
                   <select id="fbaf-section" class="selectpicker default" data-selected-text-format="count" data-size="<?php echo e(count($formSections)); ?>"
                    title="Select term" tabindex="-98">
                     <option class="bs-title-option" value="none">Select section</option>
                     <?php
                      foreach($formSections as $fs)
                       {
                     ?>
                       <option value="<?php echo e($fs['id']); ?>"><?php echo e($fs['title']); ?></option>
                     <?php
                       }
                     ?>
                   </select>
                   </div>
                   <div class="col-md-6">
                   <?php echo $__env->make('components.form-validation', ['id' => "fbaf-type-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                   <h5>Field type</h5>
                   <select id="fbaf-type" class="selectpicker default" data-selected-text-format="count" data-size="<?php echo e(count($fieldTypes)); ?>"
                    title="Select term" tabindex="-98">
                     <option class="bs-title-option" value="none">Select field type</option>
                     <?php
                      foreach($fieldTypes as $ft)
                       {
                     ?>
                       <option value="<?php echo e($ft['value']); ?>"><?php echo e($ft['label']); ?></option>
                     <?php
                       }
                     ?>
                   </select>
                   </div>
                   <div class="col-md-6">
                    <h5>Title</h5>
                    <?php echo $__env->make('components.form-validation', ['id' => "fbaf-title-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <input type="text" class="input-text" name="fbaf-title" id="fbaf-title" placeholder="Title">
                   </div>
                   <div class="col-md-6">
                    <h5>Description</h5>
                    <?php echo $__env->make('components.form-validation', ['id' => "fbaf-description-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <input type="text" class="input-text" name="fbaf-description" id="fbaf-description" placeholder="Description">
                   </div>
                   <div class="col-md-6">
                   <h5>Field size (between 1 to 12)</h5>
                    <?php echo $__env->make('components.form-validation', ['id' => "fbaf-bslength-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <input type="number" class="input-text" name="fbaf-bslength" id="fbaf-bslength" placeholder="Field size">
                   </div>
                   <div class="col-md-12" id="options-div">
                   
                    <div class="row">
                      <div class="col-md-12">
                         <h5>Options</h5>
                        <p>Options added:</p>
                         <div id="fbaf-options-list"></div>
                      </div>
                       <div class="col-md-6">
                         <h5>Name</h5>
                          <?php echo $__env->make('components.form-validation', ['id' => "fbaf-add-option-name-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                          <input type="text" class="input-text" id="fbaf-add-option-name" placeholder="Name">
                       </div>
                       <div class="col-md-6">
                         <h5>Value</h5>
                          <?php echo $__env->make('components.form-validation', ['id' => "fbaf-add-option-value-validation",'style' => "margin-top: 10px;"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                          <input type="text" class="input-text" id="fbaf-add-option-value" placeholder="Value">
                       </div>
                       <div class="col-md-12">
                   <?php echo $__env->make('components.button',[
                     'href' => '#',
                     'id' => 'fbaf-add-option-btn',
                     'title' => 'Add option',
                     'classes' => 'margin-top-20'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               </div>
                    </div>
                   </div>
                  </div>
               </div>

               <div class="col-md-12">
                   <?php echo $__env->make('components.button',[
                     'href' => '#',
                     'id' => 'fbaf-btn',
                     'title' => 'Add field',
                     'classes' => 'margin-top-20'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               </div>
               </div>
            </div>
           
          </div>

         
     </div>

     <div class="col-lg-12 col-md-12" id="preview-div">
     <?php echo $__env->make('components.button',[
                     'href' => '#',
                     'id' => 'fb-preview-back-btn',
                     'title' => 'Back to form builder',
                     'classes' => 'margin-top-20'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       <?php
         foreach($formSections as $fs)
         {
           $xf = $fs['id'];
       ?>
        <div class="add_utf_listing_section margin-top-45">
           <div class="utf_add_listing_part_headline_part">
               <h3><i class="sl sl-icon-book-open"></i> <?php echo e($fs['title']); ?></h3>
            </div>
        </div>

        <div class="utf_submit_section">
          <div class="row with-forms">
            <?php
              foreach($fs['form_fields'] as $ff)
              {
            ?>

            <?php
              }
            ?>
          </div>
        </div>
       <?php
         }
       ?>
     </div>
       
    </div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/repos/admissionboox/resources/views/admission-form.blade.php ENDPATH**/ ?>