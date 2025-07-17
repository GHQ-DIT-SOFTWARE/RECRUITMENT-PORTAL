<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front\Portal;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\Branch;
use App\Models\Card;
use App\Models\District;
use App\Models\Region;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\SubBranch;
use App\Models\Subsubbranch;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class BiodataController extends Controller
{
    public function __construct()
    {
        $this->middleware('portal');
    }
    public function getDistricts($region_id)
    {
        $districts = District::where('region_id', $region_id)->get();
        return response()->json($districts);
    }


    public function getSubBranches($branch_id)
    {
        return response()->json(SubBranch::where('branch_id', $branch_id)->get(['id', 'sub_branch']));
    }

    public function getSubSubBranches($sub_branch_id)
    {
        return response()->json(Subsubbranch::where('sub_branch_id', $sub_branch_id)->get(['id', 'sub_sub_branch']));
    }



    public function biodata()
    {
        $ghanaian_languages = [
            'ENGLISH',
            'FRENCH',
            'RUSSIA',
            'CHINESE',
            'AKUAPEM TWI',
            'DAGBANI',
            'EWE',
            'GA',
            'DAGOMBA',
            'DANGME',
            'FANTE',
            'KASEM',
            'NZEMA',
            'KUSAAL',
            'ASANTE TWI',
            'FRAFRA',
            'BULI',
            'KROBO',
            'GRUSI',
            'GUANG',
            'HAUSA',
            'KUSAAL',
            'SISAALA',
            'NCHUMBURUNG',
            'DAGAARE',
            'DANGME',
            'DWABENG',
            'FANTE',
            'GONJA',
            'KASEM',
            'NZEMA',
            'SAFALIBA',
            'SISALA',
            'TWI',
            'UNGANA',
            'WALI',
            'BOMU',
            'GURENNE',
            'JWIRA-PEPESA',
            'KANTOSI',
            'KONKOMBA',
            'KUSASI',
            'MOORE',
            'NABA',
            'WASA',
        ];
        $sports_interests = [
            'FOOTBALL',
            'BASKETBALL',
            'TENNIS',
            'SWIMMING',
            'ATHLETICS',
            'BADMINTON',
            'GOLF',
            'CRICKET',
            'TABLE TENNIS',
            'VOLLEYBALL',
            'BOXING',
            'CYCLING',
            'MARTIAL ARTS',
            'HIKING',
            'SKIING',
            'SNOWBOARDING',
            'SURFING',
            'SKATEBOARDING',
            'DANCING',
        ];
        $serial_number = session('serial_number');
        $pincode = session('pincode');
        $card = Card::where('serial_number', $serial_number)->where('pincode', $pincode)->first();
        $applied_applicant = Applicant::with('districts', 'regions')->where('card_id', $card->id)->first();
        $districts = District::all();
        $regions = Region::all();
        // $branches=Branch::all();

        // $branches = Branch::where('arm_of_service', $applied_applicant->arm_of_service)->get();

        // $excludedBranchesForTradesmen = ['INFANTRY', 'ARTILLERY', 'ARMOUR', 'MILITARY POLICE'];

        // if ($applied_applicant->trade_type === 'TRADESMEN') {
        //     $branches = Branch::where('arm_of_service', $applied_applicant->arm_of_service)
        //         ->whereNotIn('branch', $excludedBranchesForTradesmen)
        //         ->get();
        // } else {
        //     $branches = Branch::where('arm_of_service', $applied_applicant->arm_of_service)->get();
        // }
        $nonTradesmenAllowed = ['INFANTRY', 'ARTILLERY', 'ARMOUR', 'MILITARY POLICE'];

        if ($applied_applicant->trade_type === 'TRADESMEN') {
            $branches = Branch::where('arm_of_service', $applied_applicant->arm_of_service)
                ->whereNotIn('branch', $nonTradesmenAllowed)
                ->get();
        } elseif ($applied_applicant->trade_type === 'NON-TRADESMEN') {
            $branches = Branch::where('arm_of_service', $applied_applicant->arm_of_service)
                ->whereIn('branch', $nonTradesmenAllowed)
                ->get();
        } else {
            // Fallback for any other type (if needed)
            $branches = Branch::where('arm_of_service', $applied_applicant->arm_of_service)->get();
        }


        // $hideSubFieldsBranchIds = Branch::whereIn('branch', ['INFANTRY', 'ARTILLERY', 'ARMOUR', 'MILITARY POLICE','	EXECUTIVE TELEGRAPHIST','EXECUTIVE RADAR PLOTTERS','EXECUTIVE BOATSWAINS MATE'])
        //     ->pluck('id')
        //     ->toArray();


        $hideSubFieldsBranchIds = Branch::where('arm_of_service', $applied_applicant->arm_of_service)
            ->whereIn('branch', [
                'INFANTRY',
                'ARTILLERY',
                'ARMOUR',
                'MILITARY POLICE',
                'EXECUTIVE TELEGRAPHIST',
                'EXECUTIVE RADAR PLOTTERS',
                'EXECUTIVE BOATSWAINS MATE',
                'AIRFORCE POLICE'
            ])
            ->pluck('id')
            ->toArray();
        return view('portal.biodata', compact('districts', 'regions', 'applied_applicant', 'ghanaian_languages', 'sports_interests', 'branches', 'hideSubFieldsBranchIds'));
    }


    public function getCourses(Request $request)
    {
        $branchId = $request->input('branch_id');
        if (is_null($branchId)) {
            return response()->json(['error' => 'Branch ID missing'], 400);
        }
        $courses = Course::where('branch_id', $branchId)->where('status', 1)->get(['id', 'course_name']); // Adjust to actual column names
        return response()->json($courses);
    }


    public function saveBioData(Request $request)
    {
        $applicant = Applicant::where('card_id', $request->session()->get('card_id'))->firstOrFail();
        $request->validate([
            'home_town' => 'required',
            'sports_interest' => 'required|array',
            'applicant_image' => $applicant->applicant_image ? 'nullable|image|mimes:jpg,png|max:2048' : 'required|image|mimes:jpg,png|max:2048',
            'birth_certificate' => $applicant->birth_certificate ? 'nullable|file|mimes:pdf|max:1024' : 'required|file|mimes:pdf|max:1024',
            'surname' => 'required',
            'other_names' => 'nullable',
            'first_name' => 'required',
            'sex' => 'required',
            'marital_status' => 'required',
            'date_of_birth' => 'required|date',
            'contact' => 'required|digits:10',
            'email' => 'required|email',
            'residential_address' => 'required',
            'language' => 'required|array',
            'digital_address' => 'required',
            'identity_type' => 'required',
            'national_identity_card' => 'required',
            'sub_branch_ids' => 'nullable|array',
            'sub_sub_branch_ids' => 'nullable|array',
            'branch_id' => 'required|exists:branches,id',
            'height' => 'required',
            'weight' => 'required',
            'region_id' => 'required|exists:regions,id',
            'district_id' => 'required|exists:districts,id',
        ]);
        $save_url = $applicant->applicant_image;
        if ($request->hasFile('applicant_image')) {
            $image = $request->file('applicant_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200, 200)->save('uploads/applicantimages/' . $name_gen);
            $save_url = 'uploads/applicantimages/' . $name_gen;
        }
        $birthcertificate_save_url = $applicant->birth_certificate;
        if ($request->hasFile('birth_certificate')) {
            $file = $request->file('birth_certificate');
            // Use the original file name and sanitize it
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $name_gen = $originalName . '.' . $extension;
            $file->move(public_path('uploads/birthcertificate'), $name_gen);
            $birthcertificate_save_url = 'uploads/birthcertificate/' . $name_gen;
        }
        $applicant->update([
            'applicant_image' => $save_url,
            'surname' => $request->surname,
            'first_name' => $request->first_name,
            'other_names' => $request->other_names,
            'sex' => $request->sex,
            'marital_status' => $request->marital_status,
            'date_of_birth' => $request->date_of_birth,
            'contact' => $request->contact,
            'email' => $request->email,
            'birth_certificate' => $birthcertificate_save_url,
            'residential_address' => $request->residential_address,
            'national_identity_card' => $request->national_identity_card,
            'digital_address' => $request->digital_address,
            'language' => json_encode($request->language),
            'sports_interest' => json_encode($request->sports_interest),
            'home_town' => $request->home_town,
            'height' => $request->height,
            'weight' => $request->weight,
            'region_id' => $request->region_id,
            'district_id' => $request->district_id,
            'identity_type' => $request->identity_type,
            'branch_id' => $request->branch_id,
            'sub_branch_ids' => json_encode($request->sub_branch_ids),
            'sub_sub_branch_ids' => json_encode($request->sub_sub_branch_ids),
        ]);
        return redirect()->route('education-details');
    }
}
