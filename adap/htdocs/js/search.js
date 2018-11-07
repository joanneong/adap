/*
* JavaScript file for the search page.
*/
    // Bind submit event of form -- this code snippet is inspired by
    // https://stackoverflow.com/questions/5004233/jquery-ajax-post-example-with-php
var request;
var serializedData;

$("#search").submit(function(event) {
    // Prevent default posting of form
  event.preventDefault();

    // Abort any pending request
  if (request) {
    request.abort();
}

  const target = event.target;
  const mac = target.mac_address.value;

  serializedData = 'mac_address=' + mac_address 
      + '&model=' + model.toLowerCase()
      + '&version=' + version
      + '&company_email=' + company_email;
  console.log("data: " + serializedData);

    // Fire off the request to php/search.php
  request = $.post (
    "../php/search.php",
    serializedData,
    indicateAddRouterSuccess
  );
});

function indicateAddRouterSuccess(response) {
    console.log("response: " + response);
    if (response === "SUCCESS!") {
        var toastHTML = '<span> Results: </span>';
        M.toast({html: toastHTML, classes: 'rounded green lighten-1'});
        return ;
    }

    if (response === "ERROR!") {
        var toastHTML = '<span>Error: Invalid Request</span>';
        M.toast({html: toastHTML, classes: 'rounded red darken-1'});
        return ;
    }

    if (response === "Search failed.") {
        var toastHTML = '<span>Please re-enter your query.</span>';
        M.toast({html: toastHTML, classes: 'rounded red darken-1'});
        return ;
    }
}