// content.js
chrome.runtime.onMessage.addListener(
    function(request, sender, sendResponse) {
        if(request.method == "changePage"){
            // document.body.innerText = "Foot";
            // sendResponse({text: "hello", method: "changePage"}); //same as innerText
            var h2 = document.getElementsByTagName("h2")[0];
            // alert(h2.innerText);
            var price = document.getElementsByClassName("price")[0];
            price = price.innerText;
            price = price.substr(0, price.length-2);
            price = price.replace(',', '');
            // alert(price);
            var des = document.getElementsByClassName("woocommerce-product-details__short-description")[0];
            // alert(des.innerHTML);
            var content = document.getElementById("tab-description");
            // alert(content.innerHTML);
            var img = document.getElementsByClassName("gallery-control")[0];
            // alert(img);
            // document.body.innerText = img.innerHTML;
            var imgTags = img.innerHTML.match(/<img [^>]*src="[^"]*"[^>]*>/gm);


            // document.body.innerHTML = imgTags;
			// alert(imgTags[0]);
			var src;
			var arr_img = [];
			var link_src;
			var length_scr;
			// alert(imgTags.length);
			for (i=0;i<imgTags.length;i++) {
				src = imgTags[i].match(/src="[^"]*"/gm);
				link_src = src[0].substring(5);
				length_scr = link_src.length;
				link_src = link_src.substring(0, length_scr-1);
				// alert(src[0]);
				// alert(arr_img.includes(src[0]));
				if (i >= 4) {
					if (arr_img.includes(link_src)) {
					// alert('ok');
					// arr_img.push(src);
					} else {
						// alert('no');
						
						
						arr_img.push(link_src);
						// break;
					}
				}
				
				if (i == 7) {
					// break;
				}
			}
			// alert(arr_img.length);

			var img_content = content.innerHTML.match(/<img [^>]*src="[^"]*"[^>]*>/gm);
            // alert(img_content);
            var arr_img_content = [];

            for (i=0;i<img_content.length;i++) {
				src = img_content[i].match(/src="[^"]*"/gm);
				link_src = src[0].substring(5);
				length_scr = link_src.length;
				link_src = link_src.substring(0, length_scr-1);
				arr_img_content.push(link_src);
			}
			// alert(arr_img_content);

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

			sendResponse({text: h2.innerText, price: price, des: des.innerHTML, content: content.innerHTML, img: arr_img, img_content: arr_img_content, method: "changePage"});
        }
        // sendResponse({text: "123", method: "changePage"});
    }
);
// alert('content');