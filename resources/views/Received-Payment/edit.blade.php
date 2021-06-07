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
            <div class="card-header">
                Edit Payment
            </div>
            <div class="card-body">
                <form action="{{ route('received-payment.update', ['course'=>$course, 'received_payment'=>$receivedPayment]) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="type">Payment Method</label>
                        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                            <option value="" selected disabled>Please Select...</option>
                            <option value="BKash" @if(old('type') ?? $receivedPayment->method == "BKash") selected @endif>BKash</option>
                            <option value="Nagad" @if(old('type') ?? $receivedPayment->method == "Nagad") selected @endif>Nagad</option>
                            <option value="Rocket" @if(old('type') ?? $receivedPayment->method == "Rocket") selected @endif>Rocket</option>
                        </select>

                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="acc">Account No.</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">+880</div>
                            </div>
                            <input id="acc" type="tel" class="form-control @error('acc') is-invalid @enderror" name="acc" value="{{ old('acc') ?? $receivedPayment->account_no }}" required>

                            @error('acc')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="trxid">Transaction ID</label>
                        <input type="text" id="trxid" name="trxid" class="form-control @error('trxid') is-invalid @enderror" value="{{ old('trxid') ?? $receivedPayment->transaction_id }}" required>

                        @error('trxid')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" id="amount" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') ?? $receivedPayment->amount }}" required>

                        @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="reference">Reference</label>
                        <input type="text" id="reference" name="reference" class="form-control @error('reference') is-invalid @enderror" value="{{ old('reference') ?? $receivedPayment->reference }}">

                        @error('reference')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">

                        @error('date')
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
