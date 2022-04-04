document.addEventListener("DOMContentLoaded", function (event) {

    let root = document.getElementById('drag-group');

    [].slice.call(document.getElementsByClassName('drag-item')).forEach(function (el) {
        el.addEventListener('dragstart', function (e) {
            e.target.classList.add('dragging');
        });

        el.addEventListener('drop', function (e) {
            e.target.classList.remove('bg-gradient-secondary')

            let draggingEl = document.querySelector('.dragging');

            if (draggingEl.getAttribute('order') > e.target.getAttribute('order')) {
                e.target.before(draggingEl);

            } else {
                e.target.after(draggingEl);
            }

            let component = Livewire.find(e.target.closest('[wire\\:id]').getAttribute('wire:id'));

            let newOrderIds = [].slice.call(document.getElementsByClassName('drag-item')).map(el => el.id);

            component.call('reorderQuestions', newOrderIds);

        });

        el.addEventListener('dragenter', function (e) {
            e.target.classList.add('bg-gradient-secondary')
            e.preventDefault();
        });

        el.addEventListener('dragover', function (e) {
            e.preventDefault();
        });

        el.addEventListener('dragleave', function (e) {
            e.target.classList.remove('bg-gradient-secondary')
        });

        el.addEventListener('dragend', function (e) {
            e.target.classList.remove('dragging');
        });
    });
});

