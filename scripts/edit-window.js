let editFullNameWindow = document.querySelector('.change-full-name'),
    editEmailWindow = document.querySelector('.change-email'),
    editPasswordWindow = document.querySelector('.change-password'),

    editBtnFullName = document.querySelector('.edit-full-name'),
    editBtnEmail = document.querySelector('.edit-email'),
    editBtnPassword = document.querySelector('.edit-password'),

    closeBtnFullName = editFullNameWindow.querySelector('.close-edit-window'),
    closeBtnEmail = editEmailWindow.querySelector('.close-edit-window'),
    closeBtnPassword = editPasswordWindow.querySelector('.close-edit-window')

editBtnFullName.onclick = () => {
  editFullNameWindow.classList.remove('disabled')
}
editBtnEmail.onclick = () => {
  editEmailWindow.classList.remove('disabled')
}
editBtnPassword.onclick = () => {
  editPasswordWindow.classList.remove('disabled')
}

closeBtnFullName.onclick = () => {
  editFullNameWindow.classList.add('disabled')
}
closeBtnEmail.onclick = () => {
  editEmailWindow.classList.add('disabled')
}
closeBtnPassword.onclick = () => {
  editPasswordWindow.classList.add('disabled')
}
