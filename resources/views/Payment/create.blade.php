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
        .info{
            border: 2px dashed darkgray;
        }
        em{
            font-weight: 900;
            font-style: normal;
        }
        .wishlist-button{
            outline: none;
            background: transparent;
            border: none;
            padding-left: 0;
        }
        .wishlist-button:hover{
            text-decoration: underline;
        }
        th{
            font-weight: 900;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <div class="info table-responsive-lg">
            @if($course->paymentInfos->count())
                <table class="table border-bottom">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Method</th>
                            <th>Account No.</th>
                            <th>Account Type</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($course->paymentInfos as $paymentInfo)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $paymentInfo->method }}</td>
                            <td>{{ $paymentInfo->account_no }}</td>
                            <td>{{ $paymentInfo->account_type }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    <p>Please pay <em>{{ $course->fee }} {{ $course->currency }}</em> to any of the above accounts & give the payment information below.</p>
                </div>
            @else
                <div class="text-center my-2">
                    <h5><strong>No Payment Methods Added yet!</strong></h5>
                </div>
            @endif
        </div>
        <br>
        <div class="card">
            <div class="card-header">
                Payment
            </div>
            <div class="card-body">
                <form action="{{ route('payment.store', $course) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="type">Payment Method</label>
                        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                            <option value="" selected disabled>Please Select...</option>
                            <option value="BKash" @if(old('type') == "BKash") selected @endif>BKash</option>
                            <option value="Nagad" @if(old('type') == "Nagad") selected @endif>Nagad</option>
                            <option value="Rocket" @if(old('type') == "Rocket") selected @endif>Rocket</option>
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
                            <input id="acc" type="tel" class="form-control @error('acc') is-invalid @enderror" name="acc" value="{{ old('acc') }}" required>

                            @error('acc')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="trxid">Transaction ID</label>
                        <input type="text" id="trxid" name="trxid" class="form-control @error('trxid') is-invalid @enderror" value="{{ old('trxid') }}" required>

                        @error('trxid')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" id="amount" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required>

                        @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="reference">Reference</label>
                        <input type="text" id="reference" name="reference" class="form-control @error('reference') is-invalid @enderror" value="{{ old('reference') }}">

                        @error('reference')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <span class="float-right">
                            @can('wishlist', $course)
                                <form action="{{ route('student.wishlist', $course) }}" method="post">
                                @csrf
                                <button type="submit" class="text-danger wishlist-button"><span data-feather="bookmark" class="pr-2"></span>wishlist for later</button>
                            </form>
                            @elsecan('removeWishlist', $course)
                                <form action="{{ route('student.wishlist.remove', $course->wishlists()->where('student_id', auth()->user()->id)->first()) }}" method="post">
                                @method('DELETE')
                                    @csrf
                                <button type="submit" class="text-danger wishlist-button">remove from wishlist</button>
                            </form>
                            @endcan
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
