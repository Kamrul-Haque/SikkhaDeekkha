@extends('layouts.app')

@section('styles')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header bg-primary text-light">
                <h4>Edit Payment</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('payment.update', ['course'=>$course, 'payment'=>$payment]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="acc">Account No.</label>
                        <input type="number" id="acc" name="acc" class="form-control @error('acc') is-invalid @enderror" value="{{ old('acc') ?? $payment->account_no }}" required>

                        @error('acc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="trxid">Transaction ID</label>
                        <input type="text" id="trxid" name="trxid" class="form-control @error('trxid') is-invalid @enderror" value="{{ old('trxid') ?? $payment->transaction_id }}" required>

                        @error('trxid')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" id="amount" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') ?? $payment->amount }}" required>

                        @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="reference">Reference</label>
                        <input type="text" id="reference" name="reference" class="form-control @error('reference') is-invalid @enderror" value="{{ old('reference') ?? $payment->reference }}">

                        @error('reference')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <a href="{{ back() }}" class="btn btn-warning">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
