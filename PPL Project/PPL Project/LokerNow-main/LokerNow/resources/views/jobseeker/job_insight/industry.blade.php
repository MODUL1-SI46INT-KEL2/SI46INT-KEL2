@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8 text-[#B9FF66]">
    <h1 class="text-3xl font-bold mb-6">📈 Industry Trends Insight</h1>

    <p class="text-white mb-8">
        Understanding industry trends helps you align your career with market demand. Here are the current dominant industries and the volume of job applications associated with them.
    </p>

    <!-- Section: Chart -->
    <div class="bg-white rounded-2xl shadow p-6 mb-8 max-w-md mx-auto">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">🏢 Top Industries by Application Volume</h2>
    <canvas id="industryChart" height="80"></canvas>
</div>

    <!-- Section: Table -->
    <div class="bg-white rounded-2xl shadow p-6 mb-8 overflow-x-auto">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">📌 Industry Breakdown</h2>
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                <tr>
                    <th class="px-4 py-2">Industry</th>
                    <th class="px-4 py-2">Application Volume</th>
                    <th class="px-4 py-2">Hiring Trend</th>
                    <th class="px-4 py-2">Example Roles</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <tr>
                    <td class="px-4 py-2">Information Technology</td>
                    <td class="px-4 py-2">40%</td>
                    <td class="px-4 py-2">Rising</td>
                    <td class="px-4 py-2">Developer, Analyst</td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Finance</td>
                    <td class="px-4 py-2">20%</td>
                    <td class="px-4 py-2">Stable</td>
                    <td class="px-4 py-2">Accountant, Auditor</td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Healthcare</td>
                    <td class="px-4 py-2">15%</td>
                    <td class="px-4 py-2">Growing</td>
                    <td class="px-4 py-2">Medical Staff, Admin</td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Retail</td>
                    <td class="px-4 py-2">10%</td>
                    <td class="px-4 py-2">Declining</td>
                    <td class="px-4 py-2">Sales, Merchandiser</td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Education</td>
                    <td class="px-4 py-2">8%</td>
                    <td class="px-4 py-2">Stable</td>
                    <td class="px-4 py-2">Teacher, Tutor</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Section: Tips -->
    <div class="bg-green-50 border-l-4 border-green-400 text-green-800 p-5 rounded-lg">
        <h3 class="text-lg font-semibold mb-3">💡 Tips to Stay Relevant in Trending Industries</h3>
        <ul class="list-disc list-inside space-y-1 text-sm">
            <li>Subscribe to newsletters from leading industry platforms.</li>
            <li>Attend online webinars and local meetups.</li>
            <li>Follow industry leaders on LinkedIn.</li>
            <li>Learn emerging tools and technologies relevant to your field.</li>
        </ul>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('industryChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Information Technology', 'Finance', 'Healthcare', 'Retail', 'Education'],
                datasets: [{
                    label: 'Industry Applications',
                    data: [40, 20, 15, 10, 8],
                    backgroundColor: [
                        '#4ade80', '#60a5fa', '#fbbf24', '#f87171', '#c084fc'
                    ],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#4B5563',
                        }
                    }
                }
            }
        });
    </script>
</div>
@endsection
