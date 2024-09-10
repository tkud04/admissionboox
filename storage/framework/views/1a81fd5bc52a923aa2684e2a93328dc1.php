<!-- HOME SEARCH COMPONENT -->
<div class="search_container_block home_main_search_part main_search_block"
            data-background-image="images/city_search_background.jpg">
            <div class="main_inner_search_block">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Find the Perfect <span class="typed-words"></span></h2>
                            <h4>Find some of the best schools in Nigeria and around the world.</h4>
                            <div class="main_input_search_part">
                                <div class="main_input_search_part_item">
                                    <input type="text" placeholder="What are you looking for?" value="" />
                                </div>
                                <div class="main_input_search_part_item intro-search-field">
                                    <select class="selectpicker default" data-live-search="true"
                                        data-selected-text-format="count" data-size="5" title="Select Location">
                                        <option value="none">Select a location</option>
                                        <?php
                                          foreach($locations as $l)
                                          {
                                        ?>
                                         <option value="<?php echo e($l['value']); ?>"><?php echo e($l['name']); ?></option>  
                                        <?php
                                          }
                                        ?>
                                    </select>
                                </div>
                                <div class="main_input_search_part_item intro-search-field">
                                    <select data-placeholder="All Categories" class="selectpicker default"
                                        title="All Categories" data-live-search="true" data-selected-text-format="count"
                                        data-size="5">
                                        <option>Early years </option>
                                        <option>Primary</option>
                                        <option>Secondary</option>
                                        <option>Tertiary</option>
                                        <option>Faith-based</option>
                                    </select>
                                </div>
                                <button class="button" onclick="window.location.">Search</button>
                            </div>
                            <div class="main_popular_categories">
                                <h3>Or Browse Schools With These Facilities</h3>
                                <?php
                                  $listCount = count($facilities) > 6 ? 6 : count($facilities);
                                  if($listCount > 0)
                                  {
                                ?>
                                <ul class="main_popular_categories_list">
                                    <?php
                                      shuffle($facilities);

                                      for($i = 0; $i < $listCount; $i++)
                                      {
                                        $facility = $facilities[$i];
                                        $icon = $facility['icon'];
                                    ?>
                                    <li> <a href="#">
                                            <div class="utf_box"> <i class="im <?php echo e($icon); ?>" aria-hidden="true"></i>
                                                <p><?php echo e($facility['facility_name']); ?></p>
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                      }
                                    }
                                    ?>
                                   
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- HOME SEARCH COMPONENT --><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/components/home-search.blade.php ENDPATH**/ ?>