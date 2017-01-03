<?php

use App\Budget;
use App\Expense;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddBudgetExpense extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_see_list_of_expenses()
    {
        $user   = factory(User::class)->create();
        $budget = factory(Budget::class)->make();
        $user->addBudget($budget);

        $budget->addExpense(factory(Expense::class)->make([
            'title'          => 'Electricity',
            'amount_planned' => '15000',
            'amount_spent'   => 0,
        ]));

        $this->actingAs($user)
            ->visitRoute('budget.show', $budget)
            ->see('Expenses')
            ->see('150.00');
    }

    /** @test */
    public function a_user_can_add_an_expense()
    {

        // $this->disableExceptionHandling();

        $user   = factory(User::class)->create();
        $budget = factory(Budget::class)->make();
        $user->addBudget($budget);

        $this->actingAs($user)
            ->visitRoute('budget.show', $budget)
            ->type('Electric', 'expense_title')
            ->type(15000, 'expense_planned')
            ->type(0, 'expense_spent')
            ->press('Add Expense');

        $this->see('Electric')
            ->see('150.00');

        $this->seeInDatabase('expenses', [
            'budget_id'      => $budget->id,
            'title'          => 'Electric',
            'amount_planned' => 15000,
            'amount_spent'   => 0,
        ]);
    }
}
