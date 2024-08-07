<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use App\Models\UserSchedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function Schedule_add(Request $request)
    {
        //dd($request->all());
        $scheduel = UserSchedule::create([
            'shift_name' => $request->shift_name,
            'start_time' =>$request->start_time,
            'end_time' => $request->end_time,
        ]);
        // $scheduel->shift_name = $request->shift_name;
        // $scheduel->start_time = $request->start_time;
        // $scheduel->end_time = $request->end_time;

        // $scheduel->save();

        return redirect()->route('scheduled')->with('success','Shift Successfully Saved....');
    }

    // public function showShifts()
    // {
        
    //     $shiftss = UserSchedule::get();
    //     return view('scheduled', compact('shiftss'));
    // }
    public function destroy($id)
{
    $shift = UserSchedule::findOrFail($id);
    $shift->delete();
    return response()->json(['success' => 'Shift deleted successfully!']);
}

public function index()
    {
        $shiftss = UserSchedule::all();
        return view('scheduled.index', compact('shiftss'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'shift_name' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $shift = UserSchedule::findOrFail($id);
        $shift->shift_name = $request->shift_name;
        $shift->start_time = $request->start_time;
        $shift->end_time = $request->end_time;
        $shift->save();

        return redirect()->route('scheduled')->with('successs', 'Shift updated successfully!');
    }

}
