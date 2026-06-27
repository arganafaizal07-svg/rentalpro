
document.addEventListener('DOMContentLoaded', function () {

    const toggleBtn = document.getElementById('menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    if (toggleBtn && sidebar) {

        toggleBtn.addEventListener('click', function () {

            sidebar.classList.toggle('hide');

        });

    }

});