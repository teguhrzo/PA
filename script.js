const menuItems = document.querySelectorAll('.topnav .menu-item');

menuItems.forEach(item => {
  item.addEventListener('click', function() {
    menuItems.forEach(item => item.classList.remove('active'));
    this.classList.add('active');
  });
});

function redirectGettingStart(){
  // if session is login then redirect to
  window.location.href = "index.php#services";
  // else, redirect to login page 
}

