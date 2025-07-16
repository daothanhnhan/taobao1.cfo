// content.js
chrome.runtime.onMessage.addListener(
    function(request, sender, sendResponse) {
        if(request.method == "changePage"){
            // document.body.innerText = "Foot";
            // sendResponse({text: "hello", method: "changePage"}); //same as innerText
            var h2 = document.getElementsByTagName("h2")[0];
            // alert(h2.innerText);
            
            

            var price = document.getElementsByClassName("new-price")[0];

            if (price) {
            	var price1 = document.getElementsByClassName("old-price")[0];
	            price1 = price1.innerText;
	            // var price_arr = price.split("VNĐ");
	            // price1 = price_arr[0].trim();
	            // price1 = price1.replaceAll(',', '');
	            // price1 = price1.replaceAll('đ', '');
	            // price1 = price1.trim();
	            price1 = price1.replace(/\D/gm,"");
	            // alert(price1);
	            // price2 = price_arr[1].trim();
	            // price2 = price2.replaceAll('.', '');
	            // alert(price2);
	            var price2 = document.getElementsByClassName("new-price")[0];
	            price2 = price2.innerText;
	            price2 = price2.replace(/\D/gm,"");
	            // alert(price2);
            } else {
            	// alert('1');
            	var price1 = document.getElementsByClassName("product-detail-info__price")[0];//alert(price1);
            	price1 = price1.innerText;//alert(price1);
	            price1 = price1.replace(/\D/gm,"");

	            var price2 = 0;
            }
            // alert(price1);
            // alert(price2);



            // var des = document.getElementsByClassName("details-sp")[0];
            // alert(des.innerHTML.replaceAll(/\s/g,''));
            // des = des.innerHTML.replaceAll(/\t/g,'');
            // document.body.innerHTML = des;
            // alert(des.innerHTML);
            // des = des.innerHTML;
            // des = encodeURIComponent(des);
            des = '';
            var content = document.getElementsByClassName("product-detail-content")[0];
            // var content1 = document.getElementById("div-3");
            // var content2 = document.getElementById("div-4");
            // alert(content.innerHTML);
            content = content.innerHTML.replaceAll(/\t/g,'');
            // content1 = content1.innerHTML.replaceAll(/\t/g,'');
            // content2 = content2.innerHTML.replaceAll(/\t/g,'');

            // content += content1;
            // content += content2;

            var re = /<a\s.*?href=[\"\'](.*?)[\"\']*?>(.*?)<\/a>/g;
			var str = content;
			var subst = '$2';
			var content = str.replaceAll(re, subst);

			content = content.replaceAll('<div class="title-section"><h3>Chi tiết</h3></div>', '');
			// content = content.replaceAll('<div class="show-more">Xem thêm</div>', '');
            // alert(content);
            
            var img = document.getElementsByClassName("thumbnail");
            var img_pro_length = img.length;//alert(img_pro_length);
            var img_pro_arr = [];
            var imgTags;
            // var img = document.getElementById("imgID").src;
            // var img;

            for (var i=0;i<img_pro_length;i++) {
            	imgTags = img[i].innerHTML.match(/<img [^>]*src="[^"]*"[^>]*>/gm);
            	// imgTags = img[i].src;
            	img_pro_arr.push(imgTags);
            }

            // alert(img_pro_arr);
            // document.body.innerHTML = img_pro_arr[0];
            


            // document.body.innerHTML = imgTags;
			// alert(imgTags[0]);
			var src;
			var arr_img = [];
			var link_src;
			var length_scr;
			// alert(imgTags.length);
			// alert(img_pro_arr.length);
			for (i=0;i<img_pro_arr.length;i++) {
				// alert(img_pro_arr[i]);
				// alert(typeof img_pro_arr[i]);
				if (img_pro_arr[i] == null) {
					continue;
				}
				src = img_pro_arr[i][0].match(/src="[^"]*"/gm);
				link_src = src[0].substring(5);
				length_scr = link_src.length;
				link_src = link_src.substring(0, length_scr-1);
				link_src = link_src.replace('74x74', '740x740');
				// alert(src[0]);
				// alert(arr_img.includes(src[0]));
				if (i >= 4 || true) {
					if (arr_img.includes(link_src)) {
				// 	// alert('ok');
				// 	// arr_img.push(src);
					} else {
				// 		// alert('no');
						
						
						arr_img.push(link_src);
				// 		// break;
					}
				}
				
				if (i == 7) {
					// break;
				}
			}
			// alert(arr_img);

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

			// throw new Error("my error message");

			// alert('content end');
			// price2 = 0;

			sendResponse({text: h2.innerText, price1: price1, price2: price2, des: des, content: content, img: arr_img, img_content: arr_img_content, method: "changePage"});
        }
        // sendResponse({text: "123", method: "changePage"});
    }
);
// alert('content');