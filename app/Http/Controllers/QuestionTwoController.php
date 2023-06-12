<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionTwoController extends Controller
{
    public function index(Request $request)
    {
        $cadena = $request->cadena;

        $cadenaLength = strlen($cadena);
        
        $substringsList = [];
        $maximumValue = 0;

        for ($i=1; $i <= $cadenaLength ; $i++) { 
            
            $length = $i;

            for ($j=0; $j < $cadenaLength ; $j++) { 
                
                $substring = substr($cadena, $j, $length);
                
                $inJson = !$this->inJson($substring, $substringsList);

                if (strlen($substring) == $length && $inJson) {
                    $value = $this->calculate($substring, $length, $cadena);
                    if ($value > $maximumValue) {
                        $maximumValue = $value;
                    }
                    
                    $array = array(
                        "substring" => $substring, 
                        "value" => $value
                    );
                    array_push($substringsList, $array );
                }
            }
        }

        $response = array(
            "ok" => true, 
            "data" => array(
                "max" => $maximumValue,
                "list" => $substringsList
            )
        );
        return $response;
    }

    private function inJson($string, $cadena)
    {
        foreach ($cadena as $key => $ele) {
            if ($ele["substring"] == $string ) {
                return true;
            }
        }
        return false;
    }

    private function calculate(string $substring, int $length, string $cadena)
    {
        $value = $length * count($this->strpos_all($cadena, $substring));
        // $value = $length * substr_count($cadena, $substring);
        return $value;
    }

    private function strpos_all($string, $substrNeeded) {
        $offset = 0;
        $allpos = array();
        while (($pos = strpos($string, $substrNeeded, $offset)) !== FALSE) {
            $offset   = $pos + 1;
            $allpos[] = $pos;
        }
        return $allpos;
    }
}