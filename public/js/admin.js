// Sidebar Toggle Functionality
const sidebarToggle = document.getElementById("sidebarToggle");
const sidebar = document.querySelector(".sidebar");
const mainContent = document.querySelector(".main-content");

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("collapsed");
    mainContent.classList.toggle("expanded");
});

// Section Display Toggle
const menuItems = document.querySelectorAll(".menu-item");
const contentSections = document.querySelectorAll(".content-section");

menuItems.forEach(item => {
    item.addEventListener("click", () => {
        const targetSection = item.getAttribute("data-target");

        contentSections.forEach(section => {
            if (section.id === targetSection) {
                section.style.display = "block";
            } else {
                section.style.display = "none";
            }
        });
    });
});

// Popup Handling for Add User and Add Stock
const addUserButton = document.getElementById("addUser");
const addStockButton = document.getElementById("addStock");
const addUserPopup = document.getElementById("addUserPopup");
const addStockPopup = document.getElementById("addStockPopup");
const closePopupButtons = document.querySelectorAll(".close");

// Show Add User Popup
addUserButton.addEventListener("click", () => {
    addUserPopup.style.display = "block";
});

// Show Add Stock Popup
addStockButton.addEventListener("click", () => {
    addStockPopup.style.display = "block";
});

// Close Popups
closePopupButtons.forEach(button => {
    button.addEventListener("click", () => {
        button.closest(".popup").style.display = "none";
    });
});

// Add User Functionality
const addUserForm = document.getElementById("addUserForm");
addUserForm.addEventListener("submit", (event) => {
    event.preventDefault();
    const userName = document.getElementById("userName").value;
    const userEmail = document.getElementById("userEmail").value;
    const userRole = document.getElementById("userRole").value;

    // Add user to table (this would be handled by backend in real scenario)
    const userBody = document.getElementById("userBody");
    const newRow = document.createElement("tr");
    newRow.innerHTML = `
        <td>1</td>
        <td>${userName}</td>
        <td>${userEmail}</td>
        <td>${userRole}</td>
        <td><button class="editBtn">Edit</button></td>
    `;
    userBody.appendChild(newRow);

    // Close the popup
    addUserPopup.style.display = "none";
});

// Add Stock Functionality
const addStockForm = document.getElementById("addStockForm");
addStockForm.addEventListener("submit", (event) => {
    event.preventDefault();
    const stockName = document.getElementById("stockName").value;
    const quantity = document.getElementById("quantity").value;
    const price = document.getElementById("price").value;

    // Add stock to table (this would be handled by backend in real scenario)
    const stockBody = document.getElementById("stockBody");
    const newRow = document.createElement("tr");
    newRow.innerHTML = `
        <td>1</td>
        <td>${stockName}</td>
        <td>${quantity}</td>
        <td>${price}</td>
        <td><button class="editBtn">Edit</button></td>
    `;
    stockBody.appendChild(newRow);

    // Close the popup
    addStockPopup.style.display = "none";
});
