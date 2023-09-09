@include('partials.__header', ['title' => 'To Do | '.$name])
@vite('resources/js/show_list.js')
@vite('resources/js/list.js')
@vite("resources/js/task.js")
<div class="flex space-x-2 w-full mr-2 justify-between">
    {{-- user id --}}
    <input type="hidden" id="user_id" value="{{ auth()->user()->id }}">
    <input type="hidden" id="list_id" value="{{$list_id}}">
    {{-- sidemenu --}}
    @include('partials.__side_menu', [
        'lists' => $lists, 
        'planned' => $planned,
        'today' => $today,
        'important' => $important
        ])

    <div class="flex flex-col w-full md:px-2 md:w-8/12 lg:w-9/12 md:pl-5 lg:pl-10 space-y-3 pt-5 mb-3 text-sm md:text-md">
        <div class="mb-3 md:mb-0 flex justify-between items-center lg:mx-4">
            <p class="text-purple-500 font-extrabold items-center text-base md:text-lg lg:text-xl"> <span id="list_name_head">{{$name}}</span>
            <a href="javascript:;" id="list_name_icon"><i class="bx bx-pencil text-gray-500"></i></a>
            </p>
            <a href="{{ route('task_form') }}?list_id={{$list_id}}">
                <button
                    class="bg-purple-700 py-1.5 px-3 font-semibold rounded-lg hover:bg-purple-500 hover:text-gray-950 active:bg-purple-500 focus:ring focus:ring-gray-200">
                    <p class="flex items-center"><i class="bx bx-xs bx-plus mr-0 md:mr-2 -ml-0.5"></i> <span
                            class="hidden md:flex">Add Task</span></p>
                </button>
            </a>
        </div>
        <div class="overflow-y-auto w-full space-y-3 pt-2" id="task_container">
        
            @if($tasks->isEmpty())
                <x-__empty_task />
            @else 
                {{-- task list --}}
                <x-__task :tasks="$tasks" />
            @endif
        </div>
    </div>
</div>
<x-__list_modal />
<x-__task_modal />
<x-__edit_list_name_modal :name="$name"/>
<script>
    if ("{{ session('success') }}") {
        sessionStorage.setItem('successMessage', "{{ session('success') }}");
    }
</script>
@include('partials.__footer')
