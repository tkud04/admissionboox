<?php
$contentHTML = isset($content) ? $content : "";
$iconString = isset($icon) ? $icon : "";
?>
<li>
        <i class="utf_list_box_icon sl {{$iconString}}"></i> {!! $contentHTML !!}
</li>