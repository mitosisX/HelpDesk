function openTab(evt, tabName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("content-tab");
  for (i = 0; i < x.length; i++) {
    $(x[i]).css('display','none');
      // x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tabs");
  for (i = 0; i < x.length; i++) {
    $(tablinks[i]).toggleClass('is-active')
      // tablinks[i].className = tablinks[i].className.replace(" is-active", "");
  }
  $(`#${tabName}`).css('display','block')
  // document.getElementById(tabName).style.display = "block";
  // evt.currentTarget.className += " is-active";
}