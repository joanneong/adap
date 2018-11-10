// Prepare to redirect to the view routers page
$(document).ready(triggerTimeout);

function triggerTimeout() {
  window.setTimeout(redirectToViewPage, 1000);

  serializedData = 'mac_address=' + mac_address;
  // Fire off the request to php/delete_router.php
  request = $.post (
    "../php/delete_router.php",
    serializedData
  );
}

function redirectToViewPage() {
  $(location).attr('href', "view_routers.php");
}
