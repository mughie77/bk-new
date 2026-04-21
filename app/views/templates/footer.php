            </div>

            <footer class="bg-white border-t border-slate-200 px-8 py-3 text-center text-[10px] text-slate-400 flex-shrink-0">
                &copy; <?= date('Y'); ?> Aplikasi Bimbingan dan Konseling Sekolah. Semua Hak Dilindungi.
            </footer>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        if(mobileMenuBtn) mobileMenuBtn.addEventListener('click', toggleSidebar);
        if(overlay) overlay.addEventListener('click', toggleSidebar);

        // Auto close mobile sidebar on escape key
        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
                toggleSidebar();
            }
        });
    </script>
</body>
</html>
