<?php

namespace App\Http\Controllers\Site\Coupom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Response;
use App\Models\Coupom;

class CoupomController extends Controller
{
    // public function index() 
    // {
    //     $coupom_code = "12345abcde";
    //     //$coupom_code = $request->coupom_code;

    //     $exist = Coupom::where([
    //         ['code', $coupom_code],
    //         ['active', 1], 
    //     ])->exists();

    //     if(!$exist) {
    //         return Response::json(['msg' => 'Invalid Coupom!']);    
    //     }
                
    //     $coupom = Coupom::where([
    //         ['code', $coupom_code],
    //         ['active', 1], 
    //     ])->firstOrFail();
        
    //     $now        = Carbon::now();
    //     $start_date = Carbon::parse($coupom->start_date);
    //     $end_date   = Carbon::parse($coupom->end_date); 
            
    //     if ($now->greaterThanOrEqualTo($start_date) && $now->lessThanOrEqualTo($end_date)) {
            
    //         if($coupom->percentage){
    //             $type  = 'Percentage';
    //             $value = $coupom->percentage;                
    //         }
            
    //         if($coupom->value){
    //             $type  = 'Value';
    //             $value = $coupom->value;
    //         }
    //         return Response::json(['msg' => 'Valid coupom', 'type' => $type,'value' => $value]);
    //     }        
    // }

    public function verifiy(Request $request)
    {
        $coupom_code = $request->coupom_code;
        
        $exist = Coupom::where([
            ['code', $coupom_code],
            ['active', 1], 
        ])->exists();

        if(!$exist) {
            return Response::json(['msg' => 'Invalid Coupom!' ]);    
        }
                
        $coupom = Coupom::where([
            ['code', $coupom_code],
            ['active', 1], 
        ])->firstOrFail();
        
        $now        = Carbon::now();
        $start_date = Carbon::parse($coupom->start_date);
        $end_date   = Carbon::parse($coupom->end_date); 
            
        if ($now->greaterThanOrEqualTo($start_date) && $now->lessThanOrEqualTo($end_date)) {
            
            if($coupom->type == 1){
                $type  = 'Money';
            }else{
                $type  = 'Percentage';
            }
            $value = $coupom->value;
            
            return Response::json(['msg' => 'Valid coupom!', 'type' => $type,'value' => $value]);
        }
    }
}
