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
                Payments
            </div>
            <div class="card-body">
                @if($payments->count())
                    <div class="table-responsive-lg">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Course</th>
                                <th>Student</th>
                                <th>Account No.</th>
                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th>Reference</th>
                                <th>Status</th>
                                <th class="text-center">Operations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $payment->course->title }}</td>
                                    <td>{{ $payment->student->name }}</td>
                                    <td>{{ $payment->account_no }}</td>
                                    <td>{{ $payment->transaction_id }}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>{{ $payment->reference }}</td>
                                    <td>@if($payment->matched()) matched, @endif @if($payment->is_verified) Verified @elseif($payment->needs_verification) Pending Verification @endif</td>
                                    <td>
                                        <div class="row justify-content-center">
                                            @if($payment->needs_verification)
                                            <form action="{{ route('admin.payment.verify', ['course'=>$payment->course, 'payment'=>$payment]) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-info btn-sm mr-1" title="delete">verify</button>
                                            </form>
                                            @endif
                                            <div>
                                                <a class="btn btn-primary btn-sm" href="{{ route('payment.edit', ['course'=>$payment->course, 'payment'=>$payment]) }}" title="edit"><span data-feather="edit" style="height: 15px; width: 15px; padding: 0"></span></a>
                                            </div>
                                            <form class="ml-1" action="{{ route('admin.payment.destroy', ['course'=>$payment->course, 'payment'=>$payment]) }}" method="post">
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
                <div class="d-flex">
                    <div class="flex-column">
                        <a href="{{ route('admin.home') }}" class="btn btn-light">Back</a>
                    </div>
                    <div class="flex-column justify-content-center">
                        {{ $payments->links() }}
                    </div>
                    <div class="flex-column">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
