// Trigger cve view only when image is clicked
$('img').click(function(event) {
  var target = event.target;
  searchCveDatabase(target.id);
});

var counter;

// Try searching for result in the current database first
function searchCveDatabase(routerInfo) {
  var parsedRouterInfo = routerInfo.split(" ");
  counter = parsedRouterInfo[0];
  var serializedRouterInfo = parsedRouterInfo[1];

  request = $.post(
    "../php/view_cve.php",
    serializedRouterInfo,
    checkIfFound
  );
}

// Check if the query is successfully found in the database
function checkIfFound(response) {
  console.log(response);
  var numOfResponses = response[0];
  var responses = response[1];

  if (numOfResponses != 0) {
    showCveDetails(responses);
  } else {
    var result = "There is no known CVE associated with this router model and firmware version!";
    showCveDetails(result);
  }
}

// Displays a given response in the card reveal
function showCveDetails(responses) {
  console.log("current counter: " + counter);
  $("#cve_content" + counter).text("Lorem ipsum dolor sit amet, consectetur adipiscing elit," 
   + "sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam," 
   + "quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. "
   + "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat "
   + "nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia "
   + "deserunt mollit anim id est laborum.");
}
