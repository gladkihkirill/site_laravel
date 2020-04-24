<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Http\Requests\Calendar\HourSaveRequest;
use App\Repositories\Calendar\HourRepository;
use Illuminate\Http\Request;

class HourResourceController extends Controller
{
    public function store(HourSaveRequest $request, 
        HourRepository $repository)
    {
        $data = $request->all();

        $result = $repository->save($data);

        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, HourRepository $hourRepository)
    {
      
       $hours = $hourRepository->getHours($id);
      
       return view('calendar.hour.index', compact('hours'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HourSaveRequest $hourSaveRequest, $id, 
    HourRepository $hourRepository)
    {
       $data = $hourSaveRequest->all();

       $result = $hourRepository->update($data, $id);

       return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, HourRepository $hourRepository)
    {
        $model = $hourRepository->getEdit($id);
        
        $model->delete();
        
        return 'ok';
    }
}
