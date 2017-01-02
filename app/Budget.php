<?php

namespace App;

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

    public function addIncome(Income $income)
    {
        $this->income()->save($income);
    }
}
