<?php
$ac = "admissions";
$useSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"New Form - {$admission['session']} Session")

@section('dashboard-styles')
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop

@section('dashboard-scripts')
  <script src="lib/datatables/datatables.min.js"></script>

  <script>
     const formPayload = []

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
	    })

    $(() =>{
      $('#fbas-btn').click((e) => {
        e.preventDefault()
        clearFbasValidations()
        const fbasTitle = $().val()
      })

      $('#fbaf-btn').click((e) => {
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
              fd.append('xf',"{{$admission['id']}}")
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
                    window.location = `school-admission?xf={{$admission['id']}}`
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
    })
		
	
  </script>
@stop

@section('dashboard-content')

<div class="row"> 
     <div class="col-lg-12 col-md-12">
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
				<tbody id="fb-components-tbody"></tbody>
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
                   @include('components.button',[
                     'href' => '#',
                     'id' => 'fbas-btn',
                     'title' => 'Add section',
                     'classes' => 'margin-top-20'
                    ])
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
                 
                   <div class="col-md-6" id="fbaf-field-type-div">
                   @include('components.form-validation', ['id' => "fbaf-field-type-validation",'style' => "margin-top: 10px;"])
                   <h5>Field type</h5>
                   <select id="fbaf-field-type" class="selectpicker default" data-selected-text-format="count" data-size="{{count($fieldTypes)}}"
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
                  </div>
               </div>

               <div class="col-md-12">
                   @include('components.button',[
                     'href' => '#',
                     'id' => 'fbaf-btn',
                     'title' => 'Add field',
                     'classes' => 'margin-top-20'
                    ])
               </div>
               </div>
            </div>
           
          </div>

          @include('components.button',[
                     'href' => '#',
                     'id' => 'fb-preview-btn',
                     'title' => 'Preview form',
                     'classes' => 'margin-top-20'
                    ])
     </div>
       
</div>
      
@stop