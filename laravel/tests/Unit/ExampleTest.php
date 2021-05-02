<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Schema;
use App\Models\Recipe;
Use App\Models\User;
use App\Models\RecipeTag;
use App\Models\Ingredient;
use App\Models\RecipeStep;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    function setUp() : void {
        parent::setUp();
        $recipe = ['name' => 'test name', 'description' => 'test description', 'user_id' => 1,
            'active_time' => 150, 'total_time' => 150];
        $recipe = Recipe::create($recipe);
        $user = User::find(1);
        $recipe_step = RecipeStep::create(['recipe_id' => 1, 'step_number' => 1, 'instructions' => 'do this']);
        $ingredient = Ingredient::create(['recipe_id' => 1, 'name' => 'egg', 'quantity' => 5, 'unit' => 'cup', 'notes' => 'blehh']);
        $recipe->ingredients->attach($ingredient);
        $recipe->steps->attach($recipe_step);
    }

    public function testCheckRecipeColumns() {
        $this->assertTrue(Schema::hasColumns('recipes', ['id', 'name', 'description', 'user_id',
            'active_time', 'total_time', 'created_at', 'updated_at']), 1);
    }

    public function testRecipeRelations() {
        $recipe = Recipe::find(1);
        $this->assertEquals(1, $recipe->ingredients->count());
        $this->assertEquals(1, $recipe->steps->count());
        $this->assertEquals(1, $recipe->author->count());
    }
}
