<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LPController extends Controller
{
    //
    public function homepage(Request $request){
        if (!empty($request->resto_id) || !empty($request->time) || !empty($request->date)) {
            # code...

            // dd($request->all() );
            $schedule = $this->filterHome($request);
        }else{
            $schedule = DB::table('restoran')->join('schedule', 'schedule.restoran_id', '=','restoran.id')
            ->select('schedule.id as id', 'restoran.name as resto_name', 'schedule.start_day', 'schedule.end_day', 'schedule.start_time', 'schedule.end_time')->paginate(10);
        }
        $resto = DB::table('restoran')->get();
       
        return view('landing-page', compact('schedule', 'resto'));
    }
    
    function filterHome(Request $request){
        $data =  DB::table('restoran')->join('schedule', 'schedule.restoran_id', '=','restoran.id')
        ->select('schedule.id as id', 'restoran.name as resto_name', 'schedule.start_day', 'schedule.end_day', 'schedule.start_time', 'schedule.end_time', 'restoran.id as resto_id');
        if (!empty($request->date)) {
            $date = date('w', strtotime($request->date)) - 1;
            if ($date == -1) {
                $date = 0;
            }
        }

        if (!empty($request->time)) {
            $time = '2000-01-01 '.$request->time.":00";
        }
        // dd($date, $time);
        if (!empty($request->resto_id) && !empty($request->time) && !empty($request->date)) {
            // $code = $data->where('schedule.end_day', '>', $date)->get();
            $code = $data->where([
                ['schedule.restoran_id', '=', $request->resto_id],
                ['schedule.start_day', '<= ', $date],
                ['schedule.end_day', '>=', $date],
                ['schedule.start_time', '<=', $time],
                ['schedule.end_time', '>=', $time]
            ]);
           
        }else if (!empty($request->resto_id) && !empty($request->time)){
            $code = $data->where([
                ['schedule.restoran_id', '=', $request->resto_id],
                ['schedule.start_time', '<=', $time],
                ['schedule.end_time', '>=', $time]
            ]);
        }else if (!empty($request->resto_id) && !empty($request->date)){
            $code = $data->where([
                ['schedule.restoran_id', '=', $request->resto_id],
                ['schedule.start_day', '<= ', $date],
                ['schedule.end_day', '>=', $date],
            ]);
        }else if (!empty($request->date)){
            $code = $data->where([
                ['schedule.start_day', '<= ', $date],
                ['schedule.end_day', '>=', $date],
            ]);
        }else if (!empty($request->time)){
            $code = $data->where([
                ['schedule.start_time', '<=', $time],
                ['schedule.end_time', '>=', $time]
            ]);
        }else{
            $code = $data->where([
                ['schedule.restoran_id', '=', $request->resto_id],
               
            ]);
        }
        return $code->paginate(10);
    }
}
