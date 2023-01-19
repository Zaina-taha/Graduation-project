
  
  chrome.runtime.onMessage.addListener(function(message, sender, sendResponse) {
    if (message.type === "open-popup") {
      console.log(message.searchTerm);
      var searchTerm = message.searchTerm;
      var AnnotationText=message.AnnotationText;
      var website=message.website;
      var tags=message.tags;
      var video=message.video;
      var ID=message.ID;

      var params = new URLSearchParams();
      params.append("searchTerm", searchTerm);
      params.append("AnnotationText", AnnotationText);
      params.append("website", website);
      params.append("tags", tags);
      params.append("video", video);
      params.append("ID", ID);

      chrome.windows.create({
        url: "http://localhost/video/ViewAndComment.php?" +params.toString(),
        type: "popup",
        width: 500,
        height: 300
      });
    }
  });
  
  