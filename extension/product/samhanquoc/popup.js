// popup.js
document.addEventListener('DOMContentLoaded', function() {
  var checkButton = document.getElementById('check');
  checkButton.addEventListener('click', function() {
    chrome.tabs.query({active: true, currentWindow: true}, function(tabs) {
        chrome.tabs.sendMessage(tabs[0].id, {method: "changePage"}, function(response) {
          if(response.method == "changePage"){
            // alert("Succeeded with "+response.method);
          }
          // alert('tuan2');
          // alert(response.img);
          var name = response.text;//alert(name);
          var price1 = response.price1;
          var price2 = response.price2;
          var des1 = response.des;
          // des1 = des1.substr(2);
          // des1 = '<h1>text</h1>';
          des1 = des1.trim();
          // des1 = des1.replaceAll("\n", "");
          des1 = encodeURIComponent(des1);
          
          // des1 = '<p>Sữa rửa mặt <strong>Thanakha Facial Foam – Perfect Pore Solutions</strong></p><ul><li>Nhẹ nhàng làm sạch bụi bẩn, bã nhờn sâu bên trong lỗ chân lông</li><li>Thu hẹp lỗ chân lông</li><li>Ngăn ngừa mụn cám &amp; mụn đầu đen</li><li>Dùng được cho cả nam &amp; nữ</li><li>Phù hợp cho mọi loại da</li></ul><p>&nbsp;</p>';
          // alert(des1);
          content = response.content;
          content = content.trim();
          // alert(content);
          content = encodeURIComponent(content);
          // alert(content);
          img = response.img;

          // alert(img);
          var img_src;
          for (var i=0;i<img.length;i++) {
            img_src += '<a href="'+img[i]+'" class="img_product" download><img src="'+img[i]+'" width="100"></a>';
          }

          document.getElementById("img").innerHTML = img_src;

          /////////////////////////////
          img_content = response.img_content;
          // alert(img_content);

          var img_src_content;
          for (var i=0;i<img_content.length;i++) {
            var http = img_content[i].substring(0, 4);//alert(http);
            if (http != 'http') {
              img_content[i] = 'http:'+img_content[i];
            }
            img_src_content += '<a href="'+img_content[i]+'" class="img_content" download><img src="'+img_content[i]+'" width="100"></a>';
          }

          document.getElementById("img-content").innerHTML = img_src_content;
          /////////////////////////////
          const xhttp = new XMLHttpRequest();
          xhttp.onload = function() {
            // document.getElementById("demo").innerHTML = this.responseText;
             alert(this.responseText);
            }
          // xhttp.open("GET", "http://taobao1.cafelink.org/extension/product.php?name="+name+"&price="+price+"&des="+des1+"&content="+content, true);
          // xhttp.send();
          xhttp.open("POST", "http://taobao1.cafelink.org/extension/product.php");
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send("name="+name+"&price1="+price1+"&price2="+price2+"&des="+des1+"&content="+content+"&img="+img);
        });
      });
  }, false);

  var checkButton1 = document.getElementById('anh_chinh');
  checkButton1.addEventListener('click', function() {
    var img_chinh = document.getElementsByClassName('img_product');
    // alert(img_chinh.length);
    for (var i=0;i<img_chinh.length;i++) {
      img_chinh[i].click();
    }
    // alert('end');
  }, false);

  var checkButton2 = document.getElementById('anh_content');
  checkButton2.addEventListener('click', function() {
    var img_content = document.getElementsByClassName('img_content');
    // alert(img_content.length);
    for (var i=0;i<img_content.length;i++) {
      img_content[i].click();
    }
    // alert('end');
  }, false);

}, false);