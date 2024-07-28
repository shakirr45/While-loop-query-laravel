$sIAndAsiUsers = User::whereHas('roles', function($q) use ($currentLoginRolePoliceStation) {
            $q->whereJsonContains('police_stations', $currentLoginRolePoliceStation)
            ->where(function ($query) {
                $query->where('name', 'Assistant Sub Inspector (ASI)')
                        ->orWhere('name', 'Sub Inspector (SI)');
            });
        })->get()->toArray();
        
        $reArrangeSIAndAsiUsers = [];
        
        if( !empty($sIAndAsiUsers) )
        {
            foreach ( $sIAndAsiUsers as $value ){
                $reArrangeSIAndAsiUsers[$value['id']] = $value['name'].' - BP Numbher: '.$value['bp_number'];
            }
        }

compact('reArrangeSIAndAsiUsers') );

===================================================================

        $getTodayDate = Carbon::now()->format('Y-m-d');

        $allEmployees = Employee::with(['attendance'])
        ->with(['employeeDetails'])
        ->get();

        $latestAttendance = [];

        foreach ($allEmployees as $employee) {
            
            $latestAttendance[$employee->id] = Attendance::where('employee_id', $employee->id)
                ->whereDate('created_at', $getTodayDate)
                // ->latest('created_at')
                ->first();
        }

        // dd($latestAttendance);


        compact('latestAttendance'));

        into blade===>
        if(latestAttendance){

        show
        }
        else{
        not show
        }

================================================

$getTodayDate = Date("Y-m-d");


$allEmployees = Employee::whereHas('attendance', function($query) use ($getTodayDate) {
    $query->whereDate('created_at', $getTodayDate);
})->with('attendance')->get()->toArray();

just need spacipic this allEmployees ;