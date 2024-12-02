<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Portfolio Management</title>
    <!-- Link to external CSS -->
    <link rel="stylesheet" href="{{ url('css/admin.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="dashboard">
        <!-- Sidebar Section -->
        <div class="sidebar">
            <button id="sidebarToggle">☰</button> <br>
            <ul>
                <li><a href="#" data-target="adminDashboardSection" class="menu-item">Admin Dashboard</a></li>
                <li><a href="#" data-target="userManagementSection" class="menu-item">User Management</a></li>
                <li><a href="#" data-target="stockManagementSection" class="menu-item">Stock Management</a></li>
                <li><a href="#" data-target="listedSecuritiesSection" class="menu-item">Listed Securities</a></li>
                <li><a href="#" data-target="eventManagementSection" class="menu-item">Event Management</a></li>
                <li><a href="#" data-target="systemSettingsSection" class="menu-item">System Settings</a></li>
                <li><button id="back"><a href="{{url('home')}}">Logout</a></button></li>
            </ul>
        </div>

        <!-- Add curved images -->
        <div class="curved-image left"></div>
        <div class="curved-image right"></div>

        <!-- Main Content Section -->
        <div class="main-content">
            <header>
                <div class="header-content">
                    <!-- Search Bar -->
                    <div class="search-container">
                        <p class="blinking-text">Welcome to Smart Folio</p>
                    </div>
                    <!-- Profile Icon -->
                    <div class="profile-icon">
                        <img src="{{ asset('images/admin.png') }}" alt="Admin Profile">
                    </div>
                </div>
            </header>

            <!-- Admin Dashboard Section -->
            <div id="adminDashboardSection" class="content-section">
                <h2>Admin Dashboard</h2>
                <div class="overview">
                    <div class="card">
                        <h3>Total Users</h3>
                        <p id="totalUsers">0</p>
                    </div>
                    <div class="card">
                        <h3>Total Stocks Listed</h3>
                        <p id="totalStocks">0</p>
                    </div>
                    <div class="card">
                        <h3>System Health</h3>
                        <p id="systemHealth">Good</p>
                    </div>
                </div>
            </div>



            <!-- User Management Section -->
            <div id="userManagementSection" class="content-section" style="display: none;">
                <h2>User Management</h2>
                <button id="addUser">Add New User</button>
                <table>
                    <thead>
                    
                        
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="userBody">
                        <!-- Dynamic rows will be added here -->
                        @foreach($folioadmins as $folioadmin)
                        <tr>
                        <td>{{$folioadmin->user_name}}</td>
                        <td>{{$folioadmin->email}}</td>
                        <td>{{$folioadmin->password}}</td>
                        <td>{{$folioadmin->role}}</td>
                        <td>
                            <button type="button"> Edit</button>
                            <button type="button"> Delete</button>
</td>
                        </tr>

                    </tbody>
                    @endforeach
                </table>
            </div>

            <!-- Stock Management Section -->
            <div id="stockManagementSection" class="content-section" style="display: none;">
                <h2>Stock Management</h2>
                <button id="addStock">Add New Stock</button>
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

            <!-- Listed Securities Section -->
            <div id="listedSecuritiesSection" class="content-section" style="display: none;">
                <h2>Listed Securities</h2>
                <input type="file" id="csvFileInput" accept=".csv">
                <button id="uploadCsv">Upload CSV</button>
                <table>
                    <thead>
                        <tr>
                            <th>Stock ID</th>
                            <th>Stock Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody id="listedSecuritiesBody">
                        <!-- Dynamic rows will be added here -->
                    </tbody>
                </table>
            </div>

            <!-- Event Management Section -->
            <div id="eventManagementSection" class="content-section" style="display: none;">
                <h2>Event Management</h2>
                <button id="addEvent">Add New Event</button>
                <table>
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Stock</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="eventBody">
                        @foreach($events as $event)
                        <tr>
                        <td>{{$event->event_name}}</td>
                        <td>{{$event->stock_name}}</td>
                        <td>{{$event->event_type}}</td>
                        <td>{{$event->price}}</td>
                        <td>{{$event->event_date}}</td>
                        <td>
                        
                            <button type="button">Edit</button>
                            <form action="#">
                            <button type="button">Delete</button>
                            </form>
                        </td>
                        </tr>

                        @endforeach
                        <!-- Dynamic rows will be added here -->
                    </tbody>
                </table>
            </div>

            <!-- Analytics Section -->
            <div id="analyticsSection" class="content-section" style="display: none;">
                <h2>System Analytics</h2>
                <!-- Add analytics components -->
            </div>

            <!-- System Settings Section -->
            <div id="systemSettingsSection" class="content-section" style="display: none;">
                <h2>System Settings</h2>
                <!-- Add system settings components -->
            </div>
        </div>
    </div>

    <!-- Popup Forms -->
    <div id="addUserPopup" class="popup" style="display: none;">
        <div class="popup-content">
            <h2>Add New User</h2>
            <form id="addUserForm" action="/add-ad" method="POST">
                @csrf
                <label for="userName">Name:</label>
                <input type="text" id="userName" name="user_name"required>
                <label for="userEmail">Email:</label>
                <input type="email" id="userEmail" name="email"required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password"required>
                <label for="userRole">Role:</label>
                <select id="userRole" name="role">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <button type="submit" id="saveUser">Save</button>
                <button type="button" id="cancelUser">Cancel</button>
            </form>
        </div>
    </div>


    <div id="addEventPopup" class="popup" style="display: none;">
    <div class="popup-content">
        <h2>Add New Event</h2>
        <form id="addEventForm" action="/add-event" method="POST">
            @csrf
            <label for="eventName">Event Name:</label>
            <input type="text" name="event_name"id="eventName" required>

            <label for="stockName">Stock Name:</label>
            <input type="text" name="stock_name" id="stockName" required>

            <label for="eventType">Event Type:</label>
            <select id="eventType" name="event_type">
                <option value="1">IPO</option>
                <option value="2">Right</option>
                <option value="3">Bonus</option>
                <option value="4">Auction</option>
                <option value="4">FPO</option>
                <option value="5">Debenture</option>
                <option value="6">Foreign Employement</option>   
            </select>
   
            <label for="eventPrice">Price:</label>
            <input type="number" name="price" id="eventPrice" required>

            <label for="eventDate">Event Date:</label>
            <input type="date" name="event_date" id="eventDate" required>

            <button type="submit" id="saveEvent">Save</button>
            <button type="button" id="cancelEvent">Cancel</button>
        </form>
    </div>
</div>


    <!-- JavaScript -->
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
