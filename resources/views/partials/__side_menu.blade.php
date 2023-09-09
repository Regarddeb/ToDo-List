<div class="hidden md:flex flex-col space-y-2 mr-0 md:mr-8 lg:mr-10 w-1/3 md:w-3/12 lg:w-3/12 px-0 py-5">
    
        <x-__filter_tab id="all" label="All" count="{{$all}}" icon='<i class="bx bx-xs bx-sun mr-3"></i>' />
        <x-__filter_tab id="today" label="Today" count="{{$today}}" icon='<i class="bx bx-xs bx-sun mr-3"></i>' />
        <x-__filter_tab id="planned" label="Planned" count="{{$planned}}" icon='<i class="bx bx-xs bx-pin mr-3"></i>' />
        <x-__filter_tab id="important" label="Important" count="{{$important}}" icon='<i class="bx bx-xs bx-star mr-3"></i>' />
    <div>
        <hr class="opacity-10">
    </div>

    <div class="flex items-center p-2 font-bold relative">
        <p class="flex items-center"><i class="bx bx-xs bx-list-ul mr-3"></i> Lists</p>
        <button id="addlist_btn"
            class="bg-purple-700 text-gray-200 hover:bg-purple-500 hover:text-gray-950 rounded-lg active:bg-purple-500 focus:ring focus:ring-gray-200 absolute right-0 -mr-0.5"><i
                class="bx bx-xs bx-plus m-2 font-bold"></i>
        </button>
    </div>

    <hr class="opacity-10">

    <div class="w-full flex flex-col space-y-2 overflow-x-auto pr-1" id="list_container">
        {{-- Task Lists --}}
        <input type="hidden" class="delete_route" data-route="{{ route('destroy_list') }}">
        @if ($lists->isEmpty())
            <!-- Display a component or message for empty lists -->
            <x-__empty_list />
        @else
            <!-- Loop through the lists -->
            <x-__list :lists="$lists" />
        @endif
   
    </div>

</div>
