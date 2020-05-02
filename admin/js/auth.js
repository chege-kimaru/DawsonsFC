let USER = undefined;
try {
    USER = JSON.parse(sessionStorage.getItem('user'));
    if(USER.role > 2) {
        location.href = 'login.php';
    }
} catch (e) {
    location.href = 'login.php';
}