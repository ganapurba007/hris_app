@extends('layouts.dashboard')
@section('section')
@section('title', 'Payrolls')
@section('link', route('payrolls.index'))
{{-- @section('page-title', 'Payrolls') --}}
@section('previous-title', 'List Data')

<section class="section">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title">
                List Data
            </h5>
            <div class="align-item-center">
                @if (session('role') == 'HR')
                    <a href="{{ route('payrolls.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle-fill"></i>&nbsp;
                        New Payroll</a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert"><i
                                class="bi bi-check-circle"></i>
                            {{ session('success') }}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert"><i
                                class="bi bi-x-circle"></i>
                            {{ session('error') }}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee</th>
                        <th>Salary</th>
                        <th>Bonuses</th>
                        <th>Deduction</th>
                        <th>Net Salary</th>
                        <th>Pay Date</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payrolls as $payroll)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payroll->employee->fullname ?? '-' }} </td>
                            <td>{{ number_format($payroll->salary) }}</td>
                            <td>{{ number_format($payroll->bonuses) }}</td>
                            <td>{{ number_format($payroll->deductions) ?? '-' }}</td>
                            <td>{{ number_format($payroll->net_salary) }}</td>
                            <td>{{ $payroll->pay_date->format('d M Y') }}</td>
                            <td class="space-x-1 py-2">
                                <a href="{{ route('payrolls.show', $payroll->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                @can('update', $payroll)
                                    <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                @endcan

                                @can ('delete', $payroll)
                                   <form action="{{ route('payrolls.destroy', $payroll->id) }}" method="POST"
                                        class="delete-form m-0" data-title="Delete Payroll"
                                        data-text="Payroll {{ $payroll->employee->fullname }} will be permanently deleted.">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endcan

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection
