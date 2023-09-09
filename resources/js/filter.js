import $ from 'jquery';
import Swal from 'sweetalert2';
window.Swal = Swal;
import './bootstrap';


$(function (){

    $("#today, #today-mobile").on("click", function () {
        $(".filter").removeClass("bg-gray-200 text-gray-950");
        $(".filter").addClass("bg-neutral-700 text-gray-200");
        let id = $(this).attr("id")
        filter(id);
    })

    $("#planned, #planned-mobile").on("click", function () {
        $(".filter").removeClass("bg-gray-200 text-gray-950");
        $(".filter").addClass("bg-neutral-700 text-gray-200");
        let id = $(this).attr("id")
        filter(id);
    })

    $("#important, #important-mobile").on("click", function () {
        $(".filter").removeClass("bg-gray-200 text-gray-950");
        $(".filter").addClass("bg-neutral-700 text-gray-200");
        let id = $(this).attr("id")
        filter(id);
    })

    $("#all, #all-mobile").on("click", function () {
        $(".filter").removeClass("bg-gray-200 text-gray-950");
        $(".filter").addClass("bg-neutral-700 text-gray-200");
        let id = $(this).attr("id")
        filter(id);
    })

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var spinner = '<div class="loader_cont py-20 w-full text-center">' +
        '<i class="bx bx-lg bx-loader bx-spin"></i>' +
        '</div>';
    
    var filter_param = localStorage.getItem('filter');

    if (filter_param !== null) {
        filter_ajax(filter_param)
    }else{
        all_task()
    }

    function filter(filter) {
        
        if (document.getElementById("task_container") === null) {
            localStorage.setItem('filter', filter);
            window.location.href = '/dashboard';
        }else{
            filter_ajax(filter)
        }
    }

    function filter_ajax(filter){
        if (filter.indexOf('-mobile') !== -1) {
            var isMobile = true
            var key = filter.replace('-mobile', '');
        } else {
            var isMobile = false
            var key = filter;
        }
        $.ajax({
            type: 'POST',
            url: '/main_filter',
            data: {
                filter: key,
                _token: csrfToken
            },
            beforeSend: function () {
                $('#task_container').html(spinner);
                if (isMobile) {
                    $('.pill').removeClass('bg-purple-700')
                    $('.pill').addClass('bg-transparent text-gray-200')
                    $("#" + filter).removeClass('bg-transparent')
                    $("#" + filter).addClass('bg-purple-700')
                } else {
                    $(".filter_tab").removeClass("bg-purple-500 bg-opacity-80 text-gray-950");
                    $("#" + filter).addClass("bg-purple-500 bg-opacity-80 text-gray-950");
                }
            },
            success: function (response) {
                $('#task_container').html(response.html);
            },
            error: function (error) {

            },
            complete: function () {
                // Remove the spinner element
                $('#task_container').removeClass("flex");
                $('#task_container .loader_cont').remove();
                localStorage.removeItem('filter');
            }
        });
    }

    function all_task(){
        var spinner =   '<div class="loader_cont py-20 w-full text-center">'+
                        '<i class="bx bx-lg bx-loader bx-spin"></i>' +
                        '</div>'
        $.ajax({
            type: 'GET',
            url: '/all_task',
            beforeSend: function() {
                $('#task_container').html(spinner);
                $(".filter_tab").removeClass("bg-purple-500 bg-opacity-80 text-gray-950");

                $("#all").addClass("bg-purple-500 bg-opacity-80 text-gray-950");
                $('#all-mobile').removeClass('bg-transparent');
                $("#all-mobile").addClass("bg-purple-700");
            },
            success: function (response) {
                $('#task_container').html(response.html);
            },
            error: function (error) {
                
            },
            complete: function() {
                // Remove the spinner element
                $('#task_container').removeClass("flex");
                $('#task_container .loader_cont').remove();
                
            }
        });
    }
})