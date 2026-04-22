                </div>
            </div>
        </main>
    </div>

    <!-- Modals Container (Global) -->
    <div id="modal-container"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        // Responsive Sidebar Logic
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        }

        if(mobileMenuBtn) mobileMenuBtn.addEventListener('click', toggleSidebar);
        if(overlay) overlay.addEventListener('click', toggleSidebar);

        // Auto close on resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sidebar.classList.add('-translate-x-full'); // Reset state but let CSS handle visibility
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });

        // Dropdown Logic (if needed)
        document.querySelectorAll('.dropdown-trigger').forEach(btn => {
            btn.addEventListener('click', function() {
                this.nextElementSibling.classList.toggle('hidden');
            });
        });
    </script>
</body>
</html>
