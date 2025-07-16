// content.js
chrome.runtime.onMessage.addListener(
    function(request, sender, sendResponse) {
        if(request.method == "changePage"){
            // document.body.innerText = "Foot";
            // sendResponse({text: "hello", method: "changePage"}); //same as innerText
            var h2 = document.getElementsByTagName("h1")[0];
            // alert(h2.innerText);

            var des_seo = document.querySelector('meta[name="description"]').content;//alert(des_seo);

            var nguon_goc = document.getElementsByClassName("variations")[0];

            if (nguon_goc == undefined) {
                  // alert('không có');
                  var nguon_goc_text = '';
            } else {
                  // alert(nguon_goc.innerText);
                  var nguon_goc_text = nguon_goc.innerText;
            }
            // alert('ok');
            
            var price = document.getElementsByClassName("product-page-price")[0];
            // alert(price.innerHTML);
            price = price.innerText;
            var price_arr = price.split("–");
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

            
            
            var des = document.getElementsByClassName("product-short-description");
            // alert(des.length);
            if (des.length == 0) {
            	des = '';
            } else {
            	des = des[0].innerHTML.replaceAll(/\t/g,'');
            }
            // alert(des.innerHTML.replaceAll(/\s/g,''));
            // des = des.innerHTML.replaceAll(/\t/g,'');
            // document.body.innerHTML = des;
            // alert(des);
            // var des_1 = des.getElementsByClassName("tdw-block-inner")[0];
            // alert(des);
            // des = des.innerHTML.replaceAll(/\t/g,'');
            // alert(des);
            // des = encodeURIComponent(des);
            // des = '';
            // var code = document.getElementsByClassName("sku")[0].innerHTML;
            // alert(code);
            var content = document.getElementById("tab-test_tab");// thông sô kỹ thuật
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

            ///////////////////
            var content1 = document.getElementById("tab-tabspbgom");// mô tả
            content1 = content1.innerHTML.replaceAll(/\t/g,'');
            var re = /<a\s.*?href=[\"\'](.*?)[\"\']*?>(.*?)<\/a>/g;
			var str = content1;
			var subst = '$2';
			var content1 = str.replaceAll(re, subst);
			content1 = content1.replace(/<img[^>]*>/g,"");
			// alert(content1);
			///////////////////
            var content2 = document.getElementById("tab-description");// sản phẩm bao gồm
            content2 = content2.innerHTML.replaceAll(/\t/g,'');
            var re = /<a\s.*?href=[\"\'](.*?)[\"\']*?>(.*?)<\/a>/g;
			var str = content2;
			var subst = '$2';
			var content2 = str.replaceAll(re, subst);
			// content2 = content2.replace(/<img[^>]*>/g,"");
			// alert(content2);
			///////////////////

            // alert('ok');
            var box_img = document.getElementsByClassName("flickity-slider")[0];
            // var box_img = document.getElementsByClassName("flickity-viewport")[1];
            // alert(box_img);
            if (box_img == undefined) {
                  // alert('no list img');
                  var img_don = document.getElementsByClassName("product-images")[0];
                  // alert(img_don);
                  var img_don_1 = img_don.getElementsByTagName('figure')[0].innerHTML;
                  // alert(img_don_1.innerHTML);
                  img_don_1 = img_don_1.match(/<img [^>]*src="[^"]*"[^>]*>/gm);
                  // alert(img_don_1);

                  var img_pro_arr = [];
                  img_pro_arr.push(img_don_1[0]);
            } else {
                  // var img = document.getElementsByClassName("item");
                  var img = box_img.getElementsByTagName("div");
                  var img_pro_length = img.length;
                  var img_pro_arr = [];
                  var imgTags;

                  for (var i=0;i<img_pro_length;i++) {
                        imgTags = img[i].innerHTML.match(/<img [^>]*src="[^"]*"[^>]*>/gm);
                        // alert(imgTags[0]);
                        img_pro_arr.push(imgTags[0]);
                  }
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

			var img_content = content2.match(/<img [^>]*src="[^"]*"[^>]*>/gm);
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
                  // alert(des);
			var code = '';
                  var brand_arr = '';

			sendResponse({brand: brand_arr, code: code, text: h2.innerText, price1: price1, price2: price2, des: des, content: content, content1:content1, content2:content2, img: arr_img, img_content: arr_img_content, des_seo:des_seo, nguon_goc_text:nguon_goc_text, method: "changePage"});
        }
        // sendResponse({text: "123", method: "changePage"});
    }
);
// alert('content');