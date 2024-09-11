<?php
$titleString = isset($title) ? $title : "";
?>
<div id="titlebar" class="gradient">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>{{$titleString}}</h2>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="{{url('/')}}">Home</a></li>
              <li>{{$titleString}}</li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>