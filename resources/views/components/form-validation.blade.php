<?php
$messageString = isset($message) ? $message : "This field is required";
$styleString = isset($style) ? $style : "";
$idString = isset($id) ? "id='{$id}'" : "";
?>
<div style="{{$styleString}}" class="form-validation" {!! $idString !!}>
    <p style="color:#FF0000;">
      <i class="fa fa-window-close"></i>  {{$messageString}}  
    </p>
</div>
