import $, { data } from 'jquery';
import { update } from 'lodash';
import Swal from 'sweetalert2';
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    customClass: {
        container: 'custom-toast-container'
    },
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

$(function () {
    $('#modal-close').on("click",function () {
        $('#modal-container').addClass('hidden');
    });

    $('#addlist_btn').on("click", function () {
        $('#modal-container').removeClass('hidden');
        $('#modal-container').addClass('flex');
    });
    
    $('#store_list').on("click", function () {
        store_list();
    })

    $('#list_name').on("keypress", function (event) {
        if (event.key === "Enter") {
            store_list();
        }
    });

    function store_list() {
        let inputData = $('#list_name').val();
        let btnID = "store_list";
        // Validate if the input is not empty
        if (inputData === "") {
            $('#error_add_list').text('Input cannot be empty.');
            return; // Stop further processing
        }

        // Clear any previous error message
        $('#error_add_list').text('');
        let route = $("#" + btnID).data('route');
        let user_id = $("#user_id").val();
        let button = $("#" + btnID);

        let originalContent = button.html();
        button.html('<span class="spinner">Loading...</span>');

        $.ajax({
            type: 'POST',
            url: route,
            data: {
                inputData: inputData,
                user_id: user_id
            },
            success: function (response) {
                button.html(originalContent);
                $('#list_name').val('');
                $('#modal-container').addClass('hidden');

                Toast.fire({
                    icon: 'success',
                    text: response.message
                })

                $("#list_container").append(response.html);

            },
            error: function (error) {
                $('#error_add_list').text(error.message);
            }
        });
    }

    $('#list_container').on("click", ".list_delete", function () {
        Swal.fire({
            icon: 'error',
            title: '',
            text: "The tasks in this list will also be deleted",
            confirmButtonText: 'Delete',
            showCancelButton: true,
            customClass: {
                popup: 'bg-gray-950 dark:bg-gray-950', 
                container: 'bg-gray-700 bg-opacity-80 dark:bg-opacity-80', 
                confirmButton: 'bg-red-500 bg-opacity-70',
                cancelButton: 'text-gray-500'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).attr("id");
                let list_id = id.split("_")[1];
                let route = $(this).data("route");

                $(".trash_" + list_id).removeClass('bx-trash').addClass('bx-loader bx-spin');
                $.ajax({
                    type: 'POST',
                    url: route,
                    data: {
                        list_id,
                    },
                    success: function (response) {
                        var listContainer = $('#list_box_' + list_id);
                        // Slide the div to the right and then fade it out
                        listContainer.animate({
                            marginLeft: '100%', // Slide to the right
                            opacity: 0         // Fade out
                        }, 500, function () {
                            // Animation complete, remove the div from the DOM
                            listContainer.remove();
                        });
                        if($('.list_container').children().length == 0){
                            window.location.reload();
                        }
                    },
                    error: function (error) {
                        $(".trash_" + list_id).removeClass('bx-loader bx-spin').addClass('bx bx-xs bx-trash');
                    }
                });
            }
        });
    })

    $("#list_name_icon").on("click", function (){
        $('#list_name_modal').removeClass('hidden');
        $('#list_name_modal').addClass('flex');
    })

    $("#close_list_name_modal").on("click", function (){
        $('#list_name_modal').removeClass('flex');
        $('#list_name_modal').addClass('hidden');
    })

    $("#update_list_btn").on("click", function (){
        update_list();
    })

    $('#list_name_val').on("keypress", function (event) {
        if (event.key === "Enter") {
            update_list();
        }
    });

    function update_list(){
        let input = $('#list_name_val').val();
        let btnID = "update_list_btn";
        // Validate if the input is not empty
        if (input === "") {
            $('#error_update_list').text('Input cannot be empty.');
            return;  //Stop further processing
        }

        // Clear any previous error message
        $('#error_update_list').text('');
        let list_id = $("#list_id").val();
        let button = $("#" + btnID);

        let originalContent = button.html();
        button.html('<span class="spinner">Loading...</span>');

        $.ajax({
            type: 'POST',
            url: '/update_list_name',
            data: {
                name: input,
                list_id: list_id
            },
            success: function (response) {
                button.html(originalContent);
                $('#list_name_val').val('');
                $('#list_name_modal').addClass('hidden');

                Toast.fire({
                    icon: 'success',
                    text: "List updated successfully."
                })

                $("#list_name_head").html(input);
                $("#list_"+list_id).html(input);
                $('#list_name_val').val(input);
            },
            error: function (error) {
                $('#error_add_list').text("Error occured on our side");
                Toast.fire({
                    icon: 'error',
                    text: "Error occured"
                })
            }
        });
    }
})