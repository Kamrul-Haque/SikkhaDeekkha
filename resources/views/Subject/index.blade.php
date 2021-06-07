@extends('layouts.app')

@section('styles')
    <style>
        th{
            background-color: #23272b;
            color: whitesmoke;
        }
    </style>
@endsection

@section('content')
    <div class="container container-custom py-4">
        <div class="card">
            <div class="card-header">
                Subjects
            </div>
            <div class="card-body">
                @if($subjects->count()>0)
                    <div class="table-responsive-lg">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Subject Name</th>
                                <th class="text-center">Operations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td> {{ $subject->subject_name }} </td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <div class="pl-1">
                                                <a class="btn btn-primary btn-sm" href="{{ route('admin.subject.edit', $subject) }}" title="edit"><span data-feather="edit" style="height: 15px; width: 15px; padding: 0"></span></a>
                                            </div>
                                            <form class="pl-1" action="{{ route('admin.subject.destroy', $subject) }}" method="post">
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
                <div class="row">
                    <div class="col-sm-4">
                        <a href="{{ route('admin.home') }}" class="btn btn-light">Back</a>
                    </div>
                    <div class="col-sm-4 d-flex justify-content-center">
                        {{ $subjects->links() }}
                    </div>
                    <div class="col-sm-4">
                        <a href="{{ route('admin.subject.create') }}" class="btn btn-success float-right">Create</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
