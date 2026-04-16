'use strict';

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.alert').forEach((alertBox) => {
    setTimeout(() => {
      alertBox.style.opacity = '0';
      setTimeout(() => {
        alertBox.remove();
      }, 400);
    }, 5000);
  });
});
