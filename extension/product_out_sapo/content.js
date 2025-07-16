// content.js
// CKEDITOR.instances.editor1.destroy();
chrome.runtime.onMessage.addListener(
    function(request, sender, sendResponse) {
        if(request.method == "changePage"){

			// document.getElementById("product-name-field").value = request.name;
			// document.getElementById("product-name-field").setAttribute("value", request.name);
			// alert(document.getElementsByClassName("css-8t8o21").length);
			document.getElementById("product-name-fieldLabel").innerHTML = request.name + ' - ' + request.price + ' - ' + request.price_sale;
			// document.getElementById("UITextField9Label").innerHTML = request.price;
			// document.getElementById("UITextField7").value = 'Nguồn gốc';

			// document.getElementById("UITextField4").value = request.price;
			// var element = document.querySelector("input[name='options.0']");
			// element.value = 'Nguồn gốc';
			//////////////////////
			// alert(request.des);
			// document.getElementsByClassName("cm-content")[0].innerHTML = request.des;
			// document.getElementsByClassName("cm-content")[0].innerHTML = '<p>Nội dung</p>';
			// var a = document.getElementsByClassName("er3j2030")[0];
			// a.getElementsByTagName('textarea')[0].innerHTML = '<p>Nội dung</p>';
			//////////////////////
			document.getElementById("input-description-short1").setAttribute("name", "1");
						
			document.getElementsByClassName("tox-tinymce")[0].innerHTML = '';

			var des = document.getElementById("input-description-short1");
			var textarea_des = document.createElement('TEXTAREA'); 

			textarea_des.name = "product_description[1][description_short]";
			
			textarea_des.value = ''; 

			des.parentNode.appendChild(textarea_des);
			//////////////////////
			document.getElementById("input-description1").setAttribute("name", "1");
						
			document.getElementsByClassName("tox-tinymce")[1].innerHTML = '';

			var content = document.getElementById("input-description1");
			var textarea_content = document.createElement('TEXTAREA'); 

			textarea_content.name = "product_description[1][description]";
			var content_shome = request.des + request.note;
			content_shome = content_shome.replaceAll('hút mùi', '<a href="https://shomesolution.vn/hut-mui">hút mùi</a>');
			content_shome = content_shome.replaceAll('máy hút mùi', '<a href="https://shomesolution.vn/hut-mui">máy hút mùi</a>');
			// content_shome = content_shome.replaceAll('bếp hồng ngoại', '<a href="https://shomesolution.vn/bep-tu">bếp hồng ngoại</a>');
			content_shome += '<p><b>Đại lý phân phối chính hãng:</b></p>';
			content_shome += '<p>Đến với S.Home - Địa chỉ cung cấp bồn tắm với mẫu mã đa dạng, nhân viên tư vấn nhiệt tình, giàu kinh nghiệm, chắc chắn sẽ làm hài lòng Quý khách hàng. Chúng tôi cam kết:</p>';
			content_shome += '<p>- Đảm bảo 100% sản phẩm chính hãng</p>';
			content_shome += '<p>- Có chế độ bảo hành rõ ràng, lâu dài</p>';
			content_shome += '<p>- Miễn phí vận chuyển</p>';
			content_shome = content_shome.replaceAll('background: white;', '');
			textarea_content.value = content_shome; 

			content.parentNode.appendChild(textarea_content);
			//////////////////////
			document.getElementById("input-price").value = request.price;

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