<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ReservationsController extends Controller
{
    // عرض قائمة الحجوزات
    public function index()
    {
        $users = User::all();
        $rooms = Room::all();
        $reservations = Reservation::where('status', 'pending')->get();
        return view('dashboard.manageRequests', compact('reservations'));        
    }

    // عرض نموذج إنشاء حجز جديد
    public function create()
    {
        return view('reservations.create');
    }

    // حفظ الحجز الجديد
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'status' => 'required|string|in:pending,approved,cancelled',
        ]);
    
        $reservation = new Reservation();
        $reservation->user_id = $request->user_id;
        $reservation->room_id = $request->room_id;
        $reservation->status = $request->status;
        $reservation->save();
    
  
        $room = Room::find($request->room_id);
        $room->status = 'pending';
        $room->save(); 
        
        return redirect()->route('rooms.index')->with('success', 'تم إنشاء الحجز بنجاح.');
    }
    
    // عرض تفاصيل الحجز
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.show', compact('reservation'));
    }

    // عرض نموذج تعديل الحجز
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit', compact('reservation'));
    }

    // تحديث بيانات الحجز
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,approved,cancelled,approved',
        ]);
    
        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->status;
        $reservation->save();

        $room = Room::find($reservation->room_id);
        $room->status ='booked';
        $room->save();
    
        return redirect()->route('reservations.index')->with('success', 'تم تحديث بيانات الحجز بنجاح.');
    }
    

    // حذف الحجز
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        $room = Room::find($reservation->room_id);
        $room->status = 'available';
        $room->save();
        

        return redirect()->route('reservations.index')->with('success', 'تم حذف الحجز بنجاح.');
    }
}
