<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'machine_id' => 'required|exists:machines,id',
            'incident_type' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'is_supervised'=>'boolean',
            'registration_date' => 'required|date',
        ];
    }
}
