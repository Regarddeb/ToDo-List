import $ from 'jquery';
import Swal from 'sweetalert2';
window.Swal = Swal;

$(function () {

    $("#task_container").on("click", ".star-icon", function () {
        var task_id = $(this).siblings('input[type="checkbox"]').val();
        var route = $(this).siblings('input[type="checkbox"]').data('route');
        star_task(task_id, route);
    });

    function star_task(task_id, route) {
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        if ($("#starred_" + task_id).val() == 0) {
            var is_starred = 1;
        } else {
            var is_starred = 0;
        };

        $("#task_box_" + task_id).addClass("opacity-60")
        $.ajax({
            type: 'POST',
            url: route,
            data: {
                task_id: task_id,
                _token: csrfToken,
                is_starred: is_starred
            },
            success: function (response) {
                $("#task_box_" + task_id).removeClass("opacity-60")
            },
            error: function (error) {
                $("#task_box_" + task_id).removeClass("opacity-60")
            }
        });
    }

    $("#task_container").on("click", ".done_checkbox", function () {
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        let route = $(this).data('route');
        let id = $(this).attr("id"); // Get the id attribute of the clicked checkbox
        let task_id = id.split("_")[2]; // Extract the number from the id

        if ($(this).val() == 0) {
            var done = 1;
        } else {
            var done = 0;
        }
        $("#task_box_" + task_id).addClass("opacity-60");
        $.ajax({
            type: 'POST',
            url: route,
            data: {
                task_id: task_id,
                _token: csrfToken,
                done: done
            },
            success: function (response) {
                $("#task_box_" + task_id).removeClass("opacity-60")
                var $taskContainer = $('#task_box_'+task_id);

                // Slide the div to the right and then fade it out
                $taskContainer.animate({
                    marginLeft: '100%', // Slide to the right
                    opacity: 0         // Fade out
                }, 500, function () {
                    // Animation complete, remove the div from the DOM
                    $taskContainer.remove();
                });
            },
            error: function (error) {
                $("#task_box_" + task_id).removeClass("opacity-60")
            }
        });
    });

    $("#task_container").on("click", ".delete_icon", function () {
        let id = $(this).attr("id");
        let route = $(this).data('route');
        
        let task_id = id.split("_")[1];
        $(".trash_"+task_id).removeClass('bx-trash').addClass('bx-loader bx-spin');

        $.ajax({
            type: 'POST',
            url: route,
            data: {
                task_id: task_id
            },
            success: function (response) {
                var $taskContainer = $('#task_box_'+task_id);

                // Slide the div to the right and then fade it out
                $taskContainer.animate({
                    marginLeft: '100%', // Slide to the right
                    opacity: 0         // Fade out
                }, 500, function () {
                    // Animation complete, remove the div from the DOM
                    $taskContainer.remove();
                });
            },
            error: function (error) {
                $(".trash_"+task_id).removeClass('bx-loader bx-spin').addClass('bx bx-xs bx-trash');
            }
        });
    })

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
})