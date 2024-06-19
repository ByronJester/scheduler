<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\{
    User, TeacherSchedule, RoomSchedule
};
use App\Services\CsvService;

class MaintenanceController extends Controller
{
    protected $csvService;

    public function __construct(CsvService $csvService)
    {
        $this->csvService = $csvService;
    }

    public function index()
    {
        $teacherSchedules = TeacherSchedule::get();
        $roomSchedules = RoomSchedule::get();
        $teachers = User::get();

        return Inertia::render('Maintenance',[
            'teacherSchedules' => $teacherSchedules,
            'roomSchedules' => $roomSchedules,
            'teachers' => $teachers
        ]);
    }

    public function teacherScheduleCreate()
    {
        $schedule = null;
        $teachers = User::where('user_type', 'teacher')->get();
        $days = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ];


        return Inertia::render('Maintenance/TeacherScheduleCreate',[
            'teachers' => $teachers,
            'days' => $days,
            'schedule' => $schedule
        ]);
    }

    public function teacherScheduleStore(Request $request)
    {
        $data = $request->except(['id']);

        TeacherSchedule::create($data);
        return redirect()->route('maintenance');
    }

    public function teacherScheduleEdit($id)
    {
        $schedule = TeacherSchedule::where('id', $id)->first();
        $teachers = User::where('user_type', 'teacher')->get();
        $days = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ];

        return Inertia::render('Maintenance/TeacherScheduleCreate',[
            'teachers' => $teachers,
            'days' => $days,
            'schedule' => $schedule
        ]);
    }

    public function teacherScheduleUpdate(Request $request)
    {
        $id = $request->id;
        $data = $request->only(['user_id', 'day', 'start_time', 'end_time', 'class']);

        TeacherSchedule::where('id', $id)
            ->update($data);

        return redirect()->route('maintenance');
    }


    public function roomScheduleCreate()
    {
        $schedule = null;
        $teachers = User::where('user_type', 'teacher')->get();
        $days = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ];


        return Inertia::render('Maintenance/RoomScheduleCreate',[
            'teachers' => $teachers,
            'days' => $days,
            'schedule' => $schedule
        ]);
    }

    public function roomScheduleStore(Request $request)
    {
        $data = $request->except(['id']);

        RoomSchedule::create($data);
        return redirect()->route('maintenance');
    }

    public function roomScheduleEdit($id)
    {
        $schedule = RoomSchedule::where('id', $id)->first();
        $teachers = User::where('user_type', 'teacher')->get();
        $days = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ];

        return Inertia::render('Maintenance/RoomScheduleCreate',[
            'teachers' => $teachers,
            'days' => $days,
            'schedule' => $schedule
        ]);
    }

    public function roomScheduleUpdate(Request $request)
    {
        $id = $request->id;
        $data = $request->only(['user_id', 'name', 'start_time', 'end_time', 'class']);

        RoomSchedule::where('id', $id)
            ->update($data);

        return redirect()->route('maintenance');
    }

    public function upload(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'csvFile' => 'required|mimes:csv,txt|max:2048', // Example validation rules,
            'type' => 'required'
        ]);

        // Process the uploaded CSV file
        $csvData = $this->csvService->import($request->file('csvFile'), $request->type);

        // Optionally, validate and process $csvData further if needed

        // Return response
        return redirect()->back();
        // return response()->json(['message' => 'File uploaded successfully', 'data' => $csvData]);
    }
}
