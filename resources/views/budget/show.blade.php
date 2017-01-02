@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $budget->title }} Income</div>

                <div class="panel-body">

                    <form action="{{ route('budget.income.store', $budget) }}" method="post">

                        {{ csrf_field() }}

                        <table class="table">

                            <tr>
                                <th>Title</th>

                                <th>Planned</th>

                                <th>Received</th>
                            </tr>

                            @foreach($budget->income as $income)

                                <tr>
                                    <td>{{ $income->title }}</td>

                                    <td>{{ $income->value_planned }}</td>

                                    <td>{{ $income->value_received }}</td>
                                </tr>

                            @endforeach

                            <tr>
                                <td>
                                    <input type="text" name="income_title" class="form-control">
                                </td>

                                <td>
                                    <input type="text" name="income_planned" class="form-control">
                                </td>

                                <td>
                                    <input type="text" name="income_received" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <button type="submit" class="btn btn-default">Add Income</button>
                                </td>
                            </tr>

                        </table>
                    </form>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection
