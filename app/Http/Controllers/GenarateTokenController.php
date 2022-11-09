<?php

namespace App\Http\Controllers;

use App\Candidates;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use Maatwebsite\Excel\Facades\Excel;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

class GenarateTokenController extends Controller
{
    public function genarateToken()
    {

        return view('testingOfficer.genarateToken.create');
    }

    public function savegenarateToken(Request $request)
    {
        if ($request->action_type == 1) { //1=Export
            if ($request->submitType == 1) { //1=Generate CSV
                return Excel::download(new UsersExport($request->boardno), 'users.xlsx');

            } else { //1=Generate Token
                $params = [
                    'user_id'       => auth()->user()->id,
                    'boardno'       => $request->boardno,
                    'secret_key'    => 'i$Sb_p$y@Pi~2022',
                ];

                $client = new Client(['base_uri' => 'http://192.168.10.45/api/']);


                try{
                    $response = $client->post(
                        'applicant-by-board-chest-psy',
                        [
                            RequestOptions::JSON => $params,

                        ],
                        ['Content-Type' => 'application/json']
                    );

                    if ($response->getBody()) {
                        $response = json_decode($response->getBody(), true);
                    }

                    if (!empty($response)) {

                        foreach ($response['data'] as $key => $value) {
                            if ($value['chestno'] != null) {
                                Candidates::create([
                                    'board_no'    => $value['board']['board_no'],
                                    'chest_no'    => $value['chestno'],
                                    'roll_no'     => $value['rollno'],
                                    'name'        => $value['name'],
                                    'image'       => $value['photo'],
                                    'course'      => $value['batch'],
                                    'secret_key'  => Str::random(6),
                                ]);
                            }
                        }

                        return Excel::download(new UsersExport($request->boardno), 'users.xlsx');

                        $output['messege'] = 'Genarated Successfully!';
                        $output['msgType'] = 'Success';
                    } else {
                        $output['messege'] = 'Automated Verification Failed';
                        $output['msgType'] = 'danger';
                    }
                }
                catch (ConnectException $e) {
                    // Connection exceptions are not caught by RequestException
                    $output['messege'] = 'Automated Verification Failed';
                    $output['msgType'] = 'danger';
                }
                catch (RequestException $e) {
                    $output['messege'] = 'Automated Verification Failed';
                    $output['msgType'] = 'danger';
                }

                // $security_token = 'i$Sb_p$y@Pi~2022';
                // $boardno = $request->boardno;
                // $client = new \GuzzleHttp\Client();

                // $apiRequest = $client->get('http://192.168.10.45/api/');
                // $response = json_decode($apiRequest->getBody());

                return redirect()->back()->with($output);
            }
        } else { //2=Import

            $board_no           = $request->board_no;
            $no_of_candidate    = $request->no_of_candidate;
            $candidateInfo      = Candidates::where('board_no', $board_no)->orderBy('id', 'desc')->first();

            if ($board_no !='' && $no_of_candidate>0) {
                for($i=0; $i<=$no_of_candidate; $i++){
                    Candidates::create([
                        'chest_no'      => ($candidateInfo)? $candidateInfo->chest_no+1: 1,
                        'board_no'      => $board_no,
                        'name'          => NULL,
                        'roll_no'       => ($candidateInfo)? $candidateInfo->roll_no+1: 1,
                        'secret_key'    => Str::random(6),
                    ]);
                }  
                
                return Excel::download(new UsersExport($board_no), 'users.xlsx');
                $output['messege'] = 'Candidates has been inserted successfully';
                $output['msgType'] = 'success';        
                return redirect()->back();      
            } else {
                return redirect()->back();
            }
            
            
            
        }

    }
}
