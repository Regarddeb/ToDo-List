@foreach ($tasks as $task)
@include('partials.__header', ['title' => 'To Do | '.$task->title])
@vite('resources/js/dashboard.js')
@vite('resources/js/list.js')
@vite("resources/js/task.js")
@vite("resources/js/add_task.js")

<div class="flex space-x-2 w-full mr-2 justify-between">
    {{-- user id --}}
    <input type="hidden" id="user_id" value="{{ auth()->user()->id }}">
   
    {{-- sidemenu --}}
    @include('partials.__side_menu', [
                                    'lists' => $lists, 
                                    'planned' => $planned,
                                    'today' => $today,
                                    'important' => $important
                                    ])

    <div class="flex flex-col w-full md:px-2 md:w-8/12 lg:w-9/12 md:pl-5 lg:pl-10 space-y-3 pt-5 mb-3 text-sm md:text-md overflow-y-auto">
        <form action="{{ route('update_task') }}" method="post">
            @csrf
            <div class="mb-3 md:mb-0 flex justify-between items-center lg:mx-4">
                <p class="text-purple-500 font-extrabold items-center text-base md:text-lg lg:text-xl"><i class="bx bx-task"></i> {{$task->title}}
                </p>
                <button type="submit"
                    class="bg-purple-700 py-1.5 px-3 font-semibold rounded-lg hover:bg-purple-500 hover:text-gray-950 active:bg-purple-500 focus:ring focus:ring-gray-200">
                    <p class="flex items-center"><i class="bx bx-xs bx-check mr-0 md:mr-2 -ml-0.5"></i> <span
                            class="hidden md:flex">Save</span></p>
                </button>
            </div>
            <input type="hidden" name="task_id" value="{{$task->task_id}}">
            <div class="overflow-y-auto w-full space-y-3 md:p-5 rounded-lg px-1">
                <div class="w-full space-y-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" required
                        class="bg-neutral-700 custom-outline w-full rounded-lg h-8 px-2" placeholder="Title of the task" value="{{$task->title}}"> 
                    @error('title')
                        <span class="text-xs flex justify-end text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full space-y-2">
                    <label for="due">Due</label>
                    <div class="md:flex space-y-2 md:space-y-0 md:space-x-1">
                        <input type="date" name="date" id="due" @if ($task->date) value="{{$task->date}}" @endif
                            class="bg-neutral-700 custom-outline rounded-lg h-8 px-2 invert-0 w-full md:w-1/2"
                            placeholder="dd/mm/yyyy">
                        <input type="time" name="time" id="time" @if ($task->time) value="{{$task->time}}" @endif
                            class="bg-neutral-700 w-full md:w-1/2 custom-outline rounded-lg h-8 px-2 text-gray-200">
                    </div>
                </div>
                <div class="w-full space-y-2">
                    <label for="list">Add to List</label>
                    <select name="list_id" id="list"
                        class="bg-neutral-700 w-full rounded-lg h-8 border-r-8 custom-outline border-r-neutral-700">
                        @if ($task->name)
                            <option value="{{$task->list_id}}" selected>{{$task->name}}</option>
                            <option value="">Remove from list</option>
                        @else
                            <option value="" selected disabled>Select a list</option>
                        @endif
                        
                        @foreach ($lists as $list)
                            <option class="option" value="{{ $list->list_id }}">{{ $list->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full flex">
                    <p>Mark as important</p>
                    @if ($task->starred == 1)
                        <label class="relative inline-flex items-center cursor-pointer ml-4">
                            <input checked type="checkbox" value="1" name="starred" id="starred" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-neutral-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-500 dark:peer-focus:ring-purple-500 rounded-full peer dark:bg-neutral-700 peer-checked:after:translate-x-full peer-checked:after:border-gray-200 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-gray-200 after:border-neutral-700 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-950 peer-checked:bg-purple-500">
                            </div>
                        </label>
                    @else 
                        <label class="relative inline-flex items-center cursor-pointer ml-4">
                            <input type="checkbox" value="0" name="starred" id="starred" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-neutral-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-500 dark:peer-focus:ring-purple-500 rounded-full peer dark:bg-neutral-700 peer-checked:after:translate-x-full peer-checked:after:border-gray-200 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-gray-200 after:border-neutral-700 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-950 peer-checked:bg-purple-500">
                            </div>
                        </label>
                    @endif
                </div>
                <div class="w-full space-y-2">
                    <label for="task_desc">Description</label>
                    <textarea  name="description" id="description" cols="30" rows="10"  
                        class="w-full bg-neutral-700 custom-outline rounded-lg p-3" placeholder="Write a brief task description (not required)">
@if ($task->description){{$task->description}} @endif
                    </textarea>
                </div>
            </div>
        </form>
    </div>
    @endforeach
</div>
<script>
    if ("{{ session('success') }}") {
        sessionStorage.setItem('successMessage', "{{ session('success') }}");
    }
</script>
@include('partials.__footer')
