<div class="panel panel-default">
  <div class="panel-heading">{{ $budget->title }} Expenses</div>
  <div class="panel-body">
    <form action="{{ route('budget.expenses.store', $budget) }}" method="post">
      {{ csrf_field() }}
      <table class="table">
        <tr>
          <th>Title</th>
          <th>Planned</th>
          <th>Spent</th>
        </tr>
        @foreach($budget->expenses as $expense)
        <tr>
          <td>{{ $expense->title }}</td>
          <td>{{ number_format($expense->amount_planned / 100, 2) }}</td>
          <td>{{ number_format($expense->amount_spent / 100, 2) }}</td>
        </tr>
        @endforeach
        <tr>
          <th>
            Total
          </th>
          <th>
            {{ number_format($budget->totalExpensesPlanned() / 100, 2) }}
          </th>
          <th>
            {{ number_format($budget->totalExpensesSpent() / 100, 2) }}
          </th>
        </tr>
        <tr>
          <td>
            <input type="text" name="expense_title" class="form-control">
          </td>
          <td>
            <input type="text" name="expense_planned" class="form-control">
          </td>
          <td>
            <input type="text" name="expense_spent" class="form-control" value="0">
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <button type="submit" class="btn btn-default">Add Expense</button>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
