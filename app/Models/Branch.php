<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    public $fillable = ['name', 'email', 'address', 'state', 'city', 'branch_code', 'mobile', 'contact_person_name', 'contact_person_mobile','phone', 'contact_person_email','is_active'];
    public $appends = [
        'status',
        'branch_name'
    ];
    public array $rules = [
        'name' => 'required|unique:branches|max:125',
        'email' => 'required|email',
        'mobile' => 'required|digits:10',
        'phone' => 'nullable|numeric',
        'address' => 'required',
        'city' => 'required',
        'branch_code' => 'required|max:5',
        'state' => 'required',
        'contact_person_name' => 'required|max:50',
    ];

    public function getStatusAttribute() {
        return $this->is_active === 1 ? 'Active' : 'Inactive';
    }

    public function getBranchNameAttribute()
    {
        return "#{$this->branch_code} - {$this->name}";
    }
}
