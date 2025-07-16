// content.js
chrome.runtime.onMessage.addListener(
    function(request, sender, sendResponse) {
        if(request.method == "changePage"){
            // document.body.innerText = "Foot";
            // sendResponse({text: "hello", method: "changePage"}); //same as innerText


            var view = document.getElementsByClassName("view");
            // alert(view.length);
            var view_arr = [];
            var href;
            for (var i=0;i<view.length;i++) {
                  // alert(view[i].innerHTML);
                  href = view[i].innerHTML.match(/href="([^"]*)/)[1];
                  // alert(href);
                  view_arr.push(href);
                  // alert(view_arr);
                  // break;
            }
            // alert(view_arr);


           
            
            

			// const xhttp = new XMLHttpRequest();
			//   xhttp.onload = function() {
			//     // document.getElementById("demo").innerHTML = this.responseText;
			//     	alert(this.responseText);
			//     }
			//   xhttp.open("GET", "http://taobao1.cafelink.org/database.php", true);
			//   xhttp.send();

			// var xhr = new XMLHttpRequest();
			// xhr.open("GET", "http://taobao1.cafelink.org/extension/product.php", true);
			// xhr.onreadystatechange = function() {
			//   if (xhr.readyState == 4) {
			//     // WARNING! Might be evaluating an evil script!
			//     // var resp = eval("(" + xhr.responseText + ")");
			//     alert('ajax');
			//     // alert(xhr.responseText);
			//   }
			// }
			// xhr.send();

			// throw new Error("my error message");

			// alert('content end');

                  // alert('end');

			sendResponse({code: view_arr, method: "changePage"});
        }
        // sendResponse({text: "123", method: "changePage"});
    }
);
// alert('content');