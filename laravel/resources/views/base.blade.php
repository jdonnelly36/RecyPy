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
</head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    console.log('base loaded!')
</script>
