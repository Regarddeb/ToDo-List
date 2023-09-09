import $ from 'jquery';
import Swal from 'sweetalert2';
window.Swal = Swal;


// change the value of the 'starred' checkbox on click
$(function () {
    $("#starred").on('click', function () {
        if ($(this).val() == 0) {
            $(this).val(1);
        } else {
            $(this).val(0);
        }
    });

    $("#today, #today-mobile").on("click", function () {
        let filter = $(this).attr("id")
        localStorage.setItem('filter', filter);
        window.location.href = '/dashboard';
    })

    $("#planned, #planned-mobile").on("click", function () {
        let filter = $(this).attr("id")
        localStorage.setItem('filter', filter);
        window.location.href = '/dashboard';
    })

    $("#important, #important-mobile").on("click", function () {
        let filter = $(this).attr("id")
        localStorage.setItem('filter', filter);
        window.location.href = '/dashboard';
    })

    $("#all, #all-mobile").on("click", function () {
        let filter = $(this).attr("id")
        localStorage.setItem('filter', filter);
        window.location.href = '/dashboard';
    })
});






