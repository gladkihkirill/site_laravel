<?php

namespace App\Repositories\Calendar;

use App\Models\Calendar\Hour as Model;
use App\Repositories\AbstractRepository;

class HourRepository extends AbstractRepository
{
    public function getModelClass()
    {
        return Model::class;
    }

    public function getHours($id)
    {
        $result = $this->start()
        ->where('day_id','=', $id)
        ->get();

        return $result;
    }

    public function getAll()
    {
        $result = $this->start()->all();
        
        return $result;
    }

    public function update($data, $id)
    {
        $model = $this->getEdit($id);
      
        $model->update($data);

        return $model;
    }

    public function save($data)
    {
        $result = Model::create($data);

        return $result;
    }
}