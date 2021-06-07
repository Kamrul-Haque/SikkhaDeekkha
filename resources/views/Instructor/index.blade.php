@extends('layouts.app')

@section('styles')
    <style>
        th{
            background-color: #23272b;
            color: whitesmoke;
        }
        .custom-container{
            width: 85%;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid custom-container p-4">
        <div class="card">
            <div class="card-header bg-primary text-light">
                Instructors
            </div>
            <div class="card-body">
                @if($instructors->count() > 0)
                    <div class="table-responsive-lg">
                        <table class="table table-light table-striped">
                            <thead class="thead">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Institution</th>
                                <th>Address</th>
                                <th>Verified</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($instructors as $instructor)
                                <tr>
                                    <td> {{ $loop->index+1 }} </td>
                                    <td> {{ $instructor->name }} </td>
                                    <td> {{ $instructor->email }} </td>
                                    <td> {{ $instructor->phone }} </td>
                                    <td> {{ $instructor->designation }} </td>
                                    <td> {{ $instructor->department }} </td>
                                    <td> {{ $instructor->institution }} </td>
                                    <td> {{ $instructor->address }} </td>
                                    <td> @if($instructor->is_verified) true @else false @endif </td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <a href="{{ route('admin.instructor.show', $instructor) }}" class="btn btn-dark btn-sm" title="view"><span data-feather="eye" style="height: 15px; width: 15px; padding: 0"></span></a>
                                            <div class="pl-1">
                                                <a class="btn btn-primary btn-sm" href="{{ route('admin.instructor.edit', $instructor) }}" title="edit"><span data-feather="edit" style="height: 15px; width: 15px; padding: 0"></span></a>
                                            </div>
                                            <form class="pl-1" action="{{ route('admin.instructor.destroy', $instructor) }}" method="post">
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
                        {{ $instructors->links() }}
                    </div>
                    <div class="col-sm-4">
                        <a href="{{ route('admin.instructor.create') }}" class="btn btn-success float-right">Create</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
