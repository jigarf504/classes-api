<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\{Request,JsonResponse};

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $sortField = $request->sort_field ?? 'id';
            $sortType = $request->sort_type ?? 'DESC';
            $perPage = $request->per_page ?? 10;
            $inquiries = Inquiry::with("branch")->orderBy($sortField, $sortType)->paginate($perPage);
            $data = [];
            if ($inquiries) {
                $data = [
                    'data' => $inquiries,
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() : JsonResponse
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : JsonResponse
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Inquiry $inquiry) : JsonResponse
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Inquiry $inquiry) : JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inquiry $inquiry) : JsonResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inquiry $inquiry) : JsonResponse
    {
        //
    }
}
