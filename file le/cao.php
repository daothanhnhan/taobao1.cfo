<form action="" method="get" accept-charset="utf-8">
  <input type="text" name="link">
  <button type="submit">submit</button>
</form>
<?php 
    $link = $_GET['link'];
    if (strpos($link, 'taobao.com')) {
      $url = $link;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
        $html = curl_exec($ch);
        curl_close($ch);
        var_dump($html);

        preg_match_all('~<ul id="J_UlThumb" class="tb-thumb tb-clearfix">\K.*(?=</ul>)~Uis', $html, $matches);
        $ul = $matches[0][0];//var_dump($ul);

        preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $ul, $ul1);//var_dump($ul1);
        $d = 0;
        $anh_arr = array();
        foreach ($ul1[1] as $element) {
            $anh = str_replace('50x50', '430x430', $element);
            $anh_duoi = explode("jpg_", $anh);
            $anh = $anh_duoi[0].'jpg';
            $anh_arr[] = $anh;
            // foreach ($img as $e1) {
                $d++;
            // }
        }

        preg_match_all('~<dl class="J_Prop tb-prop tb-clear  J_Prop_Color ">\K.*(?=</dl>)~Uis', $html, $matches5);
        // $ul = $matches[0][0];var_dump($ul);

        preg_match_all('/data-value="([^"]*)"/ism', $matches5[0][0], $so);
        // var_dump($so);

        // preg_match_all('/style="([^"]*)"/ism', $matches5[0][0], $anh1);//
        $anh1 = array();
        $anh4 = explode("<li", $matches5[0][0]);
        unset($anh4[0]);
        foreach ($anh4 as $item) {
          if (strpos($item,'class="tb-txt"')) {
            $anh1[] = 'no-image.jpg';
          } else {
            preg_match_all('/style="([^"]*)"/ism', $item, $anh11);
            $anh1[] = $anh11[1][0];
          }
        }
        // var_dump($anh1);
        $anh_arr1 = array();
        foreach ($anh1 as $item) {
          $anh3 = str_replace('30x30', '430x430', $item);
          $anh3 = str_replace('background:url(', '', $anh3);
          $anh3 = str_replace(') center no-repeat;', '', $anh3);

          $anh_duoi = explode("jpg_", $anh3);
          $anh3 = $anh_duoi[0].'jpg';
          $anh_arr1[] = $anh3;
        }

        preg_match_all('/skuMap(.*):false}}/i', $html, $matches6);//var_dump($matches6[1][0]);
        $gia = explode('skuId":', $matches6[1][0]);//var_dump($gia);

        $gia1 = array();
        foreach ($so[1] as $item) {
          foreach ($gia as $item1) {
            if (strpos($item1, $item)) {
              preg_match_all('/price(.*)stock/i', $item1, $matches8);
              $gia1[] = $matches8[1][0];
            }
          }
        }
        // var_dump($gia1);

        $gia_show = 0;
        preg_match_all('/<em class="tb-rmb-num">(.*)<\/em>/Uis', $html, $matches_gia_show);//var_dump($matches_gia_show);
        $gia_show = str_replace(".", "", $matches_gia_show[1][0]);var_dump($gia_show);


        $ten = array();
        foreach ($anh4 as $item) {
          preg_match_all('~<span>\K.*(?=</span>)~Uis', $item, $ten1);
          // var_dump($item);
          // var_dump($ten1);
            $ten[] = mb_convert_encoding($ten1[0][0], "UTF-8", "GBK");
        }
        // var_dump($ten);


        preg_match_all('~<div id="attributes" class="attributes">\K.*(?=</ul>)~Uis', $html, $matches9);//var_dump($matches9);
        $des1 = mb_convert_encoding($matches9[0][0], "UTF-8", "GBK");//var_dump($des1);

        preg_match_all('/<h3 class="tb-main-title" data-title="[^"]*">(.*)<\/h3>/Uis', $html, $matches2);//var_dump($matches2);

        $text = str_replace(' ', '', $matches2[1][0]);
        $text = mb_convert_encoding($text, "UTF-8", "GBK");//echo $text;

        preg_match_all('/\'video\'(.*)"0"}\);/iUs', $html, $matches3);//var_dump($matches3);
        // var_dump($matches3[1]);//echo '<br>';
        // var_dump($matches3[1][0]);//echo '<br>';
        if (empty($matches3[0])) {
          $video = 'mp4';
        } else {
          $video_a = $matches3[1][0];
          preg_match_all('/videoId(.*)autoplay/', $video_a, $video1);
          preg_match_all('/videoOwnerId(.*)videoStatus/', $video_a, $video2);
          $video1 = str_replace('":"', "", $video1[1][0]);
          $video1 = str_replace('","', "", $video1);
          $video2 = str_replace('":"', "", $video2[1][0]);
          $video2 = str_replace('","', "", $video2);
          // $video = str_replace('":"', "", $video);
          // $video = str_replace('p/1/e/1/t/8', "p/1/e/6/t/1", $video);
          // $video = $video."mp4";
          $video = 'https://cloud.video.taobao.com/play/u/'.$video2.'/p/2/e/6/t/1/'.$video1.'.mp4';
        }
        

        preg_match_all('/descUrl(.*)descnew/Uis', $html, $matches4);//var_dump($matches4);
        preg_match_all('/\/\/dscnew.taobao.com(.*):/', $matches4[1][0], $matches4_1);//var_dump($matches4_1);
        $des = str_replace('//', "", $matches4_1[0][0]);
        $des = str_replace('\' :', "", $des);
        // var_dump($des);
        if (empty($des)) {  
          preg_match_all('/itemcdn(.*):/Uis', $html, $matches41);var_dump($matches41);
          $des = str_replace("c' :", "", $matches41[0][0]);
        }

        $url1 = $des;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
        $html1 = curl_exec($ch);
        curl_close($ch);
        // var_dump($html1);
        $html1 = mb_convert_encoding($html1, "UTF-8", "GBK");





