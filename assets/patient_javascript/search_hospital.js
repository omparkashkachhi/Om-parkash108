// JavaScript to filter hospitals based on user input
document.getElementById('hospitalSearchInput').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const items = document.querySelectorAll('#hospitalList .hospital-item');

    items.forEach(item => {
        const name = item.querySelector('.hospital-name').textContent.toLowerCase();
        const location = item.querySelector('.hospital-location').textContent.toLowerCase();

        if (name.includes(filter) || location.includes(filter)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
});

