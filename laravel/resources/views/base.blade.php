<?php

    // INCLUDED ON EVERY PAGE

?>
<head>
    {{--    JQUERY--}}
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

{{--    Semantic UI--}}
    <link rel="stylesheet" href="{{asset('addons/SemanticUI/semantic.min.css')}}">
    <script type="text/javascript" src="{{asset('addons/SemanticUI/semantic.min.js')}}"></script>

{{--    JS Includes (developed by us)--}}
    <script type="text/javascript" src="{{asset('scripts/js/includes.js')}}"></script>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <link rel="stylesheet" href="{{asset('/scripts/style.css')}}">
</head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    console.log('base loaded!')
</script>
