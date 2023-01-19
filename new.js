const myText = async (e) => {
    var selectedText = "";


    let element = e.target;
    if (e.altKey) {
        /* Get selected text */
        selectedText = window.getSelection().toString().trim();

        if (selectedText.length > 0) {
            var first = selectedText;
            var link = window.location.href;
            var params = new URLSearchParams();
            params.append("first", first);
            params.append("link", link);
            var url = "http://localhost/video/new.php?" + params.toString();

            window.open(url, 'title', 'width=500,height=300');


        }
    }
}

document.onmouseup = myText;


