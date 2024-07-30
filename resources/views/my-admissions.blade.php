<?php
$ac = "admissions";
$useSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"Admissions")

@section('dashboard-styles')
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop

@section('dashboard-scripts')
  <script src="lib/datatables/datatables.min.js"></script>

  <script>

	 const confirmDeleteAdmission = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            removeAdmissionSession(xf,
				      () => {
			       		alert('Admission removed')
					      window.location = 'school-admissions'
				      },
				      (err) => {
				       	alert('Failed to remove admission: ',err)
				      }
			       )
           })
        
        }

    $(document).ready(() =>{
      $('#sort-select').change(() => {
         const val = $('#sort-select').val()

         console.log('status to be sorted: ',val)
      })
    })
		
	
  </script>
@stop

@section('dashboard-content')

<div class="row"> 
        <div class="col-lg-12 col-md-12">
          <div class="utf_dashboard_list_box margin-top-0">
			     <div class="sort-by my_sort_by">
           <div class="utf_sort_by_select_item">
                  <select data-placeholder="Items per page" class="utf_chosen_select_single" style="display: none;" id="items-select">
                    <option>7 items per page</option>
                  </select>
                  
                </div>
                <div class="utf_sort_by_select_item" style="margin-right: 10px;">
                  <select data-placeholder="All admissions" class="utf_chosen_select_single" style="display: none;" id="admissions-select">
                    <option>All admissions</option>
                  </select>
                  
                </div>
                
            </div>
            <h4><i class="sl sl-icon-list"></i> Admissions</h4>
            <ul>
              <?php
               if(count($admissions) > 0)
               {
                  foreach($admissions as $a)
                  {
                    $xf = $a['id'];
                    $vu = url('school-admission')."?xf={$xf}";
                    $term = ['name' => "", 'value' => '0'];
                    $classesString = "";

                    for($i = 0; $i < count($a['classes']); $i++)
                    {
                      $ac = $a['classes'][$i]; $acClass = $ac['class'];
                      $classesString .= $acClass['class_name'];

                      if($i < count($a['classes']) - 1) $classesString .= ", ";
                    }
                    foreach($terms as $t)
                    {
                      if($t['value'] === $a['term_id']) $term = $t;
                    }

              ?>
                    <li>
                      <div class="utf_list_box_listing_item">
                        <div class="utf_list_box_listing_item-img"><a href="{{$vu}}"><img src="{{$school['logo']}}" alt=""></a></div>
                        <div class="utf_list_box_listing_item_content">
                          <div class="inner">
                            <h3><a href="{{$vu}}">{{$a['session']}} Session</a></h3>
				                	  <span><i class="im im-icon-Calendar"></i> {{$term['name']}} </span> 
				                	  <span><i class="im im-icon-Building"></i> {{$classesString}} </span> 
                            <span><i class="im im-icon-Timer-2"></i> {{$a['end_date_formatted']}}</span>
					                  <span><i class="im im-icon-Folders"></i> {{count($a['applications'])}} applications</span>
					            
                           <!-- 
                            <div class="utf_star_rating_section" data-rating="4.5">
							                <div class="utf_counter_star_rating">(4.5)</div>							
						                    <span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star half"></span>
                             </div>
                             -->
						                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.</p>
                           </div>
                        </div>
                      </div>
                      <div class="buttons-to-right"> 
					              <a href="{{$vu}}" class="button gray"><i class="fa fa-pencil"></i> Edit</a> 
					              <a href="#" onclick="confirmDeleteAdmission('{{$xf}}'); return false;" class="button gray"><i class="fa fa-trash-o"></i> Remove</a> 
				              </div>
                   </li>
              <?php
                  }
             
               }
               else
               {
              ?>
               <div style="margin-top: 60px;">
              <p class="text-center"><i class="im im-icon-Student-Hat" style="font-size: 200px;"></i></p>
               <p class="text-center">
                   There are no admissions on record.
                </p>

                <div class="text-center" style="margin-top: 10px;">
                  @include('components.button',[
                     'href' => url('add-school-admission'),
                     'title' => 'Add new Admission',
                     'classes' => 'margin-top-20'
                    ])
                </div>
               </div>
                
              <?php
               }
              ?>
            
             
            </ul>
          </div>
		      <div class="clearfix"></div>
          @if(count($admissions) > 0)
            @include('components.pagination',[
              'url' => "school-admissions",
              'currentPage' => $currentPage,
              'numPages' => $numPages,
              ])
          @endif
        </div>
       
      </div>
      
@stop