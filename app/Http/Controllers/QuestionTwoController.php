<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Classes\ProblemTwo;

class QuestionTwoController extends Controller
{
    private $problenTwo;

    public function __construct()
    {
        $this->problenTwo = new ProblemTwo();
    }
    
    public function index(Request $request)
    {
        try {
            $stringText = $request->stringText;

            $result = $this->problenTwo->calculateMax($stringText);

            $response = array(
                "ok" => true, 
                "data" => $result
            );
            return $response;
        } catch (\Throwable $th) {
            $response = array(
                "ok" => false,
                "data" => "Something got wrong, please try again",
                "msg" => $th->getMessage()
            );
            return $response;
        }
    }
}