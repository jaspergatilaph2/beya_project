const fetchAppointmentCount = async () => {
  try {
    const response = await fetch("/dashboard/count");
    if (!response.ok) {
      throw new Error("Failed to fetch appointment count");
    }
    const data = await response.json();
    return data.appointments;
  } catch (error) {
    console.error("Error:", error);
    return 0;  // Default if fetch fails
  }
};

// Updated function to update the count inside the span with id 'appointmentCount'
const updateAppointmentCount = async () => {
  const appointmentCount = await fetchAppointmentCount();

  const countElem = document.querySelector('#appointmentCount span');
  if (countElem) {
    countElem.textContent = appointmentCount;
  }
};

// Call it on page load
updateAppointmentCount();
