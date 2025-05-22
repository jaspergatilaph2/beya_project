const fetchAppointmentData = async () => {
    try {
      const response = await fetch("/appointments/data");
      if (!response.ok) {
        throw new Error("Failed to fetch appointment data");
      }
      return await response.json();
    } catch (error) {
      console.error(error);
      return {
        labels: [],
        data: [],
      };
    }
  };
  
const initChart = async () => {
    const ctx = document.getElementById("myChart").getContext("2d");
    const appointmentData = await fetchAppointmentData();
  
    const myChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: appointmentData.labels,
        datasets: [
          {
            label: "Number of Appointments",
            data: appointmentData.data,
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            borderColor: "rgba(75, 192, 192, 1)",
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: "top" },
          title: {
            display: true,
            text: "Appointments Per Month - 2025",
          },
        },
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    });
  };
  
  initChart();