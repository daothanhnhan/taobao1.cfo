// content.js
chrome.runtime.onMessage.addListener(
    function(request, sender, sendResponse) {
        if(request.method == "changePage"){
            // document.body.innerText = "Foot";
            // sendResponse({text: "hello", method: "changePage"}); //same as innerText
            var h2 = document.getElementsByTagName("h1")[0];
            // alert(h2.innerText);

            var brand = document.getElementsByClassName("td_woo_product_categories tdi_77")[0];
            // alert(brand.innerHTML);
            var brand_1 = brand.getElementsByClassName("tdw-block-inner")[0];
            // alert(brand_1.innerHTML);
            var brand_a = brand.getElementsByTagName('a');
            // alert(brand_a[0].innerHTML);
            // alert(brand_a.length);
            var brand_arr = [];
            for (var i=0;i<brand_a.length;i++) {
            	// alert(i);
            	// alert(brand_a[i].innerHTML);
            	brand_arr.push(brand_a[i].innerHTML);
            }
            // alert(brand_arr);
            
            var price = document.getElementsByClassName("tdw-pp-price")[0];
            // alert(price.innerHTML);
            price = price.innerText;
            var price_arr = price.split(" ");
            if (price_arr.length == 1) {
            	price1 = price_arr[0].replaceAll(/\D+/g, '');
	            // price1 = price1.replaceAll('₫', '');
	            // alert(price1);
	            price2 = 0;
	            // price2 = price2.replaceAll('₫', '');
	            // alert(price2);
            } else {
            	price1 = price_arr[0].replaceAll(/\D+/g, '');
	            // price1 = price1.replaceAll('₫', '');
	            // alert(price1);
	            price2 = price_arr[1].replaceAll(/\D+/g, '');
	            // price2 = price2.replaceAll('₫', '');
	            // alert(price2);
            }
            if (price1 === '') {
            	price1 = 0;
            }
            // alert(price1);
            // alert(price2);
            
            var des = document.getElementsByClassName("td_woo_product_description")[0];
            // alert(des.innerHTML.replaceAll(/\s/g,''));
            // des = des.innerHTML.replaceAll(/\t/g,'');
            // document.body.innerHTML = des;
            // alert(des);
            var des_1 = des.getElementsByClassName("tdw-block-inner")[0];
            // alert(des);
            des = des_1.innerHTML.replaceAll(/\t/g,'');
            // alert(des_1);
            // des = encodeURIComponent(des);
            // des = '';
            // var code = document.getElementsByClassName("sku")[0].innerHTML;
            // alert(code);
            var content = document.getElementById("tab-description");
            // var content1 = document.getElementById("tab2");
            // var content2 = document.getElementById("tab3");
            // alert(content.innerHTML);
            content = content.innerHTML.replaceAll(/\t/g,'');
            // content1 = content1.innerHTML.replaceAll(/\t/g,'');
            // content2 = content2.innerHTML.replaceAll(/\t/g,'');
// alert('a');
            // content += content1;
            // content += content2;
            // content = content.replace('<h2>Mô tả sản phẩm</h2>', '');
            // alert(content);

            var re = /<a\s.*?href=[\"\'](.*?)[\"\']*?>(.*?)<\/a>/g;
			var str = content;
			var subst = '$2';
			var content = str.replaceAll(re, subst);

			content = content.replaceAll('<div class="show-more"> Xem thêm   </div>', '');
			content = content.replaceAll('<div class="show-more">Xem thêm</div>', '');
            // alert(content);
            
            var box_img = document.getElementsByClassName("elastislide-carousel")[0];
            // alert(box_img);
            // var img = document.getElementsByClassName("item");
            var img = box_img.getElementsByTagName("li");
            var img_pro_length = img.length;
            var img_pro_arr = [];
            var imgTags;

            for (var i=0;i<img_pro_length;i++) {
            	imgTags = img[i].innerHTML.match(/<img [^>]*src="[^"]*"[^>]*>/gm);
            	img_pro_arr.push(imgTags[0]);
            }
            // alert(img_pro_arr);
            // alert(img_pro_arr.length);
            // document.body.innerHTML = img_pro_arr[0];
            


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
					// arr_img.push(src);//bo link trung
					} else {
						// alert('no');
						
						
						arr_img.push(link_src);
						// break;
					}
				}
				
				if (i == 7) {
					// break;
				}
				// alert(arr_img.length);
			}
			// alert(arr_img.length);
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
			var code = '';

			sendResponse({brand: brand_arr, code: code, text: h2.innerText, price1: price1, price2: price2, des: des, content: content, img: arr_img, img_content: arr_img_content, method: "changePage"});
        }
        // sendResponse({text: "123", method: "changePage"});
    }
);
// alert('content');