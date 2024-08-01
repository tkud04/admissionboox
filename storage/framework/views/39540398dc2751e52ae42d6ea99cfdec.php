<?php
$void = 'javascript:void(0)';
?>


<?php $__env->startSection('title',ucwords($category)." Schools"); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
      <div class="col-lg-8 col-md-8">
        <!--
        <div class="listing_filter_block">
          <div class="col-md-2 col-xs-2">
            <div class="utf_layout_nav"> <a href="listings_grid_with_sidebar.html" class="grid"><i class="fa fa-th"></i></a> <a href="#" class="list active"><i class="fa fa-align-justify"></i></a> </div>
          </div>
          <div class="col-md-10 col-xs-10">
            <div class="sort-by utf_panel_dropdown sort_by_margin float-right"> <a href="#">Destination</a>
              <div class="utf_panel_dropdown-content">
                <input class="distance-radius" type="range" min="1" max="999" step="1" value="1" data-title="Select Range" style="position: absolute; width: 1px; height: 1px; overflow: hidden; opacity: 0;"><div class="utf_range_output">1</div><i class="data-radius-title">Select Range</i><div class="rangeslider utf_rangeslider_horizontal" id="js-rangeslider-0"><div class="utf_rangeslider_fill" style="width: 10px;"></div><div class="utf_rangeslider_handle" style="left: 0px;"></div></div>
                <div class="panel-buttons">
                  <button class="panel-apply">Apply</button>
                </div>
              </div>
            </div>
            <div class="sort-by">
              <div class="utf_sort_by_select_item sort_by_margin">
                <select data-placeholder="Sort by Listing" class="utf_chosen_select_single" style="display: none;">
                  <option>Sort by Listing</option>
				  <option>Latest Listings</option>
				  <option>Popular Listings</option>
				  <option>Price (Low to High)</option>
				  <option>Price (High to Low)</option>
				  <option>Highest Reviewe</option>
				  <option>Lowest Reviewe</option>                  
                  <option>Newest Listing</option>
                  <option>Oldest Listing</option>
				  <option>Random Listings</option>
                </select><div class="chosen-container chosen-container-single chosen-container-single-nosearch" style="width: 100%;" title=""><a class="chosen-single chosen-default"><span>Sort by Listing</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off" readonly=""></div><ul class="chosen-results"></ul></div></div>
              </div>
            </div>
            <div class="sort-by">
              <div class="utf_sort_by_select_item sort_by_margin">
                <select data-placeholder="Categories:" class="utf_chosen_select_single" style="display: none;">
				  <option>Categories</option>	
				  <option>Restaurant</option>
                  <option>Health</option>
                  <option>Hotels</option>
                  <option>Real Estate</option>                  
				  <option>Fitness</option>                  
                  <option>Shopping</option>
				  <option>Travel</option>
				  <option>Shops</option>
				  <option>Nightlife</option>
				  <option>Events</option>
                </select><div class="chosen-container chosen-container-single chosen-container-single-nosearch" style="width: 100%;" title=""><a class="chosen-single"><span>Categories</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off" readonly=""></div><ul class="chosen-results"></ul></div></div>
              </div>
            </div>
            <div class="sort-by">
              <div class="utf_sort_by_select_item utf_search_map_section">
                <ul>
                  <li><a class="utf_common_button" href="#"><i class="fa fa-dot-circle-o"></i>Near Me</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        -->
        <div class="row" srtyle="margin-top: 10px;">
          <?php
            if(count($schools) > 0)
            {
              foreach($schools as $s)
              {
                $vu = "#";
                $logo = strlen($s['logo'] > 0) ? $s['logo'] : "images/utf_listing_item-01.jpg";
          ?>
          <div class="col-lg-12 col-md-12">
            <div class="utf_listing_item-container list-layout"> <a href="<?php echo e($vu); ?>" class="utf_listing_item">
              <div class="utf_listing_item-image"> 
				  <img src="<?php echo e($logo); ?>" alt=""> 
				  <span class="like-icon"></span> 
				  <span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span> 
				  <div class="utf_listing_prige_block utf_half_list">							
					<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $45</span>					
					<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
				  </div>
			  </div>
			  <span class="utf_open_now">Open Now</span>
              <div class="utf_listing_item_content">
                <div class="utf_listing_item-inner">
                  <h3><?php echo e($s['name']); ?></h3>
                  <span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
				  <span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>
                  <div class="utf_star_rating_section" data-rating="4.5">
                    <div class="utf_counter_star_rating">(4.5)</div>
                  <span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star half"></span></div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla.</p>
                </div>
              </div>
              </a> 
			</div>
          </div>
          <?php
              }
            }
          ?>
        </div>
        <div class="clearfix"></div>
        <?php if(count($schools) > 0): ?>
            <?php echo $__env->make('components.pagination',[
              'url' => "schools?category=".$category,
              'currentPage' => $currentPage,
              'numPages' => $numPages,
              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endif; ?>
      </div>
      
      <!-- Sidebar -->
      <div class="col-lg-4 col-md-4">
        <div class="sidebar">
          <div class="utf_box_widget margin-bottom-35">
            <h3><i class="sl sl-icon-direction"></i> Filters</h3>			
            <div class="row with-forms">
              <div class="col-md-12">
                <input type="text" placeholder="What are you looking for?" value="">
              </div>
            </div>            
            <div class="row with-forms">
              <div class="col-md-12">
                <div class="input-with-icon location">
                  <input type="text" placeholder="Search Location..." value="">
                  <a href="#"><i class="sl sl-icon-location"></i></a> </div>
              </div>
            </div>
			<a href="#" class="more-search-options-trigger margin-bottom-10" data-open-title="More Filters Options" data-close-title="More Filters Options"></a>
            <div class="more-search-options relative">
				<div class="checkboxes one-in-row margin-bottom-15">
					<input id="check-a" type="checkbox" name="check">
					<label for="check-a">Real Estate</label>
					<input id="check-b" type="checkbox" name="check">
					<label for="check-b">Friendly Workspace</label>
					<input id="check-c" type="checkbox" name="check">
					<label for="check-c">Instant Book</label>
					<input id="check-d" type="checkbox" name="check">
					<label for="check-d">Wireless Internet</label>
					<input id="check-e" type="checkbox" name="check">
					<label for="check-e">Free Parking</label>
					<input id="check-f" type="checkbox" name="check">
					<label for="check-f">Elevator in Building</label>
					<input id="check-g" type="checkbox" name="check">
					<label for="check-g">Restaurant</label>	
					<input id="check-h" type="checkbox" name="check">
					<label for="check-h">Dance Floor</label>
				</div>				
			</div>			
            <button class="button fullwidth_block margin-top-5">Update</button>
          </div>		  
          <div class="utf_box_widget margin-top-35 margin-bottom-75">
            <h3><i class="sl sl-icon-folder-alt"></i> Categories</h3>
            <ul class="utf_listing_detail_sidebar">
              <li><i class="fa fa-angle-double-right"></i> <a href="#">Travel</a></li>
              <li><i class="fa fa-angle-double-right"></i> <a href="#">Nightlife</a></li>
              <li><i class="fa fa-angle-double-right"></i> <a href="#">Fitness</a></li>
              <li><i class="fa fa-angle-double-right"></i> <a href="#">Real Estate</a></li>
              <li><i class="fa fa-angle-double-right"></i> <a href="#">Restaurant</a></li>
              <li><i class="fa fa-angle-double-right"></i> <a href="#">Dance Floor</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/schools.blade.php ENDPATH**/ ?>