//         $html = file_get_html($link);//var_dump($html);
//         $d = 0;
//         $ul = $html->find('#J_UlThumb');
//         foreach ($ul as $element) {
//             $img = $element->find('img');
//             foreach ($img as $e1) {
//                 $d++;
//             }
//         }
// // var_dump($ul);
//         $anh_arr = array();
//         for ($i=0; $i < $d; $i++) { 
//             $anh = $html->getElementById("J_UlThumb")->childNodes($i)->childNodes(0)->childNodes(0)->childNodes(0)->getAttribute('data-src');//echo '<br>';
//             $anh = str_replace('50x50', '400x400', $anh);
//             $anh_arr[] = $anh;
//             if ($i==0) {
//               $img_main = $anh;
//             }
//         }
//         //////////////
//         $price = $html->find('.tb-rmb-num', 0)->plaintext;//$ $p->plaintext;
//         ///////////////
//         $title = $html->find('#J_Title', 0);
//         $text = $title->plaintext;
//         $text = str_replace(' ', '', $text);
//         $text = trim($text);
//         $text = mb_convert_encoding($text, "UTF-8", "GBK");
//         $link_tsl = 'https://translate.yandex.net/api/v1.5/tr/translate?key=trnsl.1.1.20180809T113751Z.8d856990ff3511bf.475fc4889b6ca84c685472188a127f551e19bce7&text='.$text.'&lang=zh-vi&format=plain&options=0';
//         $html = file_get_html($link_tsl);
//         $name_tsl = $html->plaintext;
//         $name_tsl = str_replace('<?xml version="1.0" encoding="utf-8"', '', $name_tsl);
    } elseif (strpos($link, '1688.com')) {
        $url = $link;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
        $html = curl_exec($ch);
        curl_close($ch);
        // print $html;

        preg_match_all('~<ul class="nav nav-tabs fd-clr">\K.*(?=</ul>)~Uis', $html, $matches);
        $ul = $matches[0][0];
        preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $ul, $img);
        $anh = $img['1'];
        $anh_arr = array();
        $d = 0;
        foreach ($anh as $item) {
          $d++;
          $src = str_replace('60x60', '400x400', $item);
          // echo '<img src="'.$src.'">';
          $anh_arr[] = $src;
          if ($d==1) {
            $img_main = $src;
          }          
        }
        ///////////////////
        preg_match_all('~<tr class="price">\K.*(?=</tr>)~Uis', $html, $matches);
        $tr = $matches[0][0];
        preg_match_all('~<span class="value price-length-.">\K.*(?=</span>)~Uis', $tr, $span);
        $price = $span[0][0];
        /////////////////////
        preg_match_all('~<h1 class="d-title">\K.*(?=</h1>)~Uis', $html, $title);
        $text = $title[0][0];
        $text = str_replace(' ', '', $text);
        $text = mb_convert_encoding($text, "UTF-8", "GBK");
        $link_tsl = 'https://translate.yandex.net/api/v1.5/tr/translate?key=trnsl.1.1.20180809T113751Z.8d856990ff3511bf.475fc4889b6ca84c685472188a127f551e19bce7&text='.$text.'&lang=zh-vi&format=plain&options=0';
        // echo $link_tsl;
        $html = file_get_html($link_tsl);
        $name_tsl = $html->plaintext;
        $name_tsl = str_replace('<?xml version="1.0" encoding="utf-8"?>', '', $name_tsl);
    } elseif (strpos($link, 'tmall.com')) {
        $url = $link;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
        $html = curl_exec($ch);
        curl_close($ch);
        var_dump($html);

        preg_match_all('~<ul id="J_UlThumb" class="tb-thumb tm-clear">\K.*(?=</ul>)~Uis', $html, $matches);
        $ul = $matches[0][0];//var_dump($ul);

        preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $ul, $ul1);//var_dump($ul1);
        $d = 0;
        $anh_arr = array();
        foreach ($ul1[1] as $element) {
            $anh = str_replace('60x60', '430x430', $element);
            $anh_duoi = explode("jpg_", $anh);
            $anh = $anh_duoi[0].'jpg';
            $anh_arr[] = $anh;
            // foreach ($img as $e1) {
                $d++;
            // }
        }

        preg_match_all('~<dl class="tb-prop tm-sale-prop tm-clear tm-img-prop ">\K.*(?=</dl>)~Uis', $html, $matches5);
        // $ul = $matches[0][0];var_dump($ul);

        preg_match_all('/data-value="([^"]*)"/ism', $matches5[0][0], $so);
        // var_dump($so);

        preg_match_all('/style="([^"]*)"/ism', $matches5[0][0], $anh1);
        // var_dump($anh1);
        $anh_arr1 = array();
        foreach ($anh1[1] as $item) {
          $anh3 = str_replace('40x40', '430x430', $item);
          $anh3 = str_replace('background:url(', '', $anh3);
          $anh3 = str_replace(') center no-repeat;', '', $anh3);

          $anh_duoi = explode("jpg_", $anh3);
          $anh3 = $anh_duoi[0].'jpg';
          $anh_arr1[] = $anh3;
        }
        var_dump($anh_arr1);

        preg_match_all('/skuMap(.*)salesProp/i', $html, $matches6);//var_dump($matches6[1][0]);
        $gia = explode('skuId":', $matches6[1][0]);//var_dump($gia);

        $gia1 = array();
        foreach ($so[1] as $item) {
          foreach ($gia as $item1) {
            if (strpos($item1, $item)) {
              preg_match_all('/priceCent(.*)price/i', $item1, $matches8);
              $a = $matches8[1][0];
              $a = str_replace('":', '', $a);
              $a = str_replace(',":', '', $a);
              $a = $a;
              $gia1[] = $a*60.75;
            }
          }
        }
        // var_dump($gia1);

        preg_match_all('~<span>\K.*(?=</span>)~Uis', $matches5[0][0], $ten1);//var_dump($ten1);
        $ten = array();
        foreach ($ten1[0] as $item) {
          
          // var_dump($item);
          // var_dump($ten1);
            $ten[] = mb_convert_encoding($item, "UTF-8", "GBK");
        }
        var_dump($ten);


        preg_match_all('~<div class="attributes-list" id="J_AttrList">\K.*(?=</ul>)~Uis', $html, $matches9);//var_dump($matches9);
        $des1 = mb_convert_encoding($matches9[0][0], "UTF-8", "GBK");//var_dump($des1);

        // preg_match_all('/propertyPics(.*)tmallRateType/i', $html, $matches7);var_dump($matches7);
        // var_dump($anh_arr1);
        // for ($i=0; $i < $d; $i++) {
        //   $anh = $html->getElementById("J_UlThumb")->childNodes($i)->childNodes(0)->childNodes(0)->getAttribute('src');//echo '<br>';
        //   $anh = str_replace('60x60', '430x430', $anh);
        //   // echo '<img src="'.$anh.'">';
        //   $anh_arr[] = $anh;
        //   if ($i==0) {
        //       $img_main = $anh;
        //   }
        // }
        ////////////////////////
        // $url = $link;
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
        // $html1 = curl_exec($ch);
        // curl_close($ch);
        // print $html;

        preg_match_all('/"defaultItemPrice":"[^a-z]*",/', $html, $matches1);
        // var_dump($matches1);
        // preg_match('/[0-9\.]+/', $matches1[0][0], $price);
        // var_dump((float)($price[0]/100));
        $price = str_replace('"defaultItemPrice":"', "", $matches1[0][0]);
        $price = str_replace('",', "", $price);
        ////////////////////
        // $div = $html->find('.tb-detail-hd')[0];
        // $h1 = $div->find('h1')[0];
        // $title = $h1->plaintext;
        preg_match_all('/<h1 data-spm="1000983">(.*)<\/h1>/Uis', $html, $matches2);//var_dump($matches2);

        $text = str_replace(' ', '', $matches2[1][0]);
        $text = mb_convert_encoding($text, "UTF-8", "GBK");//echo $text;
        $link_tsl = 'https://translate.yandex.net/api/v1.5/tr/translate?key=trnsl.1.1.20180809T113751Z.8d856990ff3511bf.475fc4889b6ca84c685472188a127f551e19bce7&text='.$text.'&lang=zh-vi&format=plain&options=0';

        // $html1 = file_get_html($link_tsl);
        // $name_tsl = $html1->plaintext;
        $name_tsl = str_replace('<?xml version="1.0" encoding="utf-8"?>', '', $name_tsl);
        ////////////////////////////
        preg_match_all('/imgVedioUrl(.*)swf/iUs', $html, $matches3);
        // var_dump($matches3[1]);//echo '<br>';
        // var_dump($matches3[1][0]);//echo '<br>';
        $video = $matches3[1][0];
        $video = str_replace('":"', "", $video);
        $video = str_replace('p/1/e/1/t/8', "p/1/e/6/t/1", $video);
        $video = $video."mp4";

        preg_match_all('/descUrl(.*)httpsDescUrl/Uis', $html, $matches4);//var_dump($matches4);
        $des = str_replace('":"//', "", $matches4[1][0]);
        $des = str_replace('","', "", $des);
        // var_dump($des);

        $url1 = $des;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
        $html1 = curl_exec($ch);
        curl_close($ch);
        // var_dump($html1);


    } elseif (strpos($link, 'aliexpress.com')) {
      
      // $link = "https://www.w3schools.com/videos/index.php";
      // $link = "https://login.aliexpress.ru/?flag=1&return_url=http%3A%2F%2Freport.aliexpress.com%2F%3Fspm%3Da2g0o.detail.1000001.7.2a7970d4EieXky";
      // $link = "http://vi.aliexpress.com";
      // $link = "http://vi.aliexpress.com";
      // $link = "https://cafelink.org";
      var_dump($link);
      $url = $link;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
      $html = curl_exec($ch);
      curl_close($ch);
      // var_dump($html);
      echo '<pre>';

      preg_match_all('/<script>(.*)<\/script>/Uis', $html, $matches2);var_dump($matches2[1][0]);

      $noi_dung = $matches2[1][0];
      $noi_dung = str_replace("window.runParams.is23 = true;", "", $noi_dung);
      $noi_dung = str_replace("window.runParams =", "", $noi_dung);

      $noi_dung = substr($noi_dung, 1);
      $noi_dung = trim($noi_dung);
      $noi_dung = substr($noi_dung, 2);

      $noi_dung = trim($noi_dung);

      // $noi_dung = str_replace(" ", "", $noi_dung);
      // $noi_dung = str_replace("\r\n", "", $noi_dung);
      // $noi_dung = str_replace("\n\r", "", $noi_dung);
      $noi_dung = str_replace("data:", "", $noi_dung);
      // $noi_dung = substr($noi_dung, 2);
      // $noi_dung = substr($noi_dung, 0, -2);

      $noi_dung = str_replace("window._d_c_ = window._d_c_ || {};", "", $noi_dung);
      $noi_dung = str_replace("window._d_c_.viewName = 'choiceDetail';", "", $noi_dung);
      $noi_dung = str_replace("window._d_c_.isCSR = fals", "", $noi_dung);
      $noi_dung = str_replace("window._d_c_.isCSR = true;", "", $noi_dung);

      $noi_dung = substr($noi_dung, 1);
      $noi_dung = trim($noi_dung);
      $noi_dung = substr($noi_dung, 2);

      $noi_dung = str_replace("window._d_c_.DCData = ", "", $noi_dung);
      $noi_dung = substr($noi_dung, 0, -1);

      $noi_dung = trim($noi_dung);
      // $noi_dung = substr($noi_dung, 0, -2);

      var_dump($noi_dung);

      // $a = json_decode('{"formatTradeCount":"600+","tradeCountUnit":"sold"}', true);var_dump($a);

      $noi_dung = json_decode($noi_dung, true);

      var_dump($noi_dung);

      $text = $noi_dung['productInfoComponent']['subject'];var_dump($text);

      $thuoc_tinh_id = $noi_dung['skuComponent']['skuPropertyJson'];
      $thuoc_tinh_id = json_decode($thuoc_tinh_id, true);
      var_dump($thuoc_tinh_id);

      var_dump($noi_dung['productInfoComponent']['subject']);
      var_dump($noi_dung['productDescComponent']['descriptionUrl']);
      var_dump($noi_dung['skuComponent']['productSKUPropertyList']);
      var_dump($noi_dung['priceComponent']['skuPriceList']);
      var_dump($noi_dung['imageComponent']['imagePathList'][0]);
      var_dump($noi_dung['videoComponent']);
      
      if (!empty($noi_dung['videoComponent'])) {
        $video_1 = $noi_dung['videoComponent']['videoUid'];
        $video_2 = $noi_dung['videoComponent']['videoId'];
        var_dump('https://video.aliexpress-media.com/play/u/ae_sg_item/'.$video_1.'/p/1/e/6/t/10301/'.$video_2.'.mp4');
      }
      

      $thuoc_tinh_id = $noi_dung['skuComponent']['skuPropertyJson'];var_dump($thuoc_tinh_id);

      $link_des = $noi_dung['productDescComponent']['descriptionUrl'];

      $url1 = $link_des;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
        $html1 = curl_exec($ch);
        curl_close($ch);

      var_dump($html1);

      /////////// end /////////////

      preg_match_all('/<title>(.*)<\/title>/Uis', $html, $matches2);
      $text = str_replace('', '', $matches2[1][0]);
      $text = explode("|", $text);
      $text = $text[0];

      preg_match_all('/imagePathList(.*)ImageModule/Uis', $html, $matches);
        $ul = $matches[1][0];//var_dump($matches);
        $ul = str_replace('":', "", $ul);
        $ul = str_replace(',"name"', "", $ul);
        // var_dump($ul);
        $ul = json_decode($ul);//var_dump($ul);
        $anh_arr = $ul;

      preg_match_all('/skuPriceList(.*)warrantyDetailJson/Uis', $html, $matches_1);
      $ul1 = $matches_1[1][0];
      $ul1 = substr($ul1, 2);
      $ul1 = substr($ul1, 0, -2);
      // var_dump($ul1);
      $ul1 = json_decode($ul1, true);//var_dump($ul1);

      preg_match_all('/productSKUPropertyList(.*)skuPriceList/Uis', $html, $matches_2);
      $ul2 = $matches_2[1][0];
      $ul2 = substr($ul2, 2);
      $ul2 = substr($ul2, 0, -2);
      // var_dump($ul2);
      $anh_arr1 = array();
      $ul2 = json_decode($ul2, true);
      
      // var_dump($ul2);

      $gia1 = array();
      $gia2 = array();
      $ten = array();

      preg_match_all('/SpecsModule(.*)storeModule/Uis', $html, $matches9);//var_dump($matches9);
      $des1 = explode('props', $matches9[1][0]);//var_dump($des1);
      $des1 = substr($des1[1], 2);
      $des1 = substr($des1[1], 2);
      // var_dump($des1);
      $des1 = json_decode($des1, true);//var_dump($des1);
      $des1_1 = '<ul>';
      foreach ($des1 as $item) {
        $des1_1 .= '<li>'.$item['attrName'].':'.$item['attrValue'].'</li>';
      }

      $des1_1 .= '</ul>';
      $des1 = $des1_1;
        // $des1 = mb_convert_encoding($matches9[0][0], "UTF-8", "GBK");//var_dump($des1);


      foreach ($ul2[0]['skuPropertyValues'] as $item) {
        $anh_arr1[] = $item['skuPropertyImagePath'];
        foreach ($ul1 as $item_1) {
          // $name = $item_1['skuAttr'];
          // $name = explode("#", $name);
          // $name = $name[1];
          // $name = explode(";", $name);
          // $name = $name[0];
          $prop_id = $item_1['skuPropIds'];
          if ($item['propertyValueId'] == $prop_id) {
            // $gia1[] = $item_1['skuVal']['actSkuCalPrice'];
            $gia1[] = $item_1['skuVal']['skuActivityAmount']['value'];
            $gia2[] = $item_1['skuVal']['skuMultiCurrencyDisplayPrice'];
            $ten[] = $item['propertyValueDisplayName'];
          }
        }
      }
      var_dump($gia1);
      // *1.65*23350
      //////////////////////
      // preg_match_all('/skuPropertyValues(.*)skuPriceList/Uis', $html, $matches_mau);//var_dump($matches_mau);
      // $mau = $matches_mau[1][0];
      // $mau = substr($mau, 2);
      // $mau = substr($mau, 0, -4);
      // $mau = json_decode($mau, true);
      // var_dump($mau);

      //////////////////////

      preg_match_all('/videoId(.*)videoUid/Uis', $html, $matches10);//var_dump($matches10);
      if (empty($matches10[0])) {
        $video = 'mp4';
      } else {
        preg_match_all('/videoUid(.*)installmentModule/Uis', $html, $matches12);//var_dump($matches12);
        $videou = $matches12[1][0];
        $videou = str_replace('":"', '', $videou);
        $videou = str_replace('"},"', '', $videou);
        $videou = '/'.$videou.'/';
        $video = $matches10[1][0];//var_dump($video);
        $video = str_replace('":', '', $video);
        $video = str_replace(',"', '', $video);
        $video = 'https://cloud.video.taobao.com/play/u/2201940393455/p/1/e/6/t/10301/'.$video.'.mp4';
        $video = str_replace('/2201940393455/', $videou, $video);
      }

      preg_match_all('/descriptionUrl(.*)features/Uis', $html, $matches4);//var_dump($matches4);
        $des = str_replace('":"', "", $matches4[1][0]);
        $des = str_replace('","', "", $des);
        // var_dump($des);

        $url1 = $des;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
        $html1 = curl_exec($ch);
        curl_close($ch);

        preg_match_all('/detail-video(.*)data-previewurl/Uis', $html1, $matches11);//var_dump($matches11);
        $video1 = '';
        if (!empty($matches11[0])) {
          $video1 = $matches11[1][0];
          $video1 = str_replace('" id="', '', $video1);
          $video1 = str_replace('" ', '', $video1);//var_dump($video1);
          $video1 = '<video src="https://cloud.video.taobao.com/play/u/2201940393455/p/1/e/6/t/10301/'.$video1.'.mp4" autobuffer autoloop loop controls poster="/images/video.png"></video>';
        }

        $html1 = $video1.$html1;

        // $html1 = preg_replace('/<\/?a[^>]*>/','',$html1);
        preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $html1, $img);//var_dump($img);
        foreach ($img[1] as $item) {
          $anh_arr[] = $item;
        }
    } elseif (strpos($link, 'lazada.vn')) {
      $url = $link;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
      $html = curl_exec($ch);
      curl_close($ch);
      // var_dump($html);

      preg_match_all('/var pdpTrackingData(.*)"}";/Uis', $html, $matches1);
      // var_dump($matches1);
      $data1 = $matches1[1][0];
      $data1 = str_replace(" = \"", "", $data1);
      $data1 = $data1."\"}";
      $data1 = str_replace("\\", "", $data1);
      // var_dump($data1);
      $data1_json = json_decode($data1, true);
      // var_dump($data1_json);
      $text = $data1_json['pdt_name'];

      if (empty($text)) {
        echo 'link lazada tạm thời bị khóa.';
      }
      // $data = "{\"pdt_category\":[\"Ôtô, Xe máy & Thiết bị định vị\",\"Ô tô\",\"Phụ kiện trong ô tô\",\"Bao ghế & Phụ kiện\",\"Nệm lót ghế \"],\"pagetype\":\"pdp\",\"pdt_discount\":\"-37%\",\"pdt_photo\":\"//my-test-11.slatic.net/p/bb90634cf4c31b71bbc7138c34811931.jpg\",\"v_voya\":1,\"brand_name\":\"Ai car fun\",\"brand_id\":\"123332662\",\"pdt_sku\":464534471,\"core\":{\"country\":\"VN\",\"layoutType\":\"desktop\",\"language\":\"vi\",\"currencyCode\":\"VND\"},\"seller_name\":\"Hetie\",\"pdt_simplesku\":869870613,\"pdt_name\":\"Gối tựa đầu khi ngủ trên xe ô tô, giá đỡ tựa đầu 2 bên gắn xe hơi, tiện lợi\",\"page\":{\"regCategoryId\":\"300300001313\",\"xParams\":\"_p_typ=pdp&_p_ispdp=1&_p_item=464534471_VNAMZ-869870613&_p_prod=464534471&_p_sku=869870613&_p_slr=1000026856\"},\"supplier_id\":1000026856,\"pdt_price\":\"491.000 ₫\"}";
      // $data_json = json_decode($data, true);
      // var_dump($data_json);
      // var_dump($data_json['pdt_name']);

      // preg_match_all('/var __moduleData__(.*)};/Uis', $html, $matches2);
      // preg_match_all('/<img(.*)\/>/Uis', $html, $matches2);
      preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $html, $matches2);
      // var_dump($matches2);
      $anh_chinh = array();
      foreach ($matches2[0] as $key => $item) {
        if (strpos($item, 'pdp-mod-common-image item-gallery__thumbnail-image')===false) {

        } else {
          $anh = str_replace("_120x120q80.jpg_.webp", "", $matches2[1][$key]);
          $anh_chinh[] = $anh;
        }
      }
      // var_dump($anh_chinh);
      $anh_arr = $anh_chinh;

      preg_match_all('/"price"(.*)}},/Uis', $html, $matches3);
      // var_dump($matches3);

      

      if (strpos($matches3[0][0], 'originalPrice') === false) {
          $gia1 = array();
          $gia2 = array();
echo 'true';
          $d = 0;
          foreach ($matches3[0] as $item) {
            $d++;
            if ($d == 1) {
              continue;
            }
            preg_match_all('/"value":(.*)}}/i', $item, $matches3_1);
            // var_dump($matches3_1);
            
            $gia = explode('},"salePrice"', $matches3_1[1][0]);
            $gia1[] = $gia[0];
            $gia = explode('"value":', $matches3_1[1][0]);
            $gia2[] = $gia[1];
          }
      } else {
        echo 'false';
          $gia1 = array();
          $d = 0;
          foreach ($matches3[1] as $item) {
            $d++;
            if ($d == 1) {
              continue;
            }
            preg_match_all('/"value":(.*)}/i', $item, $matches3_1);
            // var_dump($matches3_1);
            $gia1[] = $matches3_1[1][0];
          }
          // var_dump($gia1);

          $gia2 = array();
          $d = 0;
          foreach ($matches3[0] as $item) {
            $d++;
            if ($d == 1) {
              continue;
            }
            preg_match_all('/"value":(.*)}/i', $item, $matches3_2);
            // var_dump($matches3_2);
            preg_match_all('/"value":(.*)}/i', $matches3_2[1][0], $matches3_2_1);
            // var_dump($matches3_2_1);
            $gia2[] = $matches3_2_1[1][0];
          }
          // var_dump($gia2);
      }
      var_dump($gia2);

      preg_match_all('/"highPrice"(.*)}}/Uis', $html, $matches10);
      // var_dump($matches10);
      $highPrice = str_replace(':', '', $matches10[1][0]);
      // var_dump($highPrice);

      preg_match_all('/"skuBase"(.*)skus/Uis', $html, $matches4);
      // var_dump($matches4);

      $nhom = str_replace(':{"properties":', '', $matches4[1][0]);
      $nhom = substr($nhom, 0, -2);
      // var_dump($nhom);
      $nhom_1 = json_decode($nhom, true);
      // var_dump($nhom_1);

      $ten = array();
      $anh_arr1 = array();
      foreach ($nhom_1[0]['values'] as $item) {
        $ten[] = $item['name'];
        $anh_arr1[] = $item['image'];
      }

      

      preg_match_all('/"skuGalleries":(.*)"type":"video"/Uis', $html, $matches6);
      // var_dump($matches6);

      preg_match_all('/src":"(.*)",/Uis', $matches6[1][0], $matches6_1);
      // var_dump($matches6_1);
      $video = $matches6_1[1][0];

      preg_match_all('/"highlights":(.*)imageUrl"/Uis', $html, $matches7);
      // var_dump($matches7[1][0]);
      $noi_bat = $matches7[1][0];
      // $noi_bat = str
      if (empty($matches7[1][0])) {
        preg_match_all('/"highlights":(.*)link"/Uis', $html, $matches8);
        // var_dump($matches8[1][0]);
        $noi_bat = $matches8[1][0];
      } else {
        $noi_bat = explode('","link"', $noi_bat)[0];
      }
      var_dump($noi_bat);

      preg_match_all('/"desc"(.*)highlights/Uis', $html, $matches5);
      // var_dump($matches5);
      $mota = $matches5[1][0];
      $mota = str_replace("\\", "", $mota);
      // var_dump($mota);
      $des1 = $mota;
      // https://store.lazada.vn/pc?pageId=190651777&itemId=1231982056&sellerId=200166255008
      if (empty($mota)) {
        preg_match_all('/"pageUrl"(.*)rating/Uis', $html, $matches9);
        // var_dump($matches9);
        $mota_link = $matches9[1][0];
        $mota_link = str_replace(':"', '', $mota_link);
        $mota_link = str_replace('","', '', $mota_link);
        $mota_link = 'https:'.$mota_link;

        $url1 = $mota_link;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
        $html1 = curl_exec($ch);
        curl_close($ch);
        // var_dump($html1);
        $mota_1 = json_decode($html1, true);
        // var_dump($mota_1['result']['components']);
        $d = 0;
        $mota_2 = '';
        foreach ($mota_1['result']['components'] as $key => $val) {
          $d++;
          if ($val['moduleType'] == 'component') {
            // var_dump($val['moduleData']['schema']['children']);
            foreach ($val['moduleData']['schema']['children'] as $item_img) {
              $mota_2 .= '<img src="'.$item_img['src'].'" />';
            }
            break;
          }
        }
        // var_dump($mota_2);
        $html1 = $mota_2;
        // 1240378680
      }

    } elseif (strpos($link, 'amazon.com')) {
      $url = $link;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
      $html = curl_exec($ch);
      curl_close($ch);
      // var_dump($html);

      preg_match_all('/<h1 id="title" (.*)<\/h1>/Uis', $html, $matches2);//var_dump($matches2);
      // echo strip_tags($matches2[0][0]);

      preg_match_all('/var obj = jQuery.parseJSON(.*)}\'\);/Uis', $html, $matches3);//var_dump($matches3);

      $json = str_replace("var obj = jQuery.parseJSON('", "", $matches3[0][0]);//echo $json;
      // $json = str_replace("');", "", $json);echo $json;
      $json = substr($json, 0, -3);//echo $json;
      // $json .= '}';echo $json;
      $json_1 = $json;
      $json = json_decode($json, true);
      echo '<pre>';
      // var_dump($json);
      // var_dump($json['colorToAsin']);
      // var_dump($json['colorImages']);

      if (empty($json) && false) {
        echo 'rong';
        preg_match_all('/colorToAsin(.*)refactorEnabled/Uis', $json_1, $matches6);//var_dump($matches6);
        $ten_tinh_nang = $matches6[1][0];
        $ten_tinh_nang = substr($ten_tinh_nang, 2);
        $ten_tinh_nang = substr($ten_tinh_nang, 0, -2);
        $ten_tinh_nang = json_decode($ten_tinh_nang, true);
        // var_dump($ten_tinh_nang);
        $ten_1 = '';
        $ten_2 = '';
        $d = 0;
        foreach ($ten_tinh_nang as $key => $item) {
          $d++;
          if ($d == 1) {
            $ten_1  = $key;
          }
          if ($d == 2) {
            $ten_2  = $key;
          }
        }

        // echo $json_1;
        preg_match_all("/$ten_1(.*)$ten_2/Uis", $json_1, $matches7);//var_dump($matches7);

        preg_match_all("/large(.*)thumb/Uis", $matches7[1][1], $matches8);//var_dump($matches8);

        $anh_arr = array();
        foreach ($matches8[1] as $item)  {
          $anh = substr($item, 3);
          $anh = substr($anh, 0, -3);
          $anh_arr[] = $anh;
        }



      // foreach ($json['colorImages'] as $key => $val) {
      //   $anh_1 = $val;
      //   break;
      // }

      // // var_dump($anh_1);

      // $anh_2 = array();
      // foreach ($anh_1 as $item) {
      //   $anh_2[] = $item['large'];
      // }

        // var_dump($anh_2);
      } else {
        echo '0 rong';
        // var_dump($json['colorImages']);
        if (empty($json['colorImages']) || true) {
          echo 'ktt';
          preg_match_all('/\'colorImages\'(.*)\'colorToAsin\'/Uis', $html, $matches9);//var_dump($matches9[0][0]);
          $anh = str_replace("'colorImages': ", "", $matches9[0][0]);
          $anh = str_replace("'colorToAsin'", "", $anh);
          $anh = substr($anh, 0, -2);
          // $anh = json_decode($anh);
          preg_match_all('/large(.*)main/Uis', $anh, $matches10);//var_dump($matches10[1]);
          $anh_arr = array();
          foreach ($matches10[1] as $item) {
            $anh_1 = str_replace('":"', '', $item);
            $anh_1 = str_replace('","', '', $anh_1);
            $anh_arr[] = $anh_1;
          }
          // var_dump($anh);
        } else {
          foreach ($json['colorImages'] as $key => $val) {
            $anh_1 = $val;
            break;
          }

          // var_dump($anh_1);

          $anh_2 = array();
          foreach ($anh_1 as $item) {
            $anh_2[] = $item['large'];
          }
          // var_dump($anh_2);
          $anh_arr = $anh_2;
        }
        
      }

      

       preg_match_all('/<p class="a-spacing-none a-text-left a-size-mini twisterSwatchPrice">(.*)<\/p>/Uis', $html, $matches4);//var_dump($matches4);

       preg_match_all('/<span id="price_inside_buybox" class="a-size-medium a-color-price">(.*)<\/span>/Uis', $html, $matches5);//var_dump($matches5);

       $gia = str_replace("$", "", $matches5[1][0]);
       $gia = str_replace(",", "", $gia);
       $gia = trim($gia);
       var_dump((float)$gia);

    } elseif (strpos($link, 'fado.vn')) {
      $url = $link;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
      $html = curl_exec($ch);
      curl_close($ch);
      // var_dump($html);
      // echo "<pre>";

      preg_match_all('/<h1 class="product-name">(.*)<\/h1>/Uis', $html, $matches2);//var_dump($matches2);

      $text = $matches2[1][0];

      if (empty($text)) {
        echo 'link lazada tạm thời bị khóa.';
      }

      preg_match_all('/<a class="image-slider-item"(.*)<\/a>/Uis', $html, $matches3);//var_dump($matches3);

      $anh_arr = array();
      foreach ($matches3[1] as $item) {
        preg_match_all('/href="(.*)"/Uis', $item, $matches4);//var_dump($matches4[1][0]);
        $anh_arr[] = $matches4[1][0];
      }

      // preg_match_all('/"price":(.*)",/Uis', $html, $matches5);//var_dump($matches5);
      preg_match_all('/<span class="current-price">(.*)<\/span>/Uis', $html, $matches5);
      $price = preg_replace('/\D/', '', $matches5[1][0]);
      // var_dump($gia);

      preg_match_all('/<section class="product-specification-section mz-basic-box">(.*)<\/section>/Uis', $html, $matches6);//var_dump($matches6);
      $des1 = $matches6[0][0];

      preg_match_all('/<section class="product-info-section mz-basic-box">(.*)<\/section>/Uis', $html, $matches7);//var_dump($matches7);
      $html1 = $matches7[0][0];

      preg_match_all('/<span class="option-item-name">(.*)<\/span>/Uis', $html, $matches8);//var_dump($matches8);
      $ten = array();
      $anh_arr1 = array();
      $gia1 = array();
      foreach ($matches8[1] as $item) {
        $anh_arr1[] = '';
        $gia1[] = $price;
        $ten[] = trim($item);
      }
    } elseif (strpos($link, 'bestchineseproducts.com')) {
      $url = $link;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
      $html = curl_exec($ch);
      curl_close($ch);
      // var_dump($html);

      preg_match_all('/<h1 class="post-title single-post-title entry-title">(.*)<\/h1>/Uis', $html, $matches2);//var_dump($matches2);

      $text = $matches2[1][0];

      if (empty($text)) {
        echo 'link lazada tạm thời bị khóa.';
      }

      preg_match_all('/<div class="post-image  penci-move-title-above">(.*)<\/a>/Uis', $html, $matches3);//var_dump($matches3);
      preg_match_all('/href="(.*)"/Uis', $matches3[0][0], $matches3_1);//var_dump($matches3_1);
      $anh_arr = array();
      $anh_arr[] = $matches3_1[1][0];

      preg_match_all('/<div class="penci-google-adsense-1">(.*)<div class="penci-google-adsense-2">/Uis', $html, $matches4);//var_dump($matches4);

      $html1 = $matches4[1][0];
      $html1 = str_replace("src", "tuan", $html1);
      $html1 = str_replace("data-tuan", "src", $html1);

      // $html1 = preg_replace(array('"<a href(.*?)>"', '"</a>"'), array('',''), $html1);
      $html1 = preg_replace('/<\/?a[^>]*>/','',$html1);
      preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $html1, $img);//var_dump($img);
      foreach ($img[1] as $item) {
        $anh_arr[] = $item;
      }
    } elseif (strpos($link, 'item.jd.com')) {
      $url = $link;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
      $html = curl_exec($ch);
      curl_close($ch);
      // var_dump($html);

      preg_match_all('/<div class="sku-name">(.*)<\/div>/Uis', $html, $matches2);//var_dump($matches2);

      $text = $matches2[1][0];

      if (empty($text)) {
        echo 'link lazada tạm thời bị khóa.';
      }

      preg_match_all('/imageList:(.*)cat:/Uis', $html, $matches3);//var_dump();
      $anh = json_decode(substr(trim($matches3[1][0]), 0, -1), true);
      // var_dump($anh);
      $anh_arr = array();
      foreach ($anh as $item) {
        $anh_arr[] = 'https://img12.360buyimg.com/n1/s450x450_'.$item;
      }
      ////////////
      preg_match_all('/<div class="post-image  penci-move-title-above">(.*)<\/a>/Uis', $html, $matches3);//var_dump($matches3);
      preg_match_all('/href="(.*)"/Uis', $matches3[0][0], $matches3_1);//var_dump($matches3_1);
      // $anh_arr = array();
      // $anh_arr[] = $matches3_1[1][0];

      preg_match_all('/<div class="penci-google-adsense-1">(.*)<div class="penci-google-adsense-2">/Uis', $html, $matches4);//var_dump($matches4);

      $html1 = $matches4[1][0];
      $html1 = str_replace("src", "tuan", $html1);
      $html1 = str_replace("data-tuan", "src", $html1);

      // $html1 = preg_replace(array('"<a href(.*?)>"', '"</a>"'), array('',''), $html1);
      $html1 = preg_replace('/<\/?a[^>]*>/','',$html1);
      preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $html1, $img);//var_dump($img);
      foreach ($img[1] as $item) {
        // $anh_arr[] = $item;
      }

      //////////////////////
      preg_match_all('/<div class="p-parameter"(.*)<\/div>/Uis', $html, $matches5);//var_dump($matches5[0][0]);
      preg_match_all('/<div id="quality-life"(.*)<\/div>/Uis', $html, $matches6);//var_dump($matches6);
      preg_match_all('/<div id="suyuan-video"(.*)<\/div>/Uis', $html, $matches7);//var_dump($matches7);
      preg_match_all('/<div id="J-detail-banner"(.*)<\/div>/Uis', $html, $matches8);//var_dump($matches8);
      preg_match_all('/<div id="activity_header"(.*)<\/div>/Uis', $html, $matches9);//var_dump($matches9);
      $content = $matches9[0][0];
      $content = str_replace("data-lazyload", "src", $content);//var_dump($content);
      preg_match_all('/<div id="J-detail-pop-tpl-top-new"(.*)<\/div>/Uis', $html, $matches10);
      // preg_match_all('/<div class="detail-content clearfix"(.*)<div id="J-detail-pop-tpl-bottom-new"/Uis', $html, $matches11);var_dump($matches11);
      preg_match_all('/desc:(.*)\',/Uis', $html, $matches11);//var_dump($matches11);
      $link_des = trim($matches11[1][0]);//var_dump($link_des);
      $link_des = str_replace("'", "", $link_des);
      $url = 'https:'.$link_des;
      // var_dump($url);
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0");
      $html1 = curl_exec($ch);
      curl_close($ch);
      // var_dump($html1);

      $noi_dung = json_decode($html1, true);
      // var_dump($noi_dung['content']);

      // preg_match_all('/url(.*)avif/Uis', $html1, $matches16);var_dump($matches16);
      preg_match_all('/<div class="Ptable-item"(.*)<\/div>/Uis', $html, $matches17);var_dump($matches17);


      //////////// thuoc tinh ///////////////
      preg_match_all('/<div id="choose-attr-1"(.*)<div id="choose-results"/Uis', $html, $matches12);//var_dump($matches12);
      $thuoc_tinh = $matches12[0][0];
      // $thuoc_tinh_1 = 
      // echo '<pre>';
      preg_match_all('/<div class="dt(.*)<\/div>/Uis', $thuoc_tinh, $matches13);//var_dump($matches13);
      $count = count($matches13[0]);
      for ($i=1;$i<=$count;$i++) {
        preg_match_all('/<div id="choose-attr-'.$i.'(.*)<div id/Uis', $thuoc_tinh, $matches14);//var_dump($matches14);
        preg_match_all('/data-value="(.*)"/Uis', $matches14[0][0], $matches15);//var_dump($matches15);
      }


      
    } else {
        echo '<script type="text/javascript">alert(\'Link nhập vào không chuẩn\')</script>';
    }
    
