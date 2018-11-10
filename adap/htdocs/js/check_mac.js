// Bind submit event of form -- this code snippet is inspired by
// https://stackoverflow.com/questions/5004233/jquery-ajax-post-example-with-php
var request;
var splitMac;

$("#check_mac").submit(function(event) {
  // Prevent default posting of form
  event.preventDefault();

  // Abort any pending request
  if (request) {
    request.abort();
  }

  const target = event.target;
  const mac = target.mac.value;

  /*function split() {
      macAdd = 'mac';
      splitMac = macAdd.split(" ");
  }
  */
  splitMac = mac;

  // Fire off the request to php/search.php
  request = $.post(
    "../php/check_mac.php",
    splitMac,
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

    if (response === "ERROR!") {
        var toastHTML = '<span>Invalid mac address.</span>';
        M.toast({ html: toastHTML, classes: 'rounded red darken-1' });
        return;
    }
}