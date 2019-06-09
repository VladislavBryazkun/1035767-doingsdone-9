'use strict';

function insertParam(key, value)
{
  key = encodeURI(key); value = encodeURI(value);

  var kvp = document.location.search.substr(1).split('&');
  var i=kvp.length; var x; while(i--)
{
  x = kvp[i].split('=');

  if (x[0]==key)
  {
    x[1] = value;
    kvp[i] = x.join('=');
    break
  }
}

  if(i<0) {kvp[kvp.length] = [key,value].join('=');}

  //this will reload the page, it likely better to store this until finished
  kvp = kvp.filter(function (item, index) {
    x = item.split('=');
    return (x[0] !== "check" && x[0] !== "task_id");
  });
  document.location.search = kvp.join('&');
}

var $checkbox = document.getElementsByClassName('show_completed');

if ($checkbox.length) {
  $checkbox[0].addEventListener('change', function (event) {
    var is_checked = +event.target.checked;
    console.log(window);
    insertParam('show_completed', is_checked)
    //window.location = '/index.php?show_completed=' + is_checked;
  });
}

var $taskCheckboxes = document.getElementsByClassName('tasks');

if ($taskCheckboxes.length) {

  $taskCheckboxes[0].addEventListener('change', function (event) {
    if (event.target.classList.contains('task__checkbox')) {
      var el = event.target;

      var is_checked = +el.checked;
      var task_id = el.getAttribute('value');

      var url = '/index.php?task_id=' + task_id + '&check=' + is_checked;
      window.location = url;
    }
  });
}

flatpickr('#date', {
  enableTime: false,
  dateFormat: "Y-m-d",
  locale: "ru"
});
