<?php
declare (strict_types = 1);
namespace App\Http\Controllers\Api\Phases;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\BasicFitness;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ApiBasicFitnessController extends Controller
{
    // public function applicant_basicfit_table(Request $request)
    // {
    //     $query = Applicant::with(['regions', 'branches'])->whereHas('basicfitness');
    //     // Exact match for sex
    //     if ($request->has('sex') && in_array($request->input('sex'), ['MALE', 'FEMALE'])) {
    //         $query->where('sex', '=', $request->input('sex'));
    //     }
    //     // Partial match for surname
    //     if ($request->has('surname') && $request->input('surname') != '') {
    //         $query->where('surname', 'LIKE', '%' . $request->input('surname') . '%');
    //     }
    //     // Partial match for other names
    //     if ($request->has('other_names') && $request->input('other_names') != '') {
    //         $query->where('other_names', 'LIKE', '%' . $request->input('other_names') . '%');
    //     }
    //     // Exact match for commission type
    //     if ($request->has('commission_type') && $request->input('commission_type') != '') {
    //         $query->where('commission_type', '=', $request->input('commission_type'));
    //     }
    //     // Exact match for arm of service
    //     if ($request->has('arm_of_service') && $request->input('arm_of_service') != '') {
    //         $query->where('arm_of_service', '=', $request->input('arm_of_service'));
    //     }
    //     // Exact match for branch
    //     if ($request->has('branch') && $request->input('branch') != '') {
    //         $query->where('branch', '=', $request->input('branch'));
    //     }
    //     // Exact match for region
    //     if ($request->has('region') && $request->input('region') != '') {
    //         $query->where('region', '=', $request->input('region'));
    //     }
    //     // Exact match for qualification
    //     if ($request->has('qualification') && $request->input('qualification') != '') {
    //         $query->where('qualification', '=', $request->input('qualification'));
    //     }
    //     // Partial match for applicant serial number
    //     if ($request->has('applicant_serial_number') && $request->input('applicant_serial_number') != '') {
    //         $query->where('applicant_serial_number', 'LIKE', '%' . $request->input('applicant_serial_number') . '%');
    //     }
    //     return DataTables::of($query)
    //         ->addColumn('region_name', function ($applicant) {
    //             return $applicant->regions ? $applicant->regions->region_name : 'N/A';
    //         })
    //         ->addColumn('branch_name', function ($applicant) {
    //             return $applicant->branches ? $applicant->branches->branch : 'N/A';
    //         })
    //         ->addColumn('action', function ($row) {
    //             // Generate URL for Applicant bodyselec status using Applicant's uuid
    //             $statusUrl = route('fitnesstest.basicfitness-status', ['uuid' => $row->uuid]);
    //             // Fetch the related bodyselec record using applicant_id
    //             $fitness = BasicFitness::where('applicant_id', $row->id)->first();
    //             // Generate URL for updating bodyselec status using the bodyselec's uuid
    //             $statusUpdateUrl = $fitness
    //             ? route('fitnesstest.basicfitness-status-update', ['uuid' => $fitness->uuid])
    //             : '#'; // Fallback if no bodyselec exists
    //             $action = '<div class="btn-group" role="group">';
    //             // Add the link for viewing status
    //             $action .= '<a href="' . $statusUrl . '" class="btn btn-info btn-sm has-ripple"><i class="feather icon-edit"></i>&nbsp;Fitness Test<span class="ripple ripple-animate"></span></a>';
    //             // Add the link for updating bodyselec status (only if bodyselec exists)
    //             if ($fitness) {
    //                 $action .= '<a href="' . $statusUpdateUrl . '" class="btn btn-success btn-sm"><i class="feather icon-edit"></i>&nbsp;Fintness</a>';
    //             } else {
    //                 $action .= '<a href="#" class="btn btn-secondary btn-sm disabled" title="Not Available"><i class="feather icon-edit"></i>&nbsp;Not Yet </a>';
    //             }

