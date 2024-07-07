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
            removeAdmission(xf,
				      () => {
			       		alert('Admission removed')
					      window.location = 'admissions'
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('dashboard-content'); ?>

<div class="row"> 
        <div class="col-lg-12 col-md-12">
          <div class="utf_dashboard_list_box margin-top-0">
			     <div class="sort-by my_sort_by">
                <div class="utf_sort_by_select_item">
                  <select data-placeholder="Default Listing" class="utf_chosen_select_single" style="display: none;" id="sort-select">
                    <option>Default Listing</option>
				            <option>Active Listing</option>
				            <option>Pending Listing</option>
                    <option>Expired Listing</option>
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

              ?>
                    <li>
                      <div class="utf_list_box_listing_item">
                        <div class="utf_list_box_listing_item-img"><a href="#"><img src="images/utf_listing_item-01.jpg" alt=""></a></div>
                        <div class="utf_list_box_listing_item_content">
                          <div class="inner">
                            <h3>Chontaduro Barcelona</h3>
				                	  <span><i class="im im-icon-Hotel"></i> Hotels</span> 
                            <span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
					                  <span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>
					            
                            <div class="utf_star_rating_section" data-rating="4.5">
							                <div class="utf_counter_star_rating">(4.5)</div>							
						                    <span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star half"></span></div>
						                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.</p>
                           </div>
                        </div>
                      </div>
                      <div class="buttons-to-right"> 
					              <a href="#" class="button gray"><i class="fa fa-pencil"></i> Edit</a> 
					              <a href="#" class="button gray"><i class="fa fa-trash-o"></i> Delete</a> 
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
          <div class="utf_pagination_container_part margin-top-30 margin-bottom-30">
             <nav class="pagination">
              <ul>
			          <li><a href="#"><i class="sl sl-icon-arrow-left"></i></a></li>
                <li><a href="#" class="current-page">1</a></li>
                <li><a href="#">2</a></li>
				        <li><a href="#">3</a></li>
                <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
              </ul>
             </nav>
          </div>
          <?php endif; ?>
        </div>
       
      </div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/repos/admissionboox/resources/views/my-admissions.blade.php ENDPATH**/ ?>