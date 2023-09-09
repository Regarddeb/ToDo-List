@include('partials.__header', ['title' => 'Add Task'])
@vite('resources/js/add_task.js')
@vite('resources/js/list.js')
{{-- sidemenu --}}
@include('partials.__side_menu', [
                                    'lists' => $lists, 
                                    'planned' => $planned,
                                    'today' => $today,
                                    'important' => $important
                                    ])

<div class="flex flex-col w-full px-2 md:w-8/12 lg:w-9/12 md:pl-5 lg:pl-10 space-y-3 mb-3 text-sm md:text-md overflow-x-auto">
    <form action="{{ route('store_task') }}" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <div class="mt-5 mx-auto md:px-4 flex items-center text-lg  w-full justify-between">
            <div class="flex items-center text-purple-500">
                <i class="bx bx-plus mr-2"></i> 
                <p class=" font-extrabold">Add New Task</p>
            </div>
            <button type="submit" value="Store_Task" 
                        class="bg-purple-700 py-1.5 px-3 rounded-lg hover:bg-purple-500 hover:text-gray-950 active:bg-purple-500 focus:ring focus:ring-gray-200">
                        <p class="flex items-center text-sm font-bold">
                            <i class="bx bx-xs bx-check-circle md:mr-2 md:-ml-0.5"></i> 
                            <span class="hidden md:flex">Save Task</span>
                        </p>
            </button>
        </div>

        <div class="container mt-5 mx-auto md:px-4 md:flex w-full text-xs md:text-sm">
            {{-- title, date, etc --}}
            <div class="flex flex-col flex-grow space-y-5 p-3 items-start">
                <div class="w-full space-y-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title"
                        class="bg-neutral-700 custom-outline w-full rounded-lg h-8 px-2" placeholder="Title of the task">
                    @error('title')
                        <span class="text-xs flex justify-end text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full space-y-2">
                    <label for="due">Due</label>
                    <div class="md:flex space-y-2 md:space-y-0 md:space-x-1">
                        <input type="date" name="date" id="due"
                            class="bg-neutral-700 custom-outline rounded-lg h-8 px-2 invert-0 w-full md:w-1/2" placeholder="dd/mm/yyyy">
                        <input type="time" name="time" id="time"
                            class="bg-neutral-700 custom-outline w-full md:w-1/2 rounded-lg h-8 px-2 text-gray-200">
                    </div>
                </div>
                @if ($list_id == null)
                    <div class="w-full space-y-2">
                        <label for="list">Add to List</label>
                        <select name="list_id" id="list"
                            class="bg-neutral-700 custom-outline w-full rounded-lg h-8 px-2 pr-3 border-r-8 border-r-neutral-700">
                            <option value="0" selected disabled>Select a list</option>
                            @foreach ($lists as $list)
                                <option value="{{ $list->list_id }}">{{ $list->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @else 
                    <input type="hidden" name="list_id" value="{{$list_id}}">
                @endif
                <div class="w-full flex">
                    <p>Mark as important</p>
                    <label class="relative inline-flex items-center cursor-pointer ml-4">
                        <input type="checkbox" value="0" name="starred" id="starred" class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-neutral-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-500 dark:peer-focus:ring-purple-500 rounded-full peer dark:bg-neutral-700 peer-checked:after:translate-x-full peer-checked:after:border-gray-200 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-gray-200 after:border-neutral-700 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-950 peer-checked:bg-purple-500">
                        </div>
                    </label>

                </div>
                <div class="w-full space-y-2">
                    <label for="task_desc">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10"
                        class="w-full bg-neutral-700 custom-outline rounded-lg px-2 py-1" placeholder="Write a brief task description (not required)"></textarea>
                </div>
                
            </div>

            
        </div>
    

    </form>
</div>
<x-__list_modal />
<script>
    if ("{{ session('success') }}") {
        sessionStorage.setItem('successMessage', "{{ session('success') }}");
    }
</script>

@include('partials.__footer')