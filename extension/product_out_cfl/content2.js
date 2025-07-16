// content.js
// CKEDITOR.instances.editor1.destroy();
chrome.runtime.onMessage.addListener(
    function(request, sender, sendResponse) {
        if(request.method == "changePage"){

			document.getElementById("title").value = request.name;
			document.getElementById("excerpt").value = request.des;
			document.getElementById("content").value = request.note;
			document.getElementById("_regular_price").value = request.price;

			
			
			alert('end');
        }
        // sendResponse({text: "123", method: "changePage"});
    }
);
// alert('content');