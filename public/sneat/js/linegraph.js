(() => {
    let myChart;
    let ownerName = window.ownerName || "";

    const allMonths = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];

    const monthColors = {
        January: "#FF6384",
        February: "#36A2EB",
        March: "#FFCE56",
        April: "#4BC0C0",
        May: "#9966FF",
        June: "#FF9F40",
        July: "#C9CBCF",
        August: "#8AFFC1",
        September: "#FF6F91",
        October: "#6B5B95",
        November: "#FFA07A",
        December: "#20B2AA",
    };

    const fetchAppointmentData = async () => {
        try {
            const response = await fetch(
                `/appointments/data?owner_name=${encodeURIComponent(ownerName)}`
            );
            if (!response.ok)
                throw new Error("Failed to fetch appointment data");
            return await response.json();
        } catch (error) {
            console.error("Chart Fetch Error:", error);
            return { labels: [], data: [] };
        }
    };

    const initChart = async () => {
        try {
            const chartElement = document.getElementById("myChart");
            if (!chartElement) {
                console.warn("Chart element not found");
                return;
            }

            const ctx = chartElement.getContext("2d");
            const appointmentData = await fetchAppointmentData();

            // Create a map of label => data, normalizing case for safety
            const dataMap = {};
            appointmentData.labels.forEach((label, idx) => {
                dataMap[label.toLowerCase()] = appointmentData.data[idx];
            });

            // Prepare data array and colors based on allMonths
            const filledData = allMonths.map(
                (month) => dataMap[month.toLowerCase()] || 0
            );
            const dynamicColors = allMonths.map(
                (month) => monthColors[month] || "#cccccc"
            );

            if (myChart) myChart.destroy();

            const maxDataValue = Math.max(...filledData, 1);

            myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: allMonths,
                    datasets: [
                        {
                            label: "Number of Appointments",
                            data: filledData,
                            backgroundColor: dynamicColors,
                            borderColor: dynamicColors,
                            borderWidth: 2,
                            borderRadius: 5,
                            categoryPercentage: 0.7, // reduce overall width of bar group
                            barPercentage: 0.7, // reduce width of individual bars
                            
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: "top" },
                        title: {
                            display: true,
                            text: "Appointments Per Month - 2025",
                        },
                    },
                    scales: {
                        x: {
                            ticks: {
                                maxRotation: 45,
                                minRotation: 45,
                            },
                            grid: { display: false },
                        },
                        y: {
                            beginAtZero: true,
                            precision: 0,
                            stepSize: 1,
                            suggestedMax: maxDataValue,
                        },
                    },
                },
            });
        } catch (err) {
            console.error("Error initializing chart:", err);
        }
    };

    document.addEventListener("DOMContentLoaded", initChart);
})();
