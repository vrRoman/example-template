document.addEventListener('DOMContentLoaded', function() {
  let preloader = document.querySelector('header'),
      imgs = [...document.querySelectorAll('img'), ...document.querySelectorAll('svg image')],
      percentForPicture = 100 / imgs.length,
      loadedImg = 0,
      progressLine = document.querySelector('.progress'),
      logo = preloader.querySelector('.logo'),
      animTime = 650

  document.body.style.overflowY = 'hidden'

  for (i = 0; i < imgs.length; i++) {
    let imgCopy = new Image()
    imgCopy.src = imgs[i].src
    imgCopy.onload = increaseProgress
    imgCopy.onerror = increaseProgress
  }

  function increaseProgress() {
    loadedImg++
    progressLine.style.width = loadedImg * percentForPicture + '%'
    if (loadedImg == imgs.length) {
      endPreloader();
    }
  }

  function endPreloader() {
    logo.style.left = 0
    logo.style.marginRight = 0
    logo.style.transform = 'translateX(0)'
    preloader.querySelector('.load-line').style.opacity = 0
    
    logo.addEventListener('transitionend', () => {
      document.body.style.overflowY = 'visible'

      preloader.querySelector('.menu').style.opacity = 1

      preloader.classList.remove('preloader')

      setTimeout(() => {
        preloader.style.transition = 'none'
        logo.style.transition = 'none'
      }, animTime * 2)
    })
  }
})
