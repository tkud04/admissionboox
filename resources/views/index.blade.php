<?php
$void = 'javascript:void(0)';
?>
@extends('layout')

@section('title',"Welcome")

@section('scripts')
<script src="js/typed.js"></script>
    <script>
        var typed = new Typed('.typed-words', {
            strings: {!! json_encode($typedTexts) !!},
            typeSpeed: 80,
            backSpeed: 80,
            backDelay: 4000,
            startDelay: 1000,
            loop: true,
            showCursor: true
        });
    </script>
@stop

@section('content')
  @include('components.home-search',['locations' => $locations])
  @include('components.listing-categories',['categories' => $categories])
  @include('components.listing-categories',['categories' => $viewMoreCategories,'title'=>"More Categories",'ssm' => false])
@stop