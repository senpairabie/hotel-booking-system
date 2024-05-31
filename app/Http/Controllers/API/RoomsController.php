<?php

namespace App\Http\Controllers\Api;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomsController extends Controller
{
    // عرض قائمة الغرف
    public function index()
    {
        $rooms = Room::all();
        return response()->json($rooms);
    }

    // إنشاء غرفة جديدة
    public function store(Request $request)
    {
        $room = Room::create($request->all());
        return response()->json($room, 201);
    }

    // عرض بيانات غرفة معينة
    public function show($id)
    {
        $room = Room::findOrFail($id);
        return response()->json($room);
    }

    // تحديث بيانات غرفة معينة
    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->update($request->all());
        return response()->json($room, 200);
    }

    // حذف غرفة معينة
    public function destroy($id)
    {
        Room::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
