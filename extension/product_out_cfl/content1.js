// content.js
// CKEDITOR.instances.editor1.destroy();
chrome.runtime.onMessage.addListener(
    function(request, sender, sendResponse) {
        if(request.method == "changePage"){

        	var element = document.getElementById("editor1");
  			element.classList.remove("ckeditor");
            
			document.getElementById("title").value = request.name;
			// CKEDITOR.instances.editor1.insertHtml( '<p>This is a new paragraph.</p>' );
			// CKEDITOR.instances['editor1'].insertHtml('<p>This is a new paragraph.</p>');
			CKEDITOR.instances['editor1'].setData('<p>123</p>');
			var des = document.querySelectorAll("textarea[name='page_des']")[0];
			// des.value = request.des;
			var content = document.querySelectorAll("textarea[name='page_content']")[0];
			// content.value = '<p>abc</p>';



			CKEDITOR.instances.editor1.destroy();

			document.getElementById("cke_editor1").innerHTML = '';
			document.getElementById("editor1").innerHTML = '<p>1234</p>';



			var editor1 = document.getElementById("editor1");
			editor1.setAttribute("name", "1");

			var input = document.createElement('input'); 
			input.type = "text"; 
			//...    
			editor1.parentNode.appendChild(input);


			document.getElementsByClassName("cke_source")[0].value = request.des;

			// var editor = CKEDITOR.instances['editor1'];
			// var get1 = editor.getData();
			// alert(get1);
			alert('end');
        }
        // sendResponse({text: "123", method: "changePage"});
    }
);
// alert('content');