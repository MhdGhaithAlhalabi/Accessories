<?php

namespace App\Traits;

trait GeneralTrait
{

    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    public function returnError( $msg)
    {
        return response()->json([
            'status' => false,
            'msg' => $msg,

        ],400);
    }


    public function returnSuccessMessage($msg = "")
    {
        return response()->json([
            'status' => true,
            'msg' => $msg,
        ],200);
    }

    public function returnData($key, $value, $msg = "")
    {
        return response()->json([
            'status' => true,
            'msg' => $msg,
            $key => $value
        ],200);
    }


    //////////////////
    public function returnValidationError($validator)
    {
        return $this->returnError($validator);
    }


  /*  public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }

    public function getErrorCode($input)
    {
        if ($input == "name")
            return 'E0001';

        else if ($input == "password")
            return 'E002';

        else if ($input == "phone")
            return 'E003';

        else if ($input == "city")
            return 'E004';
        else if ($input == "message")
            return 'E005';
        else if ($input == "customer_id")
            return 'E006';
        else if ($input == "amount")
            return 'E007';
        else if ($input == "address")
            return 'E008';
        else if ($input == "status")
            return 'E009';
        else if ($input == "product_id")
            return 'E010';
        else if ($input == "cart_id")
            return 'E011';
        else if ($input == "qty")
            return 'E012';
        else if ($input == "color")
            return 'E013';
        else if ($input == "has_name")
            return 'E014';
        else if ($input == "has_measure")
            return 'E015';
        else if ($input == "rate")
            return 'E016';

               else
            return "";
    }*/


}
