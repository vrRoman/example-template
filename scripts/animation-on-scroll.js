// secBl - second block
// thBl - third block
let secBl = document.querySelector('.block2'),
    secBl_text = secBl.querySelector('.text-block2'),
    secBl_pageImg = secBl.querySelector('.document-image'),
    secBl_strip = secBl.querySelector('.strip-block2'),

    thBl = document.querySelector('.block3'),
    thBl_heading = thBl.querySelector('h1'),
    thBl_rightCircle = thBl.querySelector('.right-circle'),
    thBl_leftCircle = thBl.querySelector('.left-circle'),
    thBl_rightLink = thBl.querySelector('.right-link'),
    thBl_leftLink = thBl.querySelector('.left-link')

document.addEventListener('scroll', animationsOnScroll)
window.addEventListener('load', animationsOnScroll)

function animationsOnScroll() {
  windowHeight = document.documentElement.clientHeight
  if (windowHeight > secBl.getBoundingClientRect().top + secBl.offsetHeight / 2) {
    secBlAnimate()
  }
  if (windowHeight > thBl.getBoundingClientRect().top + thBl.offsetHeight / 2) {
    thBlAnimate()
  }
}

function secBlAnimate() {
  secBl_strip.style.left = '0'
  secBl_pageImg.style.filter = 'blur(1rem)'
  if (document.documentElement.clientWidth <= 992) {
    secBl_text.style.right = '5%'
  } else {
    secBl_text.style.right = '15.7rem'
  }
}
function thBlAnimate() {
  thBl_heading.style.opacity = 1
  thBl_rightCircle.style.right = '13.2rem'

  if (document.documentElement.clientWidth <= 992) {
    thBl_rightLink.style.left = '3%'
    thBl_leftLink.style.left = '3%'
    thBl_leftCircle.style.left = '40%'
  } else {
    thBl_rightLink.style.right = '13.2rem'
    thBl_leftLink.style.left = '13.2rem'
    thBl_leftCircle.style.left = '13.2rem'
  }
}