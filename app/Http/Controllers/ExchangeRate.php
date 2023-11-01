<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeRequest;

class ExchangeRate extends Controller
{
    private $rateJsonData = '{
        "currencies": {
            "TWD": {
                "TWD": 1,
                "JPY": 3.669,
                "USD": 0.03281
            },
            "JPY": {
                "TWD": 0.26956,
                "JPY": 1,
                "USD": 0.00885
            },
            "USD": {
                "TWD": 30.444,
                "JPY": 111.801,
                "USD": 1
            }
        }
    }';
    
    public function exchange(ExchangeRequest $request)
    {
        $rateArray = json_decode($this->rateJsonData, true);

        $source  = $request->source;
        $target = $request->target;
        $amount = $request->amount;
        $cleanedAmount = floatval(str_replace(['$', ','], '', $amount));

        if ($cleanedAmount < 0) {
            return generateFailedResponse('amount must be greater than 0');
        }

        $rate = $rateArray['currencies'][$source][$target] ?? 999;

        if ($rate == 999) {
            return generateFailedResponse('no rate data');
        }

        $ratedAmount = round($cleanedAmount * $rate, 2);

        $result = [
            'msg' => 'success',
            'amount' => '$' . number_format($ratedAmount, 2)
        ];

        return generateSuccessResponse($result, 'success');
    }
}
