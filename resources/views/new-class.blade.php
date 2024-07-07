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
    $('#ac-name-validation').hide()
    $('#ac-value-validation').hide()
   }

    $(document).ready(() =>{
      $('#ac-name').change(() => {
         const val = $('#ac-name').val()
         let slug = ''


               if(val.length > 0){
                 let trimmedTitle = val.replace(/["']/g,"").toLowerCase()
                 const titleArr = trimmedTitle.split(' ')

                 if(titleArr.length > 1){
                    slug = titleArr[0]

                    for(let i = 1; i < titleArr.length; i++){
                        slug += `-${titleArr[i]}`
                    }
                 }
               }
               
               $('#ac-value').val(slug)
      })

      $('#ac-btn').click((e) => {
         e.preventDefault()
         clearValidations()
         const name = $('#ac-name').val(), value = $('#ac-value').val(),
               v = name === '' || value === ''
        
        if(v){
          if(name === '') $('#ac-name-validation').fadeIn()
          if(value === '') $('#ac-value-validation').fadeIn()
        }
        else{
          $('#ac-btn').hide()
              $('#ac-loading').fadeIn()
              
              const fd = new FormData()
              fd.append('class_name',name)
              fd.append('class_value',value)
              addSchoolClass(fd,
              (data) => {
                
                $('#ac-loading').hide()
              $('#ac-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('Class Added!')
                    window.location = 'school-classes'
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#ac-loading').hide()
                $('#ac-btn').fadeIn()
                alert(`Failed to add class: ${err}`)
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
                 @include('components.form-validation', ['id' => "ac-name-validation"])
                 <h5>Name</h5>
                 <input type="text" class="input-text" name="address" id="ac-name">
               </div>

               <div class="col-md-6">
                 @include('components.form-validation', ['id' => "ac-value-validation"])
                 <h5>Value</h5>
                 <input type="text" class="input-text" name="value" id="ac-value">
               </div>


               <div class="col-md-12">
                  @include('components.generic-loading', ['message' => 'Processing', 'id' => "ac-loading"])
                  @include('components.button',[
                     'href' => '#',
                     'title' => 'Add new class',
                     'classes' => 'margin-top-20',
                     'id' => 'ac-btn'
                    ])
               </div>
           
            </div>
          </div>
        </div>
        
     </div>
       
</div>
      
@stop