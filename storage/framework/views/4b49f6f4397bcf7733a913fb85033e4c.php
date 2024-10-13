<?php
$ac = "admissions";
$useSidebar = true;
?>


<?php $__env->startSection('dashboard-title',"Admissions"); ?>

<?php $__env->startSection('dashboard-styles'); ?>
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-scripts'); ?>
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
    const viewApplicants = (xf) => {
      window.location = `school-applications?xf=${xf}&page=1`
    }

    $(document).ready(() =>{
      $('#sort-select').change(() => {
         const val = $('#sort-select').val()

         console.log('status to be sorted: ',val)
      })
    })
		
	
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-content'); ?>

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


                    $fee = $a['application_fee'] === '' ? '0' : $a['application_fee'];
                    $apct = count($a['applications']); $apctText = $apct === 1 ? 'Applicant' : 'Applicants';

              ?>
                    <li>
                      <div class="utf_list_box_listing_item">
                        <div class="utf_list_box_listing_item-img"><a href="<?php echo e($vu); ?>"><img src="<?php echo e($school['logo']); ?>" alt=""></a></div>
                        <div class="utf_list_box_listing_item_content">
                          <div class="inner">
                            <h3><a href="<?php echo e($vu); ?>"><?php echo e($a['session']); ?> Session</a></h3>
				                	  <span><i class="im im-icon-Calendar"></i> <?php echo e($term['name']); ?> </span> 
				                	  <span><i class="im im-icon-Building"></i> <?php echo e($classesString); ?> </span> 
                            <span><i class="im im-icon-Timer-2"></i> <?php echo e($a['date']); ?> to <?php echo e($a['end_date_formatted']); ?></span>
					                  <span><i class="im im-icon-Folders"></i> <?php echo e($apct); ?> <?php echo e($apctText); ?></span>
					                  <span><i class="im im-icon-Mail-Money"></i> Application fee: &#8358;<?php echo e(number_format($fee,2)); ?></span>
					                  <span><i class="im im-icon-Mail-Money"></i> Status: <?php echo e(ucwords($a['status'])); ?></span>
					            
                           <!-- 
                            <div class="utf_star_rating_section" data-rating="4.5">
							                <div class="utf_counter_star_rating">(4.5)</div>							
						                    <span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star half"></span>
                             </div>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.</p>
                             -->
						                   
                           </div>
                        </div>
                      </div>
                      <div class="buttons-to-right"> 
					            <?php if($a['status'] !== 'expired'): ?>  <a href="<?php echo e($vu); ?>" class="button gray"><i class="fa fa-pencil"></i> Edit</a>  <?php endif; ?>
                      <a href="#" onclick="confirmDeleteAdmission('<?php echo e($xf); ?>'); return false;" class="button gray"><i class="fa fa-trash-o"></i> Remove</a> 
                      <a href="#" onclick="viewApplicants('<?php echo e($xf); ?>'); return false;" class="button gray"><i class="fa fa-graduation-cap"></i> View <?php echo e($apctText); ?></a> 

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
                  <?php echo $__env->make('components.button',[
                     'href' => url('add-school-admission'),
                     'title' => 'Add new Admission',
                     'classes' => 'margin-top-20'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
               </div>
                
              <?php
               }
              ?>
            
             
            </ul>
          </div>
		      <div class="clearfix"></div>
          <?php if(count($admissions) > 0): ?>
            <?php echo $__env->make('components.pagination',[
              'url' => "school-admissions?xf=".$xf,
              'currentPage' => $currentPage,
              'numPages' => $numPages,
              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endif; ?>
        </div>
       
      </div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/my-admissions.blade.php ENDPATH**/ ?>