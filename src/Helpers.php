<?php

namespace Finder;

class Helpers
{
    public function months($period)
    {
        if(!is_numeric($period)) {
            return '';
        }

        return ($period == 1) ? "1 month" : "$period months";
    }

    public function yesNo($value)
    {
        if ($value == '0' || strtolower($value) == 'no') {
            return 'No';
        }
        if ($value == '1' || strtolower($value) == 'yes') {
            return 'Yes';
        }

        return '';
    }

    public function money($value, $decimals = 2)
    {
        if (!is_numeric($value) || !is_numeric($decimals)) {
            return $value;
        }

        return sprintf('$%s', number_format($value, $decimals));
    }

    public function date($data, $format = 'Y-m-d')
    {
        try {
            $time = new \DateTime($data);
        }
        catch(Exception $e) {
            return $data;
        }

        return $time->format($format);
    }

    public function pluralize($data, $unit)
    {
        if (!is_numeric($data) || is_numeric($unit)) {
            return '';
        }
        if ($data == 1) {
            return sprintf('%s %s', $data, $unit);
        } else {
            return sprintf('%s %ss', $data, $unit);
        }
    }

    public function currency($amount, $formatter)
    {
        if (!is_numeric($amount) || is_numeric($formatter)) {
            return '';
        }

        $symbols = [
                        'USD' => '$',
                        'EUR' => '€',
                        'GBP' => '£',
                   ];

        $symbol = $symbols[$formatter];

        $amount = $this->money($amount);

        return str_replace('$',$symbol,$amount);
    }

    public function lists($list){

        if (!is_array($list)) {
            return '';
        }

        $no_of_elements = count($list);
        $temp_list = $list;
        $first_element = array_shift($temp_list);

        switch ($no_of_elements) {
            case 1:
                return $first_element;
                break;
            
            default:
                $last = array_pop($list);

                if($no_of_elements > 2) {
                    $new_list = implode(', ', $list);
                }else {
                    $new_list = $first_element;
                }

                return sprintf('%s and %s', $new_list, $last);
                break;
        }

    }
}
