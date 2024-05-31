@extends('dashboard\layout')

@section('content')

    <!-- Content -->
    <div class="content">
        <h1>Manage Requests</h1>
        
        <!-- Requests Table -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Request ID</th>
                    <th scope="col">Client Name</th>
                    <th scope="col">Room Type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $itm) 
                <tr>
                    <td>{{$itm->id}}</td>
                    <td>{{$itm->user->name}}</td>
                    <td>{{$itm->room->number}}</td>
                    <td>{{$itm->status}}</td>
                    <td>
                        <form action="{{route('reservations.update', $itm->id)}}" method="post" style="display: inline-block">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                        </form>
                        <form action="{{route('reservations.destroy', $itm->id)}}" method="post" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                        </form>
                    </td>
                </tr>
                
                @endforeach

                <!-- Repeat for other requests -->
            </tbody>
        </table>
    </div>


@endsection