<div class="flex w-full space-x-2">
    <button 
        id="todo_task"
        class="bg-neutral-700 filter text-gray-200 text-xs px-3 py-1 rounded-full font-thin hover:bg-gray-200 hover:text-gray-950 focus:ring focus:ring-gray-200">
        To do
    </button>
    
    <button
        data-route="{{route("finished_task")}}"
        id="done_task" 
        class="bg-neutral-700 filter text-gray-200  text-xs px-3 py-1 rounded-full font-thin hover:bg-gray-200 hover:text-gray-950 focus:ring focus:ring-gray-200">
        Done
    </button>
</div>