<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class Helper{
    public static function initPath($path){
		$arrPath = explode('/', $path);
		
		$cur = '';
		foreach($arrPath as $val){
			$cur .= '/'.$val;
			if(!Storage::disk('public')->exists($cur))
				Storage::disk('public')->makeDirectory($cur);
		}
		// dd($arrPath);
	}

	/**
	 * Format date to be displayed on views
	 */
	public static function displayDateFormat(string $dateString, string $format = "Y-m-d H:i:s")
	{
		return \Carbon\Carbon::createFromFormat($format, $dateString);
	}

    public static function convert($current, $convert, $value)
    {
        $to = Uom::find($current);
        $from = Uom::find($convert);
        $current_stock = $value;
        if($to){
            if($to->parents == null){
                $convert = $current_stock * $from->multiplier;
            }else{
                $convert = $current_stock * $from->multiplier / $to->multiplier;
            }
        }else{
            $convert = $current_stock * $from->multiplier;
        }
        return $convert;
    }

	public static function numberToRomanRepresentation($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}