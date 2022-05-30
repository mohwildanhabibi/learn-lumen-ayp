<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Employment;

class EmploymentController extends BaseController
{
    public function create(Request $request)
    {
        try {
            $this->validate($request, [
                "workerEmail" => "required|string",
                "companyName" => "required|string",
                "jobTitle" => "required|string",
                "startDate" => "required|date",
            ]);
            $data = $request->all();
            $exist = Employment::where('workerEmail', '=', $request->workerEmail)->where(function ($query) {
                    $query->where('endDate', '>=', date("Y-m-d"))
                        ->orWhereNull('endDate');
                    })->first();
                
            // ->andWhere('endDate', '>=', date("Y-m-d"))->orWhereNull('endDate')->first();
            if ($exist) {
                throw new \Exception("There is active employement for this worker", 1);
            }
            $result = Employment::create($data);
    
            return response()->json([
                'data' => [
                    'id' => $result->id
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                $th->getMessage()
            ]);
        }
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            "workerEmploymentId" => "required|exists:employment,id",
            "endDate" => "nullable|date"
        ]);
        Employment::find($request->workerEmploymentId)->update(['endDate' => $request->endDate]);

        return response()->json([
            'data' => [
                'id' => $request->workerEmploymentId
            ]
        ]);
    }
} 