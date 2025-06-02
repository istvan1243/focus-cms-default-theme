document.addEventListener('DOMContentLoaded', async () => {
  const gallery = document.querySelector('.image-gallery');
  if (!gallery) return;

  const lightbox = new window.PhotoSwipeLightbox({
    gallery: '.image-gallery',
    children: 'figure > a',
    pswpModule: () => window.PhotoSwipe,
  });

  lightbox.on('uiRegister', () => {
    lightbox.pswp.ui.registerElement({
      name: 'fullscreen_button_div',
      ariaLabel: 'Teljes képernyő',
      order: 9,
      isButton: true,
      html: `
        <button type="button" id="fullscreen-toggle" class="text-gray-100 text-xl" title="Teljes képernyő">
          <i id="fullscreen-icon" class="mdi mdi-fullscreen mdi-24"></i>
        </button>
      `,
      onClick: () => {
        const icon = document.getElementById('fullscreen-icon');
        if (!document.fullscreenElement) {
          document.body.requestFullscreen();
          icon.classList.replace('mdi-fullscreen', 'mdi-fullscreen-exit');
          document.body.style.overflow = 'hidden';
        } else {
          document.exitFullscreen();
          icon.classList.replace('mdi-fullscreen-exit', 'mdi-fullscreen');
          document.body.style.overflow = '';
        }
      }
    });
  });

  lightbox.on('close', () => {
    if (document.fullscreenElement) {
      document.exitFullscreen().catch(console.warn);
    }
    const icon = document.getElementById('fullscreen-icon');
    if (icon) {
      icon.classList.replace('mdi-fullscreen-exit', 'mdi-fullscreen');
    }
    document.body.style.overflow = '';
  });

  lightbox.init();
});
