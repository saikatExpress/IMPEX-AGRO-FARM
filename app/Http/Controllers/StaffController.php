<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreStaffRequest;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\UpdateStaffRequest;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.create_staff');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStaffRequest $request)
    {
        try {
            DB::beginTransaction();

            $name             = $request->input('name');
            $fatherName       = $request->input('father_name');
            $motherName       = $request->input('mother_name');
            $email            = $request->input('email');
            $nidNo            = $request->input('nid_no');
            $birthCertificate = $request->input('birth_certificate');
            $presentAddress   = $request->input('present_address');
            $permanentAddress = $request->input('permanent_address');
            $bloodGroup       = $request->input('blood_group');
            $gender           = $request->input('gender');
            $birthDate        = $request->input('birth_date');

            $imageName = time() . '.' . $request->staff_image->extension();
            return $imageName;
            $request->staff_image->move(public_path('images'), $imageName);
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        //
    }
}