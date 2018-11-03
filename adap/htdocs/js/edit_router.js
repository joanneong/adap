/*
* JavaScript file for the add router page.
*/
// Bind submit event of form -- this code snippet is inspired by
// https://stackoverflow.com/questions/5004233/jquery-ajax-post-example-with-php
var request;
var serializedData;
var mac_addr;

$("#edit_router").submit(function(event) {
  // Prevent default posting of form
  event.preventDefault();

  // Abort any pending request
  if (request) {
    request.abort();
  }

  const target = event.target;
  const mac_address = target.mac_address.value;
  const model = target.model.value;
  const version = target.version.value;
  mac_addr = mac_address;

  serializedData = 'mac_address=' + mac_address 
      + '&model=' + model
      + '&version=' + version
      + '&original_mac_addr=' + original_mac_addr;
  console.log("data: " + serializedData);

  // Fire off the request to php/add_router.php
  request = $.post (
    "../php/edit_router.php",
    serializedData,
    indicateEditRouterSuccess
  );
});

function indicateEditRouterSuccess(response) {
    console.log("response: " + response);
    if (response === "SUCCESS!") {
      // var toastHTML = '<span>Successfully updated router information!</span>';
      // M.toast({html: toastHTML, classes: 'rounded green lighten-1'});
      $(location).attr('href', "updated_router.php?mac_address=" + mac_addr);
      return ;
    }

    if (response === "ERROR!") {
      var toastHTML = '<span>Check your submission!</span>';
      M.toast({html: toastHTML, classes: 'rounded red darken-1'});
      return ;
    }

    if (response === "Edit failed.") {
      var toastHTML = '<span>Unable to update router information!</span>';
      M.toast({html: toastHTML, classes: 'rounded red darken-1'});
      return ;
    }
}
