// content.js
chrome.runtime.onMessage.addListener(
    function(request, sender, sendResponse) {
        if(request.method == "changePage"){
            // document.body.innerText = "Foot";
            // sendResponse({text: "hello", method: "changePage"}); //same as innerText
            var h2 = document.getElementsByTagName("h1")[0];
            // alert(h2.innerText);
            var price = document.getElementsByClassName("price-detail")[0];
            price = price.innerText;
            price = price.substr(0, price.length-2);
            price = price.replace(',', '');
            // alert(price);
            var des = document.getElementsByClassName("detail-summary")[0];
            // alert(des.innerHTML.replaceAll(/\s/g,''));
            des = des.innerHTML.replaceAll(/\t/g,'');
            // document.body.innerHTML = des;
            // alert(des);
            // des = encodeURIComponent(des);
            // des = '';
            var content = document.getElementById("tab1");
            var content1 = document.getElementById("tab2");
            var content2 = document.getElementById("tab3");
            // alert(content.innerHTML);
            content = content.innerHTML.replaceAll(/\t/g,'');
            content1 = content1.innerHTML.replaceAll(/\t/g,'');
            content2 = content2.innerHTML.replaceAll(/\t/g,'');

            content += content1;
            content += content2;

            var re = /<a\s.*?href=[\"\'](.*?)[\"\']*?>(.*?)<\/a>/g;
			var str = content;
			var subst = '$2';
			var content = str.replaceAll(re, subst);

            // alert(content);
            
            var img = document.getElementsByClassName("MagicZoom");
            var img_pro_length = img.length;
            var img_pro_arr = [];
            var imgTags;

            for (var i=0;i<img_pro_length;i++) {
            	imgTags = img[i].innerHTML.match(/<img [^>]*src="[^"]*"[^>]*>/gm);
            	img_pro_arr.push(imgTags[0]);
            }
            // alert(img);
            // document.body.innerText = img.innerHTML;
            


            // document.body.innerHTML = imgTags;
			// alert(imgTags[0]);
			var src;
			var arr_img = [];
			var link_src;
			var length_scr;
			// alert(imgTags.length);
			for (i=0;i<img_pro_arr.length;i++) {
				src = img_pro_arr[i].match(/src="[^"]*"/gm);
				link_src = src[0].substring(5);
				length_scr = link_src.length;
				link_src = link_src.substring(0, length_scr-1);
				// alert(src[0]);
				// alert(arr_img.includes(src[0]));
				if (i >= 4 || true) {
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

			var img_content = content.match(/<img [^>]*src="[^"]*"[^>]*>/gm);
            // alert(img_content);
            var arr_img_content = [];

            if (img_content != null) {
            	for (i=0;i<img_content.length;i++) {
					src = img_content[i].match(/src="[^"]*"/gm);
					link_src = src[0].substring(5);
					length_scr = link_src.length;
					link_src = link_src.substring(0, length_scr-1);
					arr_img_content.push(link_src);
				}
				// alert(arr_img_content);
            }
            

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

			sendResponse({text: h2.innerText, price: price, des: des, content: content, img: arr_img, img_content: arr_img_content, method: "changePage"});
        }
        // sendResponse({text: "123", method: "changePage"});
    }
);
// alert('content');