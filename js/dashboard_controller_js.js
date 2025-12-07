async function loadPage(page) {
    const mainContent = document.getElementById('mainContent');
    try {
        const res = await fetch(page);
        if (!res.ok) throw new Error('Page not found');
        const html = await res.text();
        mainContent.innerHTML = html;
    } catch (err) {
        mainContent.innerHTML = `<div class="p-10 text-red-500">Error loading page: ${err.message}</div>`;
    }
}

window.addEventListener('DOMContentLoaded', () => {
    loadPage('home.php'); // Automatically load home.php
});

document.querySelectorAll('#sidebar a[data-page]').forEach(link => {
  link.addEventListener('click', async (e) => {
      e.preventDefault();
      const page = link.getAttribute('data-page');
      const mainContent = document.getElementById('mainContent');

    try {
        const res = await fetch(page);
        if (!res.ok) throw new Error('Page not found');
            const html = await res.text();
            mainContent.innerHTML = html;
    } catch (err) {
        mainContent.innerHTML = `<div class="p-10 text-red-500">Error loading page: ${err.message}</div>`;
    }
    });
});

// Mobile toggle button
document.getElementById("menuBtn").onclick = () => {
    document.getElementById("sidebar").classList.toggle("hidden");
};
