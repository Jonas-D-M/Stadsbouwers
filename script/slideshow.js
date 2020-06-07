const sleep = (ms) => {
  return new Promise((resolve) => setTimeout(resolve, ms));
};
const hideElement = (element) => {
  if (element instanceof HTMLElement) {
    element.style.transition = 'all 2s';
    element.style.display = 'none';
  }
};

const displayElement = (element) => {
  if (element instanceof HTMLElement) {
    element.style.transition = 'all 2s';
    element.style.display = 'flex';
  }
};

const hideAll = (testemonialObject) => {
  for (let i = 0; i < testemonialObject.length; i++) {
    const element = testemonialObject[i];
    element.style.display = 'none';
  }
};

const slideShow = async (testemonialObject) => {
  while (true) {
    for (let i = 0; i < testemonialObject.length; i++) {
      let elementToBeDisplayed = testemonialObject[i];
      let elementToBeHidden;
      if (i - 1 >= 0) {
        elementToBeHidden = testemonialObject[i - 1];
      } else {
        elementToBeHidden = testemonialObject[testemonialObject.length - 1];
      }

      hideElement(elementToBeHidden);
      displayElement(elementToBeDisplayed);
      await sleep(5000);
      console.log(i);
    }
  }
};

document.addEventListener('DOMContentLoaded', function () {
  console.info('Dom contentloaded');
  const testemonials = document.querySelectorAll('.c-testimonial');
  hideAll(testemonials);
  slideShow(testemonials);
});
