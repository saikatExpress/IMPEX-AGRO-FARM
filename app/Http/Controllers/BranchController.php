<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;

class BranchController extends Controller
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
        return view('branch.create_branch');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request)
    {
        try {
            DB::beginTransaction();

            $branchObj = new Branch;

            $branch_image = $request->file('branch_image');

            if ($branch_image) {
                // Generate a unique name for the image
                $image_name = time() . '.' . $branch_image->getClientOriginalExtension();

                // Set path for storing the image
                $image_path = public_path('images/branches/' . $image_name);

                // Resize and compress the image
                Image::make($branch_image->getRealPath())
                    ->resize(300, 200, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save($image_path, 60); // 60 is the quality of the compressed image (0-100)

                // Assign the image name to the branch object property
            }

            $branchObj->branch_name    = $request->input('branch_name');
            $branchObj->branch_email   = $request->input('branch_email');
            $branchObj->branch_address = $request->input('branch_address');
            $branchObj->branch_image   = $image_name;
            $branchObj->status         = '1';
            $branchObj->created_at     = Carbon::now();

            $res = $branchObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Branch Created Successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        //
    }
}