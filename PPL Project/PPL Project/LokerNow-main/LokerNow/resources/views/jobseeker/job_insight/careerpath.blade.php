@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8 text-[#B9FF66]">
    <h1 class="text-3xl font-bold mb-6">🚀 Career Path Insight</h1>

    <p class="text-white mb-8">
        Understanding common career paths can help you plan your long-term goals. Below are typical progressions and key comparisons between popular roles in tech and related fields.
    </p>

    <!-- Section: Career Progression Flow -->
    <div class="bg-white rounded-2xl shadow p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">📈 Typical Career Progressions</h2>
        <div class="overflow-x-auto">
            <canvas id="careerPathFlow" height="100"></canvas>
        </div>
    </div>

    <!-- Section: Career Comparison Table -->
    <div class="bg-white rounded-2xl shadow p-6 mb-8 overflow-x-auto">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">📌 Career Comparison</h2>
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                <tr>
                    <th class="px-4 py-2">Career</th>
                    <th class="px-4 py-2">Avg. Salary</th>
                    <th class="px-4 py-2">Market Demand</th>
                    <th class="px-4 py-2">Qualifications</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <tr>
                    <td class="px-4 py-2">Junior Developer</td>
                    <td class="px-4 py-2">Rp 7.000.000</td>
                    <td class="px-4 py-2">High</td>
                    <td class="px-4 py-2">Basic HTML/CSS/JS</td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Developer</td>
                    <td class="px-4 py-2">Rp 10.000.000</td>
                    <td class="px-4 py-2">High</td>
                    <td class="px-4 py-2">Frameworks + Team Projects</td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Senior Developer</td>
                    <td class="px-4 py-2">Rp 14.000.000</td>
                    <td class="px-4 py-2">Medium</td>
                    <td class="px-4 py-2">5+ Years Experience</td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Tech Lead</td>
                    <td class="px-4 py-2">Rp 18.000.000</td>
                    <td class="px-4 py-2">Medium</td>
                    <td class="px-4 py-2">Leadership & Architecture</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Section: Career Development Tips -->
    <div class="bg-green-50 border-l-4 border-green-400 text-green-800 p-5 rounded-lg">
        <h3 class="text-lg font-semibold mb-3">🧠 Career Growth Tips</h3>
        <ul class="list-disc list-inside space-y-1 text-sm">
            <li>Join mentorship or internship programs.</li>
            <li>Build a strong portfolio with diverse projects.</li>
            <li>Learn soft skills (communication, leadership).</li>
            <li>Stay updated with tech trends and certifications.</li>
        </ul>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('careerPathFlow').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Junior Dev', 'Developer', 'Senior Dev', 'Tech Lead'],
                datasets: [{
                    label: 'Career Progression Path',
                    data: [7000000, 10000000, 14000000, 18000000],
                    borderColor: 'rgba(59, 130, 246, 1)', // blue
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: 'rgba(59, 130, 246, 1)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
</div>
@endsection
