<?php
$ac = "admissions";
$useSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"Form Builder - {$admission['session']} Session")

@section('dashboard-styles')
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop

@section('dashboard-scripts')
  <script src="lib/datatables/datatables.min.js"></script>

  <script>
     let fbafOptions = [], fbefOptions = []

     const hideViews = () => {
      $('#preview-div').hide()
          $('#form-section-div').hide()
          $('#form-field-div').hide()
          $('#edit-form-section-div').hide()
          $('#edit-form-field-div').hide()
     }

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
          ret += `<p>Name: <b>${o.name}</b>, Value: <b>${o.value}</b>  <a href="javascript:void 0" onclick="removeFbafOption('${o.id}'); return false;">Remove <i class="fa fa-trash"></i></a></p>`
        }
      }
      $('#fbaf-options-list').html(ret)
     }

     const removeFbefOption = (id) => {
      let ret = []
      if(fbefOptions.length > 0){
        for(const o of fbefOptions){
         if(o.id === id){}
         else{
          ret.push(o)
         }
        }
      }
      fbefOptions = ret
      renderFbefOptions()
     }

     const renderFbefOptions = () => {
       let ret = ``
      if(fbefOptions.length > 0){
        for(const o of fbefOptions){
          ret += `<p>Name: <b>${o.name}</b>, Value: <b>${o.value}</b>  <a href="javascript:void 0" onclick="removeFbefOption('${o.id}'); return false;">Remove <i class="fa fa-trash"></i></a></p>`
        }
      }
      $('#fbef-options-list').html(ret)
     }

     const confirmRemoveFormSection = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            removeFormSection(xf,
				      () => {
			       		alert('Form section removed')
					       window.location = `school-admission-form?xf={{$admission['form_id']}}`
				      },
				      (err) => {
				       	alert('Failed to remove form section: ',err)
				      }
			       )
           })
        
        }

        const confirmRemoveFormField = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            removeFormField(xf,
				      () => {
			       		alert('Form field removed')
					       window.location = `school-admission-form?xf={{$admission['form_id']}}`
				      },
				      (err) => {
				       	alert('Failed to remove form field: ',err)
				      }
			       )
           })
        
        }

	 const clearFbasValidations = () => {
          $('#fbas-title-validation').hide()
          $('#fbas-description-validation').hide()
        }

  const clearFbesValidations = () => {
    $('#fbes-title-validation').hide()
    $('#fbes-description-validation').hide()
  }

        const clearFbafValidations = () => {
          $('#fbaf-title-validation').hide()
          $('#fbaf-description-validation').hide()
        }

        const clearFbefValidations = () => {
          $('#fbef-title-validation').hide()
          $('#fbef-description-validation').hide()
        }

      

    const editFormSection = (sectionId) => {
      hideViews()
      const title = $(`#fbes-${sectionId}-title`).val(), description = $(`#fbes-${sectionId}-description`).val()
      $('#fbes-title').val(title)
      $('#fbes-description').val(description)
      $('#fbes-xf').val(sectionId)
      $('#edit-form-section-div').fadeIn()
    }

    const editFormField = (fieldId) => { 
      hideViews()
      const title = $(`#fbef-${fieldId}-title`).val(), description = $(`#fbef-${fieldId}-description`).val(),
           type = $(`#fbef-${fieldId}-type`).val(), xz = $(`#fbef-${fieldId}-xz`).val(),
           options = $(`#fbef-${fieldId}-options`).val(), bs_length = $(`#fbef-${fieldId}-bs_length`).val()

      $('#fbef-title').val(title)
      $('#fbef-description').val(description)
      $('#fbef-type').selectpicker('val',type)
      $('#fbef-section').selectpicker('val',xz)
      $('#fbef-bslength').val(bs_length)
      $('#fbef-xf').val(fieldId)
      
      const v = type === 'select' || type === 'radio' || type === 'checkbox'

       const parsedOptions = JSON.parse(options)
       console.log('parsed options: ',parsedOptions)
       for(const o of parsedOptions){
        fbefOptions.push(o)
       }
       renderFbefOptions()

      if(v){
        $('#fbef-options-div').fadeIn()
      }
      else{
       $('#fbef-options-div').hide()
      }
      //$('#fbef-xz').val(xz)
      $('#edit-form-field-div').fadeIn()
      goTo('#edit-form-field-div')
    }
    

        $(() => {
		      $('.admissionboox-table').dataTable()
          $('#options-div').hide()

         hideViews()
          $('.selectpicker').selectpicker()
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
            fd.append('form_id',"{{$admission['form_id']}}")
            fd.append('title',fbasTitle)
            fd.append('description',fbasDescription)

            addFormSection(fd,
              (data) => {
                
                $('#fbas-loading').hide()
              $('#fbas-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('Form section added!')
                    window.location = `school-admission-form?xf={{$admission['form_id']}}`
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

      $('#fbes-btn').click((e) => {
        e.preventDefault()
        clearFbesValidations()
        const fbesTitle = $('#fbes-title').val(), fbesDescription = $('#fbes-description').val(),
        v = fbesTitle === '' || fbesDescription === ''

        if(v){
          if(fbesTitle === '') $('#fbes-title-validation').fadeIn()
          if(fbesDescription === '') $('#fbes-description-validation').fadeIn()
        }
        else{
            $('#fbes-btn').hide()
            $('#fbes-loading').fadeIn()
            const fd = new FormData()
            fd.append('xf',$('#fbes-xf').val())
            fd.append('title',fbesTitle)
            fd.append('description',fbesDescription)

            updateFormSection(fd,
              (data) => {
                
                $('#fbes-loading').hide()
              $('#fbes-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('Form section updated!')
                    window.location = `school-admission-form?xf={{$admission['form_id']}}`
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#fbes-loading').hide()
              $('#fbes-btn').fadeIn()
                alert(`Failed to update form section: ${err}`)
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
            fd.append('form_id',"{{$admission['form_id']}}")
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
                    window.location = `school-admission-form?xf={{$admission['form_id']}}`
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

      $('#fbef-type').change(() => {
        const option = $('#fbef-type').val(),
             v = option === 'select' || option === 'radio' || option === 'checkbox'

        if(v){
          $('#fbef-options-div').fadeIn()
        }
        else{
          $('#fbef-options-div').hide()
        }
      })

      $('#fbef-add-option-btn').click((e) => {
        e.preventDefault()
        $('#fbef-add-option-name-validation').hide()
        $('#fbef-add-option-value-validation').hide()

        const name = $('#fbef-add-option-name').val(), value = $('#fbef-add-option-value').val(),
              v = name === '' || value === ''

        if(v){
           if(name === '') $('#fbef-add-option-name-validation').fadeIn()
           if(value === '') $('#fbef-add-option-value-validation').fadeIn()
        }
        else{
          fbefOptions.push({
            id: `option-${fbefOptions.length}`,
            name,
            value
          })
          $('#fbef-add-option-name').val('')
          $('#fbef-add-option-value').val('')
          renderFbefOptions()
        }
      })

      $('#fbef-btn').click((e) => {
        e.preventDefault()
        clearFbefValidations()
        const xf = $('#fbef-xf').val(), fbefTitle = $('#fbef-title').val(), 
              fbefDescription = $('#fbef-description').val(),
              fbefSection = $('#fbef-section').val(), fbefType = $('#fbef-type').val(), 
              fbefBsLength = $('#fbef-bslength').val(),
               v = fbefTitle === '' || fbefDescription === '' || fbefSection === 'none' ||
                   fbefType === 'none' || fbefBsLength === ''

        if(v){
          if(fbefTitle === '') $('#fbef-title-validation').fadeIn()
          if(fbefDescription === '') $('#fbef-description-validation').fadeIn()
          if(fbefSection === 'none') $('#fbef-section-validation').fadeIn()
          if(fbefType === 'none') $('#fbef-type-validation').fadeIn()
          if(fbefBsLength === '') $('#fbef-bslength-validation').fadeIn()
        }
        else{
            $('#fbef-btn').hide()
            $('#fbef-loading').fadeIn()
            const fd = new FormData()
            fd.append('form_id',"{{$admission['form_id']}}")
            fd.append('section_id',fbefSection)
            fd.append('xf',xf)
            fd.append('title',fbefTitle)
            fd.append('description',fbefDescription)
            fd.append('type',fbefType)
            fd.append('bs_length',fbefBsLength)
            fd.append('options',JSON.stringify(fbefOptions))

            updateFormField(fd,
              (data) => {
                
                $('#fbef-loading').hide()
              $('#fbef-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('Form field updated!')
                    window.location = `school-admission-form?xf={{$admission['form_id']}}`
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#fbef-loading').hide()
              $('#fbef-btn').fadeIn()
                alert(`Failed to update form field: ${err}`)
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

      $('#fb-show-form-section-btn').click(e => {
        e.preventDefault()
        $('#form-section-div').fadeIn()
      })

      $('#fb-form-section-back-btn').click(e => {
        e.preventDefault()
        $('#form-section-div').hide()
      })

      $('#fb-edit-form-section-back-btn').click(e => {
        e.preventDefault()
        $('#edit-form-section-div').hide()
      })

      $('#fb-show-form-field-btn').click(e => {
        e.preventDefault()
        $('#form-field-div').fadeIn()
      })
      $('#fb-form-field-back-btn').click(e => {
        e.preventDefault()
        $('#form-field-div').hide()
      })
      $('#fb-edit-form-field-back-btn').click(e => {
        e.preventDefault()
        $('#edit-form-field-div').hide()
      })
    })
		
	
  </script>
@stop

@section('dashboard-content')

<div class="row"> 
     <div class="col-lg-12 col-md-12" id="edit-div">
       <div class="add_utf_listing_section margin-top-45">
            <div class="utf_add_listing_part_headline_part">
               <h3><i class="sl sl-icon-book-open"></i> About Form Builder</h3>
            </div>
            <p>Documentation for the form builder would be displayed here</p>
        </div>

       
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
            <input type="hidden" id="fbes-{{$xf}}-title" value="{{$fs['title']}}">
            <input type="hidden" id="fbes-{{$xf}}-description" value="{{$fs['description']}}">

            <td>Section</td>
            <td>
              <p>Title: {{$fs['title']}}</p>
              <p>Description: {{$fs['description']}}</p>
            </td>
            <td>
              <ul class="list-inline">
                <li><a href="javascript:void 0" onclick="confirmRemoveFormSection('{{$xf}}')">Remove <i class="fa fa-trash"></i></a></li>
                <li><a href="#edit-form-section-div" onclick="editFormSection('{{$xf}}')">Edit <i class="fa fa-pencil"></i></a></li>
              </ul>
            </td>
           </tr>
          <?php
              foreach($fs['form_fields'] as $ff)
              {
                $xy = $ff['id']; $xz = $ff['section_id'];
                $fieldType = null;

                foreach($fieldTypes as $ft)
                {
                  if($ft['value'] === $ff['type'])
                  {
                    $fieldType = $ft;
                  }
                }
          ?>
           <tr>
           <input type="hidden" id="fbef-{{$xy}}-title" value="{{$ff['title']}}">
           <input type="hidden" id="fbef-{{$xy}}-type" value="{{$ff['type']}}">
           <input type="hidden" id="fbef-{{$xy}}-xz" value="{{$xz}}">
           <input type="hidden" id="fbef-{{$xy}}-description" value="{{$ff['description']}}">
           <input type="hidden" id="fbef-{{$xy}}-bs_length" value="{{$ff['bs_length']}}">
           <input type="hidden" id="fbef-{{$xy}}-options" value="{{$ff['options']}}">

             <td>{{$fieldType === null ? 'Unknown' : $fieldType['label']}}</td>
             <td>
              <p>Title: {{$ff['title']}}</p>
              <p>Description: {{$ff['description']}}</p>
            </td>
            <td>
              <ul class="list-inline">
                <li><a href="javascript:void 0" onclick="confirmRemoveFormField('{{$xy}}'); return false;">Remove <i class="fa fa-trash"></i></a></li>
                <li><a href="#edit-form-field-div" onclick="editFormField('{{$xy}}'); return false;">Edit <i class="fa fa-pencil"></i></a></li>
              </ul>
  
              </div>
              
              
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

          <div class="row" >
            <div class="col-md-12" style="margin-bottom: 0;">
            <h4 class="headline_part" style="margin-top: 20px;">What would you like to do?</h4>
            </div>
            <div class="col-md-4">
               @include('components.button',[
                     'href' => '#',
                     'id' => 'fb-preview-btn',
                     'title' => 'Preview form',
                     'classes' => 'margin-top-20'
                    ])
            </div>
            <div class="col-md-4">
               @include('components.button',[
                     'href' => '#',
                     'id' => 'fb-show-form-field-btn',
                     'title' => 'Add form field',
                     'classes' => 'margin-top-20'
                    ])
            </div>
            <div class="col-md-4">
               @include('components.button',[
                     'href' => '#',
                     'id' => 'fb-show-form-section-btn',
                     'title' => 'Add form section',
                     'classes' => 'margin-top-20'
                    ])
            </div>
          </div>

          <div class="add_utf_listing_section margin-top-45" id="form-section-div">
            <div class="utf_add_listing_part_headline_part">
               <h3><i class="sl sl-icon-book-open"></i> Add Form Section</h3>
            </div>

            <div class="utf_submit_section">
               <div class="row with-forms">
               <div class="col-md-12" id="fb-add-component-div">
                  <div class="row with-forms">
                  
                   <div class="col-md-6">
                    <h5>Title</h5>
                    @include('components.form-validation', ['id' => "fbas-title-validation",'style' => "margin-top: 10px;"])
                    <input type="text" class="input-text" name="fbas-title" id="fbas-title" placeholder="Title">
                   </div>
                   <div class="col-md-6">
                    <h5>Description</h5>
                    @include('components.form-validation', ['id' => "fbas-description-validation",'style' => "margin-top: 10px;"])
                    <input type="text" class="input-text" name="fbas-description" id="fbas-description" placeholder="Description">
                   </div>
                  
                  </div>
               </div>

               <div class="col-md-12">
               @include('components.generic-loading', ['message' => 'Adding section', 'id' => "fbas-loading"])
              
               <div class="row">
                <div class="col-md-6">
                  @include('components.button',[
                     'href' => '#',
                     'id' => 'fbas-btn',
                     'title' => 'Add section',
                     'classes' => 'margin-top-20'
                    ])
                </div>
                <div class="col-md-6">
                  @include('components.button',[
                     'href' => '#',
                     'id' => 'fb-form-section-back-btn',
                     'title' => 'Back',
                     'classes' => 'margin-top-20'
                    ])
                </div>

               </div>
              
               </div>
               </div>
            </div>
           
          </div>

          <div class="add_utf_listing_section margin-top-45" id="edit-form-section-div">
            <div class="utf_add_listing_part_headline_part">
               <h3><i class="sl sl-icon-book-open"></i> Edit Form Section</h3>
            </div>
              <input type="hidden" id="fbes-xf" value="">
            <div class="utf_submit_section">
               <div class="row with-forms">
               <div class="col-md-12" id="fb-edit-component-div">
                  <div class="row with-forms">
                  
                   <div class="col-md-6">
                    <h5>Title</h5>
                    @include('components.form-validation', ['id' => "fbes-title-validation",'style' => "margin-top: 10px;"])
                    <input type="text" class="input-text" name="fbes-title" id="fbes-title" placeholder="Title">
                   </div>
                   <div class="col-md-6">
                    <h5>Description</h5>
                    @include('components.form-validation', ['id' => "fbes-description-validation",'style' => "margin-top: 10px;"])
                    <input type="text" class="input-text" name="fbes-description" id="fbes-description" placeholder="Description">
                   </div>
                  
                  </div>
               </div>

               <div class="col-md-12">
               @include('components.generic-loading', ['message' => 'Editing section', 'id' => "fbes-loading"])
              
               <div class="row">
                <div class="col-md-6">
                  @include('components.button',[
                     'href' => '#',
                     'id' => 'fbes-btn',
                     'title' => 'Edit section',
                     'classes' => 'margin-top-20'
                    ])
                </div>
                <div class="col-md-6">
                  @include('components.button',[
                     'href' => '#',
                     'id' => 'fb-edit-form-section-back-btn',
                     'title' => 'Back',
                     'classes' => 'margin-top-20'
                    ])
                </div>

               </div>
              
               </div>
               </div>
            </div>
           
          </div>

          <div class="add_utf_listing_section margin-top-45" id="form-field-div">
            <div class="utf_add_listing_part_headline_part">
               <h3><i class="sl sl-icon-book-open"></i> Add Form Field</h3>
            </div>

            <div class="utf_submit_section">
               <div class="row with-forms">
               <div class="col-md-12" id="fbaf-div">
                  <div class="row with-forms">
                  <div class="col-md-6">
                   @include('components.form-validation', ['id' => "fbaf-section-validation",'style' => "margin-top: 10px;"])
                   <h5>Section</h5>
                   <select id="fbaf-section" class="selectpicker default" data-selected-text-format="count" data-size="{{count($formSections)}}"
                    title="Select term" tabindex="-98">
                     <option class="bs-title-option" value="none">Select section</option>
                     <?php
                      foreach($formSections as $fs)
                       {
                     ?>
                       <option value="{{$fs['id']}}">{{$fs['title']}}</option>
                     <?php
                       }
                     ?>
                   </select>
                   </div>
                   <div class="col-md-6">
                   @include('components.form-validation', ['id' => "fbaf-type-validation",'style' => "margin-top: 10px;"])
                   <h5>Field type</h5>
                   <select id="fbaf-type" class="selectpicker default" data-selected-text-format="count" data-size="{{count($fieldTypes)}}"
                    title="Select term" tabindex="-98">
                     <option class="bs-title-option" value="none">Select field type</option>
                     <?php
                      foreach($fieldTypes as $ft)
                       {
                     ?>
                       <option value="{{$ft['value']}}">{{$ft['label']}}</option>
                     <?php
                       }
                     ?>
                   </select>
                   </div>
                   <div class="col-md-6">
                    <h5>Title</h5>
                    @include('components.form-validation', ['id' => "fbaf-title-validation",'style' => "margin-top: 10px;"])
                    <input type="text" class="input-text" name="fbaf-title" id="fbaf-title" placeholder="Title">
                   </div>
                   <div class="col-md-6">
                    <h5>Description</h5>
                    @include('components.form-validation', ['id' => "fbaf-description-validation",'style' => "margin-top: 10px;"])
                    <input type="text" class="input-text" name="fbaf-description" id="fbaf-description" placeholder="Description">
                   </div>
                   <div class="col-md-6">
                   <h5>Field size (between 1 to 12)</h5>
                    @include('components.form-validation', ['id' => "fbaf-bslength-validation",'style' => "margin-top: 10px;"])
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
                          @include('components.form-validation', ['id' => "fbaf-add-option-name-validation",'style' => "margin-top: 10px;"])
                          <input type="text" class="input-text" id="fbaf-add-option-name" placeholder="Name">
                       </div>
                       <div class="col-md-6">
                         <h5>Value</h5>
                          @include('components.form-validation', ['id' => "fbaf-add-option-value-validation",'style' => "margin-top: 10px;"])
                          <input type="text" class="input-text" id="fbaf-add-option-value" placeholder="Value">
                       </div>
                       <div class="col-md-12">
                   @include('components.button',[
                     'href' => '#',
                     'id' => 'fbaf-add-option-btn',
                     'title' => 'Add option',
                     'classes' => 'margin-top-20'
                    ])
               </div>
                    </div>
                   </div>
                  </div>
               </div>

               <div class="col-md-12">
               <div class="row">
                <div class="col-md-6">
                  @include('components.button',[
                     'href' => '#',
                     'id' => 'fbaf-btn',
                     'title' => 'Add field',
                     'classes' => 'margin-top-20'
                    ])
                </div>
                <div class="col-md-6">
                  @include('components.button',[
                     'href' => '#',
                     'id' => 'fb-form-field-back-btn',
                     'title' => 'Back',
                     'classes' => 'margin-top-20'
                    ])
                </div>

               </div>
               </div>
               </div>
            </div>
           
          </div>

          <div class="add_utf_listing_section margin-top-45" id="edit-form-field-div">
            <div class="utf_add_listing_part_headline_part">
               <h3><i class="sl sl-icon-book-open"></i> Edit Form Field</h3>
            </div>
            <input type="hidden" id="fbef-xf" value="">
            <input type="hidden" id="fbef-xz" value="">

            <div class="utf_submit_section">
               <div class="row with-forms">
               <div class="col-md-12" id="fbef-div">
                  <div class="row with-forms">
                  <div class="col-md-6">
                   @include('components.form-validation', ['id' => "fbef-section-validation",'style' => "margin-top: 10px;"])
                   <h5>Section</h5>
                   <select id="fbef-section" class="selectpicker default" data-selected-text-format="count" data-size="{{count($formSections)}}"
                    title="Select term" tabindex="-98">
                     <option class="bs-title-option" value="none">Select section</option>
                     <?php
                      foreach($formSections as $fs)
                       {
                     ?>
                       <option value="{{$fs['id']}}">{{$fs['title']}}</option>
                     <?php
                       }
                     ?>
                   </select>
                   </div>
                   <div class="col-md-6">
                   @include('components.form-validation', ['id' => "fbef-type-validation",'style' => "margin-top: 10px;"])
                   <h5>Field type</h5>
                   <select id="fbef-type" class="selectpicker default" data-selected-text-format="count" data-size="{{count($fieldTypes)}}"
                    title="Select term" tabindex="-98">
                     <option class="bs-title-option" value="none">Select field type</option>
                     <?php
                      foreach($fieldTypes as $ft)
                       {
                     ?>
                       <option value="{{$ft['value']}}">{{$ft['label']}}</option>
                     <?php
                       }
                     ?>
                   </select>
                   </div>
                   <div class="col-md-6">
                    <h5>Title</h5>
                    @include('components.form-validation', ['id' => "fbef-title-validation",'style' => "margin-top: 10px;"])
                    <input type="text" class="input-text" name="fbef-title" id="fbef-title" placeholder="Title">
                   </div>
                   <div class="col-md-6">
                    <h5>Description</h5>
                    @include('components.form-validation', ['id' => "fbef-description-validation",'style' => "margin-top: 10px;"])
                    <input type="text" class="input-text" name="fbef-description" id="fbef-description" placeholder="Description">
                   </div>
                   <div class="col-md-6">
                   <h5>Field size (between 1 to 12)</h5>
                    @include('components.form-validation', ['id' => "fbef-bslength-validation",'style' => "margin-top: 10px;"])
                    <input type="number" class="input-text" name="fbef-bslength" id="fbef-bslength" placeholder="Field size">
                   </div>
                   <div class="col-md-12" id="fbef-options-div">
                   
                    <div class="row">
                      <div class="col-md-12">
                         <h5>Options</h5>
                        <p>Options added:</p>
                         <div id="fbef-options-list"></div>
                      </div>
                       <div class="col-md-6">
                         <h5>Name</h5>
                          @include('components.form-validation', ['id' => "fbef-add-option-name-validation",'style' => "margin-top: 10px;"])
                          <input type="text" class="input-text" id="fbef-add-option-name" placeholder="Name">
                       </div>
                       <div class="col-md-6">
                         <h5>Value</h5>
                          @include('components.form-validation', ['id' => "fbef-add-option-value-validation",'style' => "margin-top: 10px;"])
                          <input type="text" class="input-text" id="fbef-add-option-value" placeholder="Value">
                       </div>
                       <div class="col-md-12">
                   @include('components.button',[
                     'href' => '#',
                     'id' => 'fbef-add-option-btn',
                     'title' => 'Add option',
                     'classes' => 'margin-top-20'
                    ])
               </div>
                    </div>
                   </div>
                  </div>
               </div>

               <div class="col-md-12">
               <div class="row">
                <div class="col-md-6">
                  @include('components.button',[
                     'href' => '#',
                     'id' => 'fbef-btn',
                     'title' => 'Update field',
                     'classes' => 'margin-top-20'
                    ])
                </div>
                <div class="col-md-6">
                  @include('components.button',[
                     'href' => '#',
                     'id' => 'fb-edit-form-field-back-btn',
                     'title' => 'Back',
                     'classes' => 'margin-top-20'
                    ])
                </div>

               </div>
               </div>
               </div>
            </div>
           
          </div>

         
     </div>

     <div class="col-lg-12 col-md-12" id="preview-div">
     @include('components.button',[
                     'href' => '#',
                     'id' => 'fb-preview-back-btn',
                     'title' => 'Back to form builder',
                     'classes' => 'margin-top-20'
                    ])
       <?php
         foreach($formSections as $fs)
         {
           $xf = $fs['id'];
       ?>
        <div class="add_utf_listing_section margin-top-45">
           <div class="utf_add_listing_part_headline_part">
               <h3><i class="sl sl-icon-book-open"></i> {{$fs['title']}}</h3>
            </div>

            <div class="utf_submit_section">
          <div class="row with-forms">

            <?php
              foreach($fs['form_fields'] as $ff)
              {
                $fieldId = $ff['id'];
                $fieldType = $ff['type'];
                $fieldHTML = $ff['ui'];
                $fieldBsLength = $ff['bs_length'];

               if($fieldType === 'select')
                {
                  $fieldOptions = json_decode($ff['options']);
                  
               ?>
                 <div class="col-md-{{$fieldBsLength}}">
                   @include('components.form-validation', ['class' => "fbld-validation",'style' => "margin-top: 10px;"])
                   <h5>{{$ff['title']}}</h5>
                   <select class="selectpicker default" data-selected-text-format="count" title="Select term" tabindex="-98">
                     <option class="bs-title-option" value="none">Select an option</option>
                     <?php
                      foreach($fieldOptions as $fo)
                       {
                        $foName = $fo->name;
                        $foValue = $fo->value;
                     ?>
                       <option value="{{$foValue}}">{{$foName}}</option>
                     <?php
                       }
                     ?>
                   </select>
                   </div>
               <?php
                }
                else if($fieldType === 'checkbox')
                {
                ?>
                <div class="col-md-{{$fieldBsLength}}">
                   @include('components.form-validation', ['class' => "fbld-validation",'style' => "margin-top: 10px;"])
                   <h5>{{$ff['title']}}</h5>
                   
                  <div class="checkboxes in-row amenities_checkbox">
                   <ul>
                   <?php
                   foreach($fieldOptions as $fo)
                   {
                    $foName = $fo->name;
                        $foValue = $fo->value;
                   ?>
                    <li>
                     <input id="fbld-checkbox-{{$fieldId}}" class="fbld-checkbox-{{$fieldId}}" type="checkbox" data-value="{{$foValue}}">
                     <label >{{$foName}}</label>
                    </li>
                   <?php
                   }
                  ?>
                  </ul>
                 </div>
                 </div>
                <?php
                }
                else if($fieldType === 'radio')
                {
                ?>
                <div class="col-md-{{$fieldBsLength}}">
                   @include('components.form-validation', ['class' => "fbld-validation",'style' => "margin-top: 10px;"])
                   <h5>{{$ff['title']}}</h5>
                   
                  <div class="checkboxes in-row amenities_checkbox">
                   <ul>
                   <?php
                   foreach($fieldOptions as $fo)
                   {
                    $foName = $fo->name;
                        $foValue = $fo->value;
                   ?>
                    <li>
                     <input id="fbld-radio-{{$fieldId}}" class="fbld-checkbox-{{$fieldId}}" type="checkbox" data-value="{{$foValue}}">
                     <label for="fbld-radio-{{$fieldId}}">{{$foName}}</label>
                    </li>
                   <?php
                   }
                  ?>
                  </ul>
                 </div>
                 </div>
                <?php
                }
                else
                {
                ?>
                {!! $fieldHTML !!}
              <?php
                }
              }
            ?>
          </div>
        </div>
        </div>

       
       <?php
         }
       ?>
     </div>
       
    </div>
      
@stop