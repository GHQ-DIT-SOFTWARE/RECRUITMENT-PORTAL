<?php

namespace App\Http\Controllers\Api\Arm;

use App\Http\Controllers\Controller;
use App\Models\ArmOfService;
use DataTables;
use Illuminate\Http\Request;

class ArmOfServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ArmOfService::orderBy('arm_of_service', 'ASC')->get();
        return  Datatables::of($data)
            ->addColumn('action', function ($row) {
                $action = '';
                $action .= '<div class="btn-group"> <button type="button" class="btn btn-outline-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button><div class="dropdown-menu bg-light" style="">';
                $action .= '<a class="dropdown-item btn-edit" href="javascript:void(0)" data-href="' . route('step.arm.show', $row->uuid) . '">Edit</a>';
                $action .= '<a class="dropdown-item btn-delete text-danger" href="javascript:void(0)" data-href="' . route('step.arm.destroy', $row->uuid) . '">Delete</a>';
                $action .= '</div></div>';

                return $action ?? '...';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'arm_of_service' => 'required',
        ]);
        ArmOfService::create([
            'arm_of_service' => $request->arm_of_service,

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ArmOfService $arm)
    {
        return $arm;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArmOfService $arm)
    {
        $validated = $request->validate([
            'arm_of_service' => 'required',
        ]);
        $arm->update([
            'arm_of_service' => $request->arm_of_service,
        ]);
    }

    public function destroy(ArmOfService $arm)
    {
        $arm->delete();
    }
}
