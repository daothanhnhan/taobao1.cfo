// content.js
// CKEDITOR.instances.editor1.destroy();
chrome.runtime.onMessage.addListener(
    function(request, sender, sendResponse) {
        if(request.method == "changePage"){

			document.getElementById("title").value = request.name;
			//////////////////////
			// document.getElementById("input-description-short1").setAttribute("name", "1");
						
			// document.getElementsByClassName("tox-tinymce")[0].innerHTML = '';

			// var des = document.getElementById("input-description-short1");
			// var textarea_des = document.createElement('TEXTAREA'); 

			// textarea_des.name = "product_description[1][description_short]";
			
			// textarea_des.value = request.des; 

			// des.parentNode.appendChild(textarea_des);
			//////////////////////
			// document.getElementById("input-description1").setAttribute("name", "1");
						
			// document.getElementsByClassName("tox-tinymce")[1].innerHTML = '';

			// var content = document.getElementById("input-description1");
			// var textarea_content = document.createElement('TEXTAREA'); 

			// textarea_content.name = "product_description[1][description]";
			// var content_shome = request.des + request.note;
			// // var content_shome = request.note;
			// content_shome = content_shome.replaceAll('lò nướng', '<a href="https://shomesolution.vn/lo-nuong">lò nướng</a>');
			// content_shome = content_shome.replaceAll('Lò nướng', '<a href="https://shomesolution.vn/lo-nuong">Lò nướng</a>');
			// content_shome = content_shome.replaceAll('lò vi sóng', '<a href="https://shomesolution.vn/lo-vi-song">lò vi sóng</a>');
			// content_shome = content_shome.replaceAll('Lò vi sóng', '<a href="https://shomesolution.vn/lo-vi-song">Lò vi sóng</a>');
			// // content_shome = content_shome.replaceAll('bếp điện từ', '<a href="https://shomesolution.vn/bep-tu">bếp điện từ</a>');
			// // content_shome = content_shome.replaceAll('Bếp điện từ', '<a href="https://shomesolution.vn/bep-tu">Bếp điện từ</a>');
			// // content_shome = content_shome.replaceAll('bếp hồng ngoại', '<a href="https://shomesolution.vn/bep-tu">bếp hồng ngoại</a>');
			// // content_shome = content_shome.replaceAll('Bếp hồng ngoại', '<a href="https://shomesolution.vn/bep-tu">Bếp hồng ngoại</a>');
			// // content_shome = content_shome.replaceAll('bếp hồng ngoại', '<a href="https://shomesolution.vn/bep-tu">bếp hồng ngoại</a>');

			// content_shome += '<h2><span style="font-size: 18pt;"><strong id="docs-internal-guid-dc41ce0d-7fff-8f09-6cf3-762c2812b56a">Đại lý phân phối chính hãng</strong></span></h2>';
			// content_shome += '<p dir="ltr"><span style="font-size: 14pt;">&nbsp;&nbsp;&nbsp;&nbsp;Đến với S.Home&nbsp;- Địa chỉ cung cấp máy hút mùi Kocher với mẫu mã đa dạng, nhân viên tư vấn nhiệt tình, giàu kinh nghiệm, chắc chắn sẽ làm hài lòng Quý khách hàng. Chúng tôi cam kết:&nbsp;</span></p>';
			// content_shome += '<p dir="ltr"><span style="font-size: 14pt;">→&nbsp; Đảm bảo 100% sản phẩm chính hãng</span></p>';
			// content_shome += '<p dir="ltr"><span style="font-size: 14pt;">→ Có chế độ bảo hành rõ ràng, lâu dài</span></p>';
			// content_shome += '<p dir="ltr"><span style="font-size: 14pt;">→&nbsp; Miễn phí vận chuyển&nbsp;</span></p>';
			// content_shome = content_shome.replaceAll('background: white;', '');
			// textarea_content.value = content_shome; 

			// content.parentNode.appendChild(textarea_content);
			var textarea_content = request.des + request.note;
			document.getElementById("content").innerHTML = textarea_content;
			//////////////////////
			// document.getElementById("input-price").value = request.price;
			document.getElementById("_regular_price").value = request.price_sale;

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

			// document.getElementById("product_seo_url_0_1").value = slug;

			alert('end');
        }
        // sendResponse({text: "123", method: "changePage"});
    }
);
// alert('content');