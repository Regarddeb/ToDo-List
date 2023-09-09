
@foreach ($tasks as $task)
    <div id="task_box_{{$task->task_id}}" 
        class="flex task_box w-full bg-neutral-800 py-2 md:py-3 px-1.5 md:px-2 hover:bg-opacity-80 rounded-xl h-fit items-center space-x-2 transition-transform hover:translate-y-[-5px]">
        <div class="flex items-center mr-2">
            
            @if(($task->done) == 0)
                <input 
                type="checkbox" value="{{$task->done}}" 
                id="task_done_{{$task->task_id}}"
                class="done_checkbox bg-neutral-800 mr-2 ml-1 md:ml-3 accent-purple-500 scale-125"
                data-route="{{ route('update_done') }}">
            @else 
                <input checked 
                type="checkbox" value="{{$task->done}}" 
                id="task_done_{{$task->task_id}}"
                class="done_checkbox bg-neutral-800 mr-2 ml-1 md:ml-3 accent-purple-500 scale-125"
                data-route="{{ route('update_done') }}">
            @endif

            <input type="hidden" id="starred_{{$task->task_id}}" value="{{$task->starred}}">

            @if (($task->starred) == 1) 
                <label class="relative inline-flex cursor-pointer pt-1">
                    <input checked type="checkbox" class="hidden star-checkbox" value="{{$task->task_id}}" data-route="{{ route('update_star') }}"/>
                    
                    <!-- Star SVG icon with stroke and fill color -->
                    <svg class="star-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 2L9 8H3L8 12L6 18L12 14L18 18L16 12L21 8H15L12 2Z" />
                    </svg>
                </label>
            @else
                <label class="relative inline-flex cursor-pointer pt-1">
                    <input type="checkbox" class="hidden star-checkbox" value="{{$task->task_id}}" data-route="{{ route('update_star') }}"/>
                    
                    <!-- Star SVG icon with stroke and fill color -->
                    <svg class="star-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 2L9 8H3L8 12L6 18L12 14L18 18L16 12L21 8H15L12 2Z" />
                    </svg>
                </label>
            @endif
        </div>
        {{-- "{{route('show_task')}}?task_id = {{$task->task_id}}" --}}
        <a href="javascript:;" class="task_link flex flex-col flex-grow space-y-2 truncate text-ellipsis" data-route="{{route("get_task")}}" id="{{$task->task_id}}">
            <p id="title_{{$task->task_id}}" class="tracking-wider text-sm md:text-base font-bold ">{{$task->title}}</p>

            @if ($task->date)
                <p class="text-xs flex items-center">
                    <i class="bx bx-calendar bx-xs"></i>&nbsp;&nbsp; {{$task->date}} : {{$task->time}}
                </p>
            @else
                <p class="text-xs flex items-center">
                    No Due Date
                </p>
            @endif
        
        </a>


        <a href="javascript:;" data-route="{{ route('destroy_task') }}" id="delete_{{$task->task_id}}"
            class="delete_icon hover:text-purple-500 pl-4 md:pr-4 right-0">
            <i class="bx bx-xs bx-trash trash_{{$task->task_id}}"></i>
        </a>
    </div>
@endforeach
