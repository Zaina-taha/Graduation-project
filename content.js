chrome.runtime.onMessage.addListener(function(message, sender, sendResponse) {
    if (message.type === "button-clicked") {
      highlight();
    }
});


async function highlight(){
   var data;
await fetch('http://localhost/video/popup.php')
  .then(response => response.json())
  .then(a => {
      data=a;
 
});

var currentUrl = window.location.href;
 for (let index = 0; index < data.length; index++) 
    {
      var website = data[index].website;
      if (currentUrl.includes(website)) {
        var ID=data[index].ID;
        var userID= data[index].userID;
        var AnnotatedText = data[index].AnnotatedText;
        var AnnotationText = data[index].AnnotationText;
        var tags = data[index].tags;
        var video = data[index].video;

         search(AnnotatedText,AnnotationText,website,tags,video,index,ID);   
        //  console.log(AnnotatedText);  
      }
        
            
  }
  

}


  function search(searchTerm,AnnotationText,website,tags,video,index,ID){

    document.addEventListener("click", function(e) {
      // Check if the clicked element is the specific text
      if (e.target.innerHTML === searchTerm) {
        // console.log('hi');
        // Show the pop-up window
        chrome.runtime.sendMessage({ type: "open-popup",searchTerm: searchTerm,AnnotationText:AnnotationText,website:website,tags:tags,video:video,ID:ID});
      }
    });

    const matches = Array.prototype.slice.call(document.querySelectorAll('body *'))
    .filter(node => node.textContent.includes(searchTerm));
          // Iterate over the matching elements and modify their styling
          for (const match of matches) {
            // Create a new span element to highlight the matching text
            const highlight = document.createElement('span');
            highlight.classList.add('highlight');
            highlight.id= "myHeader" + index;
            highlight.textContent = searchTerm;
            highlight.style.backgroundColor='yellow';

            var regexp = new RegExp(searchTerm);

            // Replace the matching text with the highlight element
            match.innerHTML = match.innerHTML.replace(regexp, highlight.outerHTML);


           

          }
  }

 
  
  






  