<div class="modal fade fixed inset-0 items-center justify-center z-10 hidden bg-gray-700 bg-opacity-80" id="modal-container">
    <div class="rounded-lg border-solid border-neutral-400 bg-gray-950 p-5 shadow-xl w-4/5 md:w-2/5 lg:w-2/5">
        <!-- Modal content goes here -->

        <div class="space-y-6 form-control">
            <h4 class="text-purple-500 font-extrabold">Add List</h4>
            <div class="w-full space-y-2">
                <input type="text" id="list_name"
                    class="bg-neutral-700 w-full rounded-lg h-8 px-2" placeholder="Name of the list">
                    <span id="error_add_list" class="text-xs flex justify-end text-red-500"></span>
            </div>

            <div class="w-full flex justify-end items-center">
                <div class="items-center">
                    <button id="modal-close"
                        class="text-purple-500 mr-3 bg-gray-950 py-1.5 px-3 rounded-lg hover:bg-neutral-700 hover:text-gray-200 active:bg-neutral-700 focus:ring focus:ring-gray-200">
                        <p class="flex items-center">Cancel</p>
                    </button>
                    <button id="store_list" data-route="{{ route('store_list') }}"
                        class="bg-purple-700 py-1.5 px-3 rounded-lg hover:bg-purple-500 hover:text-gray-950 active:bg-purple-500 focus:ring focus:ring-gray-200">
                        <p class="flex items-center"><i class="bx bx-xs bx-plus mr-0 md:mr-2 -ml-0.5"></i> Add</p>
                        <span class="spinner" style="display: none;">Loading...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
