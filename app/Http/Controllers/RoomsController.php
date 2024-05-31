<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    // عرض قائمة الغرف
    public function index()
    {
        $rooms = Room::all();
        $reservations = Reservation::all();

        return view('front.index', compact('rooms'));
    }

    // عرض نموذج إنشاء غرفة جديدة
    public function create()
    {
        $rooms = Room::all();

        return view('dashboard.manageRooms', compact('rooms'));
    }

    // حفظ الغرفة الجديدة
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|string|max:255|unique:rooms,number,' . $request->id,
            'status' => 'required|string|in:available,booked,pending',
            'type' => 'required|string|in:single,double,suite',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);
    
        if ($request->id) {
            $room = Room::find($request->id);
        } else {
            $room = new Room();
        }
    
        $room->number = $request->number;
        $room->status = $request->status ?: 'available';
        $room->type = $request->type ?: 'single';
        $room->price = $request->price;
        $room->description = $request->description;
        $room->save();
    
        return redirect()->route('rooms.create')->with('success', 'تم إنشاء/تعديل الغرفة بنجاح.');
    }
    

    // عرض تفاصيل الغرفة
    public function show($id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.show', compact('room'));
    }

    // عرض نموذج تعديل الغرفة
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('dashboard.editRoom', compact('room'));
    }
    // تحديث بيانات الغرفة
    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $request->validate([
            'number' => 'required|string|max:255|unique:rooms,number,' . $id,
            'status' => 'required|string|in:available,booked,pending',
            'type' => 'required|string|in:single,double,suite',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $room = Room::findOrFail($id);
        $room->number = $request->number;
        $room->status = $request->status;
        $room->type = $request->type;
        $room->price = $request->price;
        $room->description = $request->description;
        $room->save();

        return redirect()->route('rooms.create')->with('success', 'تم تحديث بيانات الغرفة بنجاح.');
    }

    // حذف الغرفة
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('rooms.create')->with('success', 'تم حذف الغرفة بنجاح.');
    }
}
