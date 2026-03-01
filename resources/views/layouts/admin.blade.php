<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - AutoMate</title>

    <!-- Tailwind CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Chart.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    @stack('styles')
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar --}}
        <x-admin-sidebar />

        {{-- Main Content Area --}}
        <div class="flex-1 flex flex-col overflow-hidden ml-64">
            {{-- Main Content --}}
            <main class="flex-1 overflow-y-auto bg-gray-50">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chartElements = document.querySelectorAll('[data-chart]');

            chartElements.forEach((element) => {
                const chartType = element.dataset.chart;
                const rawSeries = element.dataset.series || '[]';
                let series;

                try {
                    series = JSON.parse(rawSeries);
                } catch (error) {
                    series = [];
                }

                const canvas = document.createElement('canvas');
                element.textContent = '';
                element.appendChild(canvas);

                if (typeof Chart === 'undefined') {
                    element.textContent = 'Chart unavailable.';
                    return;
                }

                const ctx = canvas.getContext('2d');

                if (chartType === 'monthly-revenue') {
                    const labels = series.map((item) => item.label);
                    const data = series.map((item) => item.total);

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels,
                            datasets: [
                                {
                                    label: 'Revenue',
                                    data,
                                    borderColor: '#ff5a1f',
                                    backgroundColor: 'rgba(255, 90, 31, 0.2)',
                                    fill: true,
                                    tension: 0.35,
                                    pointRadius: 3,
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    callbacks: {
                                        label: (context) => `Rs. ${context.parsed.y.toLocaleString()}`,
                                    },
                                },
                            },
                            scales: {
                                y: { beginAtZero: true },
                            },
                        },
                    });

                    return;
                }

                if (chartType === 'daily-revenue') {
                    const labels = series.map((item) => item.label);
                    const data = series.map((item) => item.total);

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels,
                            datasets: [
                                {
                                    label: 'Daily Revenue',
                                    data,
                                    borderColor: '#2563eb',
                                    backgroundColor: 'rgba(37, 99, 235, 0.15)',
                                    fill: true,
                                    tension: 0.3,
                                    pointRadius: 2,
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    callbacks: {
                                        label: (context) => `Rs. ${context.parsed.y.toLocaleString()}`,
                                    },
                                },
                            },
                            scales: {
                                y: { beginAtZero: true },
                            },
                        },
                    });

                    return;
                }

                if (chartType === 'service-status') {
                    const labels = Object.keys(series);
                    const data = Object.values(series);
                    const colors = ['#2563eb', '#16a34a', '#f59e0b', '#ef4444', '#8b5cf6', '#0ea5e9'];

                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels,
                            datasets: [
                                {
                                    data,
                                    backgroundColor: colors.slice(0, data.length),
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { position: 'bottom' },
                            },
                        },
                    });

                    return;
                }

                if (chartType === 'admin-performance') {
                    const labels = series.map((item) => item.label);
                    const data = series.map((item) => item.total);

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels,
                            datasets: [
                                {
                                    label: 'Completed Services',
                                    data,
                                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                            },
                            scales: {
                                y: { beginAtZero: true },
                            },
                        },
                    });
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
