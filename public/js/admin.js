const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

document.getElementById('sidebarToggle').addEventListener('click', function () {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('collapsed');
});


const menuItems = document.querySelectorAll('.menu-item');
menuItems.forEach(item => {
    item.addEventListener('click', function () {
        const targetSection = document.getElementById(item.getAttribute('data-target'));
        document.querySelectorAll('.content-section').forEach(section => {
            section.style.display = 'none';
        });
        targetSection.style.display = 'block';
    });
    
});


document.getElementById('addUser').addEventListener('click', function () {
    document.getElementById('addUserPopup').style.display = 'block';
});

document.getElementById('addEvent').addEventListener('click', function () {
    document.getElementById('addEventPopup').style.display = 'block';
});

document.getElementById('cancelUser').addEventListener('click', function () {
    document.getElementById('addUserPopup').style.display = 'none';
});

document.getElementById('cancelEvent').addEventListener('click', function () {
    document.getElementById('addEventPopup').style.display = 'none';
});


