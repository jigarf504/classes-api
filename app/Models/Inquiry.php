<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{InquiryCourse, InquiryQualification, InquiryFollowup, Branch};

class Inquiry extends Model
{
    use HasFactory;

    public function InquiryCourse()
    {
        return $this->hasMany(InquiryCourse::class, 'inquiry_id');
    }

    public function InquiryQualification()
    {
        return $this->hasMany(InquiryQualification::class, 'inquiry_id');
    }

    public function InquiryFollowup()
    {
        return $this->hasMany(InquiryFollowup::class, 'inquiry_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class)->select('name', 'id');
    }
}
