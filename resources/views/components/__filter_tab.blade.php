@props(['id', 'label', 'count', 'icon'])

<a href="javascript:;" id="{{$id}}"
    class="filter_tab hover:bg-purple-500 hover:bg-opacity-80 hover:text-gray-950 rounded-lg active:bg-purple-500 focus:ring focus:ring-gray-200">
    <div class="w-full relative font-semibold py-1.5 px-2 flex items-center border-inherit">
        <p class="flex items-center">{!! $icon !!} {{$label}}</p>
        <span class="absolute right-0 mr-2">{{$count}}</span>
    </div>
</a>
