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
  
  var str = mac_address;
  var mac_split = str.split(/[ ,]+/).filter(Boolean);

  console.log(mac_split);
  serializedData = 'mac_address=' + mac_split;
  console.log("DATA: " + serializedData);

  var macstring = JSON.stringify(mac_split);

  // Fire off the request to php/search.php
  request = $.post(
    "../php/check_mac.php",
    macstring,
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