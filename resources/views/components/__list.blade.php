@foreach ($lists as $list)
    <div class="w-full relative hover:bg-purple-500 hover:bg-opacity-60 rounded-md px-5 flex items-center text-sm"
        id="list_box_{{ $list->list_id }}">
        <a id="list_{{ $list->list_id }}" href="{{ route('show_list', ['list_id' => $list->list_id, 'name' => $list->name]) }}"
            class="flex my-2 flex-grow overflow-hidden items-center hover:font-bold h-full">{{ $list->name }}</a>

        <a data-route="{{ route('destroy_list') }}" href="javascript:;"
            class="absolute right-0 mr-4 hover:text-gray-950 list_delete" id="deletelist_{{ $list->list_id }}">
            <i class="bx bx-xs bx-trash trash_{{ $list->list_id }}"></i>
        </a>
    </div>
@endforeach
