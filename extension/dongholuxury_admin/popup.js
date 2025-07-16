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
          // var name = response.text;//alert(name);
          // var price1 = response.price1;
          // var price2 = response.price2;
          // var des1 = response.des;
          var code1 = response.code;
          // alert(code1.length);
          // alert(code1);
          // var code_arr = [];
          // for (var i=40;i<code1.length;i++) {
          //   if (code1[i] == 'https://dongholuxury.vn/?post_type=product') {
          //     alert('link');
          //     continue;
          //   }
          //   code_arr.push(code1[i]);
          // }
          // alert(code_arr.length);
          var code_2 = JSON.stringify(code1);
          // alert(code_2);
          // alert('database');
          // alert(code);
          // des1 = des1.substr(2);
          // des1 = '<h1>text</h1>';
          
          var name = 'tuan';
          var price1 = '';
          var price2 = '';
          var des1 = '';
          var content = '';
          var img = '';
          alert('end');
          /////////////////////////////
          const xhttp = new XMLHttpRequest();
          xhttp.onload = function() {
            // document.getElementById("demo").innerHTML = this.responseText;
             alert(this.responseText);
            }
          // xhttp.open("GET", "http://taobao1.cafelink.org/extension/product.php?name="+name+"&price="+price+"&des="+des1+"&content="+content, true);
          // xhttp.send();
          xhttp.open("POST", "http://taobao1.cafelink.org/extension/product/product_admin1.php");
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send("name="+name+"&price1="+price1+"&price2="+price2+"&des="+des1+"&content="+content+"&img="+img+"&code="+code_2);
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