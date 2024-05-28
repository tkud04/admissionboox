<?php
$titleString = isset($title) ? $title :" Most Popular Schools";
$shouldShowMore = isset($ssm) ? $ssm : true;
?>
<div class="container padding-bottom-70">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="headline_part centered margin-bottom-35 margin-top-70">
                       {{$titleString}}
                        <span>Discover the best schools to apply for<br>around the
                            country by categories.</span>
                    </h3>
                </div>
                <?php
                 foreach($categories as $c)
                 {
                ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <a href="listings_list_with_sidebar.html" class="img-box"
                        data-background-image="{{$c['image']}}">
                        <div class="utf_img_content_box visible">
                            <h4>{{$c['name']}} </h4>
                            <span>{{$c['numListings']}} Listings</span>
                        </div>
                    </a>
                </div>
                <?php
                 }
                ?>
             
             @if($shouldShowMore)
              <div class="col-md-12 centered_content"> 
                   @include('components.button',[
                     'href' => '#',
                     'title' => 'View More Categories',
                     'classes' => 'margin-top-20'
                    ])
                </div>
             @endif     
            </div>
        </div>