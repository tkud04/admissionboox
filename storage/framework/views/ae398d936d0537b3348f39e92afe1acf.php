<?php
$urlString = isset($url) ? $url : "";
$currentPageString = isset($currentPage) ? $currentPage : "1";
$numPagesString = isset($numPages) ? $numPages : "1";
?>

<div class="utf_pagination_container_part margin-top-30 margin-bottom-30">
             <nav class="pagination">
              <ul>
                <?php
                  $prevPage = $currentPageString <= 1 ? null : $currentPageString - 1;
                  $pu = $prevPage === null ? "#" : "{$urlString}?page={$prevPage}";
                ?>
			          <li><a href="<?php echo e($pu); ?>"><i class="sl sl-icon-arrow-left"></i></a></li>
                      <?php
                       for($i = 0; $i < $numPagesString; $i++)
                       {
                        $currentIndex = $i + 1;
                        $v = $currentPageString == $currentIndex ? "current-page" : "";
                        $vu = "{$urlString}?page={$currentIndex}";
                      ?>
                        <li><a href="<?php echo e($vu); ?>" class="<?php echo e($v); ?>"><?php echo e($currentIndex); ?></a></li>
                      <?php
                       }
                      ?>
                 <?php
                  $nextPage = $currentPageString >= $numPagesString ? null : $currentPageString + 1;
                  $nu = $nextPage === null ? "#" : "{$urlString}?page={$nextPage}";
                ?>
			       <li><a href="<?php echo e($nu); ?>"><i class="sl sl-icon-arrow-right"></i></a></li>
              </ul>
             </nav>
          </div><?php /**PATH /Users/tobikudayisi/repos/admissionboox/resources/views/components/pagination.blade.php ENDPATH**/ ?>