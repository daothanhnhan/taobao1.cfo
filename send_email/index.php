<?php 
	include_once 'phpmailer/class.smtp.php';
    include_once 'phpmailer/class.phpmailer.php';

	function email_send ($email_to, $title = "", $content = "") {
                $nFrom = "xdCAD";    //mail duoc gui tu dau, thuong de ten cong ty ban
                $mFrom = 'xdvietnam.com@gmail.com';  //dia chi email cua ban 
                $mPass = 'swryqzrmnakhwkdt';       //mat khau email cua ban
                $nTo = 'You'; //Ten nguoi nhan
                //$mTo = $_POST['email_dichvu'];   //dia chi nhan mail
                $mTo = $email_to;
                $mail             = new PHPMailer();
                //$body             = "<p>Kế toán thuế trọn gói: $ktttg</p><p>Kê khai thuế online: $kktol</p><p>Rà soát sổ sách: $rsss</p><p>Hoàn thiện sổ sách: $htss</p><p>Quyết toán thuế: $qtt</p>";   // Noi dung email
                //$title = 'Thông tin khách hàng từ '.SITE_NAME;   //Tieu de gui mail
                $mail->IsSMTP();             
                $mail->CharSet  = "utf-8";
                $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
                $mail->SMTPAuth   = true;    // enable SMTP authentication
                $mail->SMTPSecure = "tls";   // sets the prefix to the servier
                $mail->Host       = "smtp.gmail.com";    // sever gui mail.
                $mail->Port       = 587;         // cong gui mail de nguyen
                // xong phan cau hinh bat dau phan gui mail
                $mail->Username   = $mFrom;  // khai bao dia chi email
                $mail->Password   = $mPass;              // khai bao mat khau
                $mail->SetFrom($mFrom, $nFrom);
                $mail->AddReplyTo('xdvietnam.com@gmail.com', 'Phản Hồi Ý Kiến Khách Hàng'); //khi nguoi dung phan hoi se duoc gui den email nay
                $mail->Subject    = $title;// tieu de email 
                $mail->MsgHTML($content);// noi dung chinh cua mail se nam o day.
                $mail->AddAddress($mTo, $nTo);
                // $mail->AddAddress('truongquangtuan3110@gmail.com');
                // $mail->AddAddress('doxevip.com@gmail.com');

                $mail->Send();
        }

    function email_send_1 ($email_to, $title = "", $content = "") {
                $nFrom = "cafelink.org";    //mail duoc gui tu dau, thuong de ten cong ty ban
                $mFrom = 'kinhdoanh@cafelink.org';  //dia chi email cua ban 
                $mPass = 'cafeLink@68$';       //mat khau email cua ban
                $nTo = 'YOU'; //Ten nguoi nhan
                //$mTo = $_POST['email_dichvu'];   //dia chi nhan mail
                $mTo = $email_to;
                $mail             = new PHPMailer();
                //$body             = "<p>Kế toán thuế trọn gói: $ktttg</p><p>Kê khai thuế online: $kktol</p><p>Rà soát sổ sách: $rsss</p><p>Hoàn thiện sổ sách: $htss</p><p>Quyết toán thuế: $qtt</p>";   // Noi dung email
                //$title = 'Nguyên Anh Tax kính gửi';   //Tieu de gui mail
                $mail->IsSMTP();             
                $mail->CharSet  = "utf-8";
                $mail->SMTPDebug  = 3;   // enables SMTP debug information (for testing)
                $mail->SMTPAuth   = true;    // enable SMTP authentication
                $mail->SMTPSecure = "tls";   // sets the prefix to the servier
                $mail->Host       = "smtp.zoho.com";    // sever gui mail.
                $mail->Port       = 587;         // cong gui mail de nguyen
                // xong phan cau hinh bat dau phan gui mail
                $mail->Username   = $mFrom;  // khai bao dia chi email
                $mail->Password   = $mPass;              // khai bao mat khau
                $mail->SetFrom($mFrom, $nFrom);
                $mail->AddReplyTo('kinhdoanh@cafelink.org', 'me'); //khi nguoi dung phan hoi se duoc gui den email nay
                $mail->Subject    = $title;// tieu de email 
                $mail->MsgHTML($content);// noi dung chinh cua mail se nam o day.
                $mail->AddAddress($mTo, $nTo);
                // $mail->AddAddress('kinhdoanh@cafelink.org');

                $mail->Send();
        }

    function email_send_2 ($email_to, $title = "", $content = "") {
                $nFrom = "test send email";    //mail duoc gui tu dau, thuong de ten cong ty ban
                $mFrom = 'chonhatot.com@gmail.com';  //dia chi email cua ban 
                $mPass = 'iympyghlzqfogluq';       //mat khau email cua ban
                $nTo = 'You'; //Ten nguoi nhan
                //$mTo = $_POST['email_dichvu'];   //dia chi nhan mail
                $mTo = $email_to;
                $mail             = new PHPMailer();
                //$body             = "<p>Kế toán thuế trọn gói: $ktttg</p><p>Kê khai thuế online: $kktol</p><p>Rà soát sổ sách: $rsss</p><p>Hoàn thiện sổ sách: $htss</p><p>Quyết toán thuế: $qtt</p>";   // Noi dung email
                //$title = 'Thông tin khách hàng từ '.SITE_NAME;   //Tieu de gui mail
                $mail->IsSMTP();             
                $mail->CharSet  = "utf-8";
                $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
                $mail->SMTPAuth   = true;    // enable SMTP authentication
                $mail->SMTPSecure = "tls";   // sets the prefix to the servier
                $mail->Host       = "smtp.gmail.com";    // sever gui mail.
                $mail->Port       = 587;         // cong gui mail de nguyen
                // xong phan cau hinh bat dau phan gui mail
                $mail->Username   = $mFrom;  // khai bao dia chi email
                $mail->Password   = $mPass;              // khai bao mat khau
                $mail->SetFrom($mFrom, $nFrom);
                $mail->AddReplyTo('xdvietnam.com@gmail.com', 'Phản Hồi Ý Kiến Khách Hàng'); //khi nguoi dung phan hoi se duoc gui den email nay
                $mail->Subject    = $title;// tieu de email 
                $mail->MsgHTML($content);// noi dung chinh cua mail se nam o day.
                $mail->AddAddress($mTo, $nTo);
                // $mail->AddAddress('truongquangtuan3110@gmail.com');
                // $mail->AddAddress('doxevip.com@gmail.com');

                $mail->Send();
        }

    function email_send_3 ($email_to, $title = "", $content = "") {
                $nFrom = "test send email";    //mail duoc gui tu dau, thuong de ten cong ty ban
                $mFrom = 'hotrobatdongsan368@gmail.com';  //dia chi email cua ban 
                $mPass = 'bydnfihasjtlktsy';       //mat khau email cua ban
                $nTo = 'You'; //Ten nguoi nhan
                //$mTo = $_POST['email_dichvu'];   //dia chi nhan mail
                $mTo = $email_to;
                $mail             = new PHPMailer();
                //$body             = "<p>Kế toán thuế trọn gói: $ktttg</p><p>Kê khai thuế online: $kktol</p><p>Rà soát sổ sách: $rsss</p><p>Hoàn thiện sổ sách: $htss</p><p>Quyết toán thuế: $qtt</p>";   // Noi dung email
                //$title = 'Thông tin khách hàng từ '.SITE_NAME;   //Tieu de gui mail
                $mail->IsSMTP();             
                $mail->CharSet  = "utf-8";
                $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
                $mail->SMTPAuth   = true;    // enable SMTP authentication
                $mail->SMTPSecure = "tls";   // sets the prefix to the servier
                $mail->Host       = "smtp.gmail.com";    // sever gui mail.
                $mail->Port       = 587;         // cong gui mail de nguyen
                // xong phan cau hinh bat dau phan gui mail
                $mail->Username   = $mFrom;  // khai bao dia chi email
                $mail->Password   = $mPass;              // khai bao mat khau
                $mail->SetFrom($mFrom, $nFrom);
                $mail->AddReplyTo('xdvietnam.com@gmail.com', 'Phản Hồi Ý Kiến Khách Hàng'); //khi nguoi dung phan hoi se duoc gui den email nay
                $mail->Subject    = $title;// tieu de email 
                $mail->MsgHTML($content);// noi dung chinh cua mail se nam o day.
                $mail->AddAddress($mTo, $nTo);
                // $mail->AddAddress('truongquangtuan3110@gmail.com');
                // $mail->AddAddress('doxevip.com@gmail.com');

                $mail->Send();
        }

    function email_send_4 ($email_to, $title = "", $content = "") {
                $nFrom = "test send email học viện nexthome";    //mail duoc gui tu dau, thuong de ten cong ty ban
                $mFrom = 'hocviennh.edu@gmail.com';  //dia chi email cua ban 
                $mPass = 'bmspfaquizjxnher';       //mat khau email cua ban
                $nTo = 'You'; //Ten nguoi nhan
                //$mTo = $_POST['email_dichvu'];   //dia chi nhan mail
                $mTo = $email_to;
                $mail             = new PHPMailer();
                //$body             = "<p>Kế toán thuế trọn gói: $ktttg</p><p>Kê khai thuế online: $kktol</p><p>Rà soát sổ sách: $rsss</p><p>Hoàn thiện sổ sách: $htss</p><p>Quyết toán thuế: $qtt</p>";   // Noi dung email
                //$title = 'Thông tin khách hàng từ '.SITE_NAME;   //Tieu de gui mail
                $mail->IsSMTP();             
                $mail->CharSet  = "utf-8";
                $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
                $mail->SMTPAuth   = true;    // enable SMTP authentication
                $mail->SMTPSecure = "tls";   // sets the prefix to the servier
                $mail->Host       = "smtp.gmail.com";    // sever gui mail.
                $mail->Port       = 587;         // cong gui mail de nguyen
                // xong phan cau hinh bat dau phan gui mail
                $mail->Username   = $mFrom;  // khai bao dia chi email
                $mail->Password   = $mPass;              // khai bao mat khau
                $mail->SetFrom($mFrom, $nFrom);
                $mail->AddReplyTo('xdvietnam.com@gmail.com', 'Phản Hồi Ý Kiến Khách Hàng'); //khi nguoi dung phan hoi se duoc gui den email nay
                $mail->Subject    = $title;// tieu de email 
                $mail->MsgHTML($content);// noi dung chinh cua mail se nam o day.
                $mail->AddAddress($mTo, $nTo);
                // $mail->AddAddress('truongquangtuan3110@gmail.com');
                // $mail->AddAddress('doxevip.com@gmail.com');

                $mail->Send();
        }

        function email_send_5 ($email_to, $title = "", $content = "") {
                $nFrom = "test send email 100pic.top";    //mail duoc gui tu dau, thuong de ten cong ty ban
                $mFrom = 'info@100pic.top';  //dia chi email cua ban 
                $mPass = 'btfukmerbqmxkvms';       //mat khau email cua ban
                $nTo = 'You'; //Ten nguoi nhan
                //$mTo = $_POST['email_dichvu'];   //dia chi nhan mail
                $mTo = $email_to;
                $mail             = new PHPMailer();
                //$body             = "<p>Kế toán thuế trọn gói: $ktttg</p><p>Kê khai thuế online: $kktol</p><p>Rà soát sổ sách: $rsss</p><p>Hoàn thiện sổ sách: $htss</p><p>Quyết toán thuế: $qtt</p>";   // Noi dung email
                //$title = 'Thông tin khách hàng từ '.SITE_NAME;   //Tieu de gui mail
                $mail->IsSMTP();             
                $mail->CharSet  = "utf-8";
                $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
                $mail->SMTPAuth   = true;    // enable SMTP authentication
                $mail->SMTPSecure = "tls";   // sets the prefix to the servier
                $mail->Host       = "smtp.gmail.com";    // sever gui mail.
                $mail->Port       = 587;         // cong gui mail de nguyen
                // xong phan cau hinh bat dau phan gui mail
                $mail->Username   = $mFrom;  // khai bao dia chi email
                $mail->Password   = $mPass;              // khai bao mat khau
                $mail->SetFrom($mFrom, $nFrom);
                $mail->AddReplyTo('xdvietnam.com@gmail.com', 'Phản Hồi Ý Kiến Khách Hàng'); //khi nguoi dung phan hoi se duoc gui den email nay
                $mail->Subject    = $title;// tieu de email 
                $mail->MsgHTML($content);// noi dung chinh cua mail se nam o day.
                $mail->AddAddress($mTo, $nTo);
                // $mail->AddAddress('truongquangtuan3110@gmail.com');
                // $mail->AddAddress('doxevip.com@gmail.com');

                $mail->Send();
        }

        function email_send_6 ($email_to, $title = "", $content = "") {
                $nFrom = "test send email xe điện dak lak";    //mail duoc gui tu dau, thuong de ten cong ty ban
                $mFrom = 'thanhthong.211@gmail.com';  //dia chi email cua ban 
                $mPass = 'btfukmerbqmxkvms';       //mat khau email cua ban
                $nTo = 'You'; //Ten nguoi nhan
                //$mTo = $_POST['email_dichvu'];   //dia chi nhan mail
                $mTo = $email_to;
                $mail             = new PHPMailer();
                //$body             = "<p>Kế toán thuế trọn gói: $ktttg</p><p>Kê khai thuế online: $kktol</p><p>Rà soát sổ sách: $rsss</p><p>Hoàn thiện sổ sách: $htss</p><p>Quyết toán thuế: $qtt</p>";   // Noi dung email
                //$title = 'Thông tin khách hàng từ '.SITE_NAME;   //Tieu de gui mail
                $mail->IsSMTP();             
                $mail->CharSet  = "utf-8";
                $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
                $mail->SMTPAuth   = true;    // enable SMTP authentication
                $mail->SMTPSecure = "tls";   // sets the prefix to the servier
                $mail->Host       = "smtp.gmail.com";    // sever gui mail.
                $mail->Port       = 587;         // cong gui mail de nguyen
                // xong phan cau hinh bat dau phan gui mail
                $mail->Username   = $mFrom;  // khai bao dia chi email
                $mail->Password   = $mPass;              // khai bao mat khau
                $mail->SetFrom($mFrom, $nFrom);
                $mail->AddReplyTo('xdvietnam.com@gmail.com', 'Phản Hồi Ý Kiến Khách Hàng'); //khi nguoi dung phan hoi se duoc gui den email nay
                $mail->Subject    = $title;// tieu de email 
                $mail->MsgHTML($content);// noi dung chinh cua mail se nam o day.
                $mail->AddAddress($mTo, $nTo);
                // $mail->AddAddress('truongquangtuan3110@gmail.com');
                // $mail->AddAddress('doxevip.com@gmail.com');

                $mail->Send();
        }

    // email_send('truongquangtuan3110@gmail.com', 'Tiêu đề', 'Nội dung');
    // email_send_1('truongquangtuan3110@gmail.com', 'Tiêu đề', 'Nội dung');
    // email_send_2('truongquangtuan3110@gmail.com', 'Tiêu đề', 'Nội dung');
    // email_send_3('truongquangtuan3110@gmail.com', 'Tiêu đề', 'Nội dung');
    // email_send_4('truongquangtuan3110@gmail.com', 'Tiêu đề', 'Nội dung');
    // email_send_5('truongquangtuan3110@gmail.com', 'Tiêu đề', 'Nội dung');