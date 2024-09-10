<?php
$titleString = isset($title) ? $title :" Most Popular Schools";
$shouldShowMore = isset($ssm) ? $ssm : true;
?>
<div class="container padding-bottom-70">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="headline_part centered margin-bottom-35 margin-top-70">
                       <?php echo e($titleString); ?>

                        <span>Discover the best schools to apply for<br>around the
                            country by categories.</span>
                    </h3>
                </div>
                <?php
                 foreach($categories as $c)
                 {
                    $listingsText = $c['numListings'] === 1 ? 'Listing' : 'Listings';
                    $vu = "schools?xf=".$c['xf'];
                ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <a href="<?php echo e($vu); ?>" class="img-box"
                        data-background-image="<?php echo e($c['image']); ?>">
                        <div class="utf_img_content_box visible">
                            <h4><?php echo e($c['name']); ?> </h4>
                            <span><?php echo e($c['numListings']); ?> <?php echo e($listingsText); ?></span>
                        </div>
                    </a>
                </div>
                <?php
                 }
                ?>
             
             <?php if($shouldShowMore): ?>
              <div class="col-md-12 centered_content"> 
                   <?php echo $__env->make('components.button',[
                     'href' => '#',
                     'title' => 'View More Categories',
                     'classes' => 'margin-top-20'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
             <?php endif; ?>     
            </div>
        </div><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/components/listing-categories.blade.php ENDPATH**/ ?>