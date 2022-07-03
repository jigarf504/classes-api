<?php

namespace App\Http\Controllers;

use App\Models\StudentRegistration;
use Illuminate\Http\{Request,JsonResponse};

class StudentRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : JsonResponse
    {
        try {
            return response()->json(['message' => self::ERROR_MSG,'data' => null, 'status' => false], 500);
        } catch (\Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() : JsonResponse
    {
        try {
            return response()->json(['message' => self::ERROR_MSG,'data' => null, 'status' => false], 500);
        } catch (\Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : JsonResponse
    {
        try {
            return response()->json(['message' => self::ERROR_MSG,'data' => null, 'status' => false], 500);
        } catch (\Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentRegistration  $studentRegistration
     * @return \Illuminate\Http\Response
     */
    public function show(StudentRegistration $studentRegistration) : JsonResponse
    {
        try {
            return response()->json(['message' => self::ERROR_MSG,'data' => null, 'status' => false], 500);
        } catch (\Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentRegistration  $studentRegistration
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentRegistration $studentRegistration) : JsonResponse
    {
        try {
            return response()->json(['message' => self::ERROR_MSG,'data' => null, 'status' => false], 500);
        } catch (\Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentRegistration  $studentRegistration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentRegistration $studentRegistration) : JsonResponse
    {
        try {
            return response()->json(['message' => self::ERROR_MSG,'data' => null, 'status' => false], 500);
        } catch (\Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentRegistration  $studentRegistration
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentRegistration $studentRegistration) : JsonResponse
    {
        try {
            return response()->json(['message' => self::ERROR_MSG,'data' => null, 'status' => false], 500);
        } catch (\Exception $e) {
            return $this->getCatchErrorMessage($e);
        }
    }
}
