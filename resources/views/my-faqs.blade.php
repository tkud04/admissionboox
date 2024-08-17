<?php
$ac = "";
$useSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"FAQs")

@section('dashboard-styles')
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop

@section('dashboard-scripts')
  <script src="lib/datatables/datatables.min.js"></script>

  <script>

	 const confirmRemoveFaq = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            removeFaq(xf,
				      () => {
			       		alert('FAQ removed!')
					      window.location = 'school-faqs'
				      },
				      (err) => {
				       	alert('Failed to remove faq: ',err)
				      }
			       )
           })
        
        }

      

        const hideValidationErrors = () => {
          $('#f-question').hide()
          $('#f-answer').hide()
        }
		
	
  </script>
@stop

@section('dashboard-content')

<div class="row">
   
   <div class="col-lg-12 col-md-12 mb-4">
       <div class="utf_dashboard_list_box table-responsive recent_booking">
         <h4>FAQs</h4>
         <div class="dashboard-list-box table-responsive invoices with-icons">
           <table class="table table-hover admissionboox-table">
             <thead>
               <tr>
                 <th>Question</th>
                 <th>Answer</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>
             <?php
               $faqs = $school['faqs'];
               if(isset($faqs) && count($faqs) > 0)
               {
                 foreach($faqs as $f)
                 {
                    $fid = $f['id'];
                     $vu = url('school-faq')."?xf=".$fid;
              ?>
               <tr>
                 <td>{{$f['faq_question']}}</td>
                 <td>
                     {{$f['faq_answer']}}
                 </td>
                 <td>
                    <a href="{{$vu}}" class="button gray"><i class="fa fa-eye"></i> </a>
                    <a href="#" onclick="confirmRemoveFaq('{{$fid}}'); return false;" class="button gray"><i class="fa fa-trash"></i> </a>
                   
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
      
@stop