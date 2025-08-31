// Accessible toggle + close handlers
function toggleSidebar(force) {
  const sidebar = document.getElementById('sidebar');
  const btn = document.querySelector('.sidebar-toggle');
  if (!sidebar) return;

  const willOpen = typeof force === 'boolean'
    ? force
    : !sidebar.classList.contains('open');

  sidebar.classList.toggle('open', willOpen);
  if (btn) btn.setAttribute('aria-expanded', String(willOpen));
  document.body.style.overflow = willOpen ? 'hidden' : '';
}

// Close on ESC
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') toggleSidebar(false);
});

// Close when clicking outside (on small screens)
document.addEventListener('click', (e) => {
  const sidebar = document.getElementById('sidebar');
  const btn = e.target.closest('.sidebar-toggle');
  if (!sidebar) return;
  const clickedInside = e.target.closest('#sidebar');
  if (sidebar.classList.contains('open') && !clickedInside && !btn) {
    toggleSidebar(false);
  }
});

// Close after navigating (mobile)
window.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.sidebar .sidebar-nav a').forEach((a) => {
    a.addEventListener('click', () => {
      if (window.innerWidth < 1024) toggleSidebar(false);
    });
  });
});

// Accessible toggle + close handlers
function toggleSidebar(force) {
  const sidebar = document.getElementById('sidebar');
  const btn = document.querySelector('.sidebar-toggle');
  if (!sidebar) return;

  const willOpen = typeof force === 'boolean'
    ? force
    : !sidebar.classList.contains('open');

  sidebar.classList.toggle('open', willOpen);
  if (btn) btn.setAttribute('aria-expanded', String(willOpen));

  // NEW: reflect state on <body> for layout push on desktop
  document.body.classList.toggle('sidebar-open', willOpen);   // <— add this
  document.body.style.overflow = willOpen && window.innerWidth < 1024 ? 'hidden' : '';
}

// Close on ESC
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') toggleSidebar(false);
});

// Close when clicking outside (on small screens)
document.addEventListener('click', (e) => {
  const sidebar = document.getElementById('sidebar');
  const btn = e.target.closest('.sidebar-toggle');
  if (!sidebar) return;
  const clickedInside = e.target.closest('#sidebar');
  if (sidebar.classList.contains('open') && !clickedInside && !btn) {
    toggleSidebar(false);
  }
});

// Close sidebar after link click ONLY on mobile
window.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.sidebar .sidebar-nav a').forEach((a) => {
    a.addEventListener('click', () => {
      if (window.innerWidth < 1024) {
        toggleSidebar(false); // mobile: collapse after click
      }
      // desktop: keep it open
    });
  });
});
