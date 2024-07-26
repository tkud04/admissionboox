<?php
 $iconHTML = isset($icon) ? $icon : "";
 $hrefString = isset($href) ? $href : "";
 $classesString = isset($classes) ? $classes : "";
 $titleString = isset($title) ? $title : "";
 $idString = isset($id) ? $id : "";
 $styleString = isset($style) ? $style : "";
?>

<a href="{{$hrefString}}" id="{{$idString}}" class="button border {{$classesString}}" style="{{$styleString}}">
    {!!$iconHTML!!}{{$titleString}}
</a> 