@include('base')
@include('header')
<style>
    .centered.header {
        margin: 0 auto;
        text-align: center;
    }
</style>

<script>
    $(document).ready(function () {
        console.log('loaded')

        $('#sample-form').on('submit', function (e) {
            e.preventDefault()

            console.log('submitted')
        })
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
<div class="ui modal tiny" id="sample-modal">
    <div class="header">Sample Recipe Add Modal</div>
    <form class="ui form" id="sample-form" style="margin: 10px;">
        <div class="fields">
            <div class="field">
                <label>Recipe Name</label>
                <input type="text" name="recipe_name" id="recipe-name">
            </div>
            <div class="field">
                <label>Creator Name</label>
                <input type="text" name="creator_name" id="creator-name">
            </div>
        </div>
        <div class="actions">
            <button class="ui blue button" id="sample-submit" type="submit">Submit</button>
            <button class="ui red button cancel">Cancel</button>
        </div>
    </form>
</div>
