document.addEventListener('DOMContentLoaded', function () {

  const navigationElement = document.querySelectorAll('.admin-navigation li');
  const tabElement = document.querySelectorAll('.tab-pane');

  navigationElement.forEach(element => {
    element.addEventListener('click', (e) => {
      e.preventDefault();
      switchTab(element)
    });
  })
});


const removeActive = () => {

  const navigationElement = document.querySelectorAll('.admin-navigation li');
  const tabElement = document.querySelectorAll('.tab-pane');

  navigationElement.forEach(element => element.classList.remove('active'));
  tabElement.forEach(element => element.classList.remove('active'));
}

const switchTab = (element) => {
  removeActive();
  element.classList.add('active')
  const tabId = element.childNodes[0].getAttribute('href');
  const tab = document.querySelector(`${ tabId }`)
  tab.classList.add('active');
}

console.log('alexandra.js loaded');
