@include('partials.__header', ['title' => 'To Do | Dashboard'])
@vite('resources/js/filter.js')
@vite('resources/js/list.js')

<input type="hidden" id="user_id" value="{{ auth()->user()->id }}">
<div class="w-full flex flex-col space-y-2 overflow-y-auto" id="list_container">
    <div class="flex justify-between items-center mt-5 px-4">
        <p class="font-bold text-purple-500">Lists</p>
        <button id="addlist_btn"
            class="bg-purple-700 h-fit text-gray-200 rounded-md hover:bg-purple-500 hover:text-gray-950 active:bg-purple-500 focus:ring focus:ring-gray-200">
            <i class="bx bx-xs bx-plus m-2 font-bold"></i>
        </button>
        
    </div>
    <hr class="opacity-10">
    <input type="hidden" class="delete_route" data-route="{{ route('destroy_list') }}">
    @if ($lists->isEmpty())
        <!-- Display a component or message for empty lists -->
        <x-__empty_list />
    @else
        <!-- Loop through the lists -->
        <x-__list :lists="$lists" />
    @endif
</div>
<x-__list_modal />
<script>
    if ("{{ session('success') }}") {
        sessionStorage.setItem('successMessage', "{{ session('success') }}");
    }
</script>
@include('partials.__footer')
