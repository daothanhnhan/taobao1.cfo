// content.js
// CKEDITOR.instances.editor1.destroy();
chrome.runtime.onMessage.addListener(
    function(request, sender, sendResponse) {
        if(request.method == "changePage"){

			document.getElementById("title").value = request.name;
			document.getElementById("title_seo").value = request.name;
			// document.getElementById("editor1").innerHTML = request.note;
			document.getElementsByName("product_price")[0].value = request.price;
			document.getElementsByName("product_price_sale")[0].value = request.price_sale;
			document.getElementsByName("state")[0].checked = true;
			// document.getElementById("cke_editor1").remove();
			// document.getElementById("editor1").setAttribute("style", ""); 
			document.getElementById("editor1").setAttribute("name", "1");
			var content = document.getElementById("editor1");
			var textarea_content = document.createElement('TEXTAREA'); 
			textarea_content.name = "product_content";
			textarea_content.value = request.note; 
			content.parentNode.appendChild(textarea_content);
			//////////////////////
			slug = request.name.toLowerCase();
     
	        //Đổi ký tự có dấu thành không dấu
	        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
	        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
	        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
	        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
	        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
	        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
	        slug = slug.replace(/đ/gi, 'd');
	        //Xóa các ký tự đặt biệt
	        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
	        //Đổi khoảng trắng thành ký tự gạch ngang
	        slug = slug.replace(/ /gi, "-");
	        slug = slug.replace(/[^a-zA-Z0-9\-]+/gi, '');

	        var dau_tru = slug.indexOf("--");
	        while (dau_tru != -1) {
	        	slug = slug.replace('--', '-');
	        	dau_tru = slug.indexOf("--");
	        }

			document.getElementById("slug1").value = slug;
			//////////////////////
			document.getElementById("input-description-short1").setAttribute("name", "1");
						
			document.getElementsByClassName("tox-tinymce")[0].innerHTML = '';

			var des = document.getElementById("input-description-short1");
			var textarea_des = document.createElement('TEXTAREA'); 

			textarea_des.name = "product_description[1][description_short]";
			
			textarea_des.value = request.des; 

			des.parentNode.appendChild(textarea_des);
			//////////////////////
			document.getElementById("input-description1").setAttribute("name", "1");
						
			document.getElementsByClassName("tox-tinymce")[1].innerHTML = '';

			var content = document.getElementById("input-description1");
			var textarea_content = document.createElement('TEXTAREA'); 

			textarea_content.name = "product_description[1][description]";
			var content_shome = request.des + request.note;
			// var content_shome = request.note;
			

			
			
			textarea_content.value = content_shome; 

			content.parentNode.appendChild(textarea_content);
			//////////////////////
			document.getElementById("input-price").value = request.price;
			document.getElementById("input-price-other").value = request.price_sale;

			//////////////////////
			slug = request.name.toLowerCase();
     
	        //Đổi ký tự có dấu thành không dấu
	        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
	        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
	        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
	        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
	        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
	        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
	        slug = slug.replace(/đ/gi, 'd');
	        //Xóa các ký tự đặt biệt
	        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
	        //Đổi khoảng trắng thành ký tự gạch ngang
	        slug = slug.replace(/ /gi, "-");
	        slug = slug.replace(/[^a-zA-Z0-9\-]+/gi, '');

	        var dau_tru = slug.indexOf("--");
	        while (dau_tru != -1) {
	        	slug = slug.replace('--', '-');
	        	dau_tru = slug.indexOf("--");
	        }

			document.getElementById("product_seo_url_0_1").value = slug;

			alert('end');
        }
        // sendResponse({text: "123", method: "changePage"});
    }
);
// alert('content');