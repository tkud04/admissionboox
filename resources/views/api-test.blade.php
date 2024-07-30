<?php
$ac = "admissions";
$useSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"API Tester")

@section('dashboard-styles')
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop

@section('dashboard-scripts')
  <script src="lib/datatables/datatables.min.js"></script>

  <script>

	 const clearValidations = () => {
          $('#at-url-validation').hide()
          $('#at-method-validation').hide()
          $('#at-params-validation').hide()
          $('#at-data-validation').hide()
        }

       

    $(document).ready(() =>{
      $('#at-btn').click((e) => {
        e.preventDefault()
        clearValidations()
         const url = $('#at-url').val(), method = $('#at-method').val(),
         params = $('#at-params'), data = $('#at-data').val()
         
         //console.log({naSession,naTerm,naClass,naEndDate})

         const v = url === '' || method === 'none'

         if(v){
           if(url === 'none') $('#at-url-validation').fadeIn()
           if(method === 'none') $('#at-method-validation').fadeIn()
         }
         else{
            const v2 = (method === 'get' && params === '') || (method === 'post' && data === '') 
            if(v2){
              if(method === 'get' && params === '') $('#at-params-validation').fadeIn()
              if(method === 'post' && data === '') $('#at-data-validation').fadeIn()
            }
            else{

            }
          $('#at-btn').hide()
          $('#at-loading').fadeIn()
          const classValues = []
          naClasses.each((i,elem) => {
            classValues.push(elem.getAttribute('data-value'))
           })
           const fd = new FormData()
              fd.append('xf',"{{$admission['form_id']}}")
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

      $('#df-btn').click((e) => {
        e.preventDefault()
        confirmDeployForm("{{$admission['form_id']}}")
      })
    })
		
	
  </script>
@stop

@section('dashboard-content')
<?php
$methods = [
    ['label' => "GET",'value' => "get"],
    ['label' => "POST",'value' => "post"],
    ['label' => "PUT",'value' => "put"],
   ];
?>
<div class="row"> 
     <div class="col-lg-12 col-md-12">
       <div class="add_utf_listing_section margin-top-45">
          <div class="utf_add_listing_part_headline_part">
             <h3><i class="sl sl-icon-book-open"></i> API Tester</h3>
          </div>
       
         <div class="utf_submit_section">
          <div class="row with-forms">
               <div class="col-md-6">
                 @include('components.form-validation', ['id' => "at-url-validation",'style' => "margin-top: 10px;"])
                 <h5>URL</h5>
                 <input type="text" class="input-text" id="at-url" placeholder="Enter URL"/>
               </div>
               <div class="col-md-6">
                 @include('components.form-validation', ['id' => "at-method-validation",'style' => "margin-top: 10px;"])
                 <h5>Select method</h5>
                 <select id="at-method" class="selectpicker default" data-selected-text-format="count" data-size="{{count($methods}}"
                    title="Select method" tabindex="-98">
                     <option class="bs-title-option" value="none">Select an option</option>
                     <?php
                     
                      foreach($methods as $m)
                       {
                       
                     ?>
                       <option value="{{$m['value']}}">{{$m['name']}}</option>
                     <?php
                       }
                     ?>
                 </select>
               </div>
               
               <div class="col-md-6">
                 @include('components.form-validation', ['id' => "at-params-validation",'style' => "margin-top: 10px;"])
                 <h5>GET Params</h5>
                 <textarea class="input-text" id="at-params" rows="8" placeholder="key1=value1,key2=value2..."></textarea>
               </div>

               <div class="col-md-6">
                 @include('components.form-validation', ['id' => "at-data-validation",'style' => "margin-top: 10px;"])
                 <h5>POST data</h5>
                 <textarea class="input-text" id="at-data" rows="8" placeholder="key1=value1,key2=value2..."></textarea>
               </div>
              
              

               <div class="col-md-12">
               @include('components.generic-loading', ['message' => 'Testing API', 'id' => "at-loading"])
                   @include('components.button',[
                     'href' => '#',
                     'id' => 'at-btn',
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