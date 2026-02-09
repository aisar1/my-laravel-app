<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SalaryController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 1. Basic Salary from DB
        $basic = $user->salary ?? 0;

        // 2. Calculate Deductions (Malaysian Standard Estimates)
        $epf = $basic * 0.11;      // EPF 11%
        $socso = $basic * 0.005;   // SOCSO ~0.5%
        $eis = $basic * 0.002;     // EIS ~0.2%
        
        // 3. Calculate Net Pay
        $totalDeductions = $epf + $socso + $eis;
        $netPay = $basic - $totalDeductions;

        return view('salary.index', compact('user', 'basic', 'epf', 'socso', 'eis', 'totalDeductions', 'netPay'));
    }

    public function download()
    {
        $user = auth()->user();
        
        // Recalculate (You should ideally move this to a private function to avoid repetition)
        $basic = $user->salary ?? 0;
        $epf = $basic * 0.11;
        $socso = $basic * 0.005;
        $eis = $basic * 0.002;
        $totalDeductions = $epf + $socso + $eis;
        $netPay = $basic - $totalDeductions;

        // 3. Generate PDF
        $pdf = Pdf::loadView('salary.pdf', compact('user', 'basic', 'epf', 'socso', 'eis', 'totalDeductions', 'netPay'));

        // 4. Download
        return $pdf->download('Payslip_' . $user->first_name . '_' . date('M_Y') . '.pdf');
    }
}