/*
* JavaScript file for the add router page.
*/
// Bind submit event of form -- this code snippet is inspired by
// https://stackoverflow.com/questions/5004233/jquery-ajax-post-example-with-php
var request;
var serializedData;

$("#add_router").submit(function(event) {
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

  serializedData = 'mac_address=' + mac_address 
      + '&model=' + model.toLowerCase()
      + '&version=' + version
      + '&company_email=' + company_email;
  console.log("data: " + serializedData);

  // Fire off the request to php/add_router.php
  request = $.post (
    "../php/add_router.php",
    serializedData,
    indicateAddRouterSuccess
  );
});

function indicateAddRouterSuccess(response) {
    console.log("response: " + response);
    if (response === "SUCCESS!") {
      var toastHTML = '<span>Successfully whitelisted this router!</span>';
      M.toast({html: toastHTML, classes: 'rounded green lighten-1'});
      return ;
    }

    if (response === "ERROR!") {
      var toastHTML = '<span>Check your submission!</span>';
      M.toast({html: toastHTML, classes: 'rounded red darken-1'});
      return ;
    }

    if (response === "Add failed.") {
      var toastHTML = '<span>Router already whitelisted!</span>';
      M.toast({html: toastHTML, classes: 'rounded red darken-1'});
      return ;
    }
}
