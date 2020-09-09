let area = document.querySelector('.question')

function update() {
  area.style.height = area.scrollHeight + 'px'
}

area.oninput = update

window.addEventListener('load', update)