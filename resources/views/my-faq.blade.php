<?php
$ac = "";
$useSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"Edit FAQ")

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
              
              const payload = {
                id: $('#xf').val(),
                question: q,
                answer: a 
              }
              
              updateSchoolFaq(payload,
              (data) => {
                
                $('#fa-loading').hide()
              $('#fa-btn').fadeIn()

                if(data.status === 'ok'){
                    alert('FAQ Updated!')
                    window.location = 'school-faqs'
                }
                else if(data.status === 'error'){
                   handleResponseError(data)
                }
              },
              (err) => {
                $('#fa-loading').hide()
                $('#fa-btn').fadeIn()
                alert(`Failed to update faq: ${err}`)
              }
            )
        }
      })
    })
		
	
  </script>
@stop

@section('dashboard-content')
<?php
$fid = $faq['id'];
$question = $faq['faq_question'];
$answer = $faq['faq_answer'];
?>

<div class="row"> 
     <div class="col-lg-12 col-md-12">
       <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
             <h3><i class="sl sl-icon-book-open"></i>Edit FAQ</h3>
          </div>

          <div class="utf_submit_section">
          <div class="row with-forms">
            <input type="hidden" id="xf" value="{{$fid}}"/>
               
               <div class="col-md-6">
                 @include('components.form-validation', ['id' => "fa-question-validation"])
                 <h5>Question</h5>
                 <input type="text" class="input-text" id="fa-question" value="{{$question}}">
               </div>

               <div class="col-md-6">
                 @include('components.form-validation', ['id' => "fa-answer-validation"])
                 <h5>Answer</h5>
                 <input type="text" class="input-text" id="fa-answer" value="{{$answer}}">
               </div>


               <div class="col-md-12">
                  @include('components.generic-loading', ['message' => 'Processing', 'id' => "fa-loading"])
                  @include('components.button',[
                     'href' => '#',
                     'title' => 'Submit',
                     'classes' => 'margin-top-20',
                     'id' => 'fa-btn'
                    ])
               </div>
           
            </div>
          </div>
        </div>
        
     </div>
       
</div>
      
@stop