// Enhance touch scrolling for new arrivals section
document.addEventListener('DOMContentLoaded', function() {
  const scrollContainer = document.querySelector('.scrollable-container');
  let isDown = false;
  let startX;
  let scrollLeft;

  if (scrollContainer) {
    // Mouse events for desktop
    scrollContainer.addEventListener('mousedown', (e) => {
      isDown = true;
      scrollContainer.classList.add('active:cursor-grabbing');
      startX = e.pageX - scrollContainer.offsetLeft;
      scrollLeft = scrollContainer.scrollLeft;
    });

    scrollContainer.addEventListener('mouseleave', () => {
      isDown = false;
      scrollContainer.classList.remove('active:cursor-grabbing');
    });

    scrollContainer.addEventListener('mouseup', () => {
      isDown = false;
      scrollContainer.classList.remove('active:cursor-grabbing');
    });

    scrollContainer.addEventListener('mousemove', (e) => {
      if (!isDown) return;
      e.preventDefault();
      const x = e.pageX - scrollContainer.offsetLeft;
      const walk = (x - startX) * 2;
      scrollContainer.scrollLeft = scrollLeft - walk;
    });

    // Touch events for mobile
    let touchStartX = 0;
    let touchScrollLeft = 0;

    scrollContainer.addEventListener('touchstart', (e) => {
      touchStartX = e.touches[0].clientX;
      touchScrollLeft = scrollContainer.scrollLeft;
    });

    scrollContainer.addEventListener('touchmove', (e) => {
      if (!touchStartX) return;
      const touchX = e.touches[0].clientX;
      const walk = (touchStartX - touchX) * 1.5;
      scrollContainer.scrollLeft = touchScrollLeft + walk;
    });

    scrollContainer.addEventListener('touchend', () => {
      touchStartX = 0;
    });
  }
});
