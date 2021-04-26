@include('base')
@include('header')
<style>
    .centered.header {
        margin: 0 auto;
        text-align: center;
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

    a, a:visited, a:hover, a:active {
        color: inherit;
    }
</style>
<script>

    var recipeDiv;

    $(document).ready(function () {
        // allow user enter on ingredient search
        $('#search-ingredients-dropdown').dropdown({allowAdditions: true})

        // search submit
        $('#search-form').on('submit', function (e) {
            e.preventDefault()

            var name = $('#name-search').val()
            var desc = $('#desc-search').val()
            var ingredients = $('#search-ingredients-dropdown').dropdown('get value')
            var tags = $('#search-recipe-tag-dropdown').dropdown('get value')

            var data = {name: name, desc: desc, ingredients: ingredients, tags: tags}
            // console.log(data)

            $.ajax({
                type: 'post',
                url: '{{route('searchRecipes')}}',
                data: data,
                success: function (data) {
                    // remove old cards
                    $('#search-display').empty()

                    // take the data and show the recipe cards
                    for (var i = 0; i < data.length; i++) {
                        $('#search-display').append(recipeDiv.clone().attr('id', 'search-recipe-' + i))
                        $('#search-display :last-child').show()

                        // set search string and then reset all the other ids
                        var cur = $('#search-recipe-' + i)
                        cur.find('#recipe-title').attr('id', 'recipe-title-search-' + i)
                        cur.find('#link').attr('id', 'link-search-' + i)
                        cur.find('#author-name').attr('id', 'author-name-search-' + i)
                        cur.find('#recipe-description').attr('id', 'recipe-description-search-' + i)
                        cur.find('#ingredients-display').attr('id', 'ingredients-display-search-' + i)
                        cur.find('#tags-display').attr('id', 'tags-display-search-' + i)
                        cur.find('#steps-display').attr('id', 'steps-display-search-' + i)

                        // populate divs
                        cur.find('#recipe-title-search-' + i).html(data[i]['name'])
                        cur.find('#author-name-search-' + i).html(data[i]['author']['name'])
                        cur.find('#recipe-description-search-' + i).html(data[i]['description'])
                        cur.find('#link-search-' + i).attr('href', '/recipe_view/' + data[i]['id'])

                        // build ingredients as string
                        var ingredients = '';
                        // console.log(data['ingredients'])
                        data[i]['ingredients'].forEach(function (val, ind, arr) {
                            ingredients = ingredients + arr[ind]['name'] + '        ' + arr[ind]['quantity'] + ' ' + arr[ind]['unit']
                            if (ind != arr.length - 1)
                                ingredients = ingredients + '<br>'
                        })
                        cur.find('#ingredients-display-search-' + i).html(ingredients)

                        // build steps string
                        var steps = '';
                        // console.log(data['steps'])
                        data[i]['steps'].forEach(function (val, ind, arr) {
                            steps = steps + arr[ind]['step_number'] + ': ' + arr[ind]['instructions']
                            if (ind != arr.length - 1)
                                steps = steps + '<br>'
                        })
                        cur.find('#steps-display-search-' + i).html(steps)

                        // build tags string
                        var tags = '';
                        // console.log(data['steps'])
                        data[i]['tags'].forEach(function (val, ind, arr) {
                            tags = tags + arr[ind]['name']
                            if (ind != arr.length - 1)
                                tags = tags + ', '
                        })
                        cur.find('#tags-display-search-' + i).html(tags)
                    }
                },
                error: function (data) {
                    console.log(data)
                }
            })
        })
        recipeDiv = $('#recipe-display')
    })
</script>
<div class="ui segment">
    <div class="content">
        <h2>Search Recipes</h2>
        <div class="ui message">
            <div class="header">
                Search for Recipes
            </div>
            <p>To search enter at least one of the fields and click search. You may search on as many or as few fields as you would like.
                WHEN ENTERING INGREDIENTS, separate each one by a comma</p>
        </div>
        <form class="ui form" autocomplete="off" id="search-form">
            <div class="fields">
                <div class="field">
                    <label>Name</label>
                    <input type="text" name="name_search" id="name-search">
                </div>
                <div class="field">
                    <label>Description</label>
                    <input type="text" name="desc_search" id="desc-search">
                </div>
                <div class="field">
                    <label>Tags</label>
                    <div class="ui search multiple selection dropdown" id="search-recipe-tag-dropdown">
                        <input type="hidden" name="search_recipe_tags">
                        <i class="dropdown icon"></i>
                        <div class="default text">Recipe Tags</div>
                        <div class="menu">
                            <?php
                            $tags = get_recipe_tag_dropdown();
                            foreach ($tags as $t)
                                echo "<div class='item' data-value='" . $t['value'] . "'>" . $t['name'] . "</div>";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>Ingredients</label>
                    <div class="ui search fluid multiple selection dropdown" id="search-ingredients-dropdown" style="min-width: 300px;">
                        <input type="hidden" name="ingredients_search">
                        <i class="dropdown icon"></i>
                        <div class="default text">Enter ingredients to Search</div>
                        <div class="menu">

                        </div>
                    </div>
                </div>
                <button class="ui green button submit" type="submit" id="search-button">Search</button>
                <button class="ui red button clear" type="clear" id="search-clear">Clear</button>
            </div>
        </form>
    </div>
</div>
<div class="ui segment" id="search-display">

</div>

{{--Holds the standard format for recipe display card--}}
<div class="ui raised card" id="recipe-display" style="display: none">
    <a href="/recipe_view/" id="link">
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
    </a>
</div>
