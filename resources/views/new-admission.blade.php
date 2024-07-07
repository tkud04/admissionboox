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
          $('#na-duration-validation').hide()
        }

    $(document).ready(() =>{
      $('#na-btn').click((e) => {
        e.preventDefault()
        clearValidations()
         const naSession = $('#na-session').val(), naTerm = $('#na-term').val(),
         naClass = $('#na-class').val(), naDuration = $('#na-duration').val()
         //console.log({naSession,naTerm,naClass,naDuration})

         const v = naSession === 'none' || naTerm === 'none' || naClass === 'none' || naDuration === ''

         if(v){
           if(naSession === 'none') $('#na-session-validation').fadeIn()
           if(naTerm === 'none') $('#na-term-validation').fadeIn()
           if(naClass === 'none') $('#na-class-validation').fadeIn()
           if(naDuration === '') $('#na-duration-validation').fadeIn()
         }
         else{

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
                 @include('components.form-validation', ['id' => "na-class-validation",'style' => "margin-top: 10px;"])
                 <h5>Classes Available</h5>
                 <select id="na-class" class="selectpicker default" data-selected-text-format="count" data-size="{{count($schoolClasses)}}"
                    title="Select State" tabindex="-98">
                     <option class="bs-title-option" value="none">Select class</option>
                     <?php
                      foreach($schoolClasses as $c)
                       {
                     ?>
                       <option value="{{$c['id']}}">{{$c['class_name']}}</option>
                     <?php
                       }
                     ?>
                 </select>
               </div>
              
               <div class="col-md-6">
                 @include('components.form-validation', ['id' => "na-duration-validation",'style' => "margin-top: 10px;"])
                 <h5>Duration</h5>
                 <input type="date" class="input-text" name="address" id="na-duration">
               </div>

               <div class="col-md-12">
                   @include('components.button',[
                     'href' => '#',
                     'id' => 'na-btn',
                     'title' => 'Next',
                     'classes' => 'margin-top-20'
                    ])
               </div>
           
            </div>
          </div>
          </div>
     </div>
       
</div>
      
@stop