<?php

// THIS PAGE IS USED FOR VIEWING A RECIPE INDIVIDUALLY

?>
@include('base')
@include('header')

<style>
    #feed-display {
        margin-left: 5%;
        margin-right: 5%;
        width: 90%;
    }
</style>

<div class="ui feed" id="feed-display">
    <div class="w3-half event" id="recipe-feed">
        <div class="content">
            <img src="{{asset('sandwich.jpg')}}" alt="Sandwich" style="width:100%">
            <h3 id="feed-title">{{$recipe['name']}}</h3>
            <p id="feed-description">{{$recipe->description}}</p>
            <h3 style="margin: 0px;">Ingredients</h3>
            <p id="feed-ingredients">
                @foreach ($recipe['ingredients'] as $ing)
                    {{$ing['name'] . ': ' . $ing['quantity'] . ' ' . $ing['unit']}}
                @endforeach
            </p>
            <h3 style="margin: 0px;">Steps</h3>
            <p id="feed-steps">
                @foreach ($recipe['steps'] as $step)
                    {{$step['step_number'] . ': ' . $step['instructions']}}
                @endforeach
            </p>
            <p>Author: <a href="#" id="feed-author">{{$recipe['author']['name']}}</a> Date: <a id="feed-date">{{$recipe['created_at']}}</a> Rating: <a>3.5/5</a></p>
        </div>
    </div>
</div>
