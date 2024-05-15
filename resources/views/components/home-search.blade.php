<!-- HOME SEARCH COMPONENT -->
<div class="search_container_block home_main_search_part main_search_block"
            data-background-image="images/city_search_background.jpg">
            <div class="main_inner_search_block">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Find the Perfect <span class="typed-words"></span></h2>
                            <h4>Find some of the best schools in Nigeria from our partners.</h4>
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
                                         <option value="{{$l['value']}}">{{$l['name']}}</option>  
                                        <?php
                                          }
                                        ?>
                                    </select>
                                </div>
                                <div class="main_input_search_part_item intro-search-field">
                                    <select data-placeholder="All Categories" class="selectpicker default"
                                        title="All Categories" data-live-search="true" data-selected-text-format="count"
                                        data-size="5">
                                        <option>Food & Restaurants </option>
                                        <option>Shop & Education</option>
                                        <option>Education</option>
                                        <option>Business</option>
                                        <option>Events</option>
                                    </select>
                                </div>
                                <button class="button" onclick="window.location.">Search</button>
                            </div>
                            <div class="main_popular_categories">
                                <h3>Or Browse Schools With These Facilities</h3>
                                <ul class="main_popular_categories_list">
                                    <li> <a href="#">
                                            <div class="utf_box"> <i class="im im-icon-Chef-Hat" aria-hidden="true"></i>
                                                <p>Restaurant</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li> <a href="#">
                                            <div class="utf_box"> <i class="im im-icon-Dumbbell" aria-hidden="true"></i>
                                                <p>Fitness</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li> <a href="#">
                                            <div class="utf_box"> <i class="im im-icon-Electric-Guitar"
                                                    aria-hidden="true"></i>
                                                <p>Events</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li> <a href="#">
                                            <div class="utf_box"> <i class="im im-icon-Hotel" aria-hidden="true"></i>
                                                <p>Hotels</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li> <a href="#">
                                            <div class="utf_box"> <i class="im im-icon-Home-2" aria-hidden="true"></i>
                                                <p>Real Estate</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li> <a href="#">
                                            <div class="utf_box"> <i class="im im-icon-Business-Man"
                                                    aria-hidden="true"></i>
                                                <p>Business</p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- HOME SEARCH COMPONENT -->