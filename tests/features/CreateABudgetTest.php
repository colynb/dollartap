<?php

use App\Budget;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateABudgetTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_has_list_of_budgets()
    {
        $user   = factory(User::class)->create();
        $budget = factory(Budget::class)->make(['title' => 'January Budget']);
        $user->addBudget($budget);

        $this->actingAs($user)
            ->visit('/home')
            ->see('January Budget');
    }

    /** @test */
    public function a_user_can_create_a_budget()
    {
        // $this->disableExceptionHandling();
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/home')
            ->type('January Budget', 'title')
            ->press('Create Budget');

        $this->seeInDatabase('budgets', ['user_id' => $user->id, 'title' => 'January Budget']);
    }
}