    //             $action .= '</div>'; // End the button group
    //             return $action;
    //         })
    //         ->editColumn('qualification', function ($record) {
    //             switch ($record->qualification) {
    //                 case 'DISQUALIFIED':
    //                     return '<span class="badge badge-danger">DISQUALIFIED</span>';
    //                     case 'PENDING':
    //                         return '<span class="badge badge-danger">PENDING</span>';
    //                 case 'QUALIFIED':
    //                     return '<span class="badge badge-success">QUALIFIED</span>';
    //                 default:
    //                     return '';
    //             }
    //         })
    //         ->rawColumns(['action', 'qualification'])
    //         ->make(true);
    // }

    public function applicant_basicfit_table(Request $request)
    {
        $query = Applicant::with(['regions', 'branches'])->whereHas('basicfitness');

        // Filter using search query
        if ($request->has('search_query') && $request->input('search_query') != '') {
            $searchTerm = $request->input('search_query');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('surname', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('other_names', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('applicant_serial_number', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('commission_type', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('arm_of_service', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('branch', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('region', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        // Other filters can be added here if needed
        if ($request->has('sex') && in_array($request->input('sex'), ['MALE', 'FEMALE'])) {
            $query->where('sex', '=', $request->input('sex'));
        }

        // Additional filters for other fields can be added here similarly...

        return DataTables::of($query)
            ->addColumn('region_name', function ($applicant) {
                return $applicant->regions ? $applicant->regions->region_name : 'N/A';
            })
            ->addColumn('branch_name', function ($applicant) {
                return $applicant->branches ? $applicant->branches->branch : 'N/A';
            })
            ->addColumn('action', function ($row) {
                $statusUrl = route('fitnesstest.basicfitness-status', ['uuid' => $row->uuid]);
                $fitness = BasicFitness::where('applicant_id', $row->id)->first();
                $statusUpdateUrl = $fitness
                ? route('fitnesstest.basicfitness-status-update', ['uuid' => $fitness->uuid])
                : '#';

                $action = '<div class="btn-group" role="group">';
                $action .= '<a href="' . $statusUrl . '" class="btn btn-info btn-sm has-ripple"><i class="feather icon-edit"></i>&nbsp;Fitness Test<span class="ripple ripple-animate"></span></a>';
                if ($fitness) {
                    $action .= '<a href="' . $statusUpdateUrl . '" class="btn btn-success btn-sm"><i class="feather icon-edit"></i>&nbsp;Fitness</a>';
                } else {
                    $action .= '<a href="#" class="btn btn-secondary btn-sm disabled" title="Not Available"><i class="feather icon-edit"></i>&nbsp;Not Yet </a>';
                }
                $action .= '</div>';

                return $action;
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
            ->rawColumns(['action', 'qualification'])
            ->make(true);
    }

    // public function master_basicfitness_applicant(Request $request)
    // {
    //     $query = BasicFitness::with(['applicant', 'applicant.regions', 'applicant.branches']);

    //     // Filter by vetting status (QUALIFIED or DISQUALIFIED)
    //     if ($request->has('basic_fitness_status') && in_array($request->input('basic_fitness_status'), ['QUALIFIED', 'DISQUALIFIED'])) {
    //         $query->where('basic_fitness_status', '=', $request->input('basic_fitness_status'));
    //     }

    //     // Filter by applicant's sex
    //     if ($request->has('sex') && in_array($request->input('sex'), ['MALE', 'FEMALE'])) {
    //         $query->whereHas('applicant', function ($q) use ($request) {
    //             $q->where('sex', '=', $request->input('sex'));
    //         });
    //     }

    //     // Filter by applicant's surname
    //     if ($request->has('surname') && $request->input('surname') != '') {
    //         $query->whereHas('applicant', function ($q) use ($request) {
    //             $q->where('surname', 'LIKE', '%' . $request->input('surname') . '%');
    //         });
    //     }

    //     // Filter by applicant's other names
    //     if ($request->has('other_names') && $request->input('other_names') != '') {
    //         $query->whereHas('applicant', function ($q) use ($request) {
    //             $q->where('other_names', 'LIKE', '%' . $request->input('other_names') . '%');
    //         });
    //     }

    //     // Filter by applicant's commission type
    //     if ($request->has('commission_type') && $request->input('commission_type') != '') {
    //         $query->whereHas('applicant', function ($q) use ($request) {
    //             $q->where('commission_type', '=', $request->input('commission_type'));
    //         });
    //     }

    //     // Filter by applicant's arm of service
    //     if ($request->has('arm_of_service') && $request->input('arm_of_service') != '') {
    //         $query->whereHas('applicant', function ($q) use ($request) {
    //             $q->where('arm_of_service', '=', $request->input('arm_of_service'));
    //         });
    //     }

    //     // Filter by applicant's branch
    //     if ($request->has('branch') && $request->input('branch') != '') {
    //         $query->whereHas('applicant', function ($q) use ($request) {
    //             $q->where('branch', '=', $request->input('branch'));
    //         });
    //     }

    //     // Filter by applicant's region
    //     if ($request->has('region') && $request->input('region') != '') {
    //         $query->whereHas('applicant', function ($q) use ($request) {
    //             $q->where('region', '=', $request->input('region'));
    //         });
    //     }

    //     // Filter by applicant's serial number
    //     if ($request->has('applicant_serial_number') && $request->input('applicant_serial_number') != '') {
    //         $query->whereHas('applicant', function ($q) use ($request) {
    //             $q->where('applicant_serial_number', 'LIKE', '%' . $request->input('applicant_serial_number') . '%');
    //         });
    //     }

    //     return DataTables::of($query)
    //         ->addColumn('surname', function ($basicfitness) {
    //             return $basicfitness->applicant->surname ?? 'N/A';
    //         })
    //         ->addColumn('other_names', function ($basicfitness) {
    //             return $basicfitness->applicant->other_names ?? 'N/A';
    //         })
    //         ->addColumn('sex', function ($basicfitness) {
    //             return $basicfitness->applicant->sex ?? 'N/A';
    //         })
    //         ->addColumn('commission_type', function ($basicfitness) {
    //             return $basicfitness->applicant->commission_type ?? 'N/A';
    //         })
    //         ->addColumn('arm_of_service', function ($basicfitness) {
    //             return $basicfitness->applicant->arm_of_service ?? 'N/A';
    //         })
    //         ->addColumn('contact', function ($basicfitness) {
    //             return $basicfitness->applicant->contact ?? 'N/A';
    //         })
    //         ->addColumn('region_name', function ($basicfitness) {
    //             return $basicfitness->applicant->regions->region_name ?? 'N/A';
    //         })
    //         ->addColumn('branch_name', function ($basicfitness) {
    //             return $basicfitness->applicant->branches->branch ?? 'N/A';
    //         })
    //         ->addColumn('applicant_serial_number', function ($basicfitness) {
    //             return $basicfitness->applicant->applicant_serial_number ?? 'N/A';
    //         })
    //         ->addColumn('action', function ($basicfitness) {
    //             $statusUpdateUrl = $basicfitness ? route('fitnesstest.basicfitness-status-update', ['uuid' => $basicfitness->uuid]) : '#';
    //             $action = '<div class="btn-group" role="group">';
    //             if ($basicfitness) {
    //                 $action .= '<a href="' . $statusUpdateUrl . '" class="btn btn-success btn-sm"><i class="feather icon-edit"></i>&nbsp;Update Status</a>';
    //             } else {
    //                 $action .= '<a href="#" class="btn btn-secondary btn-sm disabled" title="Not Available"><i class="feather icon-edit"></i>&nbsp;Update Not Yet</a>';
    //             }
    //             $action .= '</div>';
    //             return $action;
    //         })
    //         ->editColumn('basic_fitness_status', function ($basicfitness) {
    //             switch ($basicfitness->basic_fitness_status) {
    //                 case 'DISQUALIFIED':
    //                     return '<span class="badge badge-danger">DISQUALIFIED</span>';
    //                 case 'QUALIFIED':
    //                     return '<span class="badge badge-success">QUALIFIED</span>';
    //                 default:
    //                     return '';
    //             }
    //         })
    //         ->rawColumns(['action', 'basic_fitness_status'])
    //         ->make(true);
    // }

    public function master_basicfitness_applicant(Request $request)
    {
        $query = BasicFitness::with(['applicant', 'applicant.regions', 'applicant.branches']);

        // Perform a search based on the search_query input
        if ($request->has('search_query') && $request->input('search_query') != '') {
            $searchQuery = $request->input('search_query');

            $query->where(function ($q) use ($searchQuery) {
                $q->whereHas('applicant', function ($subQuery) use ($searchQuery) {
                    $subQuery->where('surname', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('other_names', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('applicant_serial_number', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('commission_type', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('arm_of_service', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('branch', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('region', 'LIKE', '%' . $searchQuery . '%');
                })
                    ->orWhere('basic_fitness_status', 'LIKE', '%' . $searchQuery . '%');
            });
        }

        // Filter by vetting status (QUALIFIED or DISQUALIFIED)
        if ($request->has('basic_fitness_status') && in_array($request->input('basic_fitness_status'), ['QUALIFIED', 'DISQUALIFIED'])) {
            $query->where('basic_fitness_status', '=', $request->input('basic_fitness_status'));
        }

        // Filter by applicant's sex
        if ($request->has('sex') && in_array($request->input('sex'), ['MALE', 'FEMALE'])) {
            $query->whereHas('applicant', function ($q) use ($request) {
                $q->where('sex', '=', $request->input('sex'));
            });
        }

        return DataTables::of($query)
            ->addColumn('surname', function ($basicfitness) {
                return $basicfitness->applicant->surname ?? 'N/A';
            })
            ->addColumn('other_names', function ($basicfitness) {
                return $basicfitness->applicant->other_names ?? 'N/A';
            })
            ->addColumn('sex', function ($basicfitness) {
                return $basicfitness->applicant->sex ?? 'N/A';
            })
            ->addColumn('commission_type', function ($basicfitness) {
                return $basicfitness->applicant->commission_type ?? 'N/A';
            })
            ->addColumn('arm_of_service', function ($basicfitness) {
                return $basicfitness->applicant->arm_of_service ?? 'N/A';
            })
            ->addColumn('contact', function ($basicfitness) {
                return $basicfitness->applicant->contact ?? 'N/A';
            })
            ->addColumn('region_name', function ($basicfitness) {
                return $basicfitness->applicant->regions->region_name ?? 'N/A';
            })
            ->addColumn('branch_name', function ($basicfitness) {
                return $basicfitness->applicant->branches->branch ?? 'N/A';
            })
            ->addColumn('applicant_serial_number', function ($basicfitness) {
                return $basicfitness->applicant->applicant_serial_number ?? 'N/A';
            })
            ->addColumn('action', function ($basicfitness) {
                $statusUpdateUrl = $basicfitness ? route('fitnesstest.basicfitness-status-update', ['uuid' => $basicfitness->uuid]) : '#';
                $action = '<div class="btn-group" role="group">';
                if ($basicfitness) {
                    $action .= '<a href="' . $statusUpdateUrl . '" class="btn btn-success btn-sm"><i class="feather icon-edit"></i>&nbsp;Update Status</a>';
                } else {
                    $action .= '<a href="#" class="btn btn-secondary btn-sm disabled" title="Not Available"><i class="feather icon-edit"></i>&nbsp;Update Not Yet</a>';
                }
                $action .= '</div>';
                return $action;
            })
            ->editColumn('basic_fitness_status', function ($basicfitness) {
                switch ($basicfitness->basic_fitness_status) {
                    case 'DISQUALIFIED':
                        return '<span class="badge badge-danger">DISQUALIFIED</span>';
                    case 'QUALIFIED':
                        return '<span class="badge badge-success">QUALIFIED</span>';
                    default:
                        return '';
                }
            })
            ->rawColumns(['action', 'basic_fitness_status'])
            ->make(true);
    }

}
