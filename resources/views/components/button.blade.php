<?php
 $iconHTML = isset($icon) ? $icon : "";
 $hrefString = isset($href) ? $href : "";
 $classesString = isset($classes) ? $classes : "";
 $titleString = isset($title) ? $title : "";
 $idString = isset($id) ? $id : "";
?>

<a href="{{$hrefString}}" id="{{$idString}}" class="button border {{$classesString}}">
    {!!$iconHTML!!}{{$titleString}}
</a> 