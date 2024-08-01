<?php
$ac = "classes";
$useSidebar = true;
?>
@extends('dashboard_layout')

@section('dashboard-title',"Classes")

@section('dashboard-styles')
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
@stop

@section('dashboard-scripts')
  <script src="lib/datatables/datatables.min.js"></script>

  <script>

	 const confirmDeleteClass = (pid) => {
            confirmAction(pid, 
			    (xf) => {
            removeSchoolClass(xf,
				      () => {
			       		alert('Class removed')
					      window.location = 'classes'
				      },
				      (err) => {
				       	alert('Failed to remove class: ',err)
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
			   
            <h4><i class="sl sl-icon-list"></i> Classes</h4>
            <ul>
              <?php
               if(count($schoolClasses) > 0)
               {
                  foreach($schoolClasses as $c)
                  {
                    $xf = $c['id'];

              ?>
                    <li>
                      <i style="margin-right: 10px; font-size: 40px;" class="fa fa-school"></i> {{$c['class_name']}}
                      <div style="margin-left: 20px;">
                         <a href="#" onclick="confirmDeleteClass('{{$xf}}'); return false;"><i class="fa fa-trash"></i></a>
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
                   There are no classes on record.
                </p>

                <div class="text-center" style="margin-top: 10px;">
                  @include('components.button',[
                     'href' => url('add-school-class'),
                     'title' => 'Add new class',
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
         
        </div>
       
      </div>
      
@stop