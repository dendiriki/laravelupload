@extends('layouts.app')

@section('title', 'Ticket Detail')

@section('content')
    <div class="container">
        <h2 class="mb-4">Ticket Detail</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Ticket Information</h5>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">Number Ticket</th>
                                    <td>{{ $ticket->number_ticket }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">User</th>
                                    <td>{{ $ticket->user->username }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Document Name</th>
                                    <td>{{ $ticket->document_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Department</th>
                                    <td>{{ $ticket->department->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Description</th>
                                    <td>{{ $ticket->description }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Document Information</h5>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">Company</th>
                                    <td>{{ $ticket->company->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Document File</th>
                                    <td>{{ $ticket->document_file }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Document Status</th>
                                    <td>{{ $ticket->document_status }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Document Note</th>
                                    <td>{{ $ticket->document_note }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal</th>
                                    <td>{{ $ticket->tanggal }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
