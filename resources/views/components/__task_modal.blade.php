<div class="modal fade fixed inset-0 items-center justify-center z-10 hidden bg-gray-700 bg-opacity-80" id="modal-task">
    <div class="rounded-lg border-solid border-neutral-400 bg-gray-950 p-5 shadow-xl w-full md:w-2/5 lg:w-2/5 max-h-screen overflow-y-auto">
        <div class="space-y-2 mb-3 task_modal_content">
            <i class="bx bx-md bx-loader bx-spin task_spinner"></i>
            
        </div>
        <div class="w-full flex justify-end items-center task_modal_footer">
            <div class="items-center">
                <button id="task_modal_close" 
                    class="text-purple-500 mr-3 bg-gray-950 py-1.5 px-3 rounded-lg hover:bg-neutral-700 hover:text-gray-200 active:bg-neutral-700 focus:ring focus:ring-gray-200">
                    <p class="flex items-center">Cancel</p>
                </button>
                <button disabled type="button" id="edit_task_btn" type="link"
                    class="bg-purple-700 py-1.5 px-3 rounded-lg hover:bg-purple-500 hover:text-gray-950 active:bg-purple-500 focus:ring focus:ring-gray-200">
                    <p class="flex items-center"><i class="bx bx-xs bx-edit mr-0 md:mr-2 -ml-0.5"></i> Edit</p>
                </button>
            </div>
        </div>
    </div>
</div>