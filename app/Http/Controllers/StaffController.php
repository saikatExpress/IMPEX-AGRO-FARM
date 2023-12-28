<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
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
        $staffs = Staff::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->get();

        return view('staff.staff_list', compact('staffs'));
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

            $staffObj = new Staff;

            $staff_image = $request->file('staff_image');

            if ($staff_image) {
                // Generate a unique name for the image
                $image_name = time() . '.' . $staff_image->getClientOriginalExtension();

                // Set path for storing the image
                $image_path = public_path('images/staffs') . DIRECTORY_SEPARATOR . $image_name;

                if (!is_dir(public_path('images/staffs'))) {
                    // Create the directory if it does not exist
                    mkdir(public_path('images/staffs'), 0777, true);
                }

                if (!is_writable(public_path('images/staffs'))) {
                    // Log an error or handle the issue appropriately
                    return response()->json(['error' => 'Directory is not writable'], 500);
                }

                // Resize and compress the image
                Image::make($staff_image->getRealPath())
                    ->resize(300, 200, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save($image_path, 60); // 60 is the quality of the compressed image (0-100)

                // Assign the image name to the branch object property
            }

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

            $staffObj->branch_id         = session('branch_id');
            $staffObj->name              = $name;
            $staffObj->father_name       = $fatherName;
            $staffObj->mother_name       = $motherName;
            $staffObj->email             = $email;
            $staffObj->nid_no            = $nidNo;
            $staffObj->birth_certificate = $birthCertificate;
            $staffObj->present_address   = $presentAddress;
            $staffObj->permanent_address = $permanentAddress;
            $staffObj->blood_group       = $bloodGroup;
            $staffObj->gender            = $gender;
            $staffObj->birth_date        = $birthDate;
            $staffObj->staff_image       = $image_name;
            $staffObj->status            = '1';

            $res = $staffObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Staff created successfully');
            }

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