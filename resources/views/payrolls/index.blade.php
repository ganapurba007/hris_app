@extends('layouts.dashboard')
@section('section')
@section('title', 'Payrolls')
@section('link', route('payrolls.index'))
{{-- @section('page-title', 'List Data') --}}
@section('previous-title', 'List Data')

<section class="section">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
            <h5 class="card-title m-0">
                <i class="bi bi-cash-stack me-2 text-primary"></i>List Data
            </h5>
            <div class="align-item-center">
                @can ('create', App\Models\Payroll::class)
                    <a href="{{ route('payrolls.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle-fill me-1"></i> New Payroll
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-x-circle me-1"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0" id="table1">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 5%">#</th>
                            <th scope="col">Employee</th>
                            <th scope="col">Pay Date</th>
                            <th scope="col">Salary</th>
                            <th scope="col">Net Salary</th>
                            <th scope="col" class="text-center" style="width: 15%">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payrolls as $payroll)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $payroll->employee->fullname ?? '-' }}</td>
                                <td>
                                    <span class="text-nowrap">
                                        <i class="bi bi-calendar3 me-1 text-muted"></i>
                                        {{ $payroll->pay_date ? \Carbon\Carbon::parse($payroll->pay_date)->format('d M Y') : '-' }}
                                    </span>
                                </td>
                                <td>Rp {{ number_format($payroll->salary, 0, ',', '.') }}</td>
                                <td class="fw-bold text-success">Rp {{ number_format($payroll->net_salary, 0, ',', '.') }}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <a href="{{ route('payrolls.show', $payroll->id) }}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Detail Payroll">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        @can ('update', $payroll)
                                            <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit Payroll">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endcan
                                        @can('delete', $payroll)
                                            <form action="{{ route('payrolls.destroy', $payroll->id) }}" method="POST"
                                                class="delete-form d-inline m-0" data-title="Delete Payroll"
                                                data-text="Payroll for {{ $payroll->employee->fullname ?? 'employee' }} will be permanently deleted.">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Delete Payroll">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    Belum ada data penggajian.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
