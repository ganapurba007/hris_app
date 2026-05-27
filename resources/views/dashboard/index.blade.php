@extends('layouts.dashboard')
@section('section')
@section('title', 'Dashboard')

    @php
        $isHR = session('role') == 'HR';
        $cards = $isHR
            ? [
                [
                    'title' => 'Departments',
                    'value' => $department,
                    'icon' => 'dripicons-tag',
                    'color' => 'purple',
                ],
                [
                    'title' => 'Roles',
                    'value' => $role,
                    'icon' => 'dripicons-gear',
                    'color' => 'blue',
                ],
                [
                    'title' => 'Employees',
                    'value' => $employee,
                    'icon' => 'dripicons-user-group',
                    'color' => 'green',
                ],
                [
                    'title' => 'Tasks',
                    'value' => $task,
                    'icon' => 'dripicons-checklist',
                    'color' => 'red',
                ],
            ]
            : [
                [
                    'title' => 'Total Tasks',
                    'value' => $total_task,
                    'icon' => 'dripicons-archive',
                    'color' => 'purple',
                ],
                [
                    'title' => 'Pending Tasks',
                    'value' => $pending_task,
                    'icon' => 'dripicons-hourglass',
                    'color' => 'bg-warning',
                ],
                [
                    'title' => 'In Progress Tasks',
                    'value' => $in_progress_task,
                    'icon' => 'dripicons-loading',
                    'color' => 'blue',
                ],
                [
                    'title' => 'Done Tasks',
                    'value' => $done_task,
                    'icon' => 'dripicons-checkmark',
                    'color' => 'green',
                ],
            ];

    @endphp

    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="row">
                    @foreach ($cards as $card)
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon {{ $card['color'] }} mb-2">
                                                <i class="icon dripicons {{ $card['icon'] }}"></i>
                                            </div>
                                        </div>

                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">
                                                {{ $card['title'] }}
                                            </h6>
                                            <h6 class="font-extrabold mb-0">
                                                {{ $card['value'] }}
                                            </h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Presences</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="presences"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Latest Tasks</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>Employee</th>
                                                <th>Task</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($latest_tasks->isEmpty())
                                                <tr>
                                                    <td colspan="3" class="text-center">No tasks found.</td>
                                                </tr>
                                            @else
                                                @foreach ($latest_tasks as $latest_task)
                                                    <tr>
                                                        <td class="col-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar avatar-md">
                                                                    <img
                                                                        src="https://ui-avatars.com/api/?color=FFFF&background=57CAEB&name={{ $latest_task->employee->fullname }}">
                                                                </div>

                                                                <p class="font-bold ms-3 mb-0">
                                                                    {{ $latest_task->employee->fullname }}</p>
                                                            </div>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0">{{ $latest_task->title }}</p>
                                                        </td>
                                                        <td class="col-3">
                                                            <p class=" mb-0">
                                                                @if ($latest_task->status === 'Pending')
                                                                    <span class="badge bg-danger">Pending</span>
                                                                @elseif ($latest_task->status === 'In Progress')
                                                                    <span class="badge bg-warning">In Progress</span>
                                                                @elseif ($latest_task->status === 'Done')
                                                                    <span class="badge bg-success">Done</span>
                                                                @endif
                                                            </p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Chart JS --}}
    <script src="{{ asset('template/assets/extensions/chart.js/chart.umd.js') }}"></script>
    <script>
        const ctxBar = document.getElementById('presences').getContext('2d');

        const myBar = new Chart(ctxBar, {

            type: 'bar',

            data: {

                labels: [
                    'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July',
                    'August',
                    'September',
                    'October',
                    'November',
                    'December'
                ],

                datasets: [{
                    label: 'Total Presences',
                    data: [],
                    backgroundColor: '#768EF0',
                    borderWidth: 1
                }]
            },

            options: {

                responsive: true,

                plugins: {
                    title: {
                        display: true,
                        text: 'Presences'
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        async function updateData() {
            try {

                const response = await fetch('/dashboard/presences');

                const output = await response.json();

                myBar.data.datasets[0].data = output;

                myBar.update();

            } catch (error) {

                console.error('Chart error:', error);

            }
        }

        // LOAD PERTAMA
        updateData();

        // AUTO REFRESH
        setInterval(updateData, 3000);
    </script>
@endsection
