@include('base')
@include('header')
<style>
    .centered.header {
        margin-left: auto;
        margin-right: auto;
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
</script>

<div class="ui bottom attatched segment">
    <div class="ui float center">
        <h2>Sample Home Page</h2>
        <button class="ui blue button" onclick="openRecipeAdd()">Add Recipe!</button>
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
