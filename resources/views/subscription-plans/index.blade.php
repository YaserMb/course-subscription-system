@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Subscription Plans</h2>
                    @if(auth()->user()?->subscription_plan_id)
                        <a href="{{ route('subscription-plans.create') }}" class="btn btn-primary">Create New Plan</a>
                    @endif
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Download Limit</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plans as $plan)
                                    <tr>
                                        <td>{{ $plan->name }}</td>
                                        <td>{{ $plan->description }}</td>
                                        <td>${{ number_format($plan->price, 2) }}</td>
                                        <td>{{ $plan->limit }}</td>
                                        <td>
                                            @if(empty(auth()->user()?->subscription_plan_id))
                                                <form action="{{ route('subscription-plans.subscribe', $plan) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-primary">Subscribe</button>
                                                </form>
                                            @else
                                                <div class="btn-group">
                                                    <a href="{{ route('subscription-plans.edit', $plan) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="{{ route('subscription-plans.destroy', $plan) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
