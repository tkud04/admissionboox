<?php
 $iconHTML = isset($icon) ? $icon : "";
 $hrefString = isset($href) ? $href : "";
 $classesString = isset($classes) ? $classes : "";
 $titleString = isset($title) ? $title : "";
?>

<a href="{{$hrefString}}" class="button border {{$classesString}}">
    {!!$iconHTML!!}{{$titleString}}
</a> 