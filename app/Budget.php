<?php

namespace App;

use App\Expense;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{

    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function income()
    {
        return $this->hasMany(Income::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function addIncome(Income $income)
    {
        $this->income()->save($income);
    }

    public function addExpense(Expense $income)
    {
        $this->income()->save($income);
    }

    public function totalIncomePlanned()
    {
        return $this->income->sum('amount_planned');
    }

    public function totalIncomeReceived()
    {
        return $this->income->sum('amount_received');
    }

    public function totalExpensesPlanned()
    {
        return $this->expenses->sum('amount_planned');
    }

    public function totalExpensesSpent()
    {
        return $this->expenses->sum('amount_spent');
    }
}
