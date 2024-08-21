<?php
$ac = "reviews";
$useSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"Reviews")

@section('dashboard-styles')
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop

@section('dashboard-scripts')
  <script src="lib/datatables/datatables.min.js"></script>

  <script>

	 const confirmRemoveReview = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            removeSchoolReview(xf,
				      () => {
			       		alert('Review removed!')
					      window.location = 'school-reviews'
				      },
				      (err) => {
				       	alert('Failed to remove review: ',err)
				      }
			       )
           })
        
        }

        const confirmUpdateReview = (data={pid:'',status:''}) => {
            confirmAction(data, 
			    (xf={pid:'',status:''}) => {
            updateSchoolReview(xf.pid,
              xf.status,
				      () => {
			       		alert('Review status removed!')
					      window.location = 'school-reviews'
				      },
				      (err) => {
				       	alert('Failed to update review: ',err)
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
         <h4>Reviews</h4>
         <div class="dashboard-list-box table-responsive invoices with-icons">
            <ul>
         <?php
         if(isset($reviews) && count($reviews) > 0)
               {
                 foreach($reviews as $r)
                 {
                    $rid = $r['id'];
                    $ru = $r['user'];
                    $uname = $ru['fname']." ".$ru['lname'];
                    $su = url('school')."?xf=".$school['url'];
                    $rating = $ru['rating'];
                    $status = $ru['status'];
                    $updateBtnAction = $status === 'pending' ? 'approve' : 'decline';
                    $updateBtnText = $status === 'pending' ? 'Approve' : 'Decline';
              ?>
                <div class="comments utf_listing_reviews dashboard_review_item">
                  <ul>
                    <li>
                      <div class="avatar"><img src="images/profile.png" alt=""></div>
                      <div class="utf_comment_content">
                        <div class="utf_arrow_comment"></div>
                        <div class="utf_by_comment">{{$uname}}
                          <div class="utf_by_comment-listing">on <a href="{{$su}}">{{$school['name']}}</a></div>
                          <span class="date"><i class="fa fa-clock-o"></i> {{$ru['date']}}</span>
                          <span class="date">Status: {{$ru['status']}}</span>
                          <div class="utf_star_rating_section" data-rating="{{$rating}}"></div>
                          <a href="#" class="rate-review popup-with-zoom-anim" onclick="confirmUpdateReview({pid: '{{$rid}}',status:'{{$updateBtnAction}}'});return false;">{{$updateBtnText}}</a>
						  </div>
                        <p>{{$ru['comment']}}</p>						
					  </div>
                    </li>
                  </ul>
                </div>
             <?php
                 }
             }
             else{
             ?>
               
             <?php
             }
             ?>
             </ul>
         </div>
       </div>
     </div>
</div>
      
@stop