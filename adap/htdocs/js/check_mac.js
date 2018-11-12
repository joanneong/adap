// Bind submit event of form -- this code snippet is inspired by
// https://stackoverflow.com/questions/5004233/jquery-ajax-post-example-with-php
var request;
var serializedData;

$("#check_mac").submit(function(event) {
  // Prevent default posting of form
  event.preventDefault();

  // Abort any pending request
  if (request) {
    request.abort();
  }

  const target = event.target;
  const mac_address = target.mac_address.value;

  serializedData = 'mac_address=' + mac_address;
  console.log("DATA8: " + serializedData);

  // Fire off the request to php/search.php
  request = $.post(
    "../php/check_mac.php",
    serializedData,
    indicateSearchSuccess
  );
});

function indicateSearchSuccess(response) {
    console.log("response: " + response);
    if (response === "SUCCESS!") {
        var toastHTML = '<span>This mac is verified.</span>';
        M.toast({html: toastHTML, classes: 'rounded green lighten-1'});
        return ;
    }

    if (response === "FAILURE!") {
        var toastHTML = '<span>This mac is not verified.</span>';
        M.toast({html: toastHTML, classes: 'rounded red darken-1'});
        return ;
    }
}