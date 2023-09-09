import $ from 'jquery';
import Swal from 'sweetalert2';
window.Swal = Swal;

$(function () {
    //showing task modal
    $("#task_container").on("click", ".task_link", function (){
        $('#modal-task').removeClass('hidden');
        $('#modal-task').addClass('flex');
        var route = $(this).data("route");
        var task_id = $(this).attr("id");
        fetchTask(route, task_id);
    });

    $('#task_modal_close').on("click", function (){
        $('#modal-task').addClass('hidden');
        $(".task_modal_content").empty();
        $(".task_modal_content").append('<i class="bx bx-md bx-loader bx-spin task_spinner"></i>');
        $("#edit_task_btn").attr("href", "");
    });

    function fetchTask(route, task_id){ //ajax for fetching task info and pasting in the modal
        $.ajax({
            type: 'POST',
            url: route,
            data: {
                task_id
            },
            success: function (response) {
                renderTask(response);
            },
            error: function (error) {
                
            }
        });
    }

    function renderTask(response){ // function for appending elements to the modal
        let elements = 
            '<p class="font-bold">Title</p>' +
            '<p class="px-2 py-1 bg-neutral-600 bg-opacity-40 rounded-md">'+ response[0].title +'</p>' ;
        

        if(response[0].date != null){
            elements += '<p class="font-bold">Due</p>' + 
                        '<p class="px-2 py-1 bg-neutral-600 bg-opacity-40 rounded-md">'+ response[0].date +' | '+ response[0].time +'</p>' 
        }
        if(response[0].list != undefined){
            elements += '<p class="font-bold">List</p>' + 
                        '<p class="px-2 py-1 bg-neutral-600 bg-opacity-40 rounded-md">'+ response[0].list +'</p>'
        }
        if(response[0].description != null){
            elements += '<p class="font-bold">Description</p>' +
                        '<p class="px-2 py-1 bg-neutral-600 bg-opacity-40 rounded-md">'+ response[0].description +'</p>'
        }

        $(".task_modal_content").empty();
        $(".task_modal_content").append(elements);

        // add hewf to the edit buttton in the modal task
        var routeValue = "show_task?task_id=" + response[0].task_id;
        $("#edit_task_btn").removeAttr("disabled");
        $("#edit_task_btn").data("route", routeValue);
    }

    $("#edit_task_btn").on("click", function() {
        var routeValue = $(this).data("route");
        window.location.href = routeValue;
    });
    
    
})