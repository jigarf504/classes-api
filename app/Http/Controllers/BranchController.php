<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Exception;
use Illuminate\Http\{JsonResponse};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $selectArr = [
                'id', 'branch_code', 'name', 'email',
                'mobile', 'contact_person_name',
                'contact_person_mobile',
                'is_active'
            ];
            $sortField = $request->sort_field ?? 'id';
            $sortType = $request->sort_type ?? 'DESC';
            $perPage = $request->per_page ?? 10;

            $branches = Branch::select($selectArr)->orderBy($sortField,$sortType)->paginate($perPage)->withQueryString();
            $data = [];
            if ($branches) {
                $data = [
                    'data' => $branches,
                    'message' => 'Branches details',
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
        } catch (Exception $e) {
            return response()->json(['message' => self::ERROR_MSG, 'status' => false, 'data' => null], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), (new Branch)->rules);

            if ($validator->fails()) {
                return $this->getValidationErrorMessageAndResponse($this->modifyErrorMessage($validator->messages()->toArray()));
            }
            $branch = Branch::create($request->all());
            if ($branch) {
                return response()->json(["message" => 'Branch is created successfully.', 'status' => true, 'data' => $branch], 200);
            } else {
                return response()->json(["status" => false, 'message' => self::ERROR_MSG, 'data' => null], 500);
            }
        } catch (Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Branch $branch
     * @return JsonResponse
     */
    public function show(Branch $branch): JsonResponse
    {
        try {
            return response()->json(['data' => $branch, 'message' => 'Branch data', 'status' => true], 200);
        } catch (Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Branch $branch
     * @return JsonResponse
     */
    public function update(Request $request, Branch $branch): JsonResponse
    {
        try {
            $rulesArr = $branch->rules;
            if (isset($rulesArr['name'])) {
                $rulesArr['name'] = "required|unique:branches,name,$branch->id|max:125";
            }
            $validator = Validator::make($request->all(), $rulesArr);

            if ($validator->fails()) {
                return $this->getValidationErrorMessageAndResponse($validator->messages()->toArray());
            }

            $requestDataArr = $request->all();
            $requestDataArr['is_active'] = $requestDataArr['is_active'] == true ? 1 : 0;
            if ($branch->update($requestDataArr)) {
                return response()->json(['message' => 'Branch detail is updated successfully.!!', 'data' => $branch->refresh(), 'status' => true], 200);
            } else {
                return response()->json(['message' => self::ERROR_MSG, 'data' => null, 'status' => true], 500);
            }
        } catch (Exception $e) {
            return $this->getValidationErrorMessageAndResponse($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Branch $branch
     * @return JsonResponse
     */
    public function destroy(Branch $branch): JsonResponse
    {
        try {
            if ($branch->delete()) {
                return response()->json(['message' => 'Branch is deleted successfully.!!', 'data' => null, 'status' => true], 200);
            } else {
                return response()->json(['message' => self::ERROR_MSG, 'data' => null, 'status' => true], 500);
            }
        } catch (Exception $e) {
            return $this->getValidationErrorMessageAndResponse($e);
        }
    }

    public function bulkActions(Request $request) {
        try {
            $isOpSuccess = false;

            $branches = Branch::whereIn('id',$request->ids);
            $message = '';

            switch ($request->action) {
                case 'inactive':
                    $isOpSuccess = $branches->update(['is_active' => 0]);
                    $message = 'Branches has been inactive successfully..!!';
                    break;
                case 'active':
                    $isOpSuccess = $branches->update(['is_active' => 1]);
                    $message = 'Branches has been active successfully..!!';
                    break;
                case 'delete':
                    $isOpSuccess = $branches->delete();
                    $message = 'Branches has been deleted successfully..!!';
                    break;
            }
            if ($isOpSuccess) {
                return response()->json(['message' => $message, 'data' => null, 'status' => true], 200);
            }
            return response()->json(['message' => self::ERROR_MSG, 'data' => null, 'status' => true], 200);
        } catch (Exception $e) {
            return $this->getValidationErrorMessageAndResponse($e);
        }
    }

    public function getList(Request $request)
    {
        try {
            $branches = Branch::select([
                "id", "branch_code", "name", "is_active"
            ])
            ->when($request->q, function ($query) use ($request) {
                return $query->where("branch_code", 'like', '%' . $request->q . '%')->orWhere("name", 'Like', '%' . $request->q . '%');
            })->where("is_active", 1)->get();
            return response()->json(['message' => "branch lists", 'data' => $branches, 'status' => true], 200);
        } catch (Exception $e) {
            return $this->getValidationErrorMessageAndResponse($e);
        }
    }
}
