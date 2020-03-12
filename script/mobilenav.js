document.addEventListener('DOMContentLoaded', function() {
  toggleNav();
});

const toggleNav = function() {
  let toggleTrigger = document.querySelectorAll('.js-toggle-nav');
  for (let i = 0; i < toggleTrigger.length; i++) {
    toggleTrigger[i].addEventListener('click', function() {
      document.querySelector('body').classList.toggle('has-mobile-nav');
    });
  }
};
