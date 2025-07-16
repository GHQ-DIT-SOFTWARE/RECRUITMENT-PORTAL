<?php
declare (strict_types = 1);
namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\SaveToUpper;
use OwenIt\Auditing\Contracts\Auditable;
class Course extends Model implements Auditable
{
    use HasFactory;
    use UuidTrait;
    use SaveToUpper;
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'branch_id',
        'course_name',
        'status',
        'commission_type',
        'arm_of_service',
    ];
    public function service_branches()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'branch_id', 'id');
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];
}
