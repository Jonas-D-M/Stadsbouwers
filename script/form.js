const init = function () {
  console.info('init loaded');
};

const displaySucces = function () {
  em = document.querySelector('.c-em__confirmation');
};
const displayWarning = function () {
  em = document.querySelector('.c-em__warning');
};
const displaySucces = function () {
  em = document.querySelector('.c-em__failed');
};

document.addEventListener('DOMContentLoaded', function () {
  console.info('DOM geladen');
  init();
});

{
  /* <div class="c-em__confirmation">
<p>Uw bericht is succesvol verzonden!</p>
</div>
<div class="c-em__warning">
<p>Gelieve de reCaptcha in te vullen.</p>
</div>
<div class="c-em__failed">
<p>Er is een probleem opgetreden bij het versturen van je bericht. Probeer het later opnieuw.</p>
</div> */
}
