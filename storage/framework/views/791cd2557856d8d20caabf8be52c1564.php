<?php
$ac = "schools";
$useAdminSidebar = true;
?>


<?php $__env->startSection('dashboard-title',"Schools"); ?>

<?php $__env->startSection('dashboard-styles'); ?>
  <link rel="stylesheet" href="lib/datatables/datatables.min.css"/>
<?php $__env->stopSection(); ?>

<?php
if(!function_exists('getPriceTag'))
{
  function getPriceTag($category)
  {
    $ret = "";

    if($category === "50-100") $ret = "&#8358;50,000 - &#8358;150,000";
    if($category === "151-300") $ret = "&#8358;151,000 - &#8358;300,000";
    if($category === "301-500") $ret = "&#8358;301,000 - &#8358;500,000";
    if($category === "501-750") $ret = "&#8358;501,000 - &#8358;750,000";
    if($category === "751-1m") $ret = "&#8358;751,000 - &#8358;1,000,000";
    if($category === "above-1m") $ret = "Above &#8358;1,000,000";

    return $ret;
  }
}
?>

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
                  <select data-placeholder="All admissions" class="utf_chosen_select_single" style="display: none;" id="schools-select">
                    <option>All schools</option>
                  </select>
                  
                </div>
                
            </div>
            <h4><i class="sl sl-icon-list"></i> Schools</h4>
            <ul>
              <?php
               if(count($schools) > 0)
               {
                  foreach($schools as $s)
                  {
                    $xf = $s['id'];
                    $vu = url("my-school")."?xf=".$s['url'];
                    $logo = strlen($s['logo'] > 0) ? $s['logo'] : "images/utf_listing_item-01.jpg";
                    $info = $s['info'];
                    $address = $s['address'];
                    $priceTag = getPriceTag($info['school_fees']);

                   
                    

              ?>
                    <li>
                    
                      <div class="col-lg-12 col-md-12">
            <div class="utf_listing_item-container list-layout">
               <a href="<?php echo e($vu); ?>" class="utf_listing_item">
              <div class="utf_listing_item-image"> 
				  <img src="<?php echo e($logo); ?>" alt=""> 
				 <!-- <span class="like-icon"></span> -->
				  <span class="tag"><i class="im im-icon-Hotel"></i> <?php echo e($address['school_state']); ?></span> 
				  <div class="utf_listing_prige_block utf_half_list">							
					<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> <?php echo $priceTag; ?></span>					
					<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
				  </div>
			  </div>
			  <span class="utf_open_now">Open Now</span>
              <div class="utf_listing_item_content">
                <div class="utf_listing_item-inner">
                  <h3><?php echo e($s['name']); ?></h3>
                  <span><i class="fa fa-map-marker"></i> <?php echo e($address['school_address']); ?></span>
				  <span><i class="fa fa-phone"></i><?php echo e($s['phone']); ?></span>
                  <div class="utf_star_rating_section" data-rating="4.5">
                    <div class="utf_counter_star_rating">(4.5)</div>
                  </div>
                  <p><?php echo e($info['wcu']); ?></p>
                </div>
              </div>
              <br>
              <div class="buttons-to-right" style="margin-top: 30px;"> 
					              <a href="<?php echo e($vu); ?>" class="button gray"><i class="fa fa-pencil"></i> Edit</a> 
					              <a href="#" onclick="confirmDeleteAdmission('<?php echo e($xf); ?>'); return false;" class="button gray"><i class="fa fa-trash-o"></i> Remove</a> 
				      </div>
              </a> 
			</div>
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
                   There are no schools on record.
                 </p>
               </div>
                
              <?php
               }
              ?>
            
             
            </ul>
          </div>
		      <div class="clearfix"></div>
          <?php if(count($schools) > 0): ?>
            <?php echo $__env->make('components.pagination',[
              'url' => "my-schools?x=1",
              'currentPage' => $currentPage,
              'numPages' => $numPages,
              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endif; ?>
        </div>
       
      </div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/my-schools.blade.php ENDPATH**/ ?>