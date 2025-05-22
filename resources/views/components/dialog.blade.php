<home>
    <x-slot:title>
        New Task
    </x-slot:title>



    <dialog class="w-full max-w-[500px] rounded-lg bg-slate-700 backdrop:bg-black/60" open>
        <div class="p-5">
            <x-new></x-new>
        </div>
    </dialog>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dialog = document.querySelector('dialog');
            const addTaskBtn = document.getElementById('add-task-btn');
            const closeBtn = document.getElementById('close-btn');

            if (addTaskBtn) {
                addTaskBtn.addEventListener('click', () => {
                    dialog.showModal();
                });
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    dialog.close();
                });
            }

            dialog.addEventListener('click', (e) => {
                if (e.target === dialog) {
                    dialog.close();
                }
            });
        });
    </script>


</home>
