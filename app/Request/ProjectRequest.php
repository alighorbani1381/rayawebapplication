<?php

namespace App\Request;

use Illuminate\Http\Request;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Support\Facades\Validator;


class ProjectRequest
{

    const validString = ['۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9', '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'];

    const properties = ['name', 'lastname', 'father_name', 'meli_code', 'meli_image', 'phone', 'address', 'title', 'description', 'price', 'contract_image', 'contract_started', 'completed_at', 'date_start', 'complete_after'];

    public $contractStart = null;

    public $completedAt = null;

    public $dateStart = null;



    # Config Properties
    public function __construct()
    {
        $this->createProperies(self::properties);
    }

    # Create All Properties
    public function createProperies($array)
    {
        foreach ($array as $number => $key) {
            $this->$key = null;
        }
    }

    # Set Properties give from Request
    public function setProperies($array)
    {
        foreach ($array as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }


    # Get All Request to use in class method
    public  function setRequest(Request $request)
    {
        $this->setProperies($request->all());
    }

    # Set Date into class
    public function setDate($dateStart, $contractStart, $completedAt)
    {
        $this->dateStart = $dateStart;
        $this->contractStart = $contractStart;
        $this->completedAt = $completedAt;
    }


    # Explode Parmeter to work with date 
    public function explodeDate($orderdate)
    {
        $explodeDate = explode('/', $orderdate);
        if (count($explodeDate) != 3)
            return false;

        $date[0]   = $explodeDate[0];
        $date[1] = $explodeDate[1];
        $date[2]  = $explodeDate[2];
        return $date;
    }

    # Convert Persian string to english string
    public function convertToEnglish($string)
    {
        return strtr($string, self::validString);
    }

    # Convert English String to (INT)
    public function convertToInt($date)
    {
        foreach ($date as $dateParam) {
            $englishCharacters[] = $this->convertToEnglish($dateParam);
        }

        foreach ($englishCharacters as $englishChar) {
            $numberDate[] = (int) $englishChar;
        }

        return $numberDate;
    }

    # Convert To Gregorian Form to Insert DB
    public function getGregorianFormat($arrayDate)
    {
        return implode('-', $arrayDate);
    }

    # Compactable Method Change persian datepiceker string to gregorian date
    public function convertToGregorian($jalaliDate)
    {
        $date = $this->explodeDate($jalaliDate);
        if ($date == false)
            return 'false';

        $numberDate = $this->convertToInt($date);
        $newDate = Verta::getGregorian($numberDate[0], $numberDate[1], $numberDate[2]);
        $gregorian = $this->getGregorianFormat($newDate);
        return $gregorian;
    }

    # Normalize Date convret to Gregorian 
    public function normalizeDate()
    {
        $dateStart = $this->convertToGregorian($this->date_start);
        $contractStart = $this->convertToGregorian($this->contract_started);
        $completedAt = $this->convertToGregorian($this->completed_at);
        $this->setDate($dateStart, $contractStart, $completedAt);
    }

    # Get All Request & Get Date
    public  function getInputs()
    {
        return [
            'name'             => $this->name,
            'lastname'         => $this->lastname,
            'father_name'      => $this->father_name,
            'meli_code'        => $this->meli_code,
            'meli_image'       => $this->name,
            'phone'            => $this->phone,
            'address'          => $this->address,
            'title'            => $this->title,
            'description'      => $this->description,
            'price'            => $this->price,
            'contract_image'   => 'default',
            'contract_started' => $this->contractStart,
            'completed_at'     => $this->completedAt,
            'date_start'       => $this->dateStart,
            'complete_after'   => $this->complete_after,
        ];
    }

    # Get Validation Rules
    public function getRules()
    {
        return [
            'name'             => 'required',
            'lastname'         => 'required',
            'father_name'      => 'required',
            'meli_code'        => 'required',
            //'meli_image'       => 'default',
            'phone'            => 'required',
            'address'          => 'required',
            'title'            => 'required',
            'description'      => 'required',
            'price'            => 'required',
            'contractors'      => 'required|array',
            'categories'      => 'required|array',
            'categories.*'      => 'required|distinct|min:0|integer',
            'contractors.*'      => 'required|distinct|min:0|integer',
            //'contract_image'   => 'default',
            'contract_started' => 'required|date',
            'completed_at'     => 'required|date',
            'date_start'       => 'required|date',
            'complete_after'   => 'required|numeric|min:1',
        ];
    }

    # Main method to validate param
    public function validate(Request $request)
    {
        $this->setRequest($request);
        $this->normalizeDate();
        $inputs = $this->getInputs();
        $rules = $this->getRules();

        return Validator::make($inputs, $rules)->validate();
    }


    # Percent Divide Between Contractors
    public static function percentValidate($request)
    {
        $fileds = ['progress.*' => 'required|numeric|min:1|max:100'];
        $request->validate($fileds);
    }
}
