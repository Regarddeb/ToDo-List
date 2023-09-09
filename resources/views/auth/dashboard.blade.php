@include('partials.__header', ['title' => 'To Do | Dashboard'])
@vite('resources/js/dashboard.js')
@vite('resources/js/list.js')
@vite('resources/js/task.js')
@vite('resources/js/draggable.js')
@vite('resources/js/filter.js')
<div class="flex space-x-2 w-full mr-4 justify-between">
    {{-- user id --}}
    <input type="hidden" id="user_id" value="{{ auth()->user()->id }}">


    {{-- sidemenu --}}
    @include('partials.__side_menu', [
        'lists' => $lists,
        'planned' => $planned,
        'today' => $today,
        'important' => $important,
        'all' => $all,
    ])

    <div class="dashboard flex flex-col w-full md:w-8/12 lg:w-9/12 lg:pl-9 space-y-3 pt-1 md:pt-5 mb-3 ml-[-0.5rem] text-sm md:text-md">

        <div class="hidden md:flex h-10 items-center justify-end md:justify-between">
            <div class="items-center text-base md:text-lg lg:text-xl font-extrabold text-purple-500 hidden md:flex">
                <i class="bx bx-sm bx-task mr-3"></i> <span class="">Tasks</span>
            </div>


            <div class="flex items-center justify-between w-full md:w-auto">
                {{-- Add task --}}
                <a href="{{ route('task_form') }}"><button
                        class="bg-purple-700 py-1.5 px-3 font-semibold rounded-lg hover:bg-purple-500 hover:text-gray-950 active:bg-purple-500 focus:ring focus:ring-gray-200">
                        <p class="flex items-center"><i class="bx bx-xs bx-plus mr-0 md:mr-2 -ml-0.5"></i> <span
                                class="hidden md:flex">New</span></p>
                    </button></a>
            </div>
        </div>
        
        {{-- mobile menu pills --}}
        @include('partials.__mobile_options', [
            'planned' => $planned,
            'today' => $today,
            'important' => $important,
            'all' => $all,
        ])

        {{-- search --}}
        @include('partials.__search')

        {{-- filters --}}
        <x-__filters />

        <div class="overflow-y-auto w-full space-y-3 pt-2 flex justify-center items-center" id="task_container">
            {{-- tasks container --}}
        </div>


        {{-- draggable mobile button for redirecting to add task form --}}
        <button id="draggable"
            class="md:hidden bottom-10 w-fit fixed right-8 bg-purple-700 py-1.5 px-3 font-semibold rounded-lg hover:bg-purple-500 hover:text-gray-950 active:bg-purple-500 focus:ring focus:ring-gray-200">
            <i class="bx bx-plus"></i> New
        </button>


    </div>
</div>
<x-__list_modal />
<x-__task_modal />
<script>
    if ("{{ session('success') }}") {
        sessionStorage.setItem('successMessage', "{{ session('success') }}");
    }
</script>
@include('partials.__footer')
