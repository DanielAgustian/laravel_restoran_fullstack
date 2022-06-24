<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Session;
class DashboardController extends Controller
{
    //
    function dashboardPage(Request $request){

        // $resto = DB::table('restoran')->get();
        $schedule = DB::table('restoran')->join('schedule', 'schedule.restoran_id', '=','restoran.id')
            ->select('schedule.id as id', 'restoran.name as resto_name', 'schedule.start_day', 'schedule.end_day', 'schedule.start_time', 'schedule.end_time')->paginate(10);
        // dd($resto, $schedule);
        return view('dashboard.dashboard_admin', compact( 'schedule'));
        // return view('master-dashboard');
    }
    function dashboardRestoPage(Request $request){
        $resto = DB::table('restoran')->paginate(10);
        return view('dashboard.dashboard-admin-resto', compact( 'resto'));
    }
    function addRestaurantPage(){
        return view('dashboard.add_restaurant');
    }
    function addRestaurantProcess(Request $request){
        if ($request->name) {
            # code...

            DB::table('restoran')->insert([
                'name' => $request->name,
                'created_at' => now(),

            ]);
            return redirect()->route('dashboardRestoPage')->with('successMsg', 'Menambah Restoran Berhasil!');
        }else{
            return redirect()->back()->with('errMsg', 'Nama Restoran tidak boleh kosong!');
        }
    }

    function addSchedulePage(){
        $restoran = DB::table('restoran')->get();
        $days = ['Monday', "Tuesday", "Wednesday", "Friday", "Saturday", "Sunday"];
        return view('dashboard.add_schedule', compact('restoran', 'days'));
    }

    function addScheduleProcess(Request $request){
        // dd($request->all());
        if (!isset($request->start_day) || !isset($request->end_day) || !isset($request->restoran_id) || !isset($request->start_time) || !isset($request->end_time)) {
            // dd($request->all(), !$request->start_day);
            return redirect()->back()->with('errMsg', 'Data tidak boleh kosong!');
        }
       
        $schedule = DB::table('schedule')->insert([
            'restoran_id' => $request->restoran_id,
            'start_day' => $request->start_day,
            'end_day' => $request->end_day,
            'start_time' =>"2000-01-01 ".$request->start_time,
            'end_time' => "2000-01-01 ".$request->end_time,
            'created_at'=>now()
        ]);
        return redirect()->route('dashboardPage')->with('successMsg', 'Menambah Jadwal Restoran Berhasil!');
    }
}
