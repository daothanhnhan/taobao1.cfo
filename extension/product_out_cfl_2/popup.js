// popup.js

var des = '';
var name = '';
const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
  // document.getElementById("demo").innerHTML = this.responseText;
    // alert(this.responseText);
    var obj = JSON.parse(this.responseText);
    // alert(obj.name);
    name = obj.name;
    des = obj.des;
    note = obj.note;
    price = obj.price;
    price_sale = obj.price_sale;
    list_danh_muc = obj.list_danh_muc;
    list_anh = obj.image;
    image_content = obj.image_content;
  }

xhttp.open("POST", "http://taobao1.cafelink.org/extension/product_out.php");
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send("name=tuan");

// alert(name);

document.addEventListener('DOMContentLoaded', function() {
  var checkButton = document.getElementById('check');
  checkButton.addEventListener('click', function() {
    chrome.tabs.query({active: true, currentWindow: true}, function(tabs) {
        chrome.tabs.sendMessage(tabs[0].id, {method: "changePage", name: name, des: des, note: note, price: price, price_sale: price_sale, list_danh_muc: list_danh_muc, list_anh: list_anh, image_content: image_content}, function(response) {
          if(response.method == "changePage"){
            // alert("Succeeded with "+response.method);
          }
          
        });
      });
  }, false);
}, false);