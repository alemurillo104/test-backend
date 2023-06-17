<?php

namespace App\Classes;


class ProblemTwo{

    public function calculateMax(string $stringText)
    {
        $stringTextLength = strlen($stringText);
        
        $substringsList = [];
        $maximumValue = 0;

        for ($i=1; $i <= $stringTextLength ; $i++) { 
            
            $length = $i;

            for ($j=0; $j < $stringTextLength ; $j++) { 
                
                $substring = substr($stringText, $j, $length);
                
                $inJson = !$this->inJson($substring, $substringsList);

                if (strlen($substring) == $length && $inJson) {
                    $value = $this->calculate($substring, $length, $stringText);
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

        return array(
            "max" => $maximumValue,
            "list" => $substringsList
        );
    }

    private function inJson($string, $originalString)
    {
        foreach ($originalString as $key => $ele) {
            if ($ele["substring"] == $string ) {
                return true;
            }
        }
        return false;
    }

    private function calculate(string $substring, int $length, string $stringText)
    {
        $value = $length * count($this->strpos_all($stringText, $substring));
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