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

  // Fire off the request to php/check_mac.php
  request = $.post(
    "../php/check_mac.php",
    serializedData,
    showVerificationResults
  );
});

// Displays the result for each type (e.g. whitelisted, invalid etc.)
function showResultsForType(type, arr) {
  const NO_RESULTS = "There are no input MAC addresses that are ";
  var id = "#" + type;
  var length = $(arr).length;

  if (length == 0) {
    type = type.replace(/_/g, " ");
    $(id).text(NO_RESULTS + type);
  } else { 
    var fullResult = "";
    for (i = 0; i < length; i++) {
      fullResult += arr[i];
      fullResult += "\n";
    }
    
    $(id).text(fullResult);
  }
}

// Remove duplicate elements in an array
function removeDuplicates(arr) {
  arr = arr.filter(function(item, pos, self) {
    return self.indexOf(item) == pos;
  });

  return arr;
}

function showVerificationResults(response) {
  console.log("response: " + response);
  response = JSON.parse(response);

  var whitelisted = response.whitelisted;
  var not_whitelisted = response.not_whitelisted;
  var invalid = response.invalid;

  whitelisted = removeDuplicates(whitelisted);
  not_whitelisted = removeDuplicates(not_whitelisted);
  invalid = removeDuplicates(invalid);

  showResultsForType("whitelisted", whitelisted);
  showResultsForType("not_whitelisted", not_whitelisted);
  showResultsForType("invalid", invalid);

  $('#results_section').show();
}
