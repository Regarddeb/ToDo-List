import $ from 'jquery';
import Swal from 'sweetalert2';
window.Swal = Swal;
import './bootstrap';



// toast template
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3500,
    customClass: {
        container: 'custom-toast-container'
    },
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

// fire the sweetalert toast when the success message is on
if (sessionStorage.getItem('successMessage')) {
    Toast.fire({
        icon: 'success',
        text: sessionStorage.getItem('successMessage')
    })
    sessionStorage.removeItem('successMessage');
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {

    $(".filter_tab").removeClass("bg-purple-500 bg-opacity-80 text-gray-950");

    $(".mobile-menu").on("click", function () {
        if ($("#sub-nav").is(':visible')) {
            $(".mobile-menu").html('<i class="bx bx-md bx-menu"></i>');
            $("#sub-nav").hide();
        } else {
            $(".mobile-menu").html('<i class="bx bx-md bx-x"></i>');
            $("#sub-nav").show();
        }

    })

    $('.logout-link').on("click", function () {
        confirmLogout();
    })

    function confirmLogout() {
        Swal.fire({
            icon: 'warning',
            title: '',
            text: "Are you sure you want to logout?",
            confirmButtonText: 'Logout',
            showCancelButton: true,
            customClass: {
                popup: 'bg-gray-950 dark:bg-gray-950',
                container: 'bg-gray-700 bg-opacity-80 dark:bg-opacity-80',
                confirmButton: 'bg-red-500 bg-opacity-70',
                cancelButton: 'text-gray-500'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, submit the logout form
                document.getElementById('logout-form').submit();
            }
        });
    }

    $('#draggable').on('click', function () {
        window.location.href = '/task_form'
    })

    
});
