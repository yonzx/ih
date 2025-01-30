<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../src/script.js"></script>
    <script>
        // Theme toggle functionality
    const themeToggle = document.getElementById('themeToggle');
    const modeIcon = themeToggle.querySelector('.mode-icon');

    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        document.body.classList.toggle('light-mode');
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('dark-mode');
        sidebar.classList.toggle('light-mode');

        // Change the icon based on the current mode
        if (document.body.classList.contains('dark-mode')) {
            modeIcon.textContent = '☀️'; // Sun icon for light mode
        } else {
            modeIcon.textContent = '🌙'; // Moon icon for dark mode
        }
    });

    // Initial icon setup based on the default mode
    if (document.body.classList.contains('dark-mode')) {
        modeIcon.textContent = '☀️'; // Sun icon for light mode
    } else {
        modeIcon.textContent = '🌙'; // Moon icon for dark mode
    }
    </script>
