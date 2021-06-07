@extends('layouts.app')

@section('styles')
    <style>
        th{
            background-color: #23272b;
            color: whitesmoke;
        }
        .container-custom{
            width: 75%;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid container-custom py-4">
        <div class="card">
            <div class="card-header">
                Received Payments
            </div>
            <div class="card-body">
                @if($receivedPayments->count())
                    <div class="table-responsive-lg">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Method</th>
                                <th>Account No.</th>
                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th>Reference</th>
                                <th>Date</th>
                                <th class="text-center">Operations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($receivedPayments as $payment)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $payment->method }}</td>
                                    <td>{{ $payment->account_no }}</td>
                                    <td>{{ $payment->transaction_id }}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>{{ $payment->reference }}</td>
                                    <td>{{ $payment->date }}</td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <div class="pl-1">
                                                <a class="btn btn-primary btn-sm" href="{{ route('received-payment.edit', ['course'=>$course, 'received_payment'=>$payment]) }}" title="edit"><span data-feather="edit" style="height: 15px; width: 15px; padding: 0"></span></a>
                                            </div>
                                            <form class="pl-1" action="{{ route('received-payment.destroy', ['course'=>$course, 'received_payment'=>$payment]) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" title="delete"><span data-feather="trash-2" style="height: 15px; width: 15px; padding: 0"></span></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h2 class="d-flex justify-content-center">NO RECORDS FOUND</h2>
                @endif
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <div class="flex-column">
                        <a href="{{ route('module.index', $course) }}" class="btn btn-light">Back</a>
                    </div>
                    <div class="flex-column justify-content-center">
                        {{ $receivedPayments->links() }}
                    </div>
                    <div class="flex-column">
                        <a href="{{ route('received-payment.create', $course) }}" class="btn btn-success">ADD</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
