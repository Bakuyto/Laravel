/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});


// document.addEventListener("DOMContentLoaded", function() {
//     function hideAlert(alertElement) {
//         if (alertElement) {
//             alertElement.classList.remove('show');
//             alertElement.classList.add('fade');
//                 alertElement.classList.add('d-none'); // Hide the alert after fade-out
//         }
//     }

//     var alertCreate = document.getElementById('category-create-alert');
//     var alertError = document.getElementById('category-create-error');
//     var alertUpdate = document.getElementById('category-update-alert');
//     var alertUpdateError = document.getElementById('category-update-error');
//     var alertDelete = document.getElementById('category-delete-alert');
//     var alertDeleteError = document.getElementById('category-delete-error');

//     // Hide alerts after 3 seconds if they exist
//     setTimeout(function() {
//         hideAlert(alertCreate);
//         hideAlert(alertError);
//         hideAlert(alertUpdate);
//         hideAlert(alertUpdateError);
//         hideAlert(alertDelete);
//         hideAlert(alertDeleteError);
//     }, 3000); // 3 seconds
// });


$(document).ready(function() {
    function hideAlert(alertElement) {
        if (alertElement.length) {
            alertElement.removeClass('show').addClass('fade');
            setTimeout(function() {
                alertElement.addClass('d-none'); // Hide the alert after fade-out
            }); // Wait for fade-out animation to complete (1000 milliseconds)
        }
    }

    var alertCreate = $('#category-create-alert');
    var alertError = $('#category-create-error');
    var alertUpdate = $('#category-update-alert');
    var alertUpdateError = $('#category-update-error');
    var alertDelete = $('#category-delete-alert');
    var alertDeleteError = $('#category-delete-error');

    // Hide alerts after 3 seconds if they exist
    setTimeout(function() {
        hideAlert(alertCreate);
        hideAlert(alertError);
        hideAlert(alertUpdate);
        hideAlert(alertUpdateError);
        hideAlert(alertDelete);
        hideAlert(alertDeleteError);
    }, 3000); // 3 seconds
});






