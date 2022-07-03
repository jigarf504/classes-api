<?php

namespace App\Http\Controllers;

use Illuminate\Http\{Request,JsonResponse};
use App\Models\Qualification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class QualificationController extends Controller
{
    public function index(Request $request) : JsonResponse
    {
        try {
            $selectArr = [
                'id', 'name',
                DB::raw('IF(is_active, "Active", "Inactive") AS status')
            ];
            $qualifications = Qualification::select($selectArr)->cursorPaginate($request->limit ?? 5)->withQueryString();
            $data = [];
            if ($qualifications) {
                $data = [
                    'data' => $qualifications,
                    'message' => 'The qualification details',
                    'status' => true
                ];
            } else {
                $data = [
                    'data' => null,
                    'message' => self::ERROR_MSG,
                    'status' => false
                ];
            }
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function show(Qualification $qualification) : JsonResponse
    {
        try {
            return response()->json(['data' => $qualification,'message' => 'The qualification detail', 'status' => true], 200);
        } catch (\Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }

    public function store(Request $request) : JsonResponse
    {
        try {
            $validator = Validator::make($request->all(),[
                'name' => "required|unique:qualifications,name|max:125"
            ]);
            if ($validator->fails()) {
                return $this->getValidationErrorMessageAndResponse($validator->messages()->toArray());
            }

            if ($qualification = Qualification::create($request->all())) {
                return response()->json(["message" => 'The qualification is created successfully.!!', 'status' => true,'data' => $qualification], 201);
            } else {
                return response()->json(["status" => false, 'message' => self::ERROR_MSG, 'data' => null], 500);
            }
        } catch (\Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }

    public function update(Request $request, Qualification $qualification) : JsonResponse
    {
        try {
            $validator = Validator::make($request->all(),[
                'name' => "required|unique:qualifications,name,$qualification->id|max:125"
            ]);
            if ($validator->fails()) {
                return $this->getValidationErrorMessageAndResponse($validator->messages()->toArray());
            }

            if ($qualification->update($request->all())) {
                return response()->json(["message" => 'The qualification is updated successfully.!!', 'status' => true,'data' => $qualification->refresh()], 200);
            } else {
                return response()->json(["status" => false, 'message' => self::ERROR_MSG , 'data' => null], 500);
            }
        } catch (\Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }

    public function updateStatus(Request  $request,Qualification $qualification) : JsonResponse {
        try {
            $statusArr = ['is_active' => $request->status === 'active' ? 1 : 0];
            if ($qualification->update($statusArr)) {
                return response()->json(['message' => 'The qualification status is updated successfully.!!', 'status' => true,'data' => $qualification->refresh()], 200);
            } else {
                return response()->json(['message' => self::ERROR_MSG, 'status' => false, 'data' => null], 500);
            }
        } catch (\Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }

    public function destory(Qualification $qualification) : JsonResponse
    {
        try {
            if ($qualification->delete()) {
                return response()->json(['message' => 'The qualification is deleted successfully.!!', 'status' => true,'data' => null], 200);
            } else {
                return response()->json(['message' => self::ERROR_MSG,'data' => null, 'status' => false], 500);
            }
        } catch (\Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }
}
