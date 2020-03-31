const toggleNav = function() {
  let toggleTrigger = document.querySelectorAll('.js-toggle-nav');
  let logo = document.querySelector('.c-header__logo');

  for (let i = 0; i < toggleTrigger.length; i++) {
    toggleTrigger[i].addEventListener('click', function() {
      if (logo.style.display === 'none') {
        logo.style.display = 'block';
      } else {
        logo.style.display = 'none';
      }
      document.querySelector('body').classList.toggle('has-mobile-nav');
    });
  }
};

window.addEventListener('load', event => {
  toggleNav();
});
