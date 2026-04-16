document.querySelectorAll('.js-delete').forEach((button) => {
    button.addEventListener('click', (event) => {
        const name = button.dataset.name || 'data ini';
        const confirmed = window.confirm(`Hapus ${name}? Tindakan ini tidak bisa dibatalkan.`);

        if (!confirmed) {
            event.preventDefault();
        }
    });
});
