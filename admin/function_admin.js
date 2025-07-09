document.addEventListener("DOMContentLoaded", () => {
    const ordersChartCtx = document.getElementById("ordersChart").getContext("2d");
    const categoryChartCtx = document.getElementById("categoryChart").getContext("2d");

    // Replace these values with PHP variables from your database
    const ordersData = [10, 20, 15, 30]; // Example data
    const categories = ["Pendidikan", "Kesehatan", "E-Commerce", "Travelling"];
    const categoryEarnings = [5000000, 3000000, 7000000, 2000000]; // Example data

    new Chart(ordersChartCtx, {
        type: "bar",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr"],
            datasets: [{
                label: "Jumlah Pesanan",
                data: ordersData,
                backgroundColor: "rgba(75, 192, 192, 0.6)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 1
            }]
        },
        options: { responsive: true }
    });

    new Chart(categoryChartCtx, {
        type: "pie",
        data: {
            labels: categories,
            datasets: [{
                data: categoryEarnings,
                backgroundColor: ["#ff6384", "#36a2eb", "#cc65fe", "#ffce56"]
            }]
        },
        options: { responsive: true }
    });
});
