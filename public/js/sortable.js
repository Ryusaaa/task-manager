document.addEventListener('DOMContentLoaded', () => {
    const list = document.getElementById('task-list');
    if (!list) return;

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content
        ?? document.querySelector('input[name="_token"]')?.value;

    Sortable.create(list, {
        handle: '.drag-handle',
        animation: 150,
        ghostClass: 'sortable-ghost',
        onEnd: () => {
            const order = Array.from(list.children).map((item) => item.dataset.id);

            fetch('/tasks/reorder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ order }),
            }).catch(() => {
                alert('Failed to save new order. Please refresh and try again.');
            });
        },
    });
});