function setNav(el, menu) {
  document.querySelectorAll('.sb-nav-item').forEach(n => n.classList.remove('on'));
  el.classList.add('on');
  if(window.showToast) window.showToast('Menuju menu: ' + menu);
}
function setFilter(el, type) {
  document.querySelectorAll('.fc').forEach(c => c.classList.remove('on'));
  el.classList.add('on');
}