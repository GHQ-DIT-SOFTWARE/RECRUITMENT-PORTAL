<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Phases;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\Interview;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ApiInterviewController extends Controller
{


    public function applicant_interview(Request $request)
    {
        // $query = Applicant::whereHas('interview_phase')->whereNotNull('interview_status');
        $query = Applicant::whereHas('interview_phase', function ($q) {
            $q->whereNull('interview_status'); // Show only applicants where interview_status is NULL
        });


        // Search functionality for multiple fields
        if ($request->has('search_query') && $request->input('search_query') != '') {
            $searchQuery = $request->input('search_query');
            $query->where(function ($q) use ($searchQuery) {
                $q->where('surname', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('other_names', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('applicant_serial_number', 'LIKE', '%' . $searchQuery . '%');
            });
        }

        // Exact match for sex
        if ($request->has('sex') && in_array($request->input('sex'), ['MALE', 'FEMALE'])) {
            $query->where('sex', '=', $request->input('sex'));
        }

        // Exact match for qualification
        if ($request->has('qualification') && $request->input('qualification') != '') {
            $query->where('qualification', '=', $request->input('qualification'));
        }

        return DataTables::of($query)
            ->addColumn('checkbox', function ($record) {
                return '<div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input approve-checkbox"
                                data-record-id="' . $record->id . '"
                                id="approve-checkbox-' . $record->id . '">
                            <label class="custom-control-label"
                                for="approve-checkbox-' . $record->id . '"> </label>
                        </div>';
            })
            ->editColumn('qualification', function ($record) {
                switch ($record->qualification) {
                    case 'DISQUALIFIED':
                        return '<span class="badge badge-danger">DISQUALIFIED</span>';
                    case 'PENDING':
                        return '<span class="badge badge-warning">PENDING</span>';
                    case 'QUALIFIED':
                        return '<span class="badge badge-success">QUALIFIED</span>';
                    default:
                        return '';
                }
            })
            ->rawColumns(['checkbox', 'qualification'])
            ->make(true);
    }


    public function master_interview_applicant(Request $request)
    {
        $query = Interview::with('applicant');

        // Filter by vetting status (QUALIFIED or DISQUALIFIED)
        if ($request->has('interview_status') && in_array($request->input('interview_status'), ['QUALIFIED', 'DISQUALIFIED'])) {
            $query->where('interview_status', '=', $request->input('interview_status'));
        }

        // Filter by applicant's sex
        if ($request->has('sex') && in_array($request->input('sex'), ['MALE', 'FEMALE'])) {
            $query->whereHas('applicant', function ($q) use ($request) {
                $q->where('sex', '=', $request->input('sex'));
            });
        }

        // Single search query for various fields
        if ($request->has('search_query') && $request->input('search_query') != '') {
            $searchQuery = $request->input('search_query');
            $query->where(function ($q) use ($searchQuery) {
                $q->whereHas('applicant', function ($subQuery) use ($searchQuery) {
                    $subQuery->where('surname', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('other_names', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('applicant_serial_number', 'LIKE', '%' . $searchQuery . '%')
                    ;
                });
            });
        }



        return DataTables::of($query)
            ->addColumn('surname', function ($interview) {
                return $interview->applicant->surname ?? 'N/A';
            })
            ->addColumn('other_names', function ($interview) {
                return $interview->applicant->other_names ?? 'N/A';
            })
            ->addColumn('sex', function ($interview) {
                return $interview->applicant->sex ?? 'N/A';
            })
            ->addColumn('commission_type', function ($interview) {
                return $interview->applicant->commission_type ?? 'N/A';
            })
            ->addColumn('arm_of_service', function ($interview) {
                return $interview->applicant->arm_of_service ?? 'N/A';
            })
            ->addColumn('contact', function ($interview) {
                return $interview->applicant->contact ?? 'N/A';
            })
            ->addColumn('region_name', function ($interview) {
                return $interview->applicant->regions->region_name ?? 'N/A';
            })
            ->addColumn('branch_name', function ($interview) {
                return $interview->applicant->branches->branch ?? 'N/A';
            })
            ->addColumn('applicant_serial_number', function ($interview) {
                return $interview->applicant->applicant_serial_number ?? 'N/A';
            })
            ->addColumn('action', function ($interview) {
                $statusUpdateUrl = $interview ? route('test.interview-status-update', ['uuid' => $interview->uuid]) : '#';
                $action = '<div class="btn-group" role="group">';
                if ($interview) {
                    $action .= '<a href="' . $statusUpdateUrl . '" class="btn btn-success btn-sm"><i class="feather icon-edit"></i>&nbsp;Update Status</a>';
                } else {
                    $action .= '<a href="#" class="btn btn-secondary btn-sm disabled" title="Not Available"><i class="feather icon-edit"></i>&nbsp;Update Not Yet</a>';
                }
                $action .= '</div>';
                return $action;
            })
            ->editColumn('interview_status', function ($interview) {
                switch ($interview->interview_status) {
                    case 'DISQUALIFIED':
                        return '<span class="badge badge-danger">DISQUALIFIED</span>';
                    case 'PENDING':
                        return '<span class="badge badge-warning">PENDING</span>';
                    case 'QUALIFIED':
                        return '<span class="badge badge-success">QUALIFIED</span>';
                    default:
                        return '';
                }
            })
            ->rawColumns(['action', 'interview_status'])
            ->make(true);
    }
}
