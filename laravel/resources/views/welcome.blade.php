@include('base')
@include('header')
<style>
    .centered.header {
        margin: 0 auto;
        text-align: center;
        width: 100%;
    }

    .field {
        width: auto;
        margin: 5px;
    }

    .ingredient.row {
        padding: 1px !important;
    }

    .recipe.view {
        border: 3px lightblue solid;
        background-color: lightgray;
    }

    #feed-display {
        margin-left: 5%;
        margin-right: 5%;
        width: 90%;
    }

    a, a:visited, a:hover, a:active {
        color: inherit;
    }
</style>
<script>
    var recipes = <?php echo json_encode(get_all_recipes()); ?>;
    var liked_recipes = <?php echo json_encode(get_all_liked_recipes()); ?>;

    $(document).ready(function () {
        // show the feed
        recipeDiv = $('#recipe-feed')
        $('#recipe-feed').hide()

        for (var i = 0; i< recipes.length; i++) {
            $('#feed-display').append(recipeDiv.clone().attr('id', 'feed-recipe-' + i))
            $('#feed-display :last-child').show()

            // set search string and then reset all the other ids
            var cur = $('#feed-recipe-' + i)
            cur.find('#feed-link').attr('id', 'feed-link-' + i)
            cur.find('#feed-title').attr('id', 'feed-title-' + i)
            cur.find('#feed-author').attr('id', 'feed-author-' + i)
            cur.find('#feed-description').attr('id', 'feed-description-' + i)
            cur.find('#feed-date').attr('id', 'feed-date-' + i)
            cur.find('#feed-ingredients').attr('id', 'feed-ingredients-' + i)
            cur.find('#like-counter').attr('id', 'feed-like-counter-' + i)
            cur.find('#like-button').attr('id', 'feed-like-button-' + i)
            $('#feed-like-button-' + i).attr('recipe-id', recipes[i]['id'])

            cur.find('#feed-title-' + i).html(recipes[i]['name'])
            cur.find('#feed-author-' + i).html(recipes[i]['author']['name'])
            cur.find('#feed-description-' + i).html(recipes[i]['description'])
            cur.find('#feed-date').html(recipes[i]['created_at'])
            cur.find('#feed-link-' + i).attr('href', '/recipe_view/' + recipes[i]['id'])
            $('#feed-like-counter-' + i).html(recipes[i]['likes'].length)

            if (liked_recipes.includes(recipes[i]['id']))
                $('#feed-like-button-' + i).addClass('green')

            // build ingredients as string
            var ingredients = '';
            // console.log(recipes['ingredients'])
            recipes[i]['ingredients'].forEach(function (val, ind, arr) {
                ingredients = ingredients + arr[ind]['name'] + '        ' + arr[ind]['quantity'] + ' ' + arr[ind]['unit']
                if (ind != arr.length - 1)
                    ingredients = ingredients + '<br>'
            })
            cur.find('#feed-ingredients-' + i).html(ingredients)
        }

        // for all like buttons
        $('.like').not('.green').on('click', function (e) {
            // add a like
            $.ajax({
                type: 'post',
                url: '{{route('likeRecipe')}}',
                data: {id: $(this).attr('recipe-id')},
                success: function (data) {
                    console.log('liked recipe')
                    // disable button
                    $("div[recipe-id='" + data + "']").addClass('green')
                    $("div[recipe-id='" + data + "']").off('click')
                },
                error: function (data) {
                    console.log(data)
                }
            })
        })
    })
</script>

<div class="ui segment feed" id="feed-display" class="centered header">

</div>

{{--Holds the standard format for recipe display card--}}
<div class="ui raised card" id="recipe-display" style="display: none">
    <div class="content">
        <div class="header" id="recipe-title"></div>
        <div class="meta" id="author-name"></div>
        <div class="description">
            <p id="recipe-description">

            </p>
            <h3 style="margin: 0px;">Ingredients</h3>
            <p id="ingredients-display">

            </p>
            <h3 style="margin: 0px;">Steps</h3>
            <p id="steps-display">

            </p>
        </div>
    </div>
    <div class="extra content">
        <p id="tags-display">

        </p>
    </div>
    <div class="extra">
        Rating:
        <div class="ui star rating" data-rating="4"></div>
    </div>
</div>

{{--Other feed option--}}
<div class="w3-half event" id="recipe-feed" style="display: none">
    <div class="content">
        <a id="feed-link" href="/recipe_view">
            <img src="{{asset('sandwich.jpg')}}" alt="Sandwich" style="width:100%">
        </a>
        <h3 id="feed-title"></h3>
        <p id="feed-description"></p>
        <h3 style="margin: 0px;">Ingredients</h3>
        <p id="feed-ingredients">

        </p>
        <p>Author: <a href="#" id="feed-author">username</a> Date: <a id="feed-date">4/8/2021</a> Rating: <a>3.5/5</a></p>
        <div class="ui labeled button" tabindex="0">
            <div class="ui button like" id="like-button">
                <i class="heart icon"></i> Like
            </div>
            <a class="ui basic label" id="like-counter">
                0
            </a>
        </div>
    </div>
</div>
