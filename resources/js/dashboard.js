import $ from 'jquery';
import Swal from 'sweetalert2';
window.Swal = Swal;
$(function () {
    var spinner = '<div class="loader_cont py-20 w-full text-center">' +
        '<i class="bx bx-lg bx-loader bx-spin"></i>' +
        '</div>';

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
                var $taskContainer = $('#task_box_' + task_id);

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
        $(".trash_" + task_id).removeClass('bx-trash').addClass('bx-loader bx-spin');

        $.ajax({
            type: 'POST',
            url: route,
            data: {
                task_id: task_id
            },
            success: function (response) {
                var $taskContainer = $('#task_box_' + task_id);

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
                $(".trash_" + task_id).removeClass('bx-loader bx-spin').addClass('bx bx-xs bx-trash');
            }
        });
    })

    $("#done_task").on("click", function () {
        var spinner = '<div class="loader_cont py-20 w-full text-center">' +
            '<i class="bx bx-lg bx-loader bx-spin"></i>' +
            '</div>'
        let route = $(this).data("route");
        $.ajax({
            type: 'GET',
            url: route,
            beforeSend: function () {
                $('#task_container').html(spinner);
                $("#done_task").addClass("bg-gray-200 text-gray-950");
                $("#done_task").removeClass("bg-neutral-700 text-gray-200");
                $("#todo_task").removeClass("bg-gray-200 text-gray-950");
                $("#todo_task").addClass("bg-neutral-700 text-gray-200");
            },
            success: function (response) {
                $('#task_container').html(response.html);
                $(".filter_tab").removeClass("bg-purple-500 bg-opacity-80 text-gray-950");
                $("#" + response.type).addClass("bg-purple-500 bg-opacity-80 text-gray-950");

                $('.pill').removeClass('bg-purple-700')
                $('.pill').addClass('bg-transparent text-gray-200')
                $("#" + response.type + "-mobile").removeClass('bg-transparent')
                $("#" + response.type + "-mobile").addClass('bg-purple-700')
            },
            error: function (error) {

            },
            complete: function () {
                // Remove the spinner element
                $('#task_container').removeClass("flex");
                $('#task_container .bx-loader').remove();
            }
        });
    })

    $("#todo_task").on("click", function () {
        var spinner = '<div class="loader_cont py-20 w-full text-center">' +
            '<i class="bx bx-lg bx-loader bx-spin"></i>' +
            '<div/>'
        $.ajax({
            type: 'GET',
            url: '/unfinished_task',
            beforeSend: function () {
                $('#task_container').html(spinner);
                $(".filter").removeClass("bg-gray-200 text-gray-950");
                $(".filter").addClass("bg-neutral-700 text-gray-200");
                $("#todo_task").removeClass("bg-neutral-700 text-gray-200");
                $("#todo_task").addClass("bg-gray-200 text-gray-950");
            },
            success: function (response) {
                $('#task_container').html(response.html);
                $(".filter_tab").removeClass("bg-purple-500 bg-opacity-80 text-gray-950");
                $("#" + response.type).addClass("bg-purple-500 bg-opacity-80 text-gray-950");

                $('.pill').removeClass('bg-purple-700')
                $('.pill').addClass('bg-transparent text-gray-200')
                $("#" + response.type + "-mobile").removeClass('bg-transparent')
                $("#" + response.type + "-mobile").addClass('bg-purple-700')
            },
            error: function (error) {

            },
            complete: function () {
                // Remove the spinner element
                $('#task_container').removeClass("flex");
                $('#task_container .loader_cont').remove();

            }
        });
    })

    $("#search_task").on("click", function () {
        search_task();
    })

    $("#search_input").on("keypress", function (event) {
        if (event.key === "Enter") {
            search_task();
        }
    });

    function search_task() {
        let search_key = $("#search_input").val();
        $.ajax({
            type: 'POST',
            url: "/search_task",
            data: {
                search_key: search_key
            },
            beforeSend: function () {
                $('#task_container').html(spinner);
            },
            success: function (response) {
                $('#task_container').html(response.html);
            },
            error: function (error) {

            },
            complete: function () {
                $(".filter").removeClass("bg-gray-200 text-gray-950");
                $(".filter").addClass("bg-neutral-700 text-gray-200");
                $('#task_container').removeClass("flex");
                $('#task_container .loader_cont').remove();
                $(".filter_tab").removeClass("bg-purple-500 bg-opacity-80 text-gray-950");
                $('.pill').removeClass('bg-purple-700')
                $('.pill').addClass('bg-transparent text-gray-200')
            }
        });
    }
})