?>

<script type="text/javascript">
   $(document).ready(function(data){  
      $('.btn_addCart').click(function(){  
         // var product_id = $(this).attr("id");
           var product_id = $('#product_id').val();
           var product_name = $('#product_name').val();  
           var product_price = $('#product_price').val();  
           var product_quantity = $('.number_cart').val();  
           var product_link = $('#product_link').val();  
           var product_img = $('#product_img').val();
           var product_size = $('#product_size').val();
           var product_color = $('#product_color').val();
           // alert(product_color);return false;
           var action = "add";
           if (product_name == '') {
                alert('Bạn chưa nhập tên sản phẩm.');
                return false;
           }
           // var a = {a : 'a'};
           if(product_quantity > 0)  
           {                  
                 $.ajax({  
                     url:"/functions/ajax.php?action=add_cart",  
                     method:"POST",  
                     dataType:"json",  
                     data:{  
                          product_id:product_id,   
                          product_name:product_name,   
                          product_price:product_price,   
                          product_quantity:product_quantity,   
                          product_link:product_link,   
                          product_img:product_img,
                          product_size:product_size,
                          product_color:product_color,
                          action:action  
                     },  
                     success:function(data)  
                     {  
                          // $('#order_table').html(data.order_table);  
                          // $('.badge').text(data.cart_item);  
                          if (confirm('Thêm sản phẩm thành công, bạn có muốn thanh toán luôn không')) {
                              window.location = '/gio-hang';
                          }else{
                              location.reload();
                          }  
                     },
                     error: function () {
                        alert('loi');
                     }  
                });  

           }  
           else  
           {  
                alert("Please Enter Number of Quantity")  
           }  
      });
   });
 </script>
