<!DOCTYPE html>
<html>
<head>
    <title>Payslip</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        .container { width: 100%; margin: 0 auto; }
        .header { text-align: center; border-bottom: 2px solid #444; padding-bottom: 20px; margin-bottom: 20px; }
        .company-name { font-size: 24px; font-weight: bold; text-transform: uppercase; }
        .meta { width: 100%; margin-bottom: 20px; }
        .meta td { padding: 5px; }
        .label { font-weight: bold; color: #555; }
        
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .table th { background-color: #f4f4f4; }
        
        .total-row td { font-weight: bold; border-top: 2px solid #333; }
        .net-pay { background-color: #e6fffa; color: #006600; font-size: 18px; }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="header">
            <div class="company-name">{{ config('app.name') }}</div>
            <div>Official Payslip - {{ \Carbon\Carbon::now()->format('F Y') }}</div>
        </div>

        <table class="meta">
            <tr>
                <td class="label">Employee Name:</td>
                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                <td class="label">Department:</td>
                <td>{{ $user->department }}</td>
            </tr>
            <tr>
                <td class="label">Position:</td>
                <td>{{ $user->position }}</td>
                <td class="label">Joined:</td>
                <td>{{ $user->joining_date ? $user->joining_date->format('d M Y') : '-' }}</td>
            </tr>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th style="text-align: right;">Earnings (RM)</th>
                    <th style="text-align: right;">Deductions (RM)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Basic Salary</td>
                    <td style="text-align: right;">{{ number_format($basic, 2) }}</td>
                    <td style="text-align: right;">-</td>
                </tr>
                <tr>
                    <td>EPF Contribution (11%)</td>
                    <td style="text-align: right;">-</td>
                    <td style="text-align: right;">{{ number_format($epf, 2) }}</td>
                </tr>
                <tr>
                    <td>SOCSO (0.5%)</td>
                    <td style="text-align: right;">-</td>
                    <td style="text-align: right;">{{ number_format($socso, 2) }}</td>
                </tr>
                <tr>
                    <td>EIS (0.2%)</td>
                    <td style="text-align: right;">-</td>
                    <td style="text-align: right;">{{ number_format($eis, 2) }}</td>
                </tr>
                
                <tr class="total-row">
                    <td>Total</td>
                    <td style="text-align: right;">{{ number_format($basic, 2) }}</td>
                    <td style="text-align: right; color: red;">- {{ number_format($totalDeductions, 2) }}</td>
                </tr>
                
                <tr>
                    <td colspan="2" style="text-align: right; font-weight: bold;">NET PAY:</td>
                    <td class="net-pay" style="text-align: right; font-weight: bold;">RM {{ number_format($netPay, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 50px; text-align: center; color: #888; font-size: 12px;">
            <p>This is a computer-generated document. No signature is required.</p>
        </div>

    </div>
</body>
</html>