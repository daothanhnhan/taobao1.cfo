<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td valign="top" width="8%">U</td>
<td valign="top" width="8%"></td>
<td valign="top" width="8%"></td>
<td valign="top" width="10%"></td>
<td valign="top" width="9%"></td>
<td valign="top" width="53%"><b>HOẠT ĐỘNG CỦA CÁC TỔ CHỨC VÀ CƠ QUAN QUỐC TẾ</b></td>
</tr>
<tr>
<td valign="top" width="8%"></td>
<td valign="top" width="8%">99</td>
<td valign="top" width="8%">990</td>
<td valign="top" width="10%">9900</td>
<td valign="top" width="9%">99000</td>
<td valign="top" width="53%">Hoạt động của các tổ chức và cơ quan quốc tế</td>
</tr>
</tbody>
</table>

<script>
	function get_tr () {
		var tr = document.getElementsByTagName("tr");
		var cap = 0;
		var code = '';
		alert(tr.length);
		for (var i = 1;i<tr.length;i++) {
			var td = tr[i].getElementsByTagName("td");
			var cot_1 = td[0].innerText;
			var cot_2 = td[1].innerText;
			var cot_3 = td[2].innerText;
			var cot_4 = td[3].innerText;
			var cot_5 = td[4].innerText;

			cot_1 = cot_1.trim();
			cot_2 = cot_2.trim();
			cot_3 = cot_3.trim();
			cot_4 = cot_4.trim();
			cot_5 = cot_5.trim();

			if (cot_1 != '') {
				cap = 1;
				code = cot_1;
			} else {
				if (cot_2 != '') {
					cap = 2;
					code = cot_2;
				} else {
					if (cot_3 != '') {
						cap = 3;
						code = cot_3;
					} else {
						if (cot_4 != '') {
							cap = 4;
							code = cot_4;
						} else {
							cap = 5;
							code = cot_5;
						}
					}
				}
			}
			// alert(code);
			// alert(cap);
			// alert(td.length);
			// alert(td[5].innerHTML);
			// alert(td[5].innerText);
			var name = td[5].innerText;
			const xhttp = new XMLHttpRequest();
			  xhttp.onload = function() {
			    // document.getElementById("demo").innerHTML = this.responseText;
			    	// alert(this.responseText);
			    }
			  xhttp.open("GET", "ajax/cao1.php?cap="+cap+"&code="+code+"&name="+name, true);
			  xhttp.send();
		}
	}
	get_tr();
</script>