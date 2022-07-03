<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Exception;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $selectArr = [
                'id', 'course_code', 'name', 'full_payment',
                'installment_payment',
                DB::raw('IF(is_active, "Active", "Inactive") AS status')
            ];
            $courses = Course::select($selectArr)->cursorPaginate(5)->withQueryString();
            $data = [];
            if ($courses) {
                $data = [
                    'data' => $courses,
                    'message' => 'course details',
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
            return $this->getCatchErrorMessage($e);
        }
    }

    public function show(Course $course): JsonResponse
    {
        try {
            return response()->json(['data' => $course, 'data' => 'course detail', 'status' => true], 200);
        } catch (Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), (new Course)->rules);
            if ($validator->fails()) {
                return $this->getValidationErrorMessageAndResponse($validator->messages());
            }

            if ($course = Course::create($request->all())) {
                return response()->json(["message" => 'course is added successfully.!!', 'data' => $course, 'status' => true], 201);
            } else {
                return response()->json(["status" => false, 'message' => self::ERROR_MSG, 'data' => null], 500);
            }
        } catch (Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }

    public function update(Request $request, Course $course): JsonResponse
    {
        try {
            $rulesArr = (new Course)->rules;
            if (isset($rulesArr['name'])) {
                $rulesArr['name'] = "required|unique:courses,name,$course->id|max:125";
            }

            $validator = Validator::make($request->all(), $rulesArr);
            if ($validator->fails()) {
                return $this->getValidationErrorMessageAndResponse($validator->messages()->toArray());
            }

            if ($course->update($request->all())) {
                return response()->json(["message" => 'The course is updated successfully.!!','data' => $course->refresh(), 'status' => true], 200);
            } else {
                return response()->json(["status" => false, 'message' => self::ERROR_MSG,'data' => null], 200);
            }
        } catch (Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }

    public function destory(Course $course): JsonResponse
    {
        try {
            if ($course->delete()) {
                return response()->json(['message' => 'The course detail is deleted successfully.!!','data' => null, 'status' => true], 200);
            } else {
                return response()->json(['message' => self::ERROR_MSG,'data' => null, 'status' => false], 500);
            }
        } catch (Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }
}
