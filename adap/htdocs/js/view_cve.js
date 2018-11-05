// Trigger cve view only when image is clicked
$('img').click(function(event) {
  var target = event.target;
  searchCveDatabase(target.id);
});

// Helps to identify the specific card to modify
var counter;

// Stores the router information for further queries
var serializedRouterInfo;

// Search for result in the current database first
function searchCveDatabase(routerInfo) {
  var parsedRouterInfo = routerInfo.split(" ");
  counter = parsedRouterInfo[0];
  serializedRouterInfo = parsedRouterInfo[1];

  for (i = 2; i < parsedRouterInfo.length; i++) {
    serializedRouterInfo += "+" + parsedRouterInfo[i];
  }

  console.log("serialized router info: " + serializedRouterInfo);
  request = $.post(
    "../php/view_cve.php",
    serializedRouterInfo,
    checkIfFound
  );
}

// Check if the query is successfully found in the database
function checkIfFound(response) {
  console.log(response);
  response = JSON.parse(response);
  var numOfResponses = response.numOfResults;
  var result = response.result;

  if (numOfResponses != 0) {
    showCveDetails(result);
  } else {
    var result = "There is no known CVE associated with this router model and firmware version!";
    showCveDetails(result);
  }
}

// Default CVE database (online) to search
const onlineDatabase = "https://www.cvedetails.com/google-search-results.php?";

// Get cve search results from an online database using jQuery
function getCveFromOnlineDatabse() {

}

// Display a given response in the card reveal
function showCveDetails(result) {
  var obj = $("#cve_content" + counter).text(result);
  obj.html(obj.html().replace(/\\n/g,'<br><br>'));
}
