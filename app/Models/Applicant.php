<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\SaveToUpper;
use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Notifications\Notifiable;

class Applicant extends Model implements Auditable
{
    use HasFactory;
    use UuidTrait;
    use SaveToUpper;
    use \OwenIt\Auditing\Auditable;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'card_id',
        'arm_of_service',
        'branch',
        'course',
        'qualification',
        'applicant_image',
        'surname',
        'first_name',
        'other_names',
        'sex',
        'marital_status',
        'height',
        'weight',
        'place_of_birth',
        'date_of_birth',
        'hometown',
        'district',
        'region',
        'contact',
        'email',
        'employment',
        'residential_address',
        'language',
        'sports_interest',
        'secondary_course_offered',
        'name_of_secondary_school',
        'wassce_index_number',
        'wassce_year_completion',
        'wassce_serial_number',
        'wassce_english',
        'wassce_mathematics',
        'wassce_subject_three',
        'wassce_subject_four',
        'wassce_subject_five',
        'wassce_subject_six',
        'wassce_subject_english_grade',
        'wassce_subject_maths_grade',
        'wassce_subject_three_grade',
        'wassce_subject_four_grade',
        'wassce_subject_five_grade',
        'wassce_subject_six_grade',
        'wassce_certificate',

        'final_checked',
        'national_identity_card',
        'digital_address',
        'exam_type_one',
        'exam_type_two',
        'exam_type_three',
        'exam_type_four',
        'exam_type_five',
        'exam_type_six',
        'results_slip_one',
        'results_slip_two',
        'results_slip_three',
        'results_slip_four',
        'results_slip_five',
        'results_slip_six',
        'age',

        'birth_certificate',
        'institution',
        'results_certificate',
        'transcript',
        'identity_type',
        'duplicate_entry',
        'private_certificate',
        'trade_type',
        'home_town',
        'branch_id',
        'sub_branch_ids',
        'sub_sub_branch_ids',
        'height',
        'weight',
        'district_id',
        'region_id',
        'identity_type',
        'sports_interest',
        'bece_index_number',
        'bece_year_completion',
        'bece_english',
        'bece_mathematics',
        'bece_subject_three',
        'bece_subject_four',
        'bece_subject_five',
        'bece_subject_six',
        'bece_subject_english_grade',
        'bece_subject_maths_grade',
        'bece_subject_three_grade',
        'bece_subject_four_grade',
        'bece_subject_five_grade',
        'bece_subject_six_grade',
        'bece_certificate',
        'pdf_path',
    ];
    public function card()
    {
        return $this->belongsTo(Card::class);
    }
    public function districts()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function regions()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    public function branches()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course', 'id');
    }
    public function resultVerification()
    {
        return $this->hasOne(ResultVerification::class, 'applicant_id', 'id');
    }

    protected $appends = [];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function documentation_phase()
    {
        return $this->hasOne(Documentation::class);
    }

    public function bodySelection_phase()
    {
        return $this->hasOne(BodySelection::class);
    }

    public function aptitude_phase()
    {
        return $this->hasOne(Aptitude::class);
    }

    public function basicfitness()
    {
        return $this->hasOne(BasicFitness::class);
    }

    public function outdoorfitness_phase()
    {
        return $this->hasOne(OutDoorLeaderless::class);
    }

    public function medicals_phase()
    {
        return $this->hasOne(Medical::class);
    }

    public function vetting_phase()
    {
        return $this->hasOne(Vetting::class);
    }

    public function interview_phase()
    {
        return $this->hasOne(Interview::class);
    }

    protected $casts = [
        'language' => 'array',
        'sports_interest' => 'array',
        'sub_branch_ids' => 'array',
        'sub_sub_branch_ids' => 'array',
    ];
}
