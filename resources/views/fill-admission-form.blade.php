<?php
$ac = "admissions";
$useSidebar = true;
$admission = $applicant['admission'];

$titleDescription = $school['name']." | ".$admission['session']. " session";
?>
@extends('dashboard_layout')

@section('dashboard-title',"Application Form - {$admission['session']} Session")

@section('dashboard-styles')
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop

@section('dashboard-scripts')
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
          $('#form-section-div').hide()
          $('#form-field-div').hide()

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

     
    })
		
	
  </script>
@stop

@section('dashboard-content')

<div class="row"> 
    
<div class="add_utf_listing_section margin-top-45">
            <div class="utf_add_listing_part_headline_part">
               <h3><i class="sl sl-icon-book-open"></i> Application Form</h3>
            </div>
            <p>{{$titleDescription}}</p>
        </div>

     <div class="col-lg-12 col-md-12" id="form-div">
    
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