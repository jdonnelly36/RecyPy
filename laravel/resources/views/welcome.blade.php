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
        margin: 5px;
    }
</style>

<script>

    var ingredientDiv;

    $(document).ready(function () {
        console.log('loaded')

        $('#sample-form').on('submit', function (e) {
            e.preventDefault()

            console.log(e.target)

            if (e.target.attr('type') != 'submit')
                return

            console.log('submitted')
        })

        ingredientDiv = $('#ingredient-base');
    })

    function openRecipeAdd() {
        $('#sample-modal').modal('show')
    }

    function listUsers() {
        $.ajax({
            type: 'get',
            url: '{{url('/test/listUsers')}}',
            success: function(data) {
                console.log(data)
            },
            error: function (data) {
                console.log(data)
            }
        })
    }

    function listRecipes() {
        $.ajax({
            type: 'get',
            url: '{{url('/test/listRecipes')}}',
            success: function(data) {
                console.log(data)
            },
            error: function (data) {
                console.log(data)
            }
        })
    }

    function listFavorites() {
        $.ajax({
            type: 'get',
            url: '{{url('/test/listFavorites')}}',
            success: function(data) {
                console.log('Favorite Recipes for User 1')
                console.log(data)
            },
            error: function (data) {
                console.log(data)
            }
        })
    }

    function listTypes() {
        $.ajax({
            type: 'get',
            url: '{{url('/test/listTypes')}}',
            success: function(data) {
                console.log(data)
            },
            error: function (data) {
                console.log(data)
            }
        })
    }

    var ingredientCount = 0;
    function addIngredient() {
        $('#ingredients-container').append(ingredientDiv.clone().attr('id', 'ingredient' + ingredientCount))
        $('#ingredients-container :last-child').show()
        $('#ingredients-container .ui.dropdown').dropdown()
        ingredientCount++
    }
</script>

<div class="ui bottom attatched segment" style="text-align: center">
    <div class="centered header">
        <h2>Sample Home Page</h2>
        <button class="ui blue button" onclick="openRecipeAdd()">Add Recipe!</button>
    </div>
    <div id="testing-div" style="margin: 10px;">
        <button class="ui button" onclick="listUsers()">List Users</button>
        <button class="ui button" onclick="listRecipes()">List Recipes</button>
{{--        <button class="ui button" onclick="listFavorites()">Show Favorites for User 1</button>--}}
        <button class="ui button" onclick="listTypes()">Show Recipe Types</button>
        <p id="show-info">

        </p>
    </div>
</div>

{{--modals--}}
<div class="ui modal small" id="sample-modal">
    <div class="header">Add Recipe</div>
    <form class="ui form" id="sample-form" style="margin: 10px;" autocomplete="off">
        <div class="fields" style="width: 95%">
            <div class="required field">
                <label>Recipe Name</label>
                <input type="text" name="recipe_name" id="recipe-name">
            </div>
            <div class="field">
                <label>Recipe tags</label>
                <div class="ui search multiple selection dropdown">
                    <input type="hidden" name="recipe_tags">
                    <i class="dropdown icon"></i>
                    <div class="default text">Recipe Types</div>
                    <div class="menu">
                        <?php
                            $types = get_recipe_type_dropdown();
                            foreach ($types as $t)
                                echo "<div class='item' data-value='" . $t['value'] . "'>" . $t['name'] . "</div>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <h1>Ingredients</h1>
        <div id="ingredients-container" class="ui grid" style="margin-left: 5px;">
            <div class="row">
                <button type="" class="ui small green circular icon button" onclick="addIngredient()" style="height: 40px; width: 40px;"><i class="plus icon"></i></button>
            </div>
        </div>
        <div class="actions">
            <button class="ui blue button" id="sample-submit" type="submit">Submit</button>
            <button class="ui red button cancel">Cancel</button>
        </div>
    </form>
</div>

{{--This is the base field used for adding ingredients. It is hidden and duplicated into the modal when a user clicks add ingredient--}}
<div class="ingredient row" style="display: none" id="ingredient-base">
    <div class="required field" style="margin: 3px;">
        <label>Ingredient</label>
        <input type="text" required>
    </div>
    <div class="required field" style="margin: 3px;">
        <label>Amount</label>
        <input type="number">
    </div>
    <div class="required field" style="margin: 3px;">
        <label>Unit</label>
        <div class="ui search selection dropdown">
            <input type="hidden" autofocus="off">
            <div class="default text">Select Unit</div>
            <i class="dropdown icon"></i>
            <div class="menu">
                {{--                                ADD IN ALL UNITS YOU CAN THINK OF HERE. Make value = to something sql safe--}}
                <div class="item" data-value="cup">Cup(s)</div>
                <div class="item" data-value="tbls">Tbls</div>
            </div>
        </div>
    </div>
</div>
