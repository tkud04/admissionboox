<?php
$ac = "admissions";
$useSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"New Admission Session")

@section('dashboard-styles')
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop

@section('dashboard-scripts')
  <script src="lib/datatables/datatables.min.js"></script>

  <script>

	 const clearValidations = () => {
          $('#na-session-validation').hide()
          $('#na-term-validation').hide()
          $('#na-class-validation').hide()
          $('#na-end-date-validation').hide()
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
              fd.append('xf',"{{$school['id']}}")
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
@stop

@section('dashboard-content')

<div class="row"> 
     <div class="col-lg-12 col-md-12">
       <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
             <h3><i class="sl sl-icon-book-open"></i> Basic Information</h3>
          </div>
       
        <div class="utf_submit_section">
          <div class="row with-forms">
               <div class="col-md-6">
                 @include('components.form-validation', ['id' => "na-session-validation",'style' => "margin-top: 10px;"])
                 <h5>Admission Session</h5>
                 <select id="na-session" class="selectpicker default" data-selected-text-format="count" data-size="{{count($availableSessions)}}"
                    title="Select session" tabindex="-98">
                     <option class="bs-title-option" value="none">Select session</option>
                     <?php
                      foreach($availableSessions as $s)
                       {
                     ?>
                       <option value="{{$s}}">{{$s}} session</option>
                     <?php
                       }
                     ?>
                 </select>
               </div>
               <div class="col-md-6">
                 @include('components.form-validation', ['id' => "na-term-validation",'style' => "margin-top: 10px;"])
                 <h5>Admission Term</h5>
                 <select id="na-term" class="selectpicker default" data-selected-text-format="count" data-size="{{count($terms)}}"
                    title="Select term" tabindex="-98">
                     <option class="bs-title-option" value="none">Select term</option>
                     <?php
                      foreach($terms as $t)
                       {
                     ?>
                       <option value="{{$t['value']}}">{{$t['name']}}</option>
                     <?php
                       }
                     ?>
                 </select>
               </div>
               <div class="col-md-6">
                 @include('components.form-validation', ['id' => "na-class-validation",'style' => "margin-top: 10px;",'message' => 'Select at least 1 class'])
                 <h5>Classes Available</h5>
                 <div class="checkboxes in-row amenities_checkbox">
          <ul>
            <?php
             for ($i = 0; $i < count($schoolClasses); $i++) {
               $class = $schoolClasses[$i];     
            ?>
              <li>
               <input id="check-class-{{$i}}" type="checkbox" class="na-classes" data-value="{{$class['id']}}">
               <label for="check-class-{{$i}}">
               {{$class['class_name']}}</label>
              </li>
            <?php
           }
            ?>
          </ul>
          </div>
               </div>
              
               <div class="col-md-6">
                 @include('components.form-validation', ['id' => "na-end-date-validation",'style' => "margin-top: 10px;"])
                 <h5>End Date</h5>
                 <input type="date" class="input-text" name="address" id="na-end-date">
               </div>

               <div class="col-md-12">
               @include('components.generic-loading', ['message' => 'Creating admission session', 'id' => "na-loading"])
                   @include('components.button',[
                     'href' => '#',
                     'id' => 'na-btn',
                     'title' => 'Submit',
                     'classes' => 'margin-top-20'
                    ])
               </div>
           
            </div>
          </div>
          </div>
     </div>
       
</div>
      
@stop