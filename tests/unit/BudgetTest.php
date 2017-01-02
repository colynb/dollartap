<?php

// use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Budget;
use App\Income;
use Illuminate\Foundation\Testing\DatabaseMigrations;

// use Illuminate\Foundation\Testing\DatabaseTransactions;

class BudgetTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_budget_can_add_income()
    {
        $budget = factory(Budget::class)->create(['id' => 1000]);
        $income = new Income([
            'title'          => 'Colyn',
            'value_planned'  => 10000,
            'value_received' => 0,
        ]);

        $budget->addIncome($income);

        $this->seeInDatabase('income', ['title' => 'Colyn', 'budget_id' => 1000]);
    }
}
