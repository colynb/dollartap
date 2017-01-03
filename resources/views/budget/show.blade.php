@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('budget.partials.income')
            <hr>
            @include('budget.partials.expenses')
        </div>
    </div>
</div>
@endsection
