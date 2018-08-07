<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\Poli;
use App\Models\Patient;
use App\Models\Message;
use Crud;
use Carbon\Carbon;

class MessageController extends Controller
{
    // public function __construct(Patient $patient, Message $message)
    // {
    //     $this->patient = $patient;
    //     $this->message = $message;
    // }

    public function index()
    {
        $title = 'Halaman Pesan Masuk';
        $messages = Message::all();
        return view('message')->with('messages',$messages)->with('title',$title);
    }

    public function list(Message $message)
    {

        $data = Crud::getAll($message);
        return Datatables::of($data)->addIndexColumn()->make(true);
    }

    public function readSms()
    {       
        $content = json_encode([
            'filters' => [
                [
                    [
                        'field' => 'message',
                        'operator' => 'like',
                        'value' => '%REG%'
                    ],
                    [
                        'field' => 'status',
                        'operator' => '=',
                        'value' => 'Received'
                    ],
                    [
                        'field' => 'device_id',
                        'operator' => '=',
                        'value' => '95828'
                    ]
                ]
            ],
            'order_by' => [
                [
                    'field' => 'created_at',
                    'direction' => 'DESC'
                ]
            ],
            'limit'   => 10,
            'offset'  => 0
        ]);
        // dd($content);
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://smsgateway.me/api/v4/message/search",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $content,
        CURLOPT_HTTPHEADER => array(
            "Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUzMDgwNDcwMSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjU2MzQ1LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.caxPwJZ-NKebIeo5LO6n8yEbbr2u0zto4Oc2inq_Mbk",
            "Content-Type: application/json"
        ),
        ));
        
        $response = json_decode(curl_exec($curl));
        
        curl_close($curl);

        return $response->results;
    }

    public function saveSms(Message $message, Patient $patient)
    {
        $dataMessages = $this->readSms();
        foreach($dataMessages as $dataMessage)
        {
            $checkExist = Message::where('message_id', $dataMessage->id)->first();
            if($checkExist)
            {
                return $this->processSms($patient);
            }
            $store['device_id'] = $dataMessage->device_id;
            $store['phone_number'] = $dataMessage->phone_number;
            $store['message'] = $dataMessage->message;
            $store['message_id'] = $dataMessage->id;
            $store['status'] = 'Belum Di Proses';

            $save = Crud::save($message, $store);
        }

        return $this->processSms($patient);
    }

    public function sendSms($phone_number, $status, $queue_no = null, $poli_code = null)
    {
        $message = $status ? 'Selamat Anda Berhasil Terdaftar!!, Nomor Antrian Anda Adalah '.$queue_no.' Kode Poli '.$poli_code.' Silakan Datang Tepat Waktu Karena Jika Terlambat Anda Harus Mendaftar Ulang Kembali'
                    : 'Format Sms Salah Atau Kode Poli Salah';
        $content = json_encode([
            [
                'phone_number' => $phone_number,
                'message' => $message,
                'device_id' => '95828'
            ]
        ]);
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://smsgateway.me/api/v4/message/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $content,
        CURLOPT_HTTPHEADER => array(
            "Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUzMDgwNDcwMSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjU2MzQ1LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.caxPwJZ-NKebIeo5LO6n8yEbbr2u0zto4Oc2inq_Mbk",
            "Content-Type: application/json"
        ),
        ));

        $response = curl_exec($curl);

        return $response;
    }

    public function sendSmsExist($phone_number)
    {
        $content = json_encode([
            [
                'phone_number' => $phone_number,
                'message' => 'Anda Sudah Terdaftar',
                'device_id' => '95828'
            ]
        ]);
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://smsgateway.me/api/v4/message/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $content,
        CURLOPT_HTTPHEADER => array(
            "Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUzMDgwNDcwMSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjU2MzQ1LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.caxPwJZ-NKebIeo5LO6n8yEbbr2u0zto4Oc2inq_Mbk",
            "Content-Type: application/json"
        ),
        ));

        $response = curl_exec($curl);

        return $response;
    }

    public function processSms(Patient $patient)
    {
        $messages = Message::where('status', 'Belum Di Proses')->get();
        foreach($messages as $message)
        {
            $data = $message->message.'#'.$message->message_id.'#'.$message->phone_number;
            $word = preg_split('/[#,]+/', $data, 5);
            $this->savePatient($word, $patient);
            // array_push($arr, $word);
        }
    }



    public function savePatient($data, Patient $patient)
    {
        $getPoli = Poli::where('poli_code', $data[2])->first();
        if($getPoli)
        {
            $checkData = Patient::where('queue_code', $data[3])->first();
            if($checkData)
            {
                return $this->sendSmsExist($data[4]);
            }
            $getLastQueue = Crud::base($patient)->whereYear('register_time', Carbon::now()->year)
            ->whereMonth('register_time', Carbon::now()->month)->where('poli_id', $getPoli->id)
            ->orderBy('id', 'desc')->first();
            $store['phone_number']=$data[4];
            $store['name']=$data[1];
            $store['queue_no']= $getLastQueue ? $getLastQueue->queue_no + 1 : '1';
            $store['queue_code'] = $data[3];
            $store['register_time'] = Carbon::now();
            $store['poli_id'] = $getPoli->id;
    
            $save = Crud::save($patient, $store);
            if($save)
            {
                $update = Message::where('message_id', $save->queue_code)->update(['status' => 'Terdaftar']);
                return $this->sendSms($data[4], True, $save->queue_no, $data[2]);
            } else {
                $update = Message::where('message_id', $data[3])->update(['status' => 'Format Salah']);
                return $this->sendSms($data[4], false);
            }

        } else {
            $update = Message::where('message_id', $data[3])->update(['status' => 'Format Salah']);
            return $this->sendSms($data[4], false);
        }
    }
}
