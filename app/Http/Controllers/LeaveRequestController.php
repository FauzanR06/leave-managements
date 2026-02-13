<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use Carbon\Carbon;
class LeaveRequestController extends Controller
{
    public function store(Request $request)
    {
        $user = auth('sanctum')->user();

        $request->validate([
            'start_date'=>'required|date|after_or_equal:today',
            'end_date'=>'required|date|after_or_equal:start_date'
        ]);

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $today = Carbon::now()->startOfDay();

        if ($startDate->isBefore($today)) {
            return response()->json(['message'=>'Start date cannot be before today'], 400);
        }

        $totalDays =
            Carbon::parse($request->start_date)
            ->diffInDays(Carbon::parse($request->end_date)) + 1;

        if ($totalDays > $user->remaining_leave) {
            return response()->json(['message'=>'Insufficient leave balance'],400);
        }

        $leave = LeaveRequest::create([
            'user_id'=>$user->id,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'total_days'=>$totalDays,
            'reason'=>$request->reason
        ]);

        return response()->json([
            'message'=>'Leave submitted',
            'data'=>$leave
        ]);
    }

    // EMPLOYEE - MY LEAVES
    public function myLeaves()
    {
        return LeaveRequest::where('user_id', auth('sanctum')->id())->get();
    }

    // ADMIN - ALL LEAVES (RELATION)
    public function index()
    {
        return LeaveRequest::with('user')->get();
    }

    // ADMIN - APPROVE
    public function approve($id)
    {
        $leave = LeaveRequest::with('user')->findOrFail($id);

        $leave->user->decrement('remaining_leave', $leave->total_days);
        $leave->update(['status'=>'APPROVED']);

        return response()->json(['message'=>'Leave approved']);
    }

    // ADMIN - REJECT
    public function reject($id)
    {
        LeaveRequest::findOrFail($id)->update(['status'=>'REJECTED']);
        return response()->json(['message'=>'Leave rejected']);
    }

    // ADMIN - GET EMPLOYEE LEAVES
    public function getEmployeeLeaves($userId)
    {
        return LeaveRequest::with('user')
            ->where('user_id', $userId)
            ->get();
    }
}
