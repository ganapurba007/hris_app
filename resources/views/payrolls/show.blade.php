@extends('layouts.dashboard')

@section('section')
@section('title', 'Detail Payroll')
@section('link', route('payrolls.index'))
@section('page-title', 'Detail Payroll')
@section('previous-title', 'List Data')

<div class="page-title">
    <div class="row">
        <div class="col-md-12">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0 text-white">
                                <i class="bi bi-receipt"></i>
                                Payroll Detail
                            </h4>

                            <small>
                                Payroll Information
                            </small>
                        </div>

                        <div>
                            <button type="button" id="btn-print" class="btn btn-light">
                                <i class="bi bi-printer-fill"></i>
                                Print Payroll
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div id="print-area">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold mb-1">
                                COMPANY PAYROLL
                            </h2>
                            <p class="text-muted mb-0">
                                Employee Salary Slip
                            </p>
                            <hr>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted">
                                    Employee Name
                                </h6>
                                <h5 class="fw-bold">
                                    {{ $payroll->employee->fullname }}
                                </h5>
                            </div>

                            <div class="col-md-6 text-md-end">
                                <h6 class="text-muted">
                                    Pay Date
                                </h6>
                                <h5 class="fw-bold">
                                    {{ $payroll->pay_date->format('d F Y') }}
                                </h5>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Description</th>
                                        <th width="35%" class="text-end">
                                            Amount
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>Base Salary</td>
                                        <td class="text-end">
                                            Rp {{ number_format($payroll->salary) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Bonuses</td>
                                        <td class="text-end text-success">
                                            + Rp {{ number_format($payroll->bonuses) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Deductions</td>
                                        <td class="text-end text-danger">
                                            - Rp {{ number_format($payroll->deductions) }}
                                        </td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                    <tr class="table-primary">
                                        <th>
                                            Net Salary
                                        </th>

                                        <th class="text-end fs-5">
                                            Rp {{ number_format($payroll->net_salary) }}
                                        </th>
                                    </tr>

                                </tfoot>
                            </table>
                        </div>

                        <div class="mt-5">
                            <div class="row">
                                <div class="col-6 text-center">
                                    <p class="mb-5">
                                        Employee Signature
                                    </p>
                                    <hr>
                                </div>

                                <div class="col-6 text-center">
                                    <p class="mb-5">
                                        HR Signature
                                    </p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">

                            <i class="bi bi-arrow-left"></i>
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const btnPrint = document.getElementById('btn-print');
    btnPrint.addEventListener('click', () => {
        const printContent = document.getElementById('print-area').innerHTML;
        const printWindow = window.open('', '', 'width=900,height=650');
        printWindow.document.write(`
    <html>
        <head>

            <title>Payroll Slip</title>
            <style>

                body {
                    font-family: Arial, sans-serif;
                    background: #f4f7fb;
                    padding: 40px;
                    color: #212529;
                }

                .payroll-container {
                    background: #ffffff;
                    border-radius: 18px;
                    padding: 40px;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
                    max-width: 900px;
                    margin: auto;
                }

                .header {
                    text-align: center;
                    margin-bottom: 40px;
                    border-bottom: 3px solid #435ebe;
                    padding-bottom: 20px;
                }

                .header h1 {
                    font-size: 34px;
                    font-weight: 800;
                    color: #435ebe;
                    margin-bottom: 8px;
                }

                .header p {
                    color: #6c757d;
                    font-size: 15px;
                    margin: 0;
                }

                .info-section {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 30px;
                    gap: 20px;
                }

                .info-card {
                    flex: 1;
                    background: #f8f9fa;
                    border-radius: 14px;
                    padding: 20px;
                    border: 1px solid #e9ecef;
                }

                .info-card h6 {
                    color: #6c757d;
                    font-size: 14px;
                    margin-bottom: 10px;
                }

                .info-card h4 {
                    font-weight: 700;
                    margin: 0;
                }

                .salary-table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                    overflow: hidden;
                    border-radius: 12px;
                }

                .salary-table thead {
                    background: #435ebe;
                    color: white;
                }

                .salary-table th {
                    padding: 16px;
                    font-size: 14px;
                    text-transform: uppercase;
                    letter-spacing: .5px;
                }

                .salary-table td {
                    padding: 16px;
                    border-bottom: 1px solid #e9ecef;
                    font-size: 15px;
                }

                .salary-table tbody tr:nth-child(even) {
                    background: #f8f9fa;
                }

                .salary-table tfoot tr {
                    background: #e8f0ff;
                }

                .salary-table tfoot th {
                    padding: 18px;
                    font-size: 18px;
                    color: #435ebe;
                }

                .text-end {
                    text-align: right;
                }

                .text-success {
                    color: #198754;
                    font-weight: 700;
                }

                .text-danger {
                    color: #dc3545;
                    font-weight: 700;
                }

                .signature-section {
                    margin-top: 80px;
                    display: flex;
                    justify-content: space-between;
                    gap: 40px;
                }

                .signature-box {
                    flex: 1;
                    text-align: center;
                }

                .signature-line {
                    margin-top: 70px;
                    border-top: 1px solid #212529;
                    padding-top: 10px;
                    font-weight: 600;
                }

                .footer {
                    margin-top: 50px;
                    text-align: center;
                    color: #6c757d;
                    font-size: 13px;
                }

                @media print {

                    body {
                        background: white;
                        padding: 0;
                    }

                    .payroll-container {
                        box-shadow: none;
                        border: none;
                    }

                }

            </style>

        </head>

        <body>

            <div class="payroll-container">

                ${printContent}

                <div class="footer">
                    Printed on ${new Date().toLocaleString()}
                </div>

            </div>

        </body>

    </html>
`);

        printWindow.document.close();

        printWindow.focus();

        printWindow.print();

        printWindow.close();

    });
</script>

@endsection
