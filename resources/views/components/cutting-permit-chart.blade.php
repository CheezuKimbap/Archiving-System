<div class="bg-white shadow-md rounded-lg p-4">
    <img src="{{ asset('images/reports/tree cutting.png') }}" alt="Tree Cutting Permits" class="w-20">

    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Tree Cutting Permit</h3>
        <h4 id="totalTCPRegistrations" class="text-sm font-medium text-gray-600">Total Permits: 0</h4>
    </div>
    <div class="flex items-center space-x-4 mb-4">
        <div>
            <label for="tcp_municipality_filter" class="block text-sm font-medium text-gray-700">Municipality:</label>
            <select id="tcp_municipality_filter"
                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                <option value="">All</option>
                <option value="Buenavista">Buenavista</option>
                <option value="Gasan">Gasan</option>
                <option value="Boac">Boac</option>
                <option value="Mogpog">Mogpog</option>
                <option value="Santa Cruz">Santa Cruz</option>
                <option value="Torrijos">Torrijos</option>
            </select>
        </div>
        <div>
            <label for="tcp_timeframe_filter" class="block text-sm font-medium text-gray-700">Timeframe:</label>
            <select id="tcp_timeframe_filter"
                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
            </select>
        </div>
        <div>
            <label for="startDateFilter" class="block text-sm font-medium text-gray-700">Start Date:</label>
            <input type="date" id="startDateFilter"
                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
        </div>
        <div>
            <label for="endDateFilter" class="block text-sm font-medium text-gray-700">End Date:</label>
            <input type="date" id="endDateFilter"
                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
        </div>
        <button id="applyTCPFilters"
            class="mt-6 px-4 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
            Apply Filters
        </button>
    </div>
    <div id="tcp_chart"></div>
    <div id="no-data-tcp-message" class="hidden text-center text-gray-500">No data available for the selected filters.
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            if (typeof ApexCharts === "undefined") {
                console.error("ApexCharts is not defined. Ensure the library is loaded.");
                return;
            }

            let tcp_chart;
            const tcp_chartElement = document.getElementById("tcp_chart");
            const totalTCPRegistrationsElement = document.getElementById("totalTCPRegistrations");
            const noDataTCPMessage = document.getElementById("no-data-tcp-message");

            async function fetchTCPChartData(municipality = "All", timeframe = "monthly", startDate = null,
                endDate = null) {
                try {
                    const url = new URL('/api/tree-cutting-statistics', window.location.origin);
                    url.searchParams.append('municipality', municipality);
                    url.searchParams.append('timeframe', timeframe);
                    if (startDate) url.searchParams.append('start_date', startDate);
                    if (endDate) url.searchParams.append('end_date', endDate);

                    const response = await fetch(url);
                    const {
                        data,
                        total_count
                    } = await response.json();

                    if (!data || data.length === 0) {
                        noDataTCPMessage.classList.remove('hidden');
                        tcp_chart.updateSeries([{
                            name: "Tree Cutting Permits",
                            data: []
                        }]);
                        tcp_chart.updateOptions({
                            xaxis: {
                                categories: []
                            }
                        });
                        totalTCPRegistrationsElement.textContent = `Total Permits: 0`;
                        return;
                    }

                    noDataTCPMessage.classList.add('hidden');
                    totalTCPRegistrationsElement.textContent = `Total Permits: ${total_count}`;

                    const categories = data.map(item => (
                        timeframe === "yearly" ? `${item.year}` : `${item.month} ${item.year}`
                    ));

                    const counts = data.map(item => item.count);

                    tcp_chart.updateOptions({
                        xaxis: {
                            categories: categories
                        }
                    });

                    tcp_chart.updateSeries([{
                        name: "Tree Cutting Permits",
                        data: counts
                    }]);
                } catch (error) {
                    console.error("Error fetching chart data:", error);
                }
            }

            const options = {
                chart: {
                    type: "bar",
                    height: 350,
                    fontFamily: "Inter, sans-serif"
                },
                colors: ["#1A56DB"],
                series: [],
                xaxis: {
                    categories: []
                },
                yaxis: {
                    title: {
                        text: "Number of Permits"
                    },
                    labels: {
                        formatter: function(value) {
                            return Math.round(value);
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "70%",
                        borderRadius: 8
                    }
                },
                dataLabels: {
                    enabled: true
                }
            };

            tcp_chart = new ApexCharts(tcp_chartElement, options);
            tcp_chart.render();

            fetchTCPChartData();

            document.getElementById("applyTCPFilters").addEventListener("click", () => {
                const municipality = document.getElementById("tcp_municipality_filter").value;
                const timeframe = document.getElementById("tcp_timeframe_filter").value;
                const startDate = document.getElementById("startDateFilter").value;
                const endDate = document.getElementById("endDateFilter").value;
                fetchTCPChartData(municipality, timeframe, startDate, endDate);
            });
        });
    </script>
</div>
<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
