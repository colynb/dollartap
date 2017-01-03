<?php

// use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Budget;
use App\Expense;
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
            'title'           => 'Colyn',
            'amount_planned'  => 10000,
            'amount_received' => 0,
        ]);

        $budget->addIncome($income);

        $this->seeInDatabase('income', ['title' => 'Colyn', 'budget_id' => 1000]);
    }

    /** @test */
    public function a_buget_has_total_planned_income()
    {
        $budget = factory(Budget::class)->create(['id' => 1000]);

        $income1 = factory(Income::class)->make([
            'title'          => 'Colyn',
            'amount_planned' => 10000,
        ]);

        $income2 = factory(Income::class)->make([
            'title'          => 'April',
            'amount_planned' => 10000,
        ]);

        $budget->addIncome($income1);
        $budget->addIncome($income2);

        $this->assertEquals(20000, $budget->totalIncomePlanned());

    }

    /** @test */
    public function a_buget_has_total_receieved_income()
    {
        $budget = factory(Budget::class)->create(['id' => 1000]);

        $income1 = factory(Income::class)->make([
            'title'           => 'Colyn',
            'amount_received' => 10000,
        ]);

        $income2 = factory(Income::class)->make([
            'title'           => 'April',
            'amount_received' => 10000,
        ]);

        $budget->addIncome($income1);
        $budget->addIncome($income2);

        $this->assertEquals(20000, $budget->totalIncomeReceived());

    }

    /** @test */
    public function a_buget_has_total_expenses_planned()
    {
        $budget = factory(Budget::class)->create(['id' => 1000]);

        $expense1 = factory(Expense::class)->make([
            'title'          => 'water',
            'amount_planned' => 100,
        ]);

        $expense2 = factory(Expense::class)->make([
            'title'          => 'electric',
            'amount_planned' => 150,
        ]);

        $budget->addExpense($expense1);
        $budget->addExpense($expense2);

        $this->assertEquals(250, $budget->totalExpensesPlanned());

    }

    /** @test */
    public function a_buget_has_total_expenses_spent()
    {
        $budget = factory(Budget::class)->create(['id' => 1000]);

        $expense1 = factory(Expense::class)->make([
            'title'        => 'water',
            'amount_spent' => 100,
        ]);

        $expense2 = factory(Expense::class)->make([
            'title'        => 'electric',
            'amount_spent' => 150,
        ]);

        $budget->addExpense($expense1);
        $budget->addExpense($expense2);

        $this->assertEquals(250, $budget->totalExpensesSpent());

    }
}
