// Trigger cve view only when image is clicked
$('.overlay').click(function(event) {
  var target = event.target;

  console.log("target id is: " + target.id);
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
    parseDatabaseResponse
  );
}

// Parse the response from the database
function parseDatabaseResponse(response) {
  response = JSON.parse(response);
  console.log(response);
  var numOfResponses = response.numOfResults;
  var results = response.results;

  if (numOfResponses != 0) {
    var fullResult = ""

    console.log(results);
    
    for (i = 0; i < numOfResponses; i++) {
      var currResult = results[i];

      fullResult += "==================\n"

      fullResult += "CVE ID: " + currResult.cve_id + "\n\n";
      fullResult += "Severity: " + currResult.cve_severity + "\n\n";
      fullResult += "Description: " + currResult.cve_description + "\n\n";
    }
    showCveDetails(fullResult);
  } else {
    var STANDARD_REPLY = "There is no known CVE associated with this router model and firmware version!";
    showCveDetails(STANDARD_REPLY);
  }
}

// Display a given response in the card reveal
function showCveDetails(result) {
  var obj = $("#cve_content" + counter).text(result);
  obj.html(obj.html().replace(/\\n/g,'<br><br>'));
}
