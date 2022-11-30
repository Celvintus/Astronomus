const popupLinks = document.querySelectorAll('.popup-link');
const body = document.querySelector('body');
const lockPadding = document.querySelectorAll('.lock-padding');

let unlock = true;

const timeout = 100;

if (popupLinks.length > 0) {
   for (let index = 0; index < popupLinks.length; index++) {
      const popupLink = popupLinks[index];
      popupLink.addEventListener("click", function (e) {
         const popupName = popupLink.getAttribute('href').replace('#', '');
         const currentPopup = document.getElementById(popupName);
         popupOpen(currentPopup);
         e.preventDefault();
      });
   }
}

const popupCloseIcon = document.querySelectorAll('.close-popup');
if (popupCloseIcon.length > 0) {
   for (let index = 0; index < popupCloseIcon.length; index++) {
      const el = popupCloseIcon[index];
      el.addEventListener('click', function (e) {
         popupClose(el.closest('.popup'));
         e.preventDefault();
      });
   }
}



function popupOpen(currentPopup) {
   if (currentPopup && unlock) {
      const popupActive = document.querySelector('.popup.open');
      if (popupActive) {
         popupClose(popupActive, false);
      } else {
         bodyLock();
      }
      currentPopup.classList.add('open');
      currentPopup.addEventListener('click', function (e) {
         if (!e.target.closest('.popup-content')) {
            popupClose(e.target.closest('.popup'));
         }
      });
   }
}

function popupClose(popupActive, doUnlock = true) {
   if (unlock) {
      popupActive.classList.remove('open');
      if (doUnlock) {
         bodyUnLock();
      }
   }
}

function bodyLock() {
   const lockPaddingValue = window.innerWidth - document.querySelector('body').offsetWidth + 'px';

   if (lockPadding < 0) {
      for (let index = 0; index < lockPaddingValue.length; index++) {
         const el = lockPadding[index];
         // el.style.paddingRight = lockPaddingValue;
      }
   }
   // body.style.paddingRight = lockPaddingValue;
   body.classList.add('lock');

   unlock = false;
   setTimeout(function () {
      unlock = true;
   }, timeout);
}

function bodyUnLock() {
   setTimeout(function () {
      for (let index = 0; index < lockPadding.length; index++) {
         const el = lockPadding[index];
         el.style.paddingRight = '0px';
      }
      // body.style.paddingRight = '0px';
      body.classList.remove('lock');
   }, timeout);

   unlock = false;
   setTimeout(function () {
      unlock = true;
   }, timeout);
}

document.addEventListener('keydown', function (e) {
   if (e.which === 27) {
      const popupActive = document.querySelector('.popup.open');
      popupClose(popupActive);
   }
});


const nameChange = document.getElementById('description-name-form');
const editNameArticle = document.getElementById('edit-name-article');
if (editNameArticle) {
   editNameArticle.addEventListener('click', function (e) {
      console.log(nameChange.classList.contains('.active'));
      if (nameChange.classList.contains('active')) {
         nameChange.classList.remove('active');
      } else {
         if (durationChange.classList.contains('active')) {
            durationChange.classList.remove('active');
         }
         if (priceChange.classList.contains('active')) {
            priceChange.classList.remove('active');
         }
         nameChange.classList.add('active');
      }
   })
}
const durationChange = document.getElementById('description-duration-form');
const editDurationArticle = document.getElementById('edit-duration-article');
if (editDurationArticle) {
   editDurationArticle.addEventListener('click', function (e) {
      console.log(durationChange.classList.contains('.active'));
      if (durationChange.classList.contains('active')) {
         durationChange.classList.remove('active');
      } else {
         if (nameChange.classList.contains('active')) {
            nameChange.classList.remove('active');
         }
         if (priceChange.classList.contains('active')) {
            priceChange.classList.remove('active');
         }
         durationChange.classList.add('active');
      }
   })
}
const priceChange = document.getElementById('description-price-form');
const editpriceArticle = document.getElementById('edit-price-article');
if (editpriceArticle) {
   editpriceArticle.addEventListener('click', function (e) {
      console.log(priceChange.classList.contains('.active'));
      if (priceChange.classList.contains('active')) {
         priceChange.classList.remove('active');
      } else {
         if (nameChange.classList.contains('active')) {
            nameChange.classList.remove('active');
         }
         if (durationChange.classList.contains('active')) {
            durationChange.classList.remove('active');
         }
         priceChange.classList.add('active');
      }
   })
}
const textChange = document.getElementById('description-text-form');
const editTextArticle = document.getElementById('edit-text-description-article');
if (editTextArticle) {
   editTextArticle.addEventListener('click', function (e) {
      console.log(textChange.classList.contains('.active'));
      if (textChange.classList.contains('active')) {
         textChange.classList.remove('active');
      } else {
        
         textChange.classList.add('active');
      }
   })
}



