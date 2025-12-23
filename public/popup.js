document.addEventListener('DOMContentLoaded', function () {
    const closeBtn = document.getElementById('operations-bridges-close');
    if (!closeBtn) return;

    closeBtn.addEventListener('click', function () {
        document.getElementById('operations-bridges-overlay').remove();
    });
});
