@extends('layouts.app')

@section('styles')
    <style>
        th{
            background-color: #23272b;
            color: whitesmoke;
        }
        .custom-container{
            width: 75%;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid custom-container p-4">
        <div class="card">
            <div class="card-header">
                Students
            </div>
            <div class="card-body">
                @if($students->count() > 0)
                <div class="table-responsive-lg">
                    <table class="table table-light table-striped">
                        <thead class="thead">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Currently Studying</th>
                            <th>Faculty</th>
                            <th>Specialization</th>
                            <th>Institution</th>
                            <th>Address</th>
                            <th>Interests</th>
                            <th>Operations</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td> {{ $student->name }} </td>
                                <td> {{ $student->email }} </td>
                                <td> {{ $student->phone }} </td>
                                <td> {{ $student->study_level }} </td>
                                <td> {{ $student->faculty }} </td>
                                <td> {{ $student->specialization }} </td>
                                <td> {{ $student->institution }} </td>
                                <td> {{ $student->address }} </td>
                                <td> {{ $student->interest }} </td>
                                <td>
                                    <div class="row justify-content-center">
                                        <a href="{{ route('admin.student.show', $student) }}" class="btn btn-dark btn-sm" title="view"><span data-feather="eye" style="height: 15px; width: 15px; padding: 0"></span></a>
                                        <div class="pl-1">
                                            <a class="btn btn-primary btn-sm" href="{{ route('admin.student.edit', $student) }}" title="edit"><span data-feather="edit" style="height: 15px; width: 15px; padding: 0"></span></a>
                                        </div>
                                        <form class="pl-1" action="{{ route('admin.student.destroy', $student) }}" method="post">
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
                        {{ $students->links() }}
                    </div>
                    <div class="col-sm-4">
                        <a href="{{ route('admin.student.create') }}" class="btn btn-success float-right">Create</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
