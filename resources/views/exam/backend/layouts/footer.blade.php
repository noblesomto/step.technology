

<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const menuButton = document.getElementById('menu-button');

    menuButton.addEventListener('click', function () {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', function () {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>
<script>
        document.addEventListener("DOMContentLoaded", function () {
            const dropdownToggles = document.querySelectorAll(".dropdown-toggle");

            dropdownToggles.forEach(toggle => {
                toggle.addEventListener("click", function (event) {
                    event.preventDefault();

                    const menu = this.nextElementSibling;
                    menu.classList.toggle("hidden");

                    // Close other dropdowns
                    document.querySelectorAll(".dropdown-menu").forEach(otherMenu => {
                        if (otherMenu !== menu) {
                            otherMenu.classList.add("hidden");
                        }
                    });
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener("click", function (event) {
                if (!event.target.closest(".relative")) {
                    document.querySelectorAll(".dropdown-menu").forEach(menu => {
                        menu.classList.add("hidden");
                    });
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Initialize Select2 -->
    <script>
        $(document).ready(function() {
            $('#specialization').select2({
                placeholder: "Select Specialization",
                allowClear: true,
            });
        });
    </script>
</body>
</html>