@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')



<div class="row">
    <div class="col-md-6">
        <canvas id="userRoleChart"></canvas>
    </div>
    <div class="col-md-6">
        <canvas id="activityChart"></canvas>
    </div>
</div>

<!-- Konten Khusus Berdasarkan Role -->
@if($role === 'admin')
    <div class="mt-4">
        <p>Ini adalah statistik untuk admin.</p>
    </div>
@endif

@if($role === 'dokter')
    <div class="mt-4">
        <p>Statistik pasien yang Anda rawat dapat ditampilkan di sini.</p>
        <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-primary">Rekam Medis</a>
    </div>
@endif

<!-- Tambahkan konten untuk role lain sesuai kebutuhan -->

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userRoleData = @json(array_values($userRoleData));
        const userRoleLabels = @json(array_keys($userRoleData));
        const monthlyActivityData = @json(array_values($monthlyActivityData));
        const monthlyActivityLabels = @json(array_keys($monthlyActivityData));

        // User Role Line Chart
        const userRoleCtx = document.getElementById('userRoleChart').getContext('2d');
        new Chart(userRoleCtx, {
            type: 'line',
            data: {
                labels: userRoleLabels,
                datasets: [{
                    label: 'User Roles',
                    data: userRoleData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4 // Smooth line
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'User Roles Distribution (Line Chart)' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Monthly Activity Line Chart
        const activityCtx = document.getElementById('activityChart').getContext('2d');
        new Chart(activityCtx, {
            type: 'line',
            data: {
                labels: monthlyActivityLabels,
                datasets: [{
                    label: 'Monthly Activities',
                    data: monthlyActivityData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4 // Smooth line
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Monthly Activities (Line Chart)' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
</script>
@endsection
