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
</style>
<script>

    var ingredientDiv, stepDiv;
    var recipe;

    $(document).ready(function () {
        $('#recipe-form').on('submit', function (e) {
            e.preventDefault()

            // if (e.target.attr('type') != 'submit')
            //     return

            console.log('submitted')

            // this is a messy way to do it but idc rn
            var name = $('#recipe-name').val()
            var ingredients = []
            var container;
            for (var i = 0; i < ingredientCount; i++) {
                container = $('#ingredient' + i)
                ingredients.push({name: container.find('input').eq(0).val(), amount: container.find('input').eq(1).val(),
                    unit: container.find('.dropdown').eq(0).dropdown('get value')})
            }

            // store as start of recipe
            recipe = {name: name, ingredients: ingredients, desc: $('#desc').val()}

            // open next modal
            $('#recipe-modal').modal('hide')
            $('#recipe-steps-modal').modal('show')
        })

        $('#recipe-steps-form').on('submit', function (e) {
            e.preventDefault()

            var steps = []
            var container;
            for (var i = 0; i < ingredientCount; i++) {
                container = $('#step' + i)
                steps.push({number: i, description: container.find('input').eq(1).val()})
            }

            recipe['steps'] = steps;

            $.ajax({
                type: 'post',
                url: '{{route('addRecipe')}}',
                data: recipe,
                success: function (data) {
                    console.log(data)
                    console.log('Recipe added successfully')
                    $('#recipe-steps-modal').modal('hide')
                },
                error: function (data) {
                    console.log(data)
                }
            })
        })

        ingredientDiv = $('#ingredient-base');
        stepDiv = $('#step-base');
    })

    function openRecipeAdd() {
        $('#recipe-modal').modal('show')
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
        $('#ingredients-container .ui.dropdown').dropdown({forceSelection: false})
        $('#ingredients-container button').eq(ingredientCount).attr('onclick', 'removeIngredient(' + ingredientCount + ')')
        ingredientCount++

        // focus in and out
        setTimeout(function () {
            $('#ingredients-container input').eq(3 + 4 * (ingredientCount - 1)).focus()
            $('#ingredients-container input').eq(4 * (ingredientCount - 1)).focus()
        }, 100)
    }

    function removeIngredient(i) {
        // removes ingredient div at i
        $('#ingredient' + i).remove()

        // decrements all following ingredient div ids and resets the minus buttons call
        for (i = i + 1; i <= ingredientCount; i++) {
            $('#ingredient' + i + ' button').attr('onclick', 'removeIngredient(' + (i - 1) + ')')
            $('#ingredient' + i).attr('id', 'ingredient' + (i - 1))
        }
        ingredientCount--
    }

    var stepCount = 0;

    function addStep() {
        $('#step-container').append(stepDiv.clone().attr('id', 'step' + stepCount))
        $('#step-container :last-child').show()
        $('#step' + stepCount).find('input').eq(0).val(stepCount + 1)
        $('#step-container button').eq(stepCount).attr('onclick', 'removeStep(' + stepCount + ')')
        stepCount++

        // focus in and out
        setTimeout(function () {
            $('#step-container input').eq(3 + 4 * (stepCount - 1)).focus()
            $('#step-container input').eq(4 * (stepCount - 1)).focus()
        }, 100)
    }

    function removeStep(i) {
        // removes ingredient div at i
        $('#step' + i).remove()

        // decrements all following ingredient div ids and resets the minus buttons call
        for (i = i + 1; i <= stepCount; i++) {
            $('#step' + i + ' button').attr('onclick', 'removeStep(' + (i - 1) + ')')
            $('#step' + i + ' input').eq(0).val(i)
            $('#step' + i).attr('id', 'step' + (i - 1))
        }
        stepCount--
    }
</script>

<div class="ui segment" style="text-align: center">
    <div class="centered header">
        <h2>Sample Home Page</h2>
        <button class="ui blue button" onclick="openRecipeAdd()">Add Recipe!</button>
    </div>
    <div id="testing-div" style="margin: 10px;">recip
        <button class="ui button" onclick="listUsers()">List Users</button>
        <button class="ui button" onclick="listRecipes()">List Recipes</button>
{{--        <button class="ui button" onclick="listFavorites()">Show Favorites for User 1</button>--}}
        <button class="ui button" onclick="listTypes()">Show Recipe Types</button>
        <p id="show-info">

        </p>
    </div>
</div>

{{--modals--}}
<div class="ui modal small" id="recipe-modal">
    <div class="header">Add Recipe</div>
    <form class="ui form" id="recipe-form" style="margin: 10px;" autocomplete="off">
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
//                            $types = get_recipe_type_dropdown();
//                            foreach ($types as $t)
//                                echo "<div class='item' data-value='" . $t['value'] . "'>" . $t['name'] . "</div>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="fields">
            <div class="field" style="width: 100%">
                <label>Description</label>
                <textarea class="ui textarea" id="desc"></textarea>
            </div>
        </div>
        <div class="fields">
            <h1 style="margin-right: 10px;">Ingredients</h1>
            <button type="" class="ui small green circular icon button" onclick="addIngredient()" style="height: 40px; width: 40px;"><i class="plus icon"></i></button>
        </div>
        <div id="ingredients-container" class="ui grid" style="margin-left: 5px;">

        </div>
        <div class="actions" style="margin-top: 10px; padding-top: 10px;">
            <button class="ui blue button" id="sample-submit" type="submit">Submit</button>
            <button class="ui red button cancel">Cancel</button>
        </div>
    </form>
</div>

<div class="ui modal small" id="recipe-steps-modal">
    <div class="header">Add Recipe (Cont.)</div>
    <form class="ui form" style="margin: 10px;" id="recipe-steps-form" autocomplete="off">
        <div class="fields">
            <h1 style="margin-right: 10px;">Steps</h1>
            <button type="button" class="ui small green circular icon button" onclick="addStep()" style="height: 40px; width: 40px;"><i class="plus icon"></i></button>
        </div>
        <div id="step-container" class="ui grid" style="margin-left: 5px;">

        </div>
        <div class="actions" style="margin-top: 10px; padding-top: 10px;">
            <button class="ui blue button submit" type="submit" id="steps-submit">Submit</button>
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
    <button type="" class="ui circular red icon button" style="height: 38px; width: 38px; margin-top: 19px;"><i class="minus icon"></i></button>
</div>

{{--This is the base field used for adding Steps. It is hidden and duplicated into the modal when a user clicks add step--}}
<div class="step row" style="display: none" id="step-base">
    <div class="field">
        <label>Step #</label>
        <input type="text" readonly>
    </div>
    <div class="required field" style="margin: 3px;">
        <label>Description</label>
        <input type="text">
    </div>
    <button type="button" class="ui circular red icon button" style="height: 38px; width: 38px; margin-top: 19px;"><i class="minus icon"></i></button>
</div>
