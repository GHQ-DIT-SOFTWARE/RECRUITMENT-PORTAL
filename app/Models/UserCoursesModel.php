<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCoursesModel extends Model
{
    protected $table = 'user_courses';

    protected $fillable = [
        'course_id',
        'user_id',
        'level',
        'semester',
    ];


    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(SubjectsModel::class, 'subject_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Fetch students enrolled in a particular course
    public function students()
    {
        return $this->hasMany(UserCoursesModel::class, 'course_id', 'course_id')
                    ->whereHas('user', function ($query) {
                        $query->where('role', 'Student');
                    });
    }

    // Fetch lecturers assigned to a particular course
    public function lecturer()
    {
        return $this->hasOne(UserCoursesModel::class, 'course_id', 'course_id')
                    ->whereHas('user', function ($query) {
                        $query->where('role', 'Lecturer');
                    });
    }

    // Fetch total subjects under a course
    public function subjects()
    {
        return $this->hasMany(UserCoursesModel::class, 'course_id', 'course_id')
                    ->distinct('subject_id');
    }

    public function packages()
    {
        return $this->hasMany(PackagingModel::class, 'course_id', 'course_id');
    }

}







