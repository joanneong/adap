// Allow autoresizing for text area
// Credit: https://stephanwagner.me/auto-resizing-textarea
jQuery.each(jQuery('textarea[data-autoresize]'), function() {

  var offset = this.offsetHeight - this.clientHeight;

  var resizeTextarea = function(el) {
      jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
  };
  jQuery(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr('data-autoresize');
});

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
  console.log("original data: " + mac_address);

  // Split string based on newline, whitespace or comma and store into an array
  var split_mac = mac_address.split(/[\r\n ,]/g);
  console.log(split_mac);

  // Convert to Json array to send to PHP
  var split_mac_json = JSON.stringify(split_mac);
  console.log("Json array: " + split_mac_json);

  serializedData = "split_mac_json=" + split_mac_json;

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