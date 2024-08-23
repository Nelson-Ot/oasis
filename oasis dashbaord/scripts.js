document.addEventListener("DOMContentLoaded", function () {
    // Initialize charts
    function createChart(ctx, type, data, options) {
        return new Chart(ctx, {
            type: type,
            data: data,
            options: options
        });
    }

    // Revenue Growth Chart
    const revenueCtx = document.getElementById("revenue-chart").getContext("2d");
    const revenueData = {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [{
            label: "Revenue",
            data: [12000, 15000, 11000, 14000, 16000, 18000],
            borderColor: "#007bff",
            backgroundColor: "rgba(0, 123, 255, 0.2)",
            fill: true,
            tension: 0.4
        }]
    };
    const revenueOptions = {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        }
    };
    createChart(revenueCtx, "line", revenueData, revenueOptions);

    // Client Growth Chart
    const clientGrowthCtx = document.getElementById("client-growth-chart").getContext("2d");
    const clientGrowthData = {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [{
            label: "Clients",
            data: [300, 350, 320, 360, 400, 420],
            borderColor: "#28a745",
            backgroundColor: "rgba(40, 167, 69, 0.2)",
            fill: true,
            tension: 0.4
        }]
    };
    const clientGrowthOptions = {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        }
    };
    createChart(clientGrowthCtx, "line", clientGrowthData, clientGrowthOptions);

    // Web Traffic Chart
    const webTrafficCtx = document.getElementById("web-traffic-chart").getContext("2d");
    const webTrafficData = {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [{
            label: "Web Traffic",
            data: [5000, 6000, 5500, 6500, 7000, 7500],
            borderColor: "#ffc107",
            backgroundColor: "rgba(255, 193, 7, 0.2)",
            fill: true,
            tension: 0.4
        }]
    };
    const webTrafficOptions = {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        }
    };
    createChart(webTrafficCtx, "line", webTrafficData, webTrafficOptions);

    // Sales Chart
    const salesCtx = document.getElementById("sales-chart").getContext("2d");
    const salesData = {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [{
            label: "Sales",
            data: [2000, 2500, 2300, 2700, 3000, 3200],
            borderColor: "#dc3545",
            backgroundColor: "rgba(220, 53, 69, 0.2)",
            fill: true,
            tension: 0.4
        }]
    };
    const salesOptions = {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        }
    };
    createChart(salesCtx, "line", salesData, salesOptions);

    // Sidebar Dropdown Toggle
    const dropdownToggles = document.querySelectorAll(".sidebar-dropdown > a");
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener("click", function (event) {
            event.preventDefault();
            const submenu = this.nextElementSibling;
            const isActive = submenu.style.display === "block";
            document.querySelectorAll(".sidebar-submenu").forEach(sub => sub.style.display = "none");
            submenu.style.display = isActive ? "none" : "block";
            document.querySelectorAll(".sidebar-dropdown").forEach(dd => dd.classList.remove("active"));
            this.parentElement.classList.toggle("active", !isActive);
        });
    });

    // Search Bar
    const searchInput = document.querySelector(".search-bar input");
    searchInput.addEventListener("keyup", function () {
        const query = this.value.toLowerCase();
        // Add functionality to filter or search items based on the query
        console.log("Search query:", query);
    });

    // Hamburger Menu Button
    const menuBtn = document.querySelector(".menu-btn");
    const sidebarWrapper = document.querySelector(".sidebar-wrapper");
    menuBtn.addEventListener("click", function () {
        sidebarWrapper.classList.toggle("active");
    });

    // User Profile Dropdown
    const userProfile = document.querySelector(".user-profile");
    userProfile.addEventListener("click", function () {
        this.classList.toggle("active");
        // Add dropdown menu functionality if needed
    });

    // Notification Badge
    const notificationBadge = document.querySelector(".notification-badge");
    if (notificationBadge) {
        // Example: decrease the notification count
        notificationBadge.textContent = "3"; // Set initial value
        // Implement notification handling if needed
    }
});
document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.querySelector(".menu-btn");
    const sidebar = document.querySelector(".sidebar-wrapper");
    const content = document.querySelector(".content");

    menuBtn.addEventListener("click", function() {
        sidebar.classList.toggle("collapsed");
        content.classList.toggle("shifted");
    });
});
