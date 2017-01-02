<?php

use App\Budget;
use App\Income;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddBudgetIncomeTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function a_user_can_see_income_list()
    {
        $user   = factory(User::class)->create();
        $budget = factory(Budget::class)->make();
        $user->addBudget($budget);

        $budget->addIncome(factory(Income::class)->make(['title' => 'Colyn', 'value_planned' => '10000', 'value_received' => 0]));

        $this->visitRoute('budget.show', $budget)
            ->see('Income')
            ->see('Colyn')
            ->see('10000');
    }

    /** @test */
    public function a_user_can_add_income()
    {

        $this->disableExceptionHandling();

        $user   = factory(User::class)->create();
        $budget = factory(Budget::class)->make();
        $user->addBudget($budget);

        $this->actingAs($user)
            ->visitRoute('budget.show', $budget)
            ->type('Colyn', 'income_title')
            ->type(10000, 'income_planned')
            ->type(0, 'income_received')
            ->press('Add Income');

        $this->see('Colyn')
            ->see('10000');

        $this->seeInDatabase('income', [
            'budget_id'      => $budget->id,
            'title'          => 'Colyn',
            'value_planned'  => 10000,
            'value_received' => 0,
        ]);
    }
}
