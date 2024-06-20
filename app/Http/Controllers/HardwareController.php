<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    User, TeacherSchedule, Trigger
};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HardwareController extends Controller
{
    public function checkAccess(Request $request)
    {
        $id = $request->query('id');
        $user = null;

        if(!!$id) {
            $user = User::where('fingerprint_id', $id)->first();
        } else {
            return response()->json("No fingerprint ID provided.");
        }

        if($user) {
            $now = Carbon::now();

            $currentTime = $now->format('H:i:s');

            $isCorrect = TeacherSchedule::where('user_id', $user->id)
                ->where('start_time', '>=', $currentTime) // Check if current time is after or at start_time
                ->where('end_time', '<', $currentTime)
                ->first();

            if($isCorrect) {
                $triggerData = Trigger::first();
                $triggerData->access_trigger = 1;

                if($triggerData->save()) {
                    return response()->json("Trigger updated successfully.");
                } else {
                    return response()->json("Error updating trigger.");
                }
            } else {
                return response()->json("Current time is not within the allowed time range.");
            }
        } else {
            return response()->json("Fingerprint ID not found.");
        }

        // return response()->json('asdasd');
    }

    public function updateTriger(Request $request)
    {
        $trigger = $request->query('access_trigger');

        if(!!$trigger) {
            $triggerData = Trigger::first();
            $triggerData->access_trigger = $trigger;

            if($triggerData->save()) {
                return response()->json("Record updated successfully.");
            } else {
                return response()->json("Error updating record.");
            }
        } else {
            return response()->json("Invalid parameters");
        }
    }

    public function checkTrigger(Request $request)
    {
        $trigger = Trigger::first();

        return response()->json($trigger);
    }
}
