<?php
namespace App\Services;
use App\Models\Salary;
use App\Interfaces\SalaryServiceInterface;

class SalaryService implements SalaryServiceInterface
{
    public function getAllTeachersSalary()
    {
        
        return Salary::all();
    }
}
//
