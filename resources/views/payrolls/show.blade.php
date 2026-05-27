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
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div id="print-area">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Employee</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <h6>: {{ $payroll->employee->fullname }}</h6>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="email-horizontal">Salary</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <h6 class="text-justify">: {{ number_format($payroll->salary) }}</h6>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="contact-info-horizontal">Bonuses</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <h6>: {{ number_format($payroll->bonuses) }}</h6>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="password-horizontal">Deductions</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <h6>: {{ number_format($payroll->deductions) }}</h6>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="password-horizontal">Net Salary</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <h6>: {{ number_format($payroll->net_salary) }}</h6>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="password-horizontal">Pay Date</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <h6>: {{ $payroll->pay_date->format('d F Y') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 d-flex mt-2">
                                            <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">Back to
                                                List</a>
                                            <button type="button" id="btn-print" class="btn btn-warning ms-3"><i
                                                    class="bi bi-printer"></i> Print</button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <script>
        const btnPrint = document.getElementById('btn-print');
        const printArea = document.getElementById('print-area');

        btnPrint.addEventListener('click', () => {
            let printContent = printArea.innerHTML;
            let originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        });
    </script>
@endsection;
