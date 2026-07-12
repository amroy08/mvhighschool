/**
 * load-header.js
 * Fetches premium-header.php and injects it into <header>.
 * Handles: active link, mobile drawer, scroll shadow, body lock, Escape, focus.
 */

(function () {
  'use strict';

  const HEADER_URL = 'premium-header.php';

  function getCurrentPage() {
    return location.pathname.split('/').pop() || 'index.php';
  }

  function highlightActiveLink(headerEl) {
    const current = getCurrentPage();
    headerEl.querySelectorAll('.nav-link, .nav-btn').forEach(link => {
      const href = link.getAttribute('href');
      if (href && href === current) {
        link.classList.add('active');
        // Don't override highlight class styling
        if (!link.classList.contains('highlight')) {
          link.classList.add('active');
        }
      }
    });
  }

  function initMobileMenu(headerEl) {
    const menu    = headerEl.querySelector('#mobileMenu');
    const toggle  = headerEl.querySelector('#menuToggle');
    const closeBtn = headerEl.querySelector('#menuClose');

    if (!menu || !toggle) return;

    function openMenu() {
      menu.classList.add('show-menu');
      toggle.classList.add('active');
      toggle.setAttribute('aria-expanded', 'true');
      document.body.classList.add('menu-open');
      // Focus the close button when drawer opens
      if (closeBtn) {
        setTimeout(() => closeBtn.focus(), 50);
      }
    }

    function closeMenu() {
      menu.classList.remove('show-menu');
      toggle.classList.remove('active');
      toggle.setAttribute('aria-expanded', 'false');
      document.body.classList.remove('menu-open');
      // Restore focus to toggle button
      toggle.focus();
    }

    toggle.addEventListener('click', () => {
      if (menu.classList.contains('show-menu')) {
        closeMenu();
      } else {
        openMenu();
      }
    });

    if (closeBtn) {
      closeBtn.addEventListener('click', closeMenu);
    }

    // Close on Escape
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && menu.classList.contains('show-menu')) {
        closeMenu();
      }
    });

    // Trap focus inside the open menu
    document.addEventListener('keydown', (e) => {
      if (!menu.classList.contains('show-menu')) return;
      if (e.key === 'Tab') {
        const focusables = menu.querySelectorAll('a, button, [tabindex="0"]');
        if (focusables.length === 0) return;
        const first = focusables[0];
        const last = focusables[focusables.length - 1];

        if (e.shiftKey) { // Shift + Tab
          if (document.activeElement === first || !menu.contains(document.activeElement)) {
            last.focus();
            e.preventDefault();
          }
        } else { // Tab
          if (document.activeElement === last || !menu.contains(document.activeElement)) {
            first.focus();
            e.preventDefault();
          }
        }
      }
    });

    // Close after clicking a nav link (for single-page-like navigation)
    menu.querySelectorAll('.nav-link, .nav-btn, .nav-admission').forEach(link => {
      link.addEventListener('click', () => {
        if (menu.classList.contains('show-menu')) {
          closeMenu();
        }
      });
    });

    // Close when clicking outside menu on mobile
    document.addEventListener('click', (e) => {
      if (
        menu.classList.contains('show-menu') &&
        !menu.contains(e.target) &&
        !toggle.contains(e.target)
      ) {
        closeMenu();
      }
    });
  }

  function initScrollShadow(headerEl) {
    const mainHeader = headerEl.querySelector('.premium-header');
    if (!mainHeader) return;

    let ticking = false;
    window.addEventListener('scroll', () => {
      if (!ticking) {
        requestAnimationFrame(() => {
          if (window.scrollY > 10) {
            mainHeader.classList.add('scrolled');
          } else {
            mainHeader.classList.remove('scrolled');
          }
          ticking = false;
        });
        ticking = true;
      }
    }, { passive: true });
  }

  function loadHeader() {
    const headerEl = document.querySelector('header');
    if (!headerEl) return;

    fetch(HEADER_URL)
      .then(res => {
        if (!res.ok) throw new Error('Header fetch failed: ' + res.status);
        return res.text();
      })
      .then(html => {
        headerEl.innerHTML = html;
        highlightActiveLink(headerEl);
        initMobileMenu(headerEl);
        initScrollShadow(headerEl);
      })
      .catch(err => {
        // Graceful fallback — minimal nav so page stays usable
        console.warn('[MV Header]', err.message);
        headerEl.innerHTML = `
          <nav style="background:#102D5C;padding:12px 20px;display:flex;gap:16px;flex-wrap:wrap;">
            <a href="index.php" style="color:#E5A426;font-weight:700;text-decoration:none;">M.V. High School</a>
            <a href="admissions.php" style="color:#fff;text-decoration:none;">Admissions</a>
            <a href="contact.php" style="color:#fff;text-decoration:none;">Contact</a>
          </nav>
        `;
      });
  }

  // Run after DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadHeader);
  } else {
    loadHeader();
  }
})();
