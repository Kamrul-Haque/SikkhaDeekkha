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
                <h4>Payment</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('payment-info.store', $course) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="service">Payment Method</label>
                        <select name="service" id="service" class="form-control @error('service') is-invalid @enderror" required>
                            <option value="" selected disabled>Please Select...</option>
                            <option value="BKash" @if(old('service') == "BKash") selected @endif>BKash</option>
                            <option value="Nagad" @if(old('service') == "Nagad") selected @endif>Nagad</option>
                            <option value="Rocket" @if(old('service') == "Rocket") selected @endif>Rocket</option>
                        </select>

                        @error('service')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="acc">Account No.</label>
                        <input type="number" id="acc" name="acc" class="form-control @error('acc') is-invalid @enderror" value="{{ old('acc') }}" required>

                        @error('acc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="type">Account Type</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="" selected disabled>Please Select...</option>
                            <option value="Merchant" @if(old('type') == "Merchant") selected @endif>Merchant</option>
                            <option value="Personal" @if(old('type') == "Personal") selected @endif>Personal</option>
                        </select>

                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
