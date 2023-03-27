<?php

namespace App\Http\Controllers;
use\App\TestList;
use App\TestConfiguration;
use App\ResultConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Validator;

class ResultConfigController extends Controller
{
    public function index(){
        $test_list = TestList::get();
        return view('create_result_config', compact('test_list'));
    }


    public function loadTestConfigDataByTestId($testId){

        $testConfigData=TestConfiguration::where('test_for',$testId)->latest()->first();
        $totalItems=$testConfigData?$testConfigData->total_item+1:0;

        return view('load_test_config_data',compact('testConfigData','totalItems'));
    }

    public function saveResultConfig(Request $request){

        $existsResultConfig=ResultConfig::where(['test_id'=>$request->test_id,'test_config_id'=>$request->test_config_id])->first();

        if($existsResultConfig){
            return redirect()->back()->with('errors','Result config already exists');
        }


        $validator = Validator::make($request->all(), [
            
            'raw_score' => 'required|array',
            'raw_score.*' => 'numeric:min:0|max:999',
            'estimated_score' => 'required|array',
            'estimated_score.*' => 'numeric:min:0|max:999',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //return $request;
        
        DB::beginTransaction();
        try{
        foreach($request->raw_score as $key=>$raw_score){
            //return $request->estimated_score;

            $resultConfigInput[]=[
                'raw_score'=>$raw_score,
                'estimated_score'=>$request->estimated_score[$key],
                'test_id'=>$request->test_id,
                'test_config_id'=>$request->test_config_id,
            ];

        }
        //return $resultConfigInput;

        ResultConfig::insert($resultConfigInput);
        DB::commit();
        return redirect()->back()->with('success','Product Data Successfully Save');
    }catch(Exception $e){
        DB::rollback();
        return redirect()->back()->with('error',$e->getMessage());
    }
    }
}
