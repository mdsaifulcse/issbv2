<?php

namespace App\Http\Controllers;

use App\BoardCandidate;
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
use DB;

class GenarateTokenController extends Controller
{
    public function genarateToken()
    {
        return view('testingOfficer.genarateToken.create');
    }


    public function savegenarateToken(Request $request)
    {

        $activeBoard = BoardCandidate::where('status', 1)->first();

        if (empty($activeBoard)){
            $output['messege'] = 'There is no active board';
            $output['msgType'] = 'success';
            return back()->with($output);
        }

        $candidatesByBoard=Candidates::where('board_no',$activeBoard->board_name)->get();

        DB::beginTransaction();

        try {

            $params = [
                'user_id'       => auth()->user()->id,
                'boardno'       => $activeBoard->board_name,
                'secret_key'    => 'i$Sb_p$y@Pi~2022',
            ];

            $client = new Client(['base_uri' => 'http://192.168.10.45/api/']);

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

            if (!empty($response)) { // if can get data from master database----------------

                if (count($candidatesByBoard)>0){
                    $this->deleteCandidateByBoard($activeBoard);
                }

                foreach ($response['data'] as $key => $value) {
                    if ($value['chestno'] != null) {
                        Candidates::create([
                            'board_no'    => $value['board']['board_no'],
                            'chest_no'    => $value['chestno'],
                            'roll_no'     => $value['rollno'],
                            'name'        => $value['name'],
                            'image'       => $value['photo'],
                            'course'      => $value['batch'],
                            'secret_key'  => $this->getGenerateSecretKey(), // default digit 4
                        ]);
                    }
                }

                DB::commit();
                return Excel::download(new UsersExport($request->boardno), 'users.xlsx');

                $output['messege'] = 'Genarated Successfully!';
                $output['msgType'] = 'Success';

            } else { // if can not get data from master database then from local database------------------------

                return $this->createLocalCandidate($candidatesByBoard,$activeBoard);

                $output['messege'] = 'Candidates has been inserted successfully';
                $output['msgType'] = 'success';
                return redirect()->back()->with($output);
            }



        } catch (ConnectException $e) {
            // Connection exceptions are not caught by RequestException
            $output['messege'] = 'Automated Verification Failed';
            $output['msgType'] = 'danger';

           return $this->createLocalCandidate($candidatesByBoard,$activeBoard);



        }
        catch (RequestException $e) {
            $output['messege'] = 'Automated Verification Failed';
            $output['msgType'] = 'danger';

           return $this->createLocalCandidate($candidatesByBoard,$activeBoard);

        }
        catch (\Exception $e) {
            DB::rollback();
            return '000f';
        }

    }


    public function createLocalCandidate($candidatesByBoard,$activeBoard){
        if (count($candidatesByBoard)>0){
            $this->deleteCandidateByBoard($activeBoard);
        }

        for($i=0; $i<$activeBoard->total_candidate; $i++){
            Candidates::create([
                'chest_no'      => $i+1,
                'board_no'      => $activeBoard->board_name,
                'name'          => ' ',//NULL,
                'roll_no'       => 0,
                'secret_key'    => $this->getGenerateSecretKey(), // default digit 4
            ]);
        }
        DB::commit();
        return Excel::download(new UsersExport($activeBoard->board_name), 'users.xlsx');
    }


    public function getGenerateSecretKey($numberOfDigits=NULL) {
        if ($numberOfDigits==NULL)
        {
            $digits = 4;
        }else{
            $digits = $numberOfDigits;
        }

        $code = rand(pow(10, $digits-1), pow(10, $digits)-1);
        // $code = 1234;
        return  $code;
    }

    public function deleteCandidateByBoard($activeBoard){
        Candidates::where('board_no',$activeBoard->board_name)->delete();
    }



    public function savegenarateTokenOld(Request $request) // old token generate --
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
                        'name'          => 'name',//NULL,
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
