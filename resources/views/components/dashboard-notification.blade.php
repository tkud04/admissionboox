<?php
$typeString = isset($type) ? $type : "";
$contentHTML = isset($content) ? $content : "This is a success notification. <strong>Important information</strong> can be highlighted!";
?>
<div class="notification {{$typeString}} closeable margin-bottom-30">
    <p>{!!$contentHTML!!}</p>
    <a class="close" onclick="rn('{{$xf}}')"></a> 
</div>