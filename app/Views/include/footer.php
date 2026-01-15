   <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div>© 2024 Dashboard. All rights reserved.</div>
                <div class="footer-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Help Center</a>
                    <a href="#">Contact Us</a>
                </div>
            </div>
        </footer>

        <script>
            // Toggle sidebar on mobile
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.querySelector('.sidebar');
            
            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    
                    // Add overlay when sidebar is open
                    if (sidebar.classList.contains('active')) {
                        const overlay = document.createElement('div');
                        overlay.className = 'sidebar-overlay';
                        overlay.style.cssText = `
                            position: fixed;
                            top: 64px;
                            left: 0;
                            right: 0;
                            bottom: 0;
                            background: rgba(0,0,0,0.5);
                            z-index: 98;
                        `;
                        overlay.addEventListener('click', function() {
                            sidebar.classList.remove('active');
                            this.remove();
                        });
                        document.body.appendChild(overlay);
                    } else {
                        const overlay = document.querySelector('.sidebar-overlay');
                        if (overlay) overlay.remove();
                    }
                });

                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768 && sidebar.classList.contains('active')) {
                        if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                            sidebar.classList.remove('active');
                            const overlay = document.querySelector('.sidebar-overlay');
                            if (overlay) overlay.remove();
                        }
                    }
                });
            }

            // Sidebar active item switching
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    // Remove active class from all items
                    document.querySelectorAll('.sidebar-item').forEach(i => {
                        i.classList.remove('active');
                    });
                    
                    // Add active class to clicked item
                    this.classList.add('active');
                    
                    // Close sidebar on mobile after clicking a link
                    if (window.innerWidth <= 768 && sidebar) {
                        sidebar.classList.remove('active');
                        const overlay = document.querySelector('.sidebar-overlay');
                        if (overlay) overlay.remove();
                    }
                });
            });

            // Set active item based on current URL
            document.addEventListener('DOMContentLoaded', function() {
                const currentPath = window.location.pathname;
                const sidebarItems = document.querySelectorAll('.sidebar-item');
                
                sidebarItems.forEach(item => {
                    const href = item.getAttribute('href');
                    if (href && currentPath.includes(href) && href !== '/') {
                        item.classList.add('active');
                    }
                });
            });

            // Notification badge animation
            const notificationIcon = document.querySelector('.header-icon:nth-child(3)');
            if (notificationIcon) {
                notificationIcon.addEventListener('click', function() {
                    const badge = document.querySelector('.sidebar-item span[style*="background: #4285f4"]');
                    if (badge) {
                        badge.style.display = 'none';
                    }
                });
            }
        </script>
    </body>
</html>