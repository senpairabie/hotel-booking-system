@extends('dashboard.layout')

@section('content')
    <!-- Content -->
    <div class="content">
        <h1>Manage Rooms</h1>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#roomModal">Add New Room</button>
        
        <!-- Rooms Table -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Room Number</th>
                    <th scope="col">Room Type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room )
                <tr>
                    <td>{{$room->number}}</td>
                    <td>{{$room->type}}</td>
                    <td>{{$room->status}}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#roomModal" onclick="editRoom({{$room->id}})">Edit</button>
                        <form id="deleteRoomForm{{$room->id}}" action="{{route('rooms.destroy', $room->id)}}" method="post" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Room Modal -->
    <div class="modal fade" id="roomModal" tabindex="-1" aria-labelledby="roomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roomModalLabel">Add/Edit Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="roomForm" action="{{route('rooms.store')}}" method="post">
                        @csrf
                        <input type="hidden" id="methodInput" name="_method" value="POST">
                        <input type="hidden" id="roomIdInput" name="id" value="">
                        <div class="form-group">
                            <label for="roomNumber">Number</label>
                            <input type="text" name="number" class="form-control" id="roomNumber" placeholder="Number">
                        </div>
                        <div class="form-group">
                            <label for="roomType">Room Type</label>
                            <select class="form-control" id="roomType" name="type">
                                <option value="single">Single</option>
                                <option value="double">Double</option>
                                <option value="suite">Suite</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="roomStatus">Status</label>
                            <select class="form-control" id="roomStatus" name="status">
                                <option value="available">Available</option>
                                <option value="booked">Booked</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="roomPrice">Price</label>
                            <input type="text" name="price" class="form-control" id="roomPrice" placeholder="Price">
                        </div>
                        <div class="form-group">
                            <label for="roomDescription">Description</label>
                            <input type="text" name="description" class="form-control" id="roomDescription" placeholder="Description">
                        </div>
                        <button type="submit" class="btn btn-primary" id="roomFormSubmitBtn">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
function editRoom(roomId) {
    var room = {!! json_encode($rooms->find($room->id)) !!};
    document.getElementById("roomNumber").value = room.number;
    document.getElementById("roomType").value = room.type;
    document.getElementById("roomStatus").value = room.status;
    document.getElementById("roomPrice").value = room.price;
    document.getElementById("roomDescription").value = room.description;
    document.getElementById("roomIdInput").value = room.id;
    document.getElementById("methodInput").value = "PUT"; 
    document.getElementById("roomForm").action = "{{route('rooms.update', '')}}" + "/" + room.id;
    document.getElementById("roomFormSubmitBtn").innerText = "Update";
    console.log(roomId);
}

</script>

@endsection
