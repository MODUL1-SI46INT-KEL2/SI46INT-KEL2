@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8 text-[#B9FF66]">
    <h1 class="text-3xl font-bold mb-6">💼 Salary Estimate Insight</h1>

    <p class="text-white mb-8">
        Understanding salary trends helps you make informed career decisions. Below are estimated salary ranges and demand levels for various career paths based on recent industry data.
    </p>

    <!-- Section: Chart -->
    <div class="bg-white rounded-2xl shadow p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">📊 Salary Comparison by Career</h2>
        <canvas id="salaryChart" height="120"></canvas>
    </div>

    <!-- Section: Table -->
    <div class="bg-white rounded-2xl shadow p-6 mb-8 overflow-x-auto">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">📌 Career Insights Table</h2>
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                <tr>
                    <th class="px-4 py-2">Career</th>
                    <th class="px-4 py-2">Average Salary</th>
                    <th class="px-4 py-2">Market Demand</th>
                    <th class="px-4 py-2">Required Qualifications</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <tr>
                    <td class="px-4 py-2">Software Engineer</td>
                    <td class="px-4 py-2">Rp 12.000.000</td>
                    <td class="px-4 py-2">High</td>
                    <td class="px-4 py-2">Bachelor's in CS/IT</td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Digital Marketer</td>
                    <td class="px-4 py-2">Rp 8.000.000</td>
                    <td class="px-4 py-2">Medium</td>
                    <td class="px-4 py-2">Diploma/Bachelor + Cert</td>
                </tr>
                <tr>
                    <td class="px-4 py-2">UI/UX Designer</td>
                    <td class="px-4 py-2">Rp 10.000.000</td>
                    <td class="px-4 py-2">High</td>
                    <td class="px-4 py-2">Design Degree or Portfolio</td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Data Analyst</td>
                    <td class="px-4 py-2">Rp 11.000.000</td>
                    <td class="px-4 py-2">High</td>
                    <td class="px-4 py-2">Statistics / CS + Tools</td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Content Writer</td>
                    <td class="px-4 py-2">Rp 6.500.000</td>
                    <td class="px-4 py-2">Medium</td>
                    <td class="px-4 py-2">Good writing + SEO</td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Web Developer</td>
                    <td class="px-4 py-2">Rp 9.500.000</td>
                    <td class="px-4 py-2">High</td>
                    <td class="px-4 py-2">HTML, CSS, JS + Framework</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Section: Tips -->
    <div class="bg-green-50 border-l-4 border-green-400 text-green-800 p-5 rounded-lg">
        <h3 class="text-lg font-semibold mb-3">💡 Tips for Maximizing Your Earning Potential</h3>
        <ul class="list-disc list-inside space-y-1 text-sm">
            <li>Upskill with certifications or bootcamps.</li>
            <li>Follow industry trends via LinkedIn or job portals.</li>
            <li>Negotiate based on data, not assumptions.</li>
            <li>Explore freelance and remote opportunities.</li>
        </ul>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salaryChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Software Engineer', 'Digital Marketer', 'UI/UX Designer', 'Data Analyst', 'Content Writer', 'Web Developer'],
                datasets: [{
                    label: 'Average Salary (Rp)',
                    data: [12000000, 8000000, 10000000, 11000000, 6500000, 9500000],
                    backgroundColor: 'rgba(34, 197, 94, 0.7)',  // hijau muda
                    borderColor: 'rgba(34, 197, 94, 1)',        // hijau solid
                    borderWidth: 1,
                }]
            },
            options: {
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
