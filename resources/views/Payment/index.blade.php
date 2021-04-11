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
            <div class="card-header bg-primary text-light">
                <h4>Admins</h4>
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
                                    <td>{{ $payment->course->name }}</td>
                                    <td>{{ $payment->student->name }}</td>
                                    <td>{{ $payment->account_no }}</td>
                                    <td>{{ $payment->transaction_id }}</td>
                                    <td>{{ $payment->reference }}</td>
                                    <td>@if($payment->is_verified) Verified @elseif($payment->needs_verification) Pending Verification @else Failed @endif</td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <div class="pl-1">
                                                <a class="btn btn-primary btn-sm" href="{{ route('payment.edit', ['course'=>$course, 'payment'=>$payment]) }}" title="edit"><span data-feather="edit" style="height: 15px; width: 15px; padding: 0"></span></a>
                                            </div>
                                            <form class="pl-1" action="{{ route('payment.destroy', ['course'=>$course, 'payment'=>$payment]) }}" method="post">
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
