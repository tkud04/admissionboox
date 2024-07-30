<?php
$messageString = isset($message) ? $message : "This field is required";
$styleString = isset($style) ? $style : "";
$idString = isset($id) ? "id='{$id}'" : "";
$classString = isset($classes) ? " {$classes}" : "";
?>
<div style="{{$styleString}}" class="form-validation{{$classString}}" {!! $idString !!}>
    <p style="color:#FF0000;">
      <i class="fa fa-window-close"></i>  {{$messageString}}  
    </p>
</div>
