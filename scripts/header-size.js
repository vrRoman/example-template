let minSize = 50,
  	header = document.querySelector('header'),
    headerHeight,
  	logo = header.querySelector('.logo:not(.clone)'),
  	logoMinScale = 0.61,
  	page = document.querySelector('html'),
  	endPoint,
    oldPageWidth = document.documentElement.clientWidth

if (document.querySelector('.block1')) {
   endPoint = document.querySelector('.block1').offsetHeight
} else {
  endPoint = document.documentElement.scrollHeight / 2
}

// onload
if (document.querySelector('.preloader')) {
  let _counter = 0
  header.querySelector('.menu').ontransitionend = () => {
    if (_counter === 0) {
      headerHeight = parseFloat(window.getComputedStyle(header, null).height) - minSize
      let percent = page.scrollTop / endPoint

      changeHeight()
      if (page.scrollTop >= endPoint) {
        header.style.height = minSize + 'px'
        logo.style.transform = `scale(${logoMinScale})`
      } else if (1 - percent <= logoMinScale && page.scrollTop < endPoint) {
        logo.style.transform = `scale(${logoMinScale})`
      }

      document.addEventListener('scroll', () => {
        changeHeight();
      })
      _counter = 1
    }
  }
} else {
  document.addEventListener('scroll', () => {
    changeHeight();
  })
  window.addEventListener('load', () => {
    headerHeight = parseFloat(window.getComputedStyle(header, null).height) - minSize
    let percent = page.scrollTop / endPoint

    changeHeight()

    document.addEventListener('scroll', () => {
      changeHeight();
    })
  })
}

window.addEventListener('resize', () => {
  let newPageWidth = document.documentElement.clientWidth,
      fraction = newPageWidth / oldPageWidth,
      percent = page.scrollTop / endPoint
  
  oldPageWidth = newPageWidth

  endPoint *= fraction
  headerHeight *= fraction
  minSize *= fraction

  changeHeight()
})

function changeHeight() {
  let scrollTop = page.scrollTop
	
  if (scrollTop >= endPoint) return
	
  let percent = scrollTop / endPoint,
      value = headerHeight * percent
	
  header.style.height = headerHeight - value + minSize + 'px'
  
  if (1 - percent > logoMinScale) {
    logo.style.transform = `scale(${1 - percent})`
  }

  if (page.scrollTop >= endPoint) {
    header.style.height = minSize + 'px'
    logo.style.transform = `scale(${logoMinScale})`
  } else if (1 - percent <= logoMinScale && page.scrollTop < endPoint) {
    logo.style.transform = `scale(${logoMinScale})`
  }
}