<div class="uni-single-product-body">
    <div class="container">
        <?php include DIR_BREADCRUMBS."MS_BREADCRUMS_SPRO_0001.php";?>
        <div id="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="uni-single-product-left">
                        <?php include DIR_SIDEBAR."MS_SIDEBAR_SPRO_0002.php";?>
                        <?php include DIR_SIDEBAR."MS_SIDEBAR_SPRO_0001.php";?>
                        <?php //include DIR_SIDEBAR."MS_SIDEBAR_SPRO_0003.php";?>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="uni-single-product-right">
                        <div id="product">
                            <div class="product-info">
                                <div class="row">
                                    <div class="col-sm-6 left image-panel">
                                        <div id="carousel" class="flexslider thumbnail_product">
                                            <div id="slider" class="flexslider">
                                                <div class="product-slide">
                                                    <div class="img-slide">
                                                        <?php 
                                                        $d = 0;
                                                        foreach ($anh_arr as $item) {
                                                          $d++;
                                                        ?>
                                                        <img class="filter2 animated fadeIn shop<?= $d ?> img-responsive <?= ($d==1) ? 'active' : '' ?>" src="<?= $item ?>" alt="product">
                                                        <?php } ?>
                                                        <!-- <img class="filter2 animated fadeIn shop1 active img-responsive" src="images/tintuc/2.jpg" alt="product">
                                                        <img class="filter2 animated fadeIn shop3 img-responsive" src="images/tintuc/3.jpg" alt="product">
                                                        <img class="filter2 animated fadeIn shop4 img-responsive" src="images/tintuc/4.jpg" alt="product"> -->
                                                    </div>

                                                    <div class="row-fix">
                                                        <?php 
                                                        $d = 0;
                                                        foreach ($anh_arr as $item) {
                                                          $d++;
                                                        ?>
                                                        <div class="col-xs-3 col-sm-3 col-md-3 uni-clear-padding">
                                                            <div class="img-small active">
                                                                <img data-filter2="shop<?= $d ?>" src="<?= $item ?>" alt="product" class="img-responsive">
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                        <!-- <div class="col-xs-3 col-sm-3 col-md-3 uni-clear-padding">
                                                            <div class="img-small">
                                                                <img data-filter2="shop2" src="images/tintuc/2.jpg" alt="product" class="img-responsive">
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-3 col-sm-3 col-md-3 uni-clear-padding">
                                                            <div class="img-small">
                                                                <img data-filter2="shop3" src="images/tintuc/3.jpg" alt="product" class="img-responsive">
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-3 col-sm-3 col-md-3 uni-clear-padding">
                                                            <div class="img-small">
                                                                <img data-filter2="shop4" src="images/tintuc/4.jpg" alt="product" class="img-responsive">
                                                            </div>
                                                        </div> -->
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 right">
                                        <h1><?= $text ?></h1>
                                        <h1 class="product_title entry-title"><iframe src="/title_tb.php?link=<?= urlencode($link) ?>"></iframe></h1>
                                        <?php 
                                                        $d = -1;
                                                        foreach ($anh_arr1 as $item) {
                                                          $d++;
                                                        ?>
                                                        <img class="" src="<?= $item ?>" alt="" style="width: 50px;display: inline-block;">
                                                        <?= $gia1[$d] ?>
                                                        <?= $ten[$d] ?>
                                                        <?= $gia2[$d] ?>
                                                        <?php } ?>
                                        <?php include DIR_CART."MS_CART_SPRO_0007.php";?>

                                        <div class="description">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th>Giá:</th>
                                                        <td>
                                                          <p><?= $price ?></p>
                                                          <input type="number" step="0.01" class="form-control" name="price" id="product_price" value="<?= $price ?>" style="width: 70%;"> Tệ</td>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2">CNY = <?= $rowConfig['content_home9'] ?> VNĐ</th>
                                                        <!-- <td>Việt nam</td> -->
                                                    </tr>
                                                    <tr>
                                                        <th>Số lượng:</th>
                                                        <td><input type="number" class="form-control qty number_cart" id="pwd" min="0" value="1" style="width: 70%;"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Size:</th>
                                                        <td><input type="text" name="size" id="product_size"  class="form-control" style="width: 70%;"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Màu:</th>
                                                        <td><input type="text" name="color" id="product_color"  class="form-control" style="width: 70%;"></td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <th>Xuất sứ:</th>
                                                        <td>Việt nam</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tình trạng:</th>
                                                        <td>Còn hàng</td>
                                                    </tr> -->

                                                </table>
                                            </div>
                                        </div>
                                        <!-- .description -->

                                        <?php include DIR_CART."MS_CART_SPRO_0008.php";?>
                                    </div>
                                    <!-- .summary -->
                                </div>
                            </div>
                            <!--ĐỊA CHỈ-->
                            <?php include DIR_CONTACT."MS_CONTACT_SPRO_0002.php";?>


                            <!--Hướng dẫn mua hàng, cách thức thanh toán, Chính sách vận chuyển-->
                            <?php include DIR_CART."MS_CART_SPRO_0009.php";?>

                            <!--CHI TIẾT SẢN PHẨM-->
                            <div class="gb-mota-chitiet">
                              <video src="<?= $video ?>" autobuffer autoloop loop controls poster="/images/video.png"></video>
                                <!-- <iframe src="/mota.php?link=<?= urlencode($link) ?>" width="100%" onload="resizeIframe(this)" ></iframe> -->
                                
                                  <?= $des1 ?>
                                </ul>
                                <?php var_dump($html1); ?>
                            </div>
                        </div>

                        <section class="related products">
                            <?php //include DIR_PRODUCT."MS_PRODUCT_SPRO_0009.php";?>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        //-----------------replace image single product----------------
        jQuery('.flexslider .product-slide .img-small img').on('click', function(e) {
            if($(e.target).is('img')){
                var value2 = jQuery(this).attr("data-filter2");
                console.log(value2);

                jQuery('.flexslider .product-slide .img-small img').addClass('none');
                jQuery('.filter2').not("."+value2).removeClass('active');
                jQuery('.filter2').filter("."+value2).addClass('active');
            }

        });

        $('.flexslider .product-slide .img-small').on('click', function (e) {
            if($(e.target).is('img')){
                $('.img-small').removeClass('active');
                $(this).addClass('active');
            }
        });
    });
</script>
<script>
  function resizeIframe(obj) {
    var height = obj.contentWindow.document.body.scrollHeight;
    if (height < 100) {
        // height = 10;
        sleep(1000);
    }
    height = height + 500;
    obj.style.height = height + 'px';
  }
</script>

<video width="320" height="240" controls>
  <source src="https://video.aliexpress-media.com/play/u/ae_sg_item/2215553862152/p/1/e/6/t/10301/1100136588831.mp4" type="video/mp4">
</video>
