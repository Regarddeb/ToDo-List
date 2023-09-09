import $ from 'jquery';
import Swal from 'sweetalert2';
window.Swal = Swal;
import './bootstrap';

$(function () {
    // Check if the "ajax" query parameter is present in the URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has("ajax")) {
      // Retrieve the filter value from the URL
      let filter = urlParams.get("filter");
      if (filter.indexOf('-mobile') !== -1) {
        var isMobile = true
        var key = filter.replace('-mobile', '');
    } else {
        var isMobile = false
        var key = filter;
    }
      // Fire the AJAX call because the query parameter is present
      $.ajax({
        type: 'POST',
        url: '/main_filter',
        data: {
          filter: key, // Use the filter value from the URL
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

        }
      });
    }
  });
  