// content.js
chrome.runtime.onMessage.addListener(
    function(request, sender, sendResponse) {
        if(request.method == "changePage"){
            // document.body.innerText = "Foot";
            // sendResponse({text: "hello", method: "changePage"}); //same as innerText
            var h2 = document.getElementsByTagName("h1")[0];
            // alert(h2.innerHTML);


            var des = document.getElementsByClassName("doc-content")[0];
            // alert(des.innerHTML.replaceAll(/\s/g,''));
            // des = des.innerHTML.replaceAll(/\t/g,'');
            // document.body.innerHTML = des;
            // alert(des);
            // var des_1 = des.getElementsByClassName("tdw-block-inner")[0];
            // alert(des);
            des = des.innerHTML.replaceAll(/\t/g,'');
            // alert(des);

            var img_content = des.match(/<img [^>]*src="[^"]*"[^>]*>/gm);
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

            var the_p = document.getElementsByTagName('p');
            // alert(the_p.length);
            var mo_ta = '';
            var the_alt = [];
            for (var i=0;i<the_p.length;i++) {
                  // alert(the_p[i].innerText);
                  // break;
                  if (the_p[i].innerText.search('Thẻ mô tả') === -1) {
                        
                  } else {
                        mo_ta = the_p[i].innerText;
                  }

                  if (the_p[i].innerText.search('Thẻ alt') === -1) {
                        
                  } else {
                       the_alt.push(the_p[i].innerText);
                  }
            }
            // alert(mo_ta);
            // alert(the_alt);
            // alert(des);

            var content = des.replaceAll(h2.innerHTML, '');

            content = content.replaceAll(/<h1\s[^>]*><\/h1>/g, '');
            content = content.replaceAll(mo_ta, '');
            // alert(content);

            // var b = document.getElementsByClassName('c0');
            var b = document.getElementsByClassName('c0');
            // alert(b.length);
            // alert(b[0].style.fontWeight);

            var computedFontSize = window.getComputedStyle(document.getElementsByClassName('c0')[0]).fontWeight;
            // alert(computedFontSize);

            var arr_b = [];
            var text_b = '';
            for (var i=0;i<b.length;i++) {
              arr_b.push(b[i].innerText);
              // text_b = '<b>' + b[i].innerText + '</b>';
              // content = content.replaceAll(b[i].innerText, text_b);
            }
            // alert(arr_b);
            // alert(content);

            var b_1 = document.getElementsByClassName('c7');
            // alert(b_1.length);

            for (var i=0;i<b_1.length;i++) {
              arr_b.push(b_1[i].innerText);
              // text_b = '<b>' + b[i].innerText + '</b>';
              // content = content.replaceAll(b[i].innerText, text_b);
            }

            // alert(arr_b.length);

            

            var lop = [];
            var lop_co = '';
            for (var i=0;i<=15;i++) {
                var lop_co = document.getElementsByClassName('c'+i);
                // alert(lop_co.length);
                if (lop_co.length != 0) {
                  lop.push('c'+i);
                }
            }
            // alert(lop);

            var weight = '';
            var lop_1 = '';
            var lop_arr = [];
            for (var i=0;i<lop.length;i++) {
              lop_1 = lop[i];
              weight = window.getComputedStyle(document.getElementsByClassName(lop_1)[0]).fontWeight;
              if (weight == 700) {
                lop_arr.push(lop_1);
              }
            }
            // alert(lop_arr);

            var ten_lop = '';
            var arr_b = [];
            for (var i=0;i<lop_arr.length;i++) {
              ten_lop = lop_arr[i];
              var b_2 = document.getElementsByClassName(ten_lop);

              for (var j=0;j<b_2.length;j++) {
                arr_b.push(b_2[j].innerText);

              }
            }


            let result = [];
            result = arr_b.filter(function(element){
              return result.includes(element) ? '' : result.push(element)
            });
            // alert(result.length);

            for (var i=0;i<result.length;i++) {
              text_b = '<b>' + result[i] + '</b>';
              // alert(text_b);
              content = content.replaceAll(result[i], text_b);
            }

            // alert(content);

            

			sendResponse({mo_ta: mo_ta, the_alt: the_alt, text: h2.innerText, content: content, img_content: arr_img_content, method: "changePage"});
        }
        // sendResponse({text: "123", method: "changePage"});
    }
);
// alert('content');