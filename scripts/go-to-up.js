let upBtn = document.querySelector('.go-to-up'),
    upBtnBottom = parseFloat(window.getComputedStyle(upBtn, null).bottom),
    footer = document.querySelector('footer'),
    showOn = document.querySelector('.block2').getBoundingClientRect().top + window.pageYOffset,
    olgPageWidth = document.documentElement.clientWidth

document.addEventListener('scroll', upBtnVisibility)
window.addEventListener('load', upBtnVisibility)
window.addEventListener('resize', () => {
  let newPageWidth = document.documentElement.clientWidth,
      fraction = newPageWidth / olgPageWidth
  olgPageWidth = newPageWidth

  upBtnBottom *= fraction,
  showOn *= fraction

  upBtnVisibility();
})

upBtn.style.bottom = upBtnBottom + 'px'

function upBtnVisibility() {
  let scrolled = window.pageYOffset

  if (scrolled > showOn) {
    upBtn.classList.add('go-to-up__visible')
  } else {
    upBtn.classList.remove('go-to-up__visible')
  }

  if (document.documentElement.clientHeight > footer.getBoundingClientRect().top) {
    upBtn.style.bottom = upBtnBottom + (document.documentElement.clientHeight - footer.getBoundingClientRect().top) + 'px'
  } else {
    upBtn.style.bottom = upBtnBottom + 'px'
  }
}