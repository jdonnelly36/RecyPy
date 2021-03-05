<?php

    // INCLUDED ON EVERY PAGE

?>
<head>
    {{--    JQUERY--}}
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

{{--    Semantic UI--}}
    <script type="text/javascript" src="{{asset('addons/SemanticUI/semantic.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('addons/SemanticUI/semantic.min.css')}}">

{{--    JS Includes (developed by us)--}}
    <script type="text/javascript" src="{{asset('scripts/js/includes.js')}}"></script>
</head>
<script>
    console.log('base loaded!')
</script>
