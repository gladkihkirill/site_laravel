<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\DefaultController;
use App\Http\Requests\Calendar\DaySaveRequest;
use App\Repositories\Calendar\DayRepository;
use App\Repositories\Calendar\HourRepository;

use Illuminate\Http\Request;

class DayResourceController extends DefaultController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DayRepository $dayRepository)
    {  
       $week = $dayRepository->getWeek(); 
       
       return view('calendar.day.index', compact('week'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DaySaveRequest $daySaveRequest, DayRepository $dayRepository)
    {
       $data = $daySaveRequest->all();
        
       $result = $dayRepository->save($data);

       return response()->json($result);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DaySaveRequest $daySaveRequest, $id, 
    DayRepository $dayRepository)
    {
       $data = $daySaveRequest->all();

       $result = $dayRepository->update($data, $id);

       return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DayRepository $dayRepository)
    {
        $model = $dayRepository->getEdit($id);
        
        $model->delete();
        
        return 'ok';
    }
}
