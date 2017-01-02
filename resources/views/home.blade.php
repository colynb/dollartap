@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Budgets</div>

                <div class="panel-body">
                    
                    @foreach($user->budgets as $budget)
                        <a href="{{ route('budget.show', $budget)}}">{{$budget->title}}</a>
                    @endforeach

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Create a Budget</div>

                <div class="panel-body">
                    
                    <form action="{{ route('budget.store') }}" method="post">
                        
                        {{ csrf_field() }}

                        <div class="form-group">
                            
                            <label for="title">Budget Title</label>
                            <input type="text" class="form-control" name="title">

                        </div>

                        <div class="form-group">
                            
                            <button type="submit" class="btn btn-primary">Create Budget</button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
