<?php
$ac = "email";
$useSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"Send Email")

@section('dashboard-styles')
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop

@section('dashboard-scripts')
  <script src="lib/datatables/datatables.min.js"></script>

  <script>

  

	 const clearValidations = () => {
          $('#se-admission-validation').hide()
          $('#se-type-validation').hide()
        }


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
            window.location = `send-email?xf1=${admissionId}&xf2=${emailType}`
         }         
      })
    
    })
		
	
  </script>
@stop


@section('dashboard-content')

<div class="row"> 
     <div class="col-lg-12 col-md-12" id="send-email-div-1">
       <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
             <h3><i class="sl sl-icon-book-open"></i> Get Audience</h3>
          </div>

          <div class="utf_submit_section">
             <div class="row with-forms">
                 <div class="col-md-6">
                     @include('components.form-validation', ['id' => "se-admission-validation",'style' => "margin-top: 10px;"])
                     <h5>Admission</h5>
                     <select id="se-admission" class="selectpicker default" data-selected-text-format="count" data-size="{{count($schoolAdmissions)}}" title="Select session" tabindex="-98">
                     <option class="bs-title-option" value="none">Select admission</option>
                     <?php
                      foreach($schoolAdmissions as $a)
                       {
                     ?>
                       <option value="{{$a['id']}}">{{$a['session']}} session</option>
                     <?php
                       }
                     ?>
                    </select>
                 </div>

                 <div class="col-md-6">
                     @include('components.form-validation', ['id' => "se-type-validation",'style' => "margin-top: 10px;"])
                     <h5>Type</h5>
                     <select id="se-type" class="selectpicker default" data-selected-text-format="count" data-size="2" title="Select session" tabindex="-98">
                     <option class="bs-title-option" value="none">Email type</option>
                     <?php
                     $typpes = [
                        ['value' => 'single', 'label' => "Send email to one applicant"],
                        ['value' => 'group', 'label' => "Send email to applicant group"],
                     ];
                      foreach($typpes as $t)
                       {
                     ?>
                       <option value="{{$t['value']}}">{{$t['label']}}</option>
                     <?php
                       }
                     ?>
                    </select>
                 </div>

                 <div class="col-md-12">
                   @include('components.button',[
                     'href' => '#',
                     'id' => 'se-btn-1',
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