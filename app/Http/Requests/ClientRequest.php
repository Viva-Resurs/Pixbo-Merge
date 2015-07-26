<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ClientRequest extends Request
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
     * TODO: Add MAC Address rule!
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'ip_address' => 'required|ip',
            //'mac_address' => array('regex:/^(([0-9a-fA-F]{2}-){5}|([0-9a-fA-F]{2}:){5})[0-9a-fA-F]{2}$/'),
            //'user_id' => 'requred',
            'screengroup_id' => 'required',
            'is_active' => 'requried',
        ];
    }
}

