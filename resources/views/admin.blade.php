<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Portfolio Management</title>
    <link rel="stylesheet" href="{{ url('css/admin.css') }}"> <!-- Link to the external CSS file -->
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <button id="sidebarToggle">☰</button> <br>
            <ul>
                <li><a href="#" data-target="adminDashboardSection" class="menu-item">Admin Dashboard</a></li>
                <li><a href="#" data-target="userManagementSection" class="menu-item">User Management</a></li>
                <li><a href="#" data-target="stockManagementSection" class="menu-item">Stock Management</a></li>
                <li><a href="#" data-target="listedsecurities" class="menu-item">Listed securities</a></li>
                <li><a href="#" data-target="eventManagementSection" class="menu-item">Event Management</a></li>
                <li><a href="#" data-target="analyticsSection" class="menu-item">Analytics</a></li>
                <li><a href="#" data-target="systemSettingsSection" class="menu-item">System Settings</a></li>
            </ul>
        </div>
        
        <div class="main-content">
            <header>
                <div class="header-content">
                    <div class="search-container">
                        <input type="text" placeholder="Search..." id="adminSearchBox">
                    </div>
                    <div class="profile-icon">
                        <img src="/image/admin.png" alt="Admin Profile">
                    </div>
                </div>
            </header>

            <!-- Admin Dashboard Section -->
            <div id="adminDashboardSection" class="content-section">
                <h2>Admin Dashboard</h2>
                <div class="overview">
                    <div class="card1">
                        <h3>Total Users</h3>
                        <p id="totalUsers">0</p>
                    </div>
                    <div class="card2">
                        <h3>Total Stocks Listed</h3>
                        <p id="totalStocks">0</p>
                    </div>
                    <div class="card3">
                        <h3>System Health</h3>
                        <p id="systemHealth">Good</p>
                    </div>
                </div>
            </div>

            <!-- User Management Section -->
            <div id="userManagementSection" class="content-section" style="display: none;">
                <h2>User Management</h2>
                <button id="addUser">Add New User</button>
                <button id="editUser">Edit User</button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="userBody">
                        <!-- Dynamic rows will be added here -->
                    </tbody>
                </table>
            </div>

            <!-- Stock Management Section --> 
            <div id="stockManagementSection" class="content-section" style="display: none;">
                <h2>Stock Management</h2>
                <button id="addStock">Add New Stock</button>
                <button id="editStock">Edit Stock</button>
                <table>
                    <thead>
                        <tr>
                            <th>Stock ID</th>
                            <th>Stock Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="stockBody">
                        <!-- Dynamic rows will be added here -->
                    </tbody>
                </table>
            </div>


            <!-- listed securities Section --> 
            <div id="listedsecurities" class="content-section" style="display: none;">
                <h2>Listed securities</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="showEntries">Show 
                                <select id="showEntries" class="form-select form-select-sm" style="width: auto; display: inline-block;">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries
                            </label>
                        </div>
                    </div>
        
                    <!-- CSV File Input -->
                    <input type="file" id="csvFileInput" accept=".csv" class="form-control my-3" />
                    <button id="uploadBtn" class="btn btn-primary">Upload CSV</button>
                    
                    <div class="table-container">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <!-- Table data will be populated dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>
            <script>
                // Function to parse CSV data
                function parseCSV(csvText) {
                    const rows = csvText.split('\n');
                    return rows.map(row => row.split(','));
                }
        
                // Function to populate table with CSV data
                function populateTable(data) {
                    const tableBody = document.getElementById('tableBody');
                    tableBody.innerHTML = ''; // Clear existing table data
        
                    // Loop through the CSV rows and create table rows
                    data.forEach((row, index) => {
                        // Skip empty rows
                        if (row.length === 1 && row[0] === "") return;
        
                        const tr = document.createElement('tr');
                        row.forEach(col => {
                            const td = document.createElement('td');
                            td.textContent = col.trim();
                            tr.appendChild(td);
                        });
                        tableBody.appendChild(tr);
                    });
                }
        
                // Add event listener to the Upload button
                document.getElementById('uploadBtn').addEventListener('click', () => {
                    const fileInput = document.getElementById('csvFileInput');
                    const file = fileInput.files[0];
        
                    if (!file) {
                        alert('Please select a CSV file.');
                        return;
                    }
        
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const csvText = e.target.result;
                        const parsedData = parseCSV(csvText);
                        populateTable(parsedData);
                    };
        
                    reader.readAsText(file);
                });
            </script>
                
            </div>
            </div>


             <!-- Event Management Section -->
             <div id="eventManagementSection" class="content-section" style="display: none;">
                <h2>Event  Management</h2>
                <button id="addEvent">Add New Event</button>
                <button id="editEvent">Edit Event</button>
                <table>
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Stock Name</th>
                            <th>Quanntity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="EventBody">
                        <!-- Dynamic rows will be added here -->
                    </tbody>
                </table>
            </div>
            <!-- Analytics Section -->
            <div id="analyticsSection" class="content-section" style="display: none;">
                <h2>System Analytics</h2>
                <!-- Analytics content goes here -->
            </div>

            <!-- System Settings Section -->
            <div id="systemSettingsSection" class="content-section" style="display: none;">
                <h2>System Settings</h2>
                <!-- Settings content goes here -->
            </div>
        </div>
    </div>

    <!-- Add User Pop-Up Form -->
    <div id="addUserPopup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Add New User</h2>
            <form id="addUserForm">
                <label for="userName">Name:</label>
                <input type="text" id="userName" name="userName" required>
                <label for="userEmail">Email:</label>
                <input type="email" id="userEmail" name="userEmail" required>
                <label for="userRole">Role:</label>
                <select id="userRole" name="userRole">
                    <option value="admin">Admin</option>
                    <option value="trader">Trader</option>
                </select>
                <button type="button" id="addUserBtn">Add User</button>
                <button type="button" id="cancelUserBtn">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Add Stock Pop-Up Form -->
    <div id="addStockPopup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Add New Stock</h2>
            <form id="addStockForm">
                <label for="stockName">Stock Name:</label>
                <input type="text" id="stockName" name="stockName" required>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
                <button type="button" id="addStockBtn">OK</button>
                <button type="button" id="cancelStockBtn">Cancel</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script><!-- Link to the external JavaScript file -->
</body>
</html>
