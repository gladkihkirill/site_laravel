<?php

namespace App\Http\Requests\Calendar;

use Illuminate\Foundation\Http\FormRequest;

class DaySaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $day  = date('Y-m-d', strtotime('-1 days'));
        $week = date('Y-m-d', strtotime('+8 days'));

        return [
            'day' => "required|unique:days|before:$week|after:$day"
        ];
    }

    public function attributes()
    {
        return [
            'day' => 'День записи'
        ];
    }

    public function messages()
    {
        return [
            'day.required' => 'Поле :attribute не заполнено',
            'day.unique'   => 'Этот день уже занят',
            'day.after'   => 'Введенная вами дата не укладывается в эту неделю',
            'day.before'   =>  'Введенная вами дата не укладывается в эту неделю',
        ];
    }
}
