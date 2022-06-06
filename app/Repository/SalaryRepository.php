<?php
namespace App\Repository;
use App\Interfaces\SalaryRepositoryInterface;
use App\Interfaces\SalaryServiceInterface;
use App\Models\Salary;
use App\Interfaces\TeachersServiceInterface;
use Illuminate\Http\Request;

class SalaryRepository implements SalaryRepositoryInterface {
    /**
     * Inxdex
     */
    public function indexSalary() {
        $salary = Salary::all();
        return $salary;
    }
    /**
     * Create
     */
    public function createSalary() {
        $salary = new Salary();
        return $salary;
    }
    /**
     * Store
     */
    public function storeSalary(Request $request, $id) {
        $salary = Salary::find($id);
        $salary->teacher_id = $request->teacher_id;
        $salary->salary = $request->salary;
        $salary->save();
        return $salary;
    }
    /**
     * Show
     */
    public function showSalary($id) {
        $salary = Salary::find($id);
        return $salary;
    }
    /**
     * Edit
     */
    public function editSalary($id) {
        $salary = Salary::find($id);
        return $salary;
    }
    /**
     * Update
     */
    public function updateSalary(Request $request, $id) {
        $salary = Salary::find($id);
        $salary->teacher_id = $request->teacher_id;
        $salary->salary = $request->salary;
        $salary->save();
        return $salary;
    }
    /**
     * Destroy
     */
    public function destroySalary($id) {
        $salary = Salary::find($id);
        $salary->delete();
        return $salary;
    }

}

//
