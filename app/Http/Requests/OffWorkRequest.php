<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OffWorkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employee_id' => 'required|exists:employees,id',
            'description' => 'required',
            // 'date_range' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'accepted_by' => 'nullable|exists:users,id',
            'accepted_at' => 'nullable'
        ];
    }
}
