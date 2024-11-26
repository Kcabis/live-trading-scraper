// Sidebar Toggle
document.getElementById('sidebarToggle').addEventListener('click', function() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('sidebar-open');
});

// Show/Hide Sections based on Menu Click
const menuItems = document.querySelectorAll('.menu-item');
menuItems.forEach(item => {
    item.addEventListener('click', function() {
        const targetSection = document.getElementById(item.getAttribute('data-target'));
        document.querySelectorAll('.content-section').forEach(section => {
            section.style.display = 'none';
        });
        targetSection.style.display = 'block';
    });
});

// Show Popup for Adding User
document.getElementById('addUser').addEventListener('click', function() {
    document.getElementById('addUserPopup').style.display = 'block';
});

// Show Popup for Adding Event
document.getElementById('addEvent').addEventListener('click', function() {
    document.getElementById('addEventPopup').style.display = 'block';
});

// Hide Popup (User)
document.getElementById('cancelUser').addEventListener('click', function() {
    document.getElementById('addUserPopup').style.display = 'none';
});

// Hide Popup (Event)
document.getElementById('cancelEvent').addEventListener('click', function() {
    document.getElementById('addEventPopup').style.display = 'none';
});

// // Handle Logout
// document.getElementById('logout').addEventListener('click', function() {
//     // You can use sessionStorage or localStorage to log out the user, or just redirect directly
//     window.location.href = "{{ url('home') }}"; // Redirect to login.blade.php
// });

// Save User Data Dynamically into the Table
document.getElementById('saveUser').addEventListener('click', function() {
    const userName = document.getElementById('userName').value;
    const userEmail = document.getElementById('userEmail').value;
    const userRole = document.getElementById('userRole').value;

    if (userName && userEmail && userRole) {
        const tableBody = document.getElementById('userBody');
        const newRow = tableBody.insertRow();
        
        const idCell = newRow.insertCell(0);
        const nameCell = newRow.insertCell(1);
        const emailCell = newRow.insertCell(2);
        const roleCell = newRow.insertCell(3);
        const actionCell = newRow.insertCell(4);

        const newId = tableBody.rows.length; // Assuming ID is based on row count
        idCell.innerText = newId;
        nameCell.innerText = userName;
        emailCell.innerText = userEmail;
        roleCell.innerText = userRole;
        actionCell.innerHTML = `<button class="editUser">Edit</button><button class="deleteUser">Delete</button>`;

        // Reset form and close popup
        document.getElementById('userName').value = '';
        document.getElementById('userEmail').value = '';
        document.getElementById('userRole').value = 'admin';
        document.getElementById('addUserPopup').style.display = 'none';
    } else {
        alert('Please fill all fields');
    }
});

// Save Event Data Dynamically into the Table
document.getElementById('saveEvent').addEventListener('click', function() {
    const eventName = document.getElementById('eventName').value;
    const stockName = document.getElementById('stockName').value;
    const eventType = document.getElementById('eventType').value;
    const eventPrice = document.getElementById('eventPrice').value;
    const eventDate = document.getElementById('eventDate').value;

    if (eventName && stockName && eventType && eventPrice && eventDate) {
        const tableBody = document.getElementById('eventBody');
        const newRow = tableBody.insertRow();

        const nameCell = newRow.insertCell(0);
        const stockCell = newRow.insertCell(1);
        const typeCell = newRow.insertCell(2);
        const priceCell = newRow.insertCell(3);
        const dateCell = newRow.insertCell(4);
        const actionCell = newRow.insertCell(5);

        nameCell.innerText = eventName;
        stockCell.innerText = stockName;
        typeCell.innerText = eventType;
        priceCell.innerText = eventPrice;
        dateCell.innerText = eventDate;
        actionCell.innerHTML = `<button class="editEvent">Edit</button><button class="deleteEvent">Delete</button>`;

        // Reset form and close popup
        document.getElementById('eventName').value = '';
        document.getElementById('stockName').value = '';
        document.getElementById('eventType').value = 'Webinar';
        document.getElementById('eventPrice').value = '';
        document.getElementById('eventDate').value = '';
        document.getElementById('addEventPopup').style.display = 'none';
    } else {
        alert('Please fill all fields');
    }
});

// Edit and Delete User Actions (Dynamically)
document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('editUser')) {
        const row = e.target.closest('tr');
        const id = row.cells[0].innerText;
        const name = row.cells[1].innerText;
        const email = row.cells[2].innerText;
        const role = row.cells[3].innerText;

        document.getElementById('userName').value = name;
        document.getElementById('userEmail').value = email;
        document.getElementById('userRole').value = role;

        // You can add logic here to update the row or replace it with edited values
    } else if (e.target && e.target.classList.contains('deleteUser')) {
        e.target.closest('tr').remove();
    } else if (e.target && e.target.classList.contains('editEvent')) {
        const row = e.target.closest('tr');
        const name = row.cells[0].innerText;
        const stock = row.cells[1].innerText;
        const type = row.cells[2].innerText;
        const price = row.cells[3].innerText;
        const date = row.cells[4].innerText;

        document.getElementById('eventName').value = name;
        document.getElementById('stockName').value = stock;
        document.getElementById('eventType').value = type;
        document.getElementById('eventPrice').value = price;
        document.getElementById('eventDate').value = date;

        // You can add logic here to update the row or replace it with edited values
    } else if (e.target && e.target.classList.contains('deleteEvent')) {
        e.target.closest('tr').remove();
    }
});
