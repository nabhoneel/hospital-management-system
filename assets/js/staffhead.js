changenurselist = function(e, which) {
  var names = document.querySelectorAll(which + ' .' + e.value);
  var allNames = document.querySelectorAll(which + ' option');

  for (var i = 0; i < allNames.length; i++) {
    allNames[i].style.display = 'none';
  }
  for (var i = 0; i < names.length; i++) {
    names[i].style.display = 'block';
  }
};
