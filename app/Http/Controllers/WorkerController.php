<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Worker;

class WorkerController extends BaseController
{
    public function index()
    {
        $result = Worker::select('id','firstName','lastName','email')->with('employments:workerEmail,companyName,jobTitle,startDate,endDate')->get();
        return response()->json([
            'data' => [
                'workers' => $result
            ]
        ]);
    }
    public function create(Request $request)
    {
        $this->validate($request, [
            "firstName" => "required|string",
            "lastName" => "required|string",
            "email" => "required|unique:worker|email"
        ]);
        $data = $request->all();
        $result = Worker::create($data);

        return response()->json([
            'data' => [
                'id' => $result->id
            ]
        ]);
    }
} 