<?php

namespace App\Http\Requests;

use App\Http\GetTeamDataFromRequestsTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    public function withValidator(Validator $validator)
    {
        $validator->after(function (Validator $validator) {
            if (! count($validator->failed())) {
                $this->afterValidatorPasses($validator);
            }
        });
    }

    protected function afterValidatorPasses(Validator $validator): void
    {
        // Placeholder
    }
}
