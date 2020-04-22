<?php

namespace App\Repositories\Calendar;

use App\Models\Calendar\Day as Model;
use App\Repositories\AbstractRepository;

class DayRepository extends AbstractRepository
{
    public function getModelClass()
    {
        return Model::class;
    }

    public function getWeek()
    {
        $day  = date('Y-m-d');
        $week = date('Y-m-d', strtotime('+7 days'));

        $result = $this
        ->start()
        ->where('day','>=', $day)
        ->where('day','<=', $week)
        ->get();

        return $result;
    }

    public function getAll()
    {
        $result = $this->start()->all();
        
        return $result;
    }

    public function save($data)
    {
       $result = Model::create($data);

       return $result;
    }

    public function update($day, $id)
    {
        $model = $this->getEdit($id);
      
        $model->update($day);

        return $model;
    }

}