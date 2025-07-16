(() => {
String.prototype.isNumber = function(){return /^\d+$/.test(this);}
let formatDate = function(to, from = new Date()) {
    to = new Date(to);
    let diff = (to - from) / 1000;
    if (diff < 0) return '-';

    let d = [];
    let p = [];

    d.push({key: 'ngày', value: Math.floor(diff / 86400)});
    d.push({key: 'giờ', value: Math.floor(diff / 3600)});
    d.push({key: 'phút', value: Math.floor(diff / 60)});
    d.push({key: 'giây', value: Math.round(diff)});

    d = d.filter(item => item.value > 0)[0];

    if (d != undefined) {
        return d.value + ' ' + d.key;
    }

    return '-';
};
let toSlug = function(string){
    //Đổi chữ hoa thành chữ thường
    slug = string.toLowerCase();

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
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    return slug;
}
let copyVoucherCode = function(element) {
    let voucherCode = element.dataset.code;
    let tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = voucherCode;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);

    if (element.innerHTML.trim() === "Copy mã") {
        element.innerHTML = 'Đã copy';
        setTimeout(function() {
            element.innerHTML = 'Copy mã';
        }, 1000);
        return;
    }

    element.innerHTML = 'Đã lưu';
    setTimeout(function() {
        element.innerHTML = 'Lưu mã';
    }, 1000);
}
let getElementY = function(query) {
    return window.pageYOffset + document.querySelector(query).getBoundingClientRect().top
}
function doScrolling(element, duration) {
    let startingY = window.pageYOffset
    let elementY = getElementY(element)
    let targetY = document.body.scrollHeight - elementY < window.innerHeight ? document.body.scrollHeight - window.innerHeight : elementY
    let diff = targetY - startingY
    let easing = function (t) { return t<.5 ? 4*t*t*t : (t-1)*(2*t-2)*(2*t-2)+1 }
    let start

    if (!diff) return
    window.requestAnimationFrame(function step(timestamp) {
        if (!start) start = timestamp
        let time = timestamp - start
        let percent = Math.min(time / duration, 1)
        percent = easing(percent)
        window.scrollTo(0, startingY + diff * percent)
        if (time < duration) {
          window.requestAnimationFrame(step)
        }
    });
}
let removeActive = function(className) {
    let elements = document.getElementsByClassName(className);
        [...elements].forEach(function(element) {
            element.classList.remove('active');
        });
}
let numberTwoDigital = function(n) {
    return n<10? '0'+n:''+n;
}
let dynamicSort = function(vouchers) {
    let fixedVouchers = [];
    let percentVouchers = [];
    vouchers.forEach(function(voucher) {
        if (voucher.reward_percentage === 0) {
            fixedVouchers.push(voucher);
        } else {
            percentVouchers.push(voucher);
        }
    });

    if ('' === 'asc') {
        fixedVouchers.sort((a,b) => (a.reward_value > b.reward_value) ? 1 : ((b.reward_value > a.reward_value) ? -1 : 0));
        percentVouchers.sort((a,b) => (a.reward_percentage > b.reward_percentage) ? 1 : ((b.reward_percentage > a.reward_percentage) ? -1 : 0));
    } else {
        fixedVouchers.sort((a,b) => (a.reward_value < b.reward_value) ? 1 : ((b.reward_value < a.reward_value) ? -1 : 0));
        percentVouchers.sort((a,b) => (a.reward_percentage < b.reward_percentage) ? 1 : ((b.reward_percentage < a.reward_percentage) ? -1 : 0));
    }

    if ('' === 'rate') {
        return percentVouchers.concat(fixedVouchers);
    } else {
        return fixedVouchers.concat(percentVouchers);
    }
}
let setPaginationTitle = function(pagination) {
    let numberFrom = document.getElementById('cps-number-from');
    let numberTo = document.getElementById('cps-number-to');
    let numberTotal = document.getElementById('cps-number-total');
    totalPage = Math.ceil(pagination.totalVouchers / pagination.pageSize);
    numberFrom.innerHTML = (pagination.currentPage - 1) * pagination.pageSize + 1;
    numberTo.innerHTML = (pagination.totalVouchers < pagination.pageSize) ? pagination.totalVouchers : (pagination.currentPage < totalPage) ? (pagination.currentPage * pagination.pageSize) : pagination.totalVouchers;
    numberTotal.innerHTML = pagination.totalVouchers;
}
let generateVouchersTabs = function(vouchers, productLink = '') {
    let categoryLabels = document.getElementById('cps-category-labels');
    let vouchersBlocks = document.getElementById('cps-vouchers-blocks');
    let groups = vouchers.reduce((r, a) => {
        if (a.icon_text){
            r[a.icon_text] = [...r[a.icon_text] || [], a];
        }
        else {
            r['SHOPEE'] = [...r['SHOPEE'] || [], a];
        }
        return r;
    }, {});
    keysSorted = Object.keys(groups).sort(function(a,b){return groups[b].length - groups[a].length});
    while (categoryLabels.firstChild) {
        categoryLabels.removeChild(categoryLabels.lastChild);
    }
    while (vouchersBlocks.firstChild) {
        vouchersBlocks.removeChild(vouchersBlocks.lastChild);
    }
    let upcomingVouchers = generateVouchersTab(vouchers, 'Tất cả', productLink);
    if (upcomingVouchers.length > 0) {
        upcomingVouchers = dynamicSort(upcomingVouchers);
        generateVouchersTab(upcomingVouchers, 'Sắp diễn ra', productLink);
    }
    for (let index in keysSorted) {
        generateVouchersTab(groups[keysSorted[index]], keysSorted[index], productLink);
    }
}
let generateVouchersTab = function(group, category, productLink = '') {
    let categoryLabels = document.getElementById('cps-category-labels');
    let vouchersBlocks = document.getElementById('cps-vouchers-blocks');
    let blockAll = document.getElementById('tat-ca');
    let blockUpcoming = document.getElementById('sap-dien-ra');
    let activeClass = category === 'Tất cả' ? 'active' : '';
    let upComingClass = category === 'Sắp diễn ra' ? 'up-coming' : '';
    let categoryLabel = `<span class="cps-category-label ${activeClass} ${upComingClass}" data-id=${toSlug(category)}>${category} (${group.length})</span>`;
    categoryLabels.insertAdjacentHTML('beforeend', categoryLabel);
    let vouchersBlock = document.createElement("div");
    vouchersBlock.classList.add('cps-vouchers-block');
    if (activeClass !== '') {
        vouchersBlock.classList.add(activeClass);
    }
    vouchersBlock.id = toSlug(category);
    vouchersBlocks.appendChild(vouchersBlock);
    let pageSize = 10;
    let totalPage = Math.ceil(group.length / pageSize);
    let lastSize = group.length % pageSize;
    let upComingVouchers = [];
    for (let i = 0; i < totalPage; i++) {
        let offset = (lastSize === 0) ? pageSize : (i < totalPage - 1) ? pageSize : lastSize;
        let vouchersPage = document.createElement("div");
        vouchersPage.classList.add('cps-vouchers-page');
        if (i === 0 && activeClass !== '') {
            vouchersPage.classList.add(activeClass);
        }
        vouchersPage.id = toSlug(category) + '-page-' + (i + 1);
        vouchersBlock.appendChild(vouchersPage);
        for (let j = i * pageSize; j < (i * pageSize + offset); j++) {
            moVoucher = group[j];
            let voucherHtml = renverVoucher(moVoucher, productLink);
            vouchersPage.insertAdjacentHTML('beforeend', voucherHtml);
            if (new Date(moVoucher.start_time * 1000) > new Date()) {
                upComingVouchers.push(moVoucher);
            }
        }
    }

    return upComingVouchers;
}
let renverVoucher = function(moVoucher, productLink = '') {
    let moTypeColor = '#ee3916';
    let moDuration = '';
    let moType = ''
    let moTitle = '';
    if (typeof moVoucher['discount_percentage'] === 'undefined' || moVoucher['discount_percentage'] === null) {
        if (typeof moVoucher['coin_percentage'] !== 'undefined' && moVoucher['coin_percentage'] !== null) {
            moTypeColor = '#d0021b';
            if (moVoucher['coin_percentage'] > 100) {
                moTitle = `Hoàn ${Math.round(moVoucher.coin_percentage/1000)}K xu Đơn tối thiểu ${Math.round(moVoucher.min_spend/100000000)}K`;
            }
            else {
                moTitle = `Hoàn ${moVoucher.coin_percentage}% Đơn tối thiểu ${Math.round(moVoucher.min_spend/100000000)}K`;
            }
            moType      = 'Hoàn xu';
            if (moVoucher.coin_cap > 0) {
                moTitle += ` Hoàn tối đa ${Math.round(moVoucher.coin_cap/1000)}K xu`;
            }
        }
    }
    else {
        moType = 'Giảm giá';
        if (moVoucher['discount_percentage'] == 0) {
            moTitle = `Giảm ${Math.round(moVoucher.discount_value/100000000)}K Đơn tối thiểu ${Math.round(moVoucher.min_spend/100000000)}K`;
        }
        else {
            moTitle = `Giảm ${moVoucher.discount_percentage}% Đơn tối thiểu ${Math.round(moVoucher.min_spend/100000000)}K`;
        }
        if (moVoucher.discount_cap > 0) {
            moTitle += ` Giảm tối đa ${Math.round(moVoucher.discount_cap/100000000)}K`;
        }
    }

    if (new Date(moVoucher.start_time * 1000) > new Date()) {
        let start  = new Date(moVoucher.start_time * 1000);
        start = [start.getHours(),
                numberTwoDigital(start.getMinutes())].join('h') + ' ' +
                [numberTwoDigital(start.getDate()),
                numberTwoDigital(start.getMonth()+1),
                start.getFullYear()].join('/');
        moDuration = `<span style="color: #1d7be1;">Hiệu lực từ: ${start}</span>`;
    }
    else {
        moDuration = `<span class="cps-voucher-percent-used">Còn lại ${(100 - moVoucher.percentage_used) + '%'}</span> - <span style="color: #ff1424;">Hết hạn sau: ${formatDate(moVoucher.end_time * 1000)}</span>`;
    }
    let moIcon = moVoucher.icon_hash ? 'https://cf.shopee.vn/file/' + moVoucher.icon_hash : 'http://promotion-api.masoffer.net/images/shopee-logo.png';

    let moVoucherType = '';
    let moNewUser = '';
    let buttonText = 'Copy mã';
    let bannerBadge = '';

    if ((moVoucher.force_new_user && moVoucher.force_new_user === 1) || (moVoucher.new_user_only && moVoucher.new_user_only === true)) {
        moNewUser = `<div class="cps-voucher-type">
                         <span class="cps-badge cps-tooltip" style="background: #1879f2;">
                        Người mới
                            <span class="cps-tooltiptext">Áp dụng cho khách hàng mới mua hàng lần đầu</span>
                         </span>
                     </div>`;
    }
    let moDevice = '';
    if (moVoucher.devices && moVoucher.devices.length === 2) {
        moDevice = `<i class="fa fa-mobile cps-device cps-tooltip cps-phone" aria-hidden="true">
                        <span class="cps-tooltiptext">Chỉ sử dụng được trên Mobile App</span>
                    </i>`;
    }
    else {
        moDevice = `<i class="fa fa-globe cps-device cps-tooltip cps-all-devices" aria-hidden="true">
                        <span class="cps-tooltiptext">Sử dụng được trên tất cả thiết bị</span>
                    </i>`;
    }

    let voucherLink = productLink || 'https://rutgon.me/v0/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn&amp;mo_source=shopee_voucher' + '&aff_sub1=MGGSHOPEE_MOPLUGIN&amp;aff_sub2=SEARCH&amp;aff_sub3=&amp;aff_sub4=';;
    if (moVoucher.is_banner) {
        buttonText = 'Lưu mã';
        bannerBadge = `<span class="cps-badge cps-tooltip" style="background: #ee3916;">
                        Mã lưu banner
                            <span class="cps-tooltiptext">Cần phải lưu trên banner</span>
                         </span>`;
        voucherLink = moVoucher.banner_link || 'https://rutgon.me/v0/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn&amp;mo_source=shopee_voucher' + '&aff_sub1=MGGSHOPEE_MOPLUGIN&amp;aff_sub2=SEARCH&amp;aff_sub3=&amp;aff_sub4=';
    }

    if (moNewUser !== '' || bannerBadge !== '') {
        moVoucherType = `<div class="cps-voucher-type">
                            ${moNewUser}
                            ${bannerBadge}
                         </div>`;
    }

    let shopVoucher = moVoucher.shop_id ? 'shop-voucher' : '';
    return `
    <div class="cps-voucher-row">
        <div class="cps-voucher-wrap">
            <div class="cps-voucher-left ${shopVoucher}">
                <div class="cps-voucher-image">
                    <div class="cps-voucher-icon" style="background-image: url('${moIcon}'); background-size: contain; background-repeat: no-repeat;"></div>
                </div>
                <div class="cps-voucher-icon-text">${moVoucher.icon_text || 'SHOPEE'}</div>
                <div class="cps-voucher-border-left ${shopVoucher}">
                    <div class="cps-border-left"></div>
                </div>
            </div>
            <div class="cps-voucher-right">
                <div class="cps-voucher-title">
                    ${moVoucherType}
                    <div class="cps-voucher-title-text">${moTitle}</div>
                </div>
                <div></div>
                <span class="cps-voucher-note">
                    <div class="cps-voucher-pregress">
                        <div style="width: ${(100 - moVoucher.percentage_used)}%; height: 100%; background: linear-gradient(270deg, rgb(255, 176, 0) 0%, rgb(235, 23, 23) 100%);"></div>
                    </div>
                    <div class="cps-voucher-duration">
                        ${moDuration}
                        <div class="cps-voucher-detail-link">
                            <a class="cps-tooltip" href="${moVoucher.detail_link + '&aff_sub1=MGGSHOPEE_MOPLUGIN&amp;aff_sub2=SEARCH&amp;aff_sub3=&amp;aff_sub4='}" target="_blank">
                                Chi tiết <i class="fa fa-share-square-o" aria-hidden="true"></i>
                                <span class="cps-tooltiptext">${moVoucher.usage_terms || moTitle}</span>
                            </a>
                        </div>
                        <a class="cps-list-product-link cps-tooltip" href="${moVoucher.search_link + '&aff_sub1=MGGSHOPEE_MOPLUGIN&amp;aff_sub2=SEARCH&amp;aff_sub3=&amp;aff_sub4='}" data-code="${moVoucher.voucher_code}" data-code="${moVoucher.voucher_code}" target="_blank">
                            SP áp dụng
                            <span class="cps-tooltiptext">Danh sách sản phẩm có thể sử dụng mã</span>
                        </a>
                        <a class="cps-btn-get-voucher" href="${voucherLink}" data-code="${moVoucher.voucher_code}" target="_blank">
                            ${buttonText}
                        </a>
                    </div>
                </span>
            </div>
        </div>
    </div>`;
}
let checkVoucher = function(moVoucherslist, moVoucher, moProductInfo, loadingPercent) {
    let loadingTitle = document.getElementById('cps-loading-title');
    let progressBar = document.getElementById('cps-progress-bar');

    return fetch('https://publisher-api.masoffer.net' + '/check-voucher?name=' + encodeURIComponent(moProductInfo.item_name) + '&min=' + moProductInfo.price_min + '&max=' + moProductInfo.price_max + '&promotion=' + moVoucher.promotionid, {
        "headers": {
            "Origin": "https://shopee.vn"
        }
    }).then(response => {
        if (!response.ok) {
            throw new Error('Có lỗi xảy ra');
        }
        return response.json();
    })
    .then(data => {
        loadingPercent = Math.round((parseFloat(progressBar.innerHTML.slice(0, -1)) + loadingPercent) * 100) / 100;
        loadingTitle.innerHTML = 'Đang kiểm tra mã ' + moVoucher.voucher_code;
        progressBar.innerHTML = (loadingPercent < 100 ? loadingPercent : 100) + '%';
        progressBar.style.width = progressBar.innerHTML;
        if (data['total_count'] && data['total_count'] > 0) {
            return moVoucher;
        }
        else {
            return 0;
        }
    })
    .catch((error) => {
        loadingPercent = Math.round((parseFloat(progressBar.innerHTML.slice(0, -1)) + loadingPercent) * 100) / 100;
        loadingTitle.innerHTML = 'Đang kiểm tra mã ' + moVoucher.voucher_code;
        progressBar.innerHTML = (loadingPercent < 100 ? loadingPercent : 100) + '%';
        progressBar.style.width = progressBar.innerHTML;
        return 0;
    });
}
let checkScreenSize = function () {
    if (screen.width < 576) {
        stickyBlock.style.width = vouchersBlocks.offsetWidth + 'px';
    }
    else {
        stickyBlock.classList.remove('fixed');
        stickyBlock.classList.add('unset');
        stickyBlock.style.width = '100%';
    }
}

let moRecommendVoucherCss = `
<style type="text/css">
    @import  url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
    html {
        scroll-behavior: smooth;
    }
    .cps-show {
        display: block!important;
    }
    .cps-wrap {
        font-family: 'Open Sans', Helvetica, Arial, sans-serif;
        width: 100%;
        margin: 0;
        padding: 0;
        border: 0;
        vertical-align: baseline;
        position: relative;
        color: #333333;
        z-index: 998;
    }
    .cps-title {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        width: 100%;
        margin-bottom: 10px;
    }
    #cps-search-form {
        display: flex;
        flex-wrap: wrap;
        height: 45px;
        width: 100%;
        margin-bottom: 5px;
    }
    #cps-error-message {
        color: #dc3545;
        font-size: 12px;
    }
    #cps-search-form input {
        font-size: 16px;
        border-radius: 2px;
        width: 80%;
        height: 100%;
        outline: none;
    }
    #cps-search-form .cps-search-btn {
        font-size: 14px;
        height: 100%;
        width: 15%;
        display: inline-block;
        font-weight: 400;
        text-transform: none;
        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
        padding: 4px 8px;
        line-height: 1.5;
        border-radius: 3px;
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
        margin-left: 4%;
        margin-right: 0;
        cursor: pointer;
    }
    #cps-search-form .cps-search-btn:hover, #cps-search-form .cps-search-btn:focus {
        outline: none;
        text-decoration: none;
        background-color: #36a04e;
    }
    #cps-loading-title {
        margin-top: 10px;
        margin-bottom: 2px;
        font-size: 15px;
    }
    #cps-loading-bar {
        display: none;
        width: 100%;
        height: 20px;
        overflow: hidden;
        font-size: 13px;
        background-color: #e9ecef;
        border-radius: 5px;
    }
    #cps-loading-bar .cps-progress-bar {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        -ms-flex-pack: center;
        justify-content: center;
        height: 100%;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        background-color: #007bff;
        transition: width .6s ease;
    }
    #cps-loading-bar .cps-progress-bar-striped {
        background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
        background-size: 10px 10px;
    }
    #cps-vouchers-blocks {
        width: 100%;
        max-width: 580px;
        margin: auto;
        margin-top: 10px;
    }
    #cps-vouchers-blocks a {
        text-decoration: none !important;
    }

    /* CSS for loading */
    .cps-overlay {
        background: #fdfdfd;
        display: none;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        opacity: 0.5;
    }
    .cps-loading .cps-overlay {
        display: block;
    }
    .cps-loading .cps-con-loading {
        display: flex;
    }
    .cps-con-loading {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none;
        flex-direction: row;
        z-index: 1000;
    }
    .cps_loading__letter {
        font-size: 25px;
        font-weight: normal;
        letter-spacing: 4px;
        text-transform: uppercase;
        font-family: 'Open Sans', Helvetica, Arial, sans-serif;
        color: #ee4d2d;
        animation-name: cps-bounce;
        animation-duration: 2s;
        animation-iteration-count: infinite;
    }
    @keyframes  cps-bounce {
        0% {
            transform: translateY(0px);
        }
        40% {
            transform: translateY(-30px);
        }
        80%,
        100% {
            transform: translateY(0px);
        }
    }
    .cps_loading__letter:nth-child(2) {
        animation-delay: 0.1s;
    }
    .cps_loading__letter:nth-child(3) {
        animation-delay: 0.2s;
    }
    .cps_loading__letter:nth-child(4) {
        animation-delay: 0.3s;
    }
    .cps_loading__letter:nth-child(5) {
        animation-delay: 0.4s;
    }
    .cps_loading__letter:nth-child(6) {
        animation-delay: 0.5s;
    }
    .cps_loading__letter:nth-child(7) {
        animation-delay: 0.6s;
    }
    .cps_loading__letter:nth-child(8) {
        animation-delay: 0.8s;
    }
    .cps_loading__letter:nth-child(9) {
        animation-delay: 1s;
    }
    .cps_loading__letter:nth-child(10) {
        animation-delay: 1.1s;
    }
    .cps_loading__letter:nth-child(11) {
        animation-delay: 1.2s;
    }
    /* CSS for tooltip */
    #cps-vouchers-blocks .cps-tooltip {
        position: relative;
        color: #ee3916;
        font-weight: 600;
    }
    #cps-vouchers-blocks .cps-tooltip:hover {
        color: #f25031;
        text-decoration: none!important;
    }
    #cps-vouchers-blocks .cps-tooltip:focus {
        color: #f25031;
        border: none!important;
    }
    #cps-vouchers-blocks .cps-tooltip .cps-tooltiptext {
        visibility: hidden;
        width: 250px;
        background-color: black;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 10px;
        position: absolute;
        z-index: 1;
        top: 100%;
        left: 50%;
        transform: translate(-50%, 0);
    }
    #cps-vouchers-blocks .cps-tooltip:hover .cps-tooltiptext {
        visibility: visible;
        outline: none;
    }
    #cps-vouchers-blocks .cps-voucher-row {
        width: 100%;
        position: relative;
        margin-bottom: 15px;
    }
    #cps-vouchers-blocks .cps-voucher-wrap {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        overflow: hidden;
        border-radius: 2px;
        position: relative;
        overflow: visible;
        box-shadow: 2px 2px 5px rgb(0 0 0 / 7%);
        padding: 0;
        width: 100%;
        height: 118px;
    }
    #cps-vouchers-blocks .cps-voucher-left {
        position: relative;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -moz-box-orient: vertical;
        -moz-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -moz-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -moz-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        width: 118px;
        height: 118px;
        position: relative;
        display: flex;
        background: -webkit-gradient(linear,left top,right top,color-stop(0,transparent),color-stop(3px,transparent),color-stop(4px,#ee3916));
        background: linear-gradient(90deg,transparent 0,transparent 3px,#ee3916 4px);
        background-origin: border-box;
        border-top: 1px solid #e8e8e8;
        border-bottom: 1px solid #e8e8e8;
        border-right: 1px dashed #e8e8e8;
    }
    #cps-vouchers-blocks .cps-voucher-left.shop-voucher {
        background: -webkit-gradient(linear,left top,right top,color-stop(0,transparent),color-stop(3px,transparent),color-stop(4px,#fff));
        background: linear-gradient(90deg,transparent 0,transparent 3px,#fff 4px);
    }
    #cps-vouchers-blocks .cps-voucher-image {
        position: relative;
        height: 56px;
        width: 56px;
        position: relative;
        overflow: hidden;
        border-radius: 50%;
    }
    #cps-vouchers-blocks .shop-voucher .cps-voucher-image {
        border: 1px solid #efefef;
    }
    #cps-vouchers-blocks .cps-voucher-icon {
        opacity: 1;
        -webkit-transition: opacity .2s ease;
        transition: opacity .2s ease;
        width: 100%;
        height: 100%;
    }
    #cps-vouchers-blocks .cps-voucher-icon-text {
        overflow: hidden;
        display: -webkit-box;
        text-overflow: ellipsis;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        font-size: 12px;
        line-height: 14px;
        max-height: 28px;
        max-width: 90%;
        text-align: center;
        -webkit-box-pack: center;
        word-break: break-word;
        margin-top: 5px;
        padding: 0 8px;
        padding-bottom: 2px;
        color: #fff;
    }
    #cps-vouchers-blocks .shop-voucher .cps-voucher-icon-text {
        color: #000;
    }
    #cps-vouchers-blocks .cps-voucher-border-left {
        top: 0;
        left: 0;
        position: absolute;
        width: 4px;
        height: 100%;
    }
    #cps-vouchers-blocks .cps-voucher-border-left:before {
        top: 0;
    }
    #cps-vouchers-blocks .cps-voucher-border-left:after {
        bottom: 0;
    }
    #cps-vouchers-blocks .cps-voucher-border-left:after, #cps-vouchers-blocks .cps-voucher-border-left:before {
        content: "";
        position: absolute;
        width: 100%;
        height: 3px;
        border-left: 1px solid #e8e8e8;
        background: #ee3916;
    }
    #cps-vouchers-blocks .shop-voucher .cps-voucher-border-left:after, #cps-vouchers-blocks .shop-voucher .cps-voucher-border-left:before {
        background: #fff;
    }
    #cps-vouchers-blocks .cps-border-left {
        position: absolute;
        top: 3px;
        left: 0;
        width: 4px;
        height: -webkit-calc(100% - 6px);
        height: calc(100% - 6px);
        background: radial-gradient(circle at 0,at 6px,transparent 0,rgba(0,0,0,.03) 3px,#e8e8e8 0,#e8e8e8 4px,#ee3916 0);
        background: radial-gradient(circle at 0 6px,transparent 0,rgba(0,0,0,.03) 3px,#e8e8e8 0,#e8e8e8 4px,#ee3916 0);
        background-size: 4px 10px;
        background-repeat: repeat-y;
    }
    #cps-vouchers-blocks .shop-voucher .cps-border-left {
        background: radial-gradient(circle at 0,at 6px,transparent 0,rgba(0,0,0,.03) 3px,#e8e8e8 0,#e8e8e8 4px,#fff 0);
        background: radial-gradient(circle at 0 6px,transparent 0,rgba(0,0,0,.03) 3px,#e8e8e8 0,#e8e8e8 4px,#fff 0);
        background-size: 4px 10px;
        background-repeat: repeat-y;
    }
    #cps-vouchers-blocks .cps-border-left:before {
        content: "";
        top: 0;
        left: 0;
        height: 100%;
        background: repeating-linear-gradient(#e8e8e8,#e8e8e8 2px,transparent 0,transparent 10px);
        background-size: 1px 10px;
        position: absolute;
        width: 1px;
    }
    #cps-vouchers-blocks .cps-voucher-right {
        position: relative;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        min-width: 0;
        height: -webkit-calc(100% - 2px);
        height: calc(100% - 2px);
        background: #fff;
        border-radius: 0 2px 2px 0;
        border: 1px solid #e8e8e8;
        border-left: 0 solid transparent;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -moz-box-orient: vertical;
        -moz-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        padding: 0 15px;
        -webkit-box-flex: 1;
        -webkit-flex: 1;
        -moz-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -moz-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        height: 100%;
    }
    #cps-vouchers-blocks .cps-badge, #cps-vouchers-blocks .cps-voucher-type {
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -moz-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -moz-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }
    #cps-vouchers-blocks .cps-voucher-type {
        display: -webkit-inline-box;
        display: -webkit-inline-flex;
        display: -moz-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        vertical-align: middle;
        height: 20px;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    #cps-vouchers-blocks .cps-badge {
        color: #fff;
        border-radius: 2px;
        padding: 0 6px;
        font-size: 12px;
        font-weight: 300;
        height: 18px;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        cursor: pointer;
    }
    #cps-vouchers-blocks .cps-voucher-title, #cps-vouchers-blocks .cps-voucher-title-text {
        font-weight: 500;
        color: rgba(0,0,0,.87);
        word-break: break-word;
    }
    #cps-vouchers-blocks .cps-voucher-title {
        font-size: 16px;
        overflow: hidden;
        display: -webkit-box;
        text-overflow: ellipsis;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        line-height: 20px;
        max-height: 43px;
    }
    #cps-vouchers-blocks .cps-voucher-title-text {
        display: inline;
    }
    #cps-vouchers-blocks .cps-voucher-note {
        line-height: 14px;
        margin-top: 5px;
        color: rgba(0,0,0,.54);
        text-overflow: ellipsis;
        white-space: nowrap;
        margin: 5px 5px 0 0;
    }
    #cps-vouchers-blocks .cps-voucher-pregress {
        width: 100%;
        height: 4px;
        background: rgba(0,0,0,.09);
        border-radius: 4px;
        overflow: hidden;
    }
    #cps-vouchers-blocks .cps-voucher-duration {
        font-size: 12px;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        display: -webkit-box;
        text-overflow: ellipsis;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        white-space: normal;
        margin-top: 4px;
    }
    #cps-vouchers-blocks .cps-voucher-percent-used {
        color: #ff1424;
        font-weight: 500;
    }
    #cps-vouchers-blocks .cps-duration-text {
        color: #ff1424;
    }
    #cps-vouchers-blocks .cps-voucher-detail-link {
        display: block;
        margin-top: 11px;
        font-size: 13px;
    }
    #cps-vouchers-blocks .cps-btn-get-voucher, #cps-vouchers-blocks .cps-list-product-link{
        position: absolute;
        right: 20px;
        bottom: 10px;
        display: inline;
        text-decoration: none;
        font-size: 12px;
        margin: 0;
        padding: 5px 10px;
        cursor: pointer;
        border: 1px solid #ee3916;
        background-color: #ee3916;
        border-style: solid;
        -webkit-appearance: none;
        border-radius: 2px;
        white-space: nowrap;
        box-sizing: border-box;
        color: #fff;
    }
    #cps-vouchers-blocks .cps-btn-get-voucher:hover {
        color: #fff;
        background-color: #f04c2c;
        border-color: #f04c2c;
    }
    #cps-vouchers-blocks .cps-list-product-link {
        background-color: #28a745;
        color: #fff;
        border-color: #28a745;
        right: 95px;
        font-weight: unset;
    }
    #cps-vouchers-blocks .cps-list-product-link.cps-tooltip:hover, #cps-vouchers-blocks .cps-list-product-link.cps-tooltip:focus {
        background-color: #28a745;
        color: #fff;
        border: 1px solid #28a745!important;
        text-decoration: none!important;
    }
    #cps-vouchers-blocks .cps-badge.cps-tooltip {
        position: unset;
    }
    #cps-vouchers-blocks .cps-badge.cps-tooltip .cps-tooltiptext{
        top: 36%;
        left: 32%;
    }
    #cps-vouchers-blocks .cps-badge.cps-tooltip:hover {
        color: #fff;
        text-decoration: none!important;
    }
    #cps-vouchers-blocks .cps-device {
        margin-right: 5px;
        color: #ee3916;
        cursor: pointer;
    }
    #cps-vouchers-blocks .cps-device.cps-tooltip {
        position: unset;
    }
    #cps-vouchers-blocks .cps-device.cps-tooltip .cps-tooltiptext{
        font-family: 'Open Sans', Helvetica, Arial, sans-serif;
        font-size: 12px;
        font-weight: normal;
        top: 36%;
        left: 0%;
    }
    #cps-vouchers-blocks .cps-device.cps-tooltip:hover {
        color: #1e1e1e;
        text-decoration: none!important;
    }
    #cps-vouchers-blocks .cps-all-devices {
        font-size: 18px;
    }
    #cps-vouchers-blocks .cps-phone {
        font-size: 20px;
    }
    #cps-category-labels {
        margin-top: 10px;
        overflow-x: auto;
        overflow-y: hidden;
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        height: 100px;
        white-space: nowrap;
    }
    .cps-category-label {
        display: inline-block;
        text-align: center;
        color: #111;
        min-width: 20px;
        margin: 5px 10px 5px 0;
        padding: 3px 5px;
        font-size: 14px;
        border: solid 1px #555;
        border-radius: 3px;
        cursor: pointer;
    }
    .cps-category-label.up-coming {
        color: #1879f2;
    }
    .cps-category-label.active {
        border-color: #f05532;
        background-color: #f05532;
        color: #fff!important;
    }
    .cps-vouchers-block {
        display: none;
    }
    .cps-vouchers-block.active {
        display: block;
    }
    .cps-vouchers-page {
        display: none;
    }
    .cps-vouchers-page.active {
        display: block;
    }
    /* custom scrollbar */
    #cps-category-labels::-webkit-scrollbar {
        width: 15px;
    }
    #cps-category-labels::-webkit-scrollbar-track {
        background-color: transparent;
    }
    #cps-category-labels::-webkit-scrollbar-thumb {
        background-color: #d6dee1;
        border-radius: 20px;
        border: 6px solid transparent;
        background-clip: content-box;
    }
    #cps-category-labels::-webkit-scrollbar-thumb:hover {
        background-color: #a8bbbf;
    }

    #cps-pagination {
        max-width: 580px;
        margin: auto;
        text-align: right;
        position: relative;
    }
    #cps-pagination .cps-toggle-page {
        color: #1e1e1e;
        padding: 1px 15px;
        padding-bottom: 4px;
        text-decoration: none;
        cursor: pointer;
        border-radius: 3px;
        border: solid 1px #ee3916;
        transition: background-color .5s;
    }
    #cps-pagination .cps-pagination-title {
        position: absolute;
        left: 0;
        font-size: 14px;
        color: #000;
    }
    .no-touch #cps-pagination .cps-toggle-page:hover {
        color: #fff;
        background-color: #ee3916;
    }
    #cps-back-to-all {
        margin-top: 10px;
    }
    #cps-back-to-all .cps-back {
        display: none;
        font-size: 15px;
        color: #1879f2;
        margin-top: 10px;
        cursor: pointer;
    }
    #cps-back-to-all .cps-back.show {
        display: block;
    }
    #cps-back-to-all .cps-back:hover {
        color: #2781f2;
        text-decoration: none;
    }
    #cps-sticky-block {
        position: absolute;
        -webkit-transition: all 0.5s ease;
        -moz-transition: position 10s;
        -ms-transition: position 10s;
        -o-transition: position 10s;
        transition: all 0.5s ease;
        animation: smoothScroll 1s forwards;
    }
    #cps-sticky-block.fixed {
        top: 0;
        z-index: 1000;
        background-color: #fff;
        position: fixed;
        margin-top: 0;
    }
    #cps-sticky-block.unset {
        position: unset;
    }
    @keyframes  smoothScroll {
        0% {
            transform: translateY(30px);
        }
        100% {
            transform: translateY(0px);
        }
    }
    @media  only screen and (max-width: 575px) {
        #cps-search-form {
            display: contents;
        }
        #cps-search-form input {
            width: 100%;
            height: 40px;
            margin-bottom: 0;
        }
        #cps-search-form .cps-search-btn {
            width: 100%;
            margin-left: 0;
            margin-top: 10px;
            height: 30px;
        }
        #cps-error-message {
            margin: 10px 0;;
        }
        #cps-vouchers-blocks, #cps-sticky-block {
            width: 100%;
        }
        #cps-vouchers-blocks .cps-voucher-wrap {
            height: 100px;
        }
        #cps-vouchers-blocks .cps-voucher-left {
            width: 100px;
            height: 100px;
        }
        #cps-vouchers-blocks .cps-voucher-title {
            font-size: 13px;
            line-height: 13px;
        }
        #cps-vouchers-blocks .cps-voucher-duration {
            font-size: 10px;
        }
        #cps-vouchers-blocks .cps-btn-get-voucher {
            font-size: 10px;
            bottom: 8px;
            padding: 2px 5px;
            width: 60px;
            text-align: center;
            right: 15px;
        }
        #cps-vouchers-blocks .cps-voucher-detail-link {
            margin-top: 7px;
            font-size: 11px;
        }
        #cps-vouchers-blocks .cps-badge {
            font-size: 10px;
            height: 16px;
        }
        #cps-vouchers-blocks .cps-list-product-link {
            font-size: 9px;
            bottom: 8px;
            padding: 2px 5px;
            right: 78px;
        }
        .cps-category-label {
            font-size: 12px;
        }
        #cps-pagination .cps-pagination-title {
            font-size: 12px;
        }
        #cps-pagination .cps-toggle-page {
            padding: 0 10px;
            padding-bottom: 2px;
        }
    }
</style>`;

let moRecommendVoucherHtml = `
<div class="cps-wrap" id="cps-wrap">
    <div class="cps-title">
        Tìm kiếm mã giảm giá Shopee
    </div>
    <div id="cps-search-form">
        <input type="text" name="cps_search_url" id="cps-search-url" class="form-control" value="" placeholder="Nhập link sản phẩm để tìm kiếm voucher" required="" autocomplete="on" onClick="this.setSelectionRange(0, this.value.length);">
        <button class="cps-search-btn" id="cps-btn-search-voucher">Tìm kiếm</button>
    </div>
    <div id="cps-error-message"></div>
    <div id="cps-loading-title"></div>
    <div id="cps-loading-bar">
        <div id="cps-progress-bar" class="cps-progress-bar cps-progress-bar-striped" style="width: 0%;">0%</div>
    </div>
    <div id="cps-sticky-block" class="unset">
        <div id="cps-back-to-all">
            <span class="cps-back" id="cps-back-btn">
                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                Xem tất cả mã
            </span>
        </div>
        <div id="cps-category-labels"></div>
    </div>
    <div id="cps-vouchers-blocks"></div>
    <div id="cps-pagination">
        <span class="cps-pagination-title">
            Hiển thị từ <span id="cps-number-from"></span>
            đến <span id="cps-number-to"></span>
            trong tổng số <span id="cps-number-total"></span> mã
        </span>
        <span class="cps-toggle-page" id="cps-previous">&laquo;</span>
        <span class="cps-toggle-page" id="cps-next">&raquo;</span>
    </div>
    <div class="cps-overlay">
    </div>
    <div class="cps-con-loading">
        <div class="cps_loading__letter">Đ</div>
        <div class="cps_loading__letter">a</div>
        <div class="cps_loading__letter">n</div>
        <div class="cps_loading__letter">g</div>
        <div class="cps_loading__letter">&nbsp;</div>
        <div class="cps_loading__letter">T</div>
        <div class="cps_loading__letter">ả</div>
        <div class="cps_loading__letter">i</div>
        <div class="cps_loading__letter">.</div>
        <div class="cps_loading__letter">.</div>
        <div class="cps_loading__letter">.</div>
    </div>
</div>`;

let meta = document.createElement('meta');
meta.setAttribute('name', 'viewport');
meta.setAttribute('content', 'width=device-width, initial-scale=1, maximum-scale=1');
document.getElementsByTagName('head')[0].appendChild(meta);
if(!document.getElementById('font-awesome-4')) {
    var link = document.createElement('link');
    link.id = 'font-awesome-4';
    link.rel = 'stylesheet';
    link.href = 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css';
    document.getElementsByTagName('head')[0].appendChild(link);
}
let moRecommendVoucherElement       = document.getElementById('mo-recommend-widget-28755');
moRecommendVoucherElement.innerHTML = moRecommendVoucherCss + moRecommendVoucherHtml;
let moWrap         = document.getElementById('cps-wrap');
let moSearchInput  = document.getElementById('cps-search-url');
let moErrorMessage = document.getElementById('cps-error-message');
let moVoucherslist = document.getElementById('cps-vouchers');
let loadingBar     = document.getElementById('cps-loading-bar');
let loadingTitle   = document.getElementById('cps-loading-title');
let progressBar    = document.getElementById('cps-progress-bar');
let searchBtn      = document.getElementById('cps-btn-search-voucher');
let vouchersBlocks = document.getElementById('cps-vouchers-blocks');
let paginationNode = document.getElementById('cps-pagination');
let backToAllBtn   = document.getElementById('cps-back-btn');
let stickyBlock    = document.getElementById('cps-sticky-block');
let moVouchersData = [{"promotionid":180801555742720,"voucher_code":"FMCGMART399","signature":"ba7b23fe9e8b7b55d71040fc949893537e3c5761495037b9490b5a7c9c5c7d9a","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":39900000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":45,"start_time":1631120400,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":10000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"55d163fd9315325248d8b51ae6d6ba3b","icon_text":"Shopee Mart","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-86186809B8A080280000000044101500","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":10000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 FMCGMART399 gi\u1ea3m 10% t\u1ed1i \u0111a 100000 cho \u0111\u01a1n t\u1eeb 399000. HSD: 23:59 30\/9\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. \u00c1p d\u1ee5ng cho m\u1ed9t s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D180801555742720%26signature%3Dba7b23fe9e8b7b55d71040fc949893537e3c5761495037b9490b5a7c9c5c7d9a%26voucherCode%3DFMCGMART399\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FFMCGMART399%2F180801555742720%2Fba7b23fe9e8b7b55d71040fc949893537e3c5761495037b9490b5a7c9c5c7d9a%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":180801539293184,"voucher_code":"FMCGMART250","signature":"b5e919a3920c2da6aa4d7921a3dc15534c6c816e6b35d4921ef6c039f56001ed","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":25000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":48,"start_time":1631120400,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":6000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"55d163fd9315325248d8b51ae6d6ba3b","icon_text":"Shopee Mart","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-AC0D681CB8A080280000000044101500","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":6000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 FMCGMART250 gi\u1ea3m 10% t\u1ed1i \u0111a 60000 cho \u0111\u01a1n t\u1eeb 250000. HSD: 23:59 30\/9\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D180801539293184%26signature%3Db5e919a3920c2da6aa4d7921a3dc15534c6c816e6b35d4921ef6c039f56001ed%26voucherCode%3DFMCGMART250\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FFMCGMART250%2F180801539293184%2Fb5e919a3920c2da6aa4d7921a3dc15534c6c816e6b35d4921ef6c039f56001ed%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176553824747520,"voucher_code":"ELSAMHOT","signature":"c291553f0c4be82fa80b6cce02f4c6fd7c9be8cb230ff1dd170bebc5e568318a","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":300000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":87,"start_time":1630508400,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":5,"reward_value":0,"reward_cap":100000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"01ad529d780769c418b225c96cb8a3d7","icon_text":"\u0110i\u1ec7n T\u1eed","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-06180A06AA2080280000000044004105","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":5,"discount_cap":100000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 ELSAMHOT gi\u1ea3m 5% t\u00f4\u0301i \u0111a 1000000 cho \u0111\u01a1n t\u1eeb 3000000. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. HSD: 30\/09\/2021 23:59. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n! \u00c1p d\u1ee5ng cho m\u1ed9t s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh","devices":["Web","Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176553824747520%26signature%3Dc291553f0c4be82fa80b6cce02f4c6fd7c9be8cb230ff1dd170bebc5e568318a%26voucherCode%3DELSAMHOT\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FELSAMHOT%2F176553824747520%2Fc291553f0c4be82fa80b6cce02f4c6fd7c9be8cb230ff1dd170bebc5e568318a%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":172750195326976,"voucher_code":"SPFFHPBD2021","signature":"fe799a7c69217b4b3ce10cae151911451d512cd2285632e5869ff91548ebbf78","use_type":0,"platform_type":null,"voucher_market_type":1,"min_spend":5000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":1,"percentage_claimed":0,"percentage_used":19,"start_time":1630429200,"end_time":1633021140,"collect_time":null,"claim_start_time":1630429200,"valid_days":0,"reward_type":0,"reward_percentage":0,"reward_value":2000000000,"reward_cap":0,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"SHOPEE","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[1],"wallet_redeemable":false,"customer_reference_id":"MP-48C48037022080280000000041510151","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":2000000000,"discount_percentage":0,"discount_cap":0,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":true,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 SPFFHPBD2021 gi\u1ea3m 20K cho \u0111\u01a1n t\u1eeb 50K.. HSD: 00:00 01.09.2021 - 23:59 30.09.2021. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n","devices":["Web","Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D172750195326976%26signature%3Dfe799a7c69217b4b3ce10cae151911451d512cd2285632e5869ff91548ebbf78%26voucherCode%3DSPFFHPBD2021\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPFFHPBD2021%2F172750195326976%2Ffe799a7c69217b4b3ce10cae151911451d512cd2285632e5869ff91548ebbf78%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":175839342067712,"voucher_code":"FMCGMEXSEPTK","signature":"5bc3b1a934415c7628fc08f1e988f596981e4b62a43fbba7e31e73d637a0d981","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":19900000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":75,"start_time":1630429200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":1,"reward_percentage":100,"reward_value":null,"reward_cap":30000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"SHOPEE","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-F0C3EAB16A2080280000000041555450","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":null,"discount_percentage":null,"discount_cap":null,"coin_percentage":100,"coin_cap":30000,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 FMCGMEXSEPTK ho\u00e0n t\u1ed1i \u0111a 30000 xu cho \u0111\u01a1n t\u1eeb 199000. HSD: 23:59 30\/9\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D175839342067712%26signature%3D5bc3b1a934415c7628fc08f1e988f596981e4b62a43fbba7e31e73d637a0d981%26voucherCode%3DFMCGMEXSEPTK\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FFMCGMEXSEPTK%2F175839342067712%2F5bc3b1a934415c7628fc08f1e988f596981e4b62a43fbba7e31e73d637a0d981%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":171983291596800,"voucher_code":"SPPTELCO09","signature":"f7566ea9b87a8b96f7712749682af8b82fc79061bc10f917e3c5de30ad9b6765","use_type":1,"platform_type":null,"voucher_market_type":2,"min_spend":4000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":37,"start_time":1630429200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":0,"reward_value":3000000000,"reward_cap":0,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"3aa6515e76eb97e19478777608398690","icon_text":"N\u1ea1p th\u1ebb","icon_url":null,"customised_labels":[{"content":"V\u00ed ShopeePay\t","color":null},{"content":"Kh\u00e1ch h\u00e0ng m\u1edbi","color":null}],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":null,"is_shop_official":null,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":"Mobile Topup","invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":true,"customer_reference_id":"DP-7DEFA2A0F82080280000000041501444","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":3000000000,"discount_percentage":0,"discount_cap":0,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":true,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 SPPTELCO09 Gi\u1ea3m ngay 30000 cho \u0111\u01a1n t\u1eeb 40000\u0111. HSD: 30\/09\/2021 23:59. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n! M\u00e3 ch\u1ec9 \u00e1p d\u1ee5ng khi thanh to\u00e1n b\u1eb1ng V\u00ed ShopeePay. \u00c1p d\u1ee5ng cho 1 s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D171983291596800%26signature%3Df7566ea9b87a8b96f7712749682af8b82fc79061bc10f917e3c5de30ad9b6765%26voucherCode%3DSPPTELCO09\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPPTELCO09%2F171983291596800%2Ff7566ea9b87a8b96f7712749682af8b82fc79061bc10f917e3c5de30ad9b6765%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":171983015182336,"voucher_code":"SPPHD09","signature":"f5ee76afe74edeb9ee96575d9fc802589cb7a4d7c01a300ab122ee265a5ca68b","use_type":1,"platform_type":null,"voucher_market_type":2,"min_spend":0,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":87,"start_time":1630429200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":3,"reward_value":0,"reward_cap":1000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"6b1e8ce959d93f06cb2965a454f187a2","icon_text":"H\u00f3a \u0111\u01a1n","icon_url":null,"customised_labels":[{"content":"V\u00ed ShopeePay\t","color":null}],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":null,"is_shop_official":null,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":"N\u1ea1p th\u1ebb \u0026 D\u1ecbch v\u1ee5","invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":true,"customer_reference_id":"DP-DCCEE2B5A82080280000000041501444","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":3,"discount_cap":1000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":true,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 SPPHD09 Gi\u1ea3m 3% t\u1ed1i \u0111a 10000 cho \u0111\u01a1n t\u1eeb 0\u0111. HSD: 30\/09\/2021 23:59. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n! M\u00e3 ch\u1ec9 \u00e1p d\u1ee5ng khi thanh to\u00e1n b\u1eb1ng V\u00ed ShopeePay.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D171983015182336%26signature%3Df5ee76afe74edeb9ee96575d9fc802589cb7a4d7c01a300ab122ee265a5ca68b%26voucherCode%3DSPPHD09\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPPHD09%2F171983015182336%2Ff5ee76afe74edeb9ee96575d9fc802589cb7a4d7c01a300ab122ee265a5ca68b%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":171983300345856,"voucher_code":"SPPFIN09","signature":"43cc0069d1fa514fcdfe2e3805605e0e2d366badc608e44808f5ec4106fce5f4","use_type":1,"platform_type":null,"voucher_market_type":2,"min_spend":50000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":6,"start_time":1630429200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":0,"reward_value":3000000000,"reward_cap":0,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"6b1e8ce959d93f06cb2965a454f187a2","icon_text":"H\u00f3a \u0111\u01a1n","icon_url":null,"customised_labels":[{"content":"V\u00ed ShopeePay\t","color":null},{"content":"Kh\u00e1ch h\u00e0ng m\u1edbi","color":null}],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":null,"is_shop_official":null,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":"Finance","invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":true,"customer_reference_id":"DP-FDEFE2B4B82080280000000041501444","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":3000000000,"discount_percentage":0,"discount_cap":0,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":true,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 SPPFIN09 Gi\u1ea3m ngay 30000 cho \u0111\u01a1n t\u1eeb 500000\u0111. HSD: 30\/09\/2021 23:59. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n! M\u00e3 ch\u1ec9 \u00e1p d\u1ee5ng khi thanh to\u00e1n b\u1eb1ng V\u00ed ShopeePay. \u00c1p d\u1ee5ng cho 1 s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D171983300345856%26signature%3D43cc0069d1fa514fcdfe2e3805605e0e2d366badc608e44808f5ec4106fce5f4%26voucherCode%3DSPPFIN09\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPPFIN09%2F171983300345856%2F43cc0069d1fa514fcdfe2e3805605e0e2d366badc608e44808f5ec4106fce5f4%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":171983015067648,"voucher_code":"SPPDT09","signature":"79fadc8f17bf02e9192cd2e11aeb5f91875733d86fe490bc9ae2537aa16b819e","use_type":1,"platform_type":null,"voucher_market_type":2,"min_spend":4000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":57,"start_time":1630429200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":5,"reward_value":0,"reward_cap":500000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"3aa6515e76eb97e19478777608398690","icon_text":"N\u1ea1p th\u1ebb v\u00e0 d\u1ecbch v\u1ee5","icon_url":null,"customised_labels":[{"content":"V\u00ed ShopeePay\t","color":null}],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":null,"is_shop_official":null,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":"N\u1ea1p th\u1ebb \u0026 D\u1ecbch v\u1ee5","invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":true,"customer_reference_id":"DP-DCCEE2B1B82080280000000041501444","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":5,"discount_cap":500000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":true,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 SPPDT09 Gi\u1ea3m 5% t\u1ed1i \u0111a 5000 cho \u0111\u01a1n t\u1eeb 40000\u0111. HSD: 30\/09\/2021 23:59. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n! M\u00e3 ch\u1ec9 \u00e1p d\u1ee5ng khi thanh to\u00e1n b\u1eb1ng V\u00ed ShopeePay.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D171983015067648%26signature%3D79fadc8f17bf02e9192cd2e11aeb5f91875733d86fe490bc9ae2537aa16b819e%26voucherCode%3DSPPDT09\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPPDT09%2F171983015067648%2F79fadc8f17bf02e9192cd2e11aeb5f91875733d86fe490bc9ae2537aa16b819e%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":171988568522752,"voucher_code":"SPPNUOC09N","signature":"fbb7efb8e4035c4d162790074614ee8878c3f626691d26a36b09d90042e547e9","use_type":1,"platform_type":null,"voucher_market_type":2,"min_spend":0,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":12,"start_time":1630429200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":0,"reward_value":3000000000,"reward_cap":0,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"6b1e8ce959d93f06cb2965a454f187a2","icon_text":"H\u00f3a \u0111\u01a1n","icon_url":null,"customised_labels":[{"content":"V\u00ed ShopeePay\t","color":null},{"content":"Kh\u00e1ch h\u00e0ng m\u1edbi","color":null}],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":null,"is_shop_official":null,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":"WaterBill","invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":true,"customer_reference_id":"DP-A7396AE0B82080280000000041501450","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":3000000000,"discount_percentage":0,"discount_cap":0,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":true,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 SPPNUOC09N Gi\u1ea3m ngay 30000 cho \u0111\u01a1n t\u1eeb 0\u0111. HSD: 30\/09\/2021 23:59. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n! M\u00e3 ch\u1ec9 \u00e1p d\u1ee5ng khi thanh to\u00e1n b\u1eb1ng V\u00ed ShopeePay. \u00c1p d\u1ee5ng cho 1 s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh.","devices":["Android","iOS"],"force_new_user":1,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D171988568522752%26signature%3Dfbb7efb8e4035c4d162790074614ee8878c3f626691d26a36b09d90042e547e9%26voucherCode%3DSPPNUOC09N\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPPNUOC09N%2F171988568522752%2Ffbb7efb8e4035c4d162790074614ee8878c3f626691d26a36b09d90042e547e9%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":171988568391680,"voucher_code":"SPPDIEN09N","signature":"0b991ae7952580fa185a4eb71fc48e973102fdbce9f069c1b9a9dce0f8cf0625","use_type":1,"platform_type":null,"voucher_market_type":2,"min_spend":0,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":68,"start_time":1630429200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":0,"reward_value":3000000000,"reward_cap":0,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"6b1e8ce959d93f06cb2965a454f187a2","icon_text":"H\u00f3a \u0111\u01a1n","icon_url":null,"customised_labels":[{"content":"V\u00ed ShopeePay\t","color":null},{"content":"Kh\u00e1ch h\u00e0ng m\u1edbi","color":null}],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":null,"is_shop_official":null,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":"ElectricityBill","invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":true,"customer_reference_id":"DP-A7396AB4B82080280000000041501450","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":3000000000,"discount_percentage":0,"discount_cap":0,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":true,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 SPPDIEN09N Gi\u1ea3m ngay 30000 cho \u0111\u01a1n t\u1eeb 0\u0111. HSD: 30\/09\/2021 23:59. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n! M\u00e3 ch\u1ec9 \u00e1p d\u1ee5ng khi thanh to\u00e1n b\u1eb1ng V\u00ed ShopeePay. \u00c1p d\u1ee5ng cho 1 s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh.","devices":["Android","iOS"],"force_new_user":1,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D171988568391680%26signature%3D0b991ae7952580fa185a4eb71fc48e973102fdbce9f069c1b9a9dce0f8cf0625%26voucherCode%3DSPPDIEN09N\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPPDIEN09N%2F171988568391680%2F0b991ae7952580fa185a4eb71fc48e973102fdbce9f069c1b9a9dce0f8cf0625%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":171983300313088,"voucher_code":"SPPNET09","signature":"1d291e786b879666f05cd9f6c0d0ad0a8b01d90ebaa2abafbd4124bc73a9b172","use_type":1,"platform_type":null,"voucher_market_type":2,"min_spend":0,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":12,"start_time":1630429200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":0,"reward_value":3000000000,"reward_cap":0,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"6b1e8ce959d93f06cb2965a454f187a2","icon_text":"H\u00f3a \u0111\u01a1n","icon_url":null,"customised_labels":[{"content":"V\u00ed ShopeePay\t","color":null},{"content":"Kh\u00e1ch h\u00e0ng m\u1edbi","color":null}],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":null,"is_shop_official":null,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":"InternetBill","invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":true,"customer_reference_id":"DP-FDEFE2B1F82080280000000041501444","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":3000000000,"discount_percentage":0,"discount_cap":0,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":true,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 SPPNET09 Gi\u1ea3m ngay 30000 cho \u0111\u01a1n t\u1eeb 0\u0111. HSD: 30\/09\/2021 23:59. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n! M\u00e3 ch\u1ec9 \u00e1p d\u1ee5ng khi thanh to\u00e1n b\u1eb1ng V\u00ed ShopeePay. \u00c1p d\u1ee5ng cho 1 s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D171983300313088%26signature%3D1d291e786b879666f05cd9f6c0d0ad0a8b01d90ebaa2abafbd4124bc73a9b172%26voucherCode%3DSPPNET09\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPPNET09%2F171983300313088%2F1d291e786b879666f05cd9f6c0d0ad0a8b01d90ebaa2abafbd4124bc73a9b172%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":172130319171584,"voucher_code":"SPPSE09","signature":"06bbeed258862ed98dd840a0231fcfd69b5bba37bf77b9364b373ee4bc315aa6","use_type":1,"platform_type":null,"voucher_market_type":2,"min_spend":3000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":23,"start_time":1630429200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":2000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"73ab7e4f9d770ccfd2f8b786d29bad81","icon_text":"M\u00e3 \u01b0u \u0111\u00e3i","icon_url":null,"customised_labels":[{"content":"V\u00ed ShopeePay\t","color":null}],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":null,"is_shop_official":null,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":"E-voucher","invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":true,"customer_reference_id":"DP-8F3C4017E82080280000000041504051","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":2000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":true,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 SPPSE09 Gi\u1ea3m 10% t\u1ed1i \u0111a 20000 cho \u0111\u01a1n t\u1eeb 30000\u0111. HSD: 30\/09\/2021 23:59. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n! M\u00e3 ch\u1ec9 \u00e1p d\u1ee5ng khi thanh to\u00e1n b\u1eb1ng V\u00ed ShopeePay.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D172130319171584%26signature%3D06bbeed258862ed98dd840a0231fcfd69b5bba37bf77b9364b373ee4bc315aa6%26voucherCode%3DSPPSE09\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPPSE09%2F172130319171584%2F06bbeed258862ed98dd840a0231fcfd69b5bba37bf77b9364b373ee4bc315aa6%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":175790612856832,"voucher_code":"LIFEBOOK9","signature":"b7216b541896145b241d18be63274427b47ec1b0716e2549158a091b4c7e7a0e","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":9900000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":53,"start_time":1630429200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":8,"reward_value":0,"reward_cap":10000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"426a0cdd937f1db50cb535d9f05374bc","icon_text":"Nh\u00e0 S\u00e1ch Online","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-352B02607A2080280000000041555401","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":8,"discount_cap":10000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 LIFEBOOK9 gi\u1ea3m 8% t\u1ed1i \u0111a 100K \u0111\u01a1n t\u1eeb 99K. H\u1ea1n s\u1eed d\u1ee5ng: 23:59 ph\u00fat, 30\/09\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. \u00c1p d\u1ee5ng cho m\u1ed9t s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D175790612856832%26signature%3Db7216b541896145b241d18be63274427b47ec1b0716e2549158a091b4c7e7a0e%26voucherCode%3DLIFEBOOK9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FLIFEBOOK9%2F175790612856832%2Fb7216b541896145b241d18be63274427b47ec1b0716e2549158a091b4c7e7a0e%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":175703882645504,"voucher_code":"NAFNEWBUYT9","signature":"2f6d451426f73c710f0a1e783ad1220a73ecc8614b430364563ecb5d60dde8d2","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":5000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":73,"start_time":1630429200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":0,"reward_value":2000000000,"reward_cap":0,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"SHOPEE","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-AFFD40047A2080280000000041555051","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":2000000000,"discount_percentage":0,"discount_cap":0,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 NAFNEWBUYT9 gi\u1ea3m t\u1ed1i \u0111a 20000 cho \u0111\u01a1n h\u00e0ng 50000 tr\u00ean \u1ee9ng d\u1ee5ng Shopee. H\u1ea1n s\u1eed d\u1ee5ng 30\/9\/2021 23:59 PM . M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u00e3 ch\u1ec9 \u00e1p d\u1ee5ng cho m\u1ed9t s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh.","devices":["iOS","Android"],"force_new_user":1,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D175703882645504%26signature%3D2f6d451426f73c710f0a1e783ad1220a73ecc8614b430364563ecb5d60dde8d2%26voucherCode%3DNAFNEWBUYT9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FNAFNEWBUYT9%2F175703882645504%2F2f6d451426f73c710f0a1e783ad1220a73ecc8614b430364563ecb5d60dde8d2%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":171983015149568,"voucher_code":"SPPBAY09","signature":"7671c42a21c2127d1211c039f916a7cd908c1ee23bfa5d8ae6382ecc11a0d2b0","use_type":1,"platform_type":null,"voucher_market_type":2,"min_spend":0,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":0,"start_time":1630429200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":5,"reward_value":0,"reward_cap":10000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"4fac818193016227d29f29852bf1ff8f","icon_text":"\u0110\u1eb7t v\u00e9 m\u00e1y bay","icon_url":null,"customised_labels":[{"content":"V\u00ed ShopeePay\t","color":null}],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":null,"is_shop_official":null,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":"Flight","invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":true,"customer_reference_id":"DP-DCCEE2B4E82080280000000041501444","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":5,"discount_cap":10000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":true,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 SPPBAY09 Gi\u1ea3m 5% t\u1ed1i \u0111a 100000 cho \u0111\u01a1n t\u1eeb 0\u0111. HSD: 30\/09\/2021 23:59. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n! M\u00e3 ch\u1ec9 \u00e1p d\u1ee5ng khi thanh to\u00e1n b\u1eb1ng V\u00ed ShopeePay.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D171983015149568%26signature%3D7671c42a21c2127d1211c039f916a7cd908c1ee23bfa5d8ae6382ecc11a0d2b0%26voucherCode%3DSPPBAY09\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPPBAY09%2F171983015149568%2F7671c42a21c2127d1211c039f916a7cd908c1ee23bfa5d8ae6382ecc11a0d2b0%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176265751592960,"voucher_code":"FASHIONPREMIUM9","signature":"bf199860df3b2321e92dcae17cf90334ca25fd0f01bcdfd5413f56ea4f8b706d","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":100000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":7,"start_time":1630472700,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":50000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"aa73f8aa302834aa9fc6adbf6e704cf2","icon_text":"Th\u1eddi Trang","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-A1216804EA2080280000000044001100","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":50000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 FASHIONPREMIUM9 gi\u1ea3m 10% t\u1ed1i \u0111a 500K \u0111\u01a1n t\u1eeb 1 Tri\u1ec7u. H\u1ea1n s\u1eed d\u1ee5ng: [23h59, 30\/9\/2021]\nM\u1ed7i ng\u01b0\u1eddi ch\u1ec9 s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n.\nS\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.","devices":["iOS","Android"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176265751592960%26signature%3Dbf199860df3b2321e92dcae17cf90334ca25fd0f01bcdfd5413f56ea4f8b706d%26voucherCode%3DFASHIONPREMIUM9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FFASHIONPREMIUM9%2F176265751592960%2Fbf199860df3b2321e92dcae17cf90334ca25fd0f01bcdfd5413f56ea4f8b706d%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176356331667456,"voucher_code":"LIFESBCWG9","signature":"b621dd58bd78daedfe1c4d3f51494aea3532d3dc09c74af5e79aa92328259411","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":20000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":68,"start_time":1630479600,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":8,"reward_value":0,"reward_cap":3000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"426a0cdd937f1db50cb535d9f05374bc","icon_text":"Nh\u00e0 S\u00e1ch Online","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-84C840A0FA2080280000000044001411","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":8,"discount_cap":3000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 LIFESBCWG9 gi\u1ea3m 8% gi\u1ea3m t\u1ed1i \u0111a 30K cho \u0111\u01a1n t\u1eeb 200K.\r\nH\u1ea1n s\u1eed d\u1ee5ng: 23:59 ph\u00fat, 30\/09\/2021.\r\nS\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176356331667456%26signature%3Db621dd58bd78daedfe1c4d3f51494aea3532d3dc09c74af5e79aa92328259411%26voucherCode%3DLIFESBCWG9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FLIFESBCWG9%2F176356331667456%2Fb621dd58bd78daedfe1c4d3f51494aea3532d3dc09c74af5e79aa92328259411%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176356357046272,"voucher_code":"LIFESBC09","signature":"f47cf2d02b02f3c4df53595f77eb32d5fe3ec3a927a7a71aa1427e73f951ee7c","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":10000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":78,"start_time":1630515600,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":0,"reward_value":1000000000,"reward_cap":0,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"426a0cdd937f1db50cb535d9f05374bc","icon_text":"Nh\u00e0 S\u00e1ch Online","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-0CCC00B0AA2080280000000044001411","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":1000000000,"discount_percentage":0,"discount_cap":0,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 LIFESBC09 gi\u1ea3m 10K cho \u0111\u01a1n t\u1eeb 100K.\r\nH\u1ea1n s\u1eed d\u1ee5ng: 23:59 ph\u00fat, 30\/09\/2021.\r\nS\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176356357046272%26signature%3Df47cf2d02b02f3c4df53595f77eb32d5fe3ec3a927a7a71aa1427e73f951ee7c%26voucherCode%3DLIFESBC09\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FLIFESBC09%2F176356357046272%2Ff47cf2d02b02f3c4df53595f77eb32d5fe3ec3a927a7a71aa1427e73f951ee7c%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176382630313984,"voucher_code":"ELTEFAL09","signature":"459de87c977c59a8e4b535bf20cbe5c5780daecdbe70994b039f3053c335cbe4","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":50000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":92,"start_time":1630472400,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":5,"reward_value":0,"reward_cap":30000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"01ad529d780769c418b225c96cb8a3d7","icon_text":"\u0110i\u1ec7n T\u1eed","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-10C20AB4BA2080280000000044001445","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":5,"discount_cap":30000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 ELTEFAL09 gi\u1ea3m 5% t\u00f4\u0301i \u0111a 300000 cho \u0111\u01a1n t\u1eeb 500000. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. HSD: 30\/09\/2021 23:59. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n!","devices":"","force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176382630313984%26signature%3D459de87c977c59a8e4b535bf20cbe5c5780daecdbe70994b039f3053c335cbe4%26voucherCode%3DELTEFAL09\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FELTEFAL09%2F176382630313984%2F459de87c977c59a8e4b535bf20cbe5c5780daecdbe70994b039f3053c335cbe4%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176390892879872,"voucher_code":"COSLUX9","signature":"f1ada43aead01a23f6919ebcbe00b3212c6e827116651ec0547fff0aceacb28d","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":150000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":23,"start_time":1630486800,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":0,"reward_value":12000000000,"reward_cap":0,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"b0c71ac4233792b24df0739f80aba3a6","icon_text":"Kh\u1ecfe \u0026 \u0110\u1eb9p","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-8738400DAA2080280000000044001451","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":12000000000,"discount_percentage":0,"discount_cap":0,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 COSLUX9 gi\u1ea3m t\u1ed1i \u0111a 120,000 cho \u0111\u01a1n h\u00e0ng t\u1eeb 1,500,000. HSD: 23:59 30\/9\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.","devices":["iOS","Android"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176390892879872%26signature%3Df1ada43aead01a23f6919ebcbe00b3212c6e827116651ec0547fff0aceacb28d%26voucherCode%3DCOSLUX9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FCOSLUX9%2F176390892879872%2Ff1ada43aead01a23f6919ebcbe00b3212c6e827116651ec0547fff0aceacb28d%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176937981542400,"voucher_code":"SKAMA9","signature":"5cf937cd26c10c9c54fa5631cf0c591fa810d520627e8912a8c6b79e73f530f2","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":25000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":93,"start_time":1630861200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":8,"reward_value":0,"reward_cap":5000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"SHOPEE","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-E331EAE140A080280000000044005450","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":8,"discount_cap":5000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Voucher SKAMA9  gi\u1ea3m 8% cho \u0111\u01a1n t\u1eeb 250K, t\u1ed1i \u0111a 50K. H\u1ea1n s\u1eed d\u1ee5ng: 23h59 30\/09\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176937981542400%26signature%3D5cf937cd26c10c9c54fa5631cf0c591fa810d520627e8912a8c6b79e73f530f2%26voucherCode%3DSKAMA9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSKAMA9%2F176937981542400%2F5cf937cd26c10c9c54fa5631cf0c591fa810d520627e8912a8c6b79e73f530f2%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176937997844480,"voucher_code":"SKAMLTSW9","signature":"61fd5690565d4750cde1efe47a48a834788ea83c3edd74e1464bf78845ec03fc","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":9900000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":25,"start_time":1630861200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":5000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"SHOPEE","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-CB34EAA410A080280000000044005450","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":5000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Voucher SKAMLTSW9  gi\u1ea3m 10% cho \u0111\u01a1n t\u1eeb 99K, t\u1ed1i \u0111a 50K. H\u1ea1n s\u1eed d\u1ee5ng: 23h59 30\/09\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176937997844480%26signature%3D61fd5690565d4750cde1efe47a48a834788ea83c3edd74e1464bf78845ec03fc%26voucherCode%3DSKAMLTSW9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSKAMLTSW9%2F176937997844480%2F61fd5690565d4750cde1efe47a48a834788ea83c3edd74e1464bf78845ec03fc%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176938006331392,"voucher_code":"SKAMCLU9","signature":"496538cd27c1cc98f8291bb0e6b228eb29b441dcb82526eab134b0cf101ca832","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":10000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":82,"start_time":1630558800,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":5000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"SHOPEE","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-6B35AAA550A080280000000044005450","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":5000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Voucher SKAMCLU9  gi\u1ea3m 10% cho \u0111\u01a1n t\u1eeb 100K, t\u1ed1i \u0111a 50K. H\u1ea1n s\u1eed d\u1ee5ng: 23h59 30\/09\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176938006331392%26signature%3D496538cd27c1cc98f8291bb0e6b228eb29b441dcb82526eab134b0cf101ca832%26voucherCode%3DSKAMCLU9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSKAMCLU9%2F176938006331392%2F496538cd27c1cc98f8291bb0e6b228eb29b441dcb82526eab134b0cf101ca832%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176938065428480,"voucher_code":"SKAMNEW9","signature":"c02c7c8eeffb9594798134dac938f72ce50e11083ada05d8267aad0be2666d1c","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":0,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":44,"start_time":1630558800,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":50,"reward_value":0,"reward_cap":5000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"SHOPEE","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[1],"wallet_redeemable":false,"customer_reference_id":"MP-C9E4EAE140A080280000000044005450","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":50,"discount_cap":5000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":true,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Voucher SKAMNEW9 gi\u1ea3m 50% cho \u0111\u01a1n t\u1eeb 0\u0110, t\u1ed1i \u0111a 50K. H\u1ea1n s\u1eed d\u1ee5ng: 23h59 30\/09\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n","devices":["Android","iOS"],"force_new_user":1,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176938065428480%26signature%3Dc02c7c8eeffb9594798134dac938f72ce50e11083ada05d8267aad0be2666d1c%26voucherCode%3DSKAMNEW9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSKAMNEW9%2F176938065428480%2Fc02c7c8eeffb9594798134dac938f72ce50e11083ada05d8267aad0be2666d1c%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176435067256832,"voucher_code":"FAFRINW9","signature":"4dd4f25531dba30713024a2d8dd419a61cd387bdd6df11a5d18d82f58990c36f","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":9900000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":78,"start_time":1630602000,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":8,"reward_value":0,"reward_cap":3000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"aa73f8aa302834aa9fc6adbf6e704cf2","icon_text":"Th\u1eddi Trang","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-B7FB488CEA2080280000000044001515","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":8,"discount_cap":3000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 FAFRINW9 gi\u1ea3m 8% t\u1ed1i \u0111a 30K \u0111\u01a1n t\u1eeb 99K. H\u1ea1n s\u1eed d\u1ee5ng: [23h59, 30\/9\/2021]\r\nM\u1ed7i ng\u01b0\u1eddi ch\u1ec9 s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n.\r\nS\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176435067256832%26signature%3D4dd4f25531dba30713024a2d8dd419a61cd387bdd6df11a5d18d82f58990c36f%26voucherCode%3DFAFRINW9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FFAFRINW9%2F176435067256832%2F4dd4f25531dba30713024a2d8dd419a61cd387bdd6df11a5d18d82f58990c36f%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176435117817856,"voucher_code":"FAFRISEP","signature":"3b9d3fc7f5e8d1c0a25e07582d40ddb274b041c53013886157e8d7b26d265a79","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":5000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":77,"start_time":1630602000,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":6,"reward_value":0,"reward_cap":2000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"aa73f8aa302834aa9fc6adbf6e704cf2","icon_text":"Th\u1eddi Trang","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-C000C89CAA2080280000000044001515","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":6,"discount_cap":2000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 FAFRISEP gi\u1ea3m 6% t\u1ed1i \u0111a 20K \u0111\u01a1n t\u1eeb 50K. H\u1ea1n s\u1eed d\u1ee5ng: [23h59, 30\/9\/2021]\r\n M\u1ed7i ng\u01b0\u1eddi ch\u1ec9 s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n.\r\n S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176435117817856%26signature%3D3b9d3fc7f5e8d1c0a25e07582d40ddb274b041c53013886157e8d7b26d265a79%26voucherCode%3DFAFRISEP\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FFAFRISEP%2F176435117817856%2F3b9d3fc7f5e8d1c0a25e07582d40ddb274b041c53013886157e8d7b26d265a79%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176332508168192,"voucher_code":"COSNIVSEP","signature":"3257a6e5aa469efb7caa98546672d3c10ac2630e98eea99e17c0e75c68fe121a","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":25000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":12,"start_time":1630861200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":8,"reward_value":0,"reward_cap":4000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"b0c71ac4233792b24df0739f80aba3a6","icon_text":"Kh\u1ecfe \u0026 \u0110\u1eb9p","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-C3F0C825AA2080280000000044001155","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":8,"discount_cap":4000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 COSNIVSEP gi\u1ea3m 8% t\u1ed1i \u0111a 40000 cho \u0111\u01a1n t\u1eeb 250000. HSD: 23:59 30\/9\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176332508168192%26signature%3D3257a6e5aa469efb7caa98546672d3c10ac2630e98eea99e17c0e75c68fe121a%26voucherCode%3DCOSNIVSEP\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FCOSNIVSEP%2F176332508168192%2F3257a6e5aa469efb7caa98546672d3c10ac2630e98eea99e17c0e75c68fe121a%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176937922723840,"voucher_code":"SKAMSALE9","signature":"c9e120cbf3737977bceaffc37ed608bea147b41716bf2c2cda14ef473afef637","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":20000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":91,"start_time":1630861200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":10000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"SHOPEE","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-4924AAE000A080280000000044005450","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":10000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Voucher SKAMSALE9  gi\u1ea3m 10% cho \u0111\u01a1n t\u1eeb 200K, t\u1ed1i \u0111a 100K. H\u1ea1n s\u1eed d\u1ee5ng: 23h59 30\/09\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176937922723840%26signature%3Dc9e120cbf3737977bceaffc37ed608bea147b41716bf2c2cda14ef473afef637%26voucherCode%3DSKAMSALE9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSKAMSALE9%2F176937922723840%2Fc9e120cbf3737977bceaffc37ed608bea147b41716bf2c2cda14ef473afef637%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":183441350508544,"voucher_code":"WABRBIS3","signature":"771edd72b12323faefb29f8f8a63f4c07746a4f89dd6c1c3df04a37e2ee1d0a0","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":25000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":48,"start_time":1631379600,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":5000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"aa73f8aa302834aa9fc6adbf6e704cf2","icon_text":"Th\u1eddi Trang","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-D212E0C05AA080280000000044145114","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":5000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 WABRBIS3 gi\u1ea3m ngay 10% (t\u1ed1i \u0111a 50K) cho \u0111\u01a1n h\u00e0ng t\u1eeb 250K tr\u1edf l\u00ean tr\u00ean App. HSD: 23:59 ng\u00e0y 30\/09\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D183441350508544%26signature%3D771edd72b12323faefb29f8f8a63f4c07746a4f89dd6c1c3df04a37e2ee1d0a0%26voucherCode%3DWABRBIS3\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FWABRBIS3%2F183441350508544%2F771edd72b12323faefb29f8f8a63f4c07746a4f89dd6c1c3df04a37e2ee1d0a0%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":175032265555968,"voucher_code":"MCRBTC9","signature":"42234b309df01c5d1d76d3f7b7b15dad349ff1012828e929cdc16bfab4a1a3cb","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":41000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":10,"start_time":1630429200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":0,"reward_value":3000000000,"reward_cap":0,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"b0c71ac4233792b24df0739f80aba3a6","icon_text":"Kho\u1ebb \u0026 \u0110\u1eb9p","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-540AA80F1A2080280000000041550500","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":3000000000,"discount_percentage":0,"discount_cap":0,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 MCRBTC9 gi\u1ea3m t\u1ed1i \u0111a 30000 cho \u0111\u01a1n t\u1eeb 410000. HSD: 23:59 30\/9\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. \u00c1p d\u1ee5ng cho 1 s\u1ed1 ng\u01b0\u1eddi d\u1ee5ng nh\u1ea5t \u0111\u1ecbnh.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D175032265555968%26signature%3D42234b309df01c5d1d76d3f7b7b15dad349ff1012828e929cdc16bfab4a1a3cb%26voucherCode%3DMCRBTC9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FMCRBTC9%2F175032265555968%2F42234b309df01c5d1d76d3f7b7b15dad349ff1012828e929cdc16bfab4a1a3cb%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176552683798528,"voucher_code":"ELSAMSEP","signature":"1facd89d12ee82e300b770411b312a0ed8e4350f3e1c94f48a08aa7b3e81f66f","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":50000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":54,"start_time":1630508400,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":5,"reward_value":0,"reward_cap":30000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"01ad529d780769c418b225c96cb8a3d7","icon_text":"\u0110i\u1ec7n T\u1eed","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-540AA202EA2080280000000044004104","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":5,"discount_cap":30000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 ELSAMSEP gi\u1ea3m 5% t\u00f4\u0301i \u0111a 300000 cho \u0111\u01a1n t\u1eeb 500000. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. HSD: 30\/09\/2021 23:59. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n! \u00c1p d\u1ee5ng cho m\u1ed9t s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh","devices":["Web","Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176552683798528%26signature%3D1facd89d12ee82e300b770411b312a0ed8e4350f3e1c94f48a08aa7b3e81f66f%26voucherCode%3DELSAMSEP\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FELSAMSEP%2F176552683798528%2F1facd89d12ee82e300b770411b312a0ed8e4350f3e1c94f48a08aa7b3e81f66f%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":185832883896320,"voucher_code":"SPPHDHCM9","signature":"68ca2333aadf515980e1234ded9c23bf684570bb22a9a70c5c1ee722af7f24d4","use_type":1,"platform_type":null,"voucher_market_type":2,"min_spend":0,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":55,"start_time":1631613300,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":0,"reward_value":2000000000,"reward_cap":0,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"6b1e8ce959d93f06cb2965a454f187a2","icon_text":"H\u00f3a \u0111\u01a1n","icon_url":null,"customised_labels":[{"content":"\u0110i\u1ec7n l\u1ef1c HCMC\t","color":null},{"content":"V\u00ed ShopeePay","color":null}],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":null,"is_shop_official":null,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":"N\u1ea1p th\u1ebb \u0026 D\u1ecbch v\u1ee5","invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":true,"customer_reference_id":"DP-6B358A68100880280000000044410005","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":2000000000,"discount_percentage":0,"discount_cap":0,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":true,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 SPPHDHCM9 gi\u1ea3m ngay 20000 cho \u0111\u01a1n t\u1eeb 0\u0111. HSD: 30\/09\/2021 23:59. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n! M\u00e3 ch\u1ec9 \u00e1p d\u1ee5ng khi thanh to\u00e1n b\u1eb1ng V\u00ed ShopeePay.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D185832883896320%26signature%3D68ca2333aadf515980e1234ded9c23bf684570bb22a9a70c5c1ee722af7f24d4%26voucherCode%3DSPPHDHCM9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPPHDHCM9%2F185832883896320%2F68ca2333aadf515980e1234ded9c23bf684570bb22a9a70c5c1ee722af7f24d4%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":182966017916928,"voucher_code":"COSIF9","signature":"02271dff73ab114fed3cdd5400062d5b0070f0c53760a22ad45f4e7487560bab","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":40000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":18,"start_time":1631271600,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":6000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"b0c71ac4233792b24df0739f80aba3a6","icon_text":"Kh\u1ecfe \u0026 \u0110\u1eb9p","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-81E068A1A2A080280000000044141440","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":6000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 COSIF9 gi\u1ea3m 10% t\u1ed1i \u0111a 60000 cho \u0111\u01a1n t\u1eeb 400000. HSD: 23:59 30\/9\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.","devices":["iOS","Android"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D182966017916928%26signature%3D02271dff73ab114fed3cdd5400062d5b0070f0c53760a22ad45f4e7487560bab%26voucherCode%3DCOSIF9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FCOSIF9%2F182966017916928%2F02271dff73ab114fed3cdd5400062d5b0070f0c53760a22ad45f4e7487560bab%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176938115629056,"voucher_code":"SKAMPUSHA9","signature":"598af57724d6e14a7b78aad9d9977a855bd6c040618f3505a4943b33c367f08a","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":25000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":48,"start_time":1631898000,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":8,"reward_value":0,"reward_cap":5000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"SHOPEE","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-E3F1EAB540A080280000000044005450","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":8,"discount_cap":5000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Voucher SKAMPUSHA9 gi\u1ea3m 8% cho \u0111\u01a1n t\u1eeb 250K, t\u1ed1i \u0111a 50K. H\u1ea1n s\u1eed d\u1ee5ng: 23h59 30\/09\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176938115629056%26signature%3D598af57724d6e14a7b78aad9d9977a855bd6c040618f3505a4943b33c367f08a%26voucherCode%3DSKAMPUSHA9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSKAMPUSHA9%2F176938115629056%2F598af57724d6e14a7b78aad9d9977a855bd6c040618f3505a4943b33c367f08a%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":188107832557568,"voucher_code":"WABRJBD2","signature":"95731e35f92f9c847cad440fac988a9fa9a0ccea83a19f6768cb1e67a842a7ac","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":50000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":19,"start_time":1631898000,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":10000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"aa73f8aa302834aa9fc6adbf6e704cf2","icon_text":"Th\u1eddi Trang","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-921240C6080880280000000044450111","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":10000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 WABRJBD2 gi\u1ea3m ngay 10% (t\u1ed1i \u0111a 100K) cho \u0111\u01a1n h\u00e0ng t\u1eeb 500K tr\u1edf l\u00ean tr\u00ean App. \u00c1p d\u1ee5ng cho 1 s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh. HSD: 23:59 ng\u00e0y 30\/09\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.","devices":["iOS","Android"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D188107832557568%26signature%3D95731e35f92f9c847cad440fac988a9fa9a0ccea83a19f6768cb1e67a842a7ac%26voucherCode%3DWABRJBD2\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FWABRJBD2%2F188107832557568%2F95731e35f92f9c847cad440fac988a9fa9a0ccea83a19f6768cb1e67a842a7ac%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":186746847526912,"voucher_code":"CCBBL0919","signature":"b3ea927bcd6119139717e6c4ddce2b750c64ee951e6b6af749e39e169cc0a86c","use_type":0,"platform_type":null,"voucher_market_type":1,"min_spend":9900000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":1,"percentage_claimed":0,"percentage_used":83,"start_time":1631984400,"end_time":1632502740,"collect_time":null,"claim_start_time":1631984400,"valid_days":0,"reward_type":1,"reward_percentage":10,"reward_value":null,"reward_cap":50000,"coin_earned":null,"title":null,"use_link":"https:\/\/shopee.vn\/collections\/721474","icon_hash":"a6ff372c86c4e242c76fb75f65ae7579","icon_text":"To\u00e0n Ng\u00e0nh H\u00e0ng","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[""],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-BC0F6884600880280000000044415140","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":null,"discount_percentage":null,"discount_cap":null,"coin_percentage":10,"coin_cap":50000,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":"ad2dd06f75d7ce33662a4a74041fa27a","distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 CCBBL0919 ho\u00e0n 10% t\u1ed1i \u0111a 50K Xu cho \u0111\u01a1n h\u00e0ng h\u1ee3p l\u1ec7 t\u1eeb 99K t\u1eeb shop Ho\u00e0n xu Xtra tr\u00ean \u1ee9ng d\u1ee5ng Shopee. HSD: 24\/09\/2021 23:59. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i kh\u00e1ch h\u00e0ng ch\u1ec9 s\u1eed d\u1ee5ng 1 l\u1ea7n.","devices":["Android","iOS"],"force_new_user":0,"is_banner":1,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fm%2Fsieu-sale-nganh-hang-1909\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D186746847526912%26signature%3Db3ea927bcd6119139717e6c4ddce2b750c64ee951e6b6af749e39e169cc0a86c%26voucherCode%3DCCBBL0919\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FCCBBL0919%2F186746847526912%2Fb3ea927bcd6119139717e6c4ddce2b750c64ee951e6b6af749e39e169cc0a86c%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":190936261230592,"voucher_code":"WABRBS1","signature":"1c47fa620e3c962a9c8047a2fd188ae3f198f52a0fb18bff983d907226f220c7","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":50000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":21,"start_time":1632221400,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":10000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"aa73f8aa302834aa9fc6adbf6e704cf2","icon_text":"Th\u1eddi Trang","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-512288B6C20880280000000044514415","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":10000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 WABRBS1 gi\u1ea3m ngay 10% (t\u1ed1i \u0111a 100K) cho \u0111\u01a1n h\u00e0ng t\u1eeb 500K tr\u1edf l\u00ean. HSD: 23:59 ng\u00e0y 30\/09\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.","devices":["iOS","Android"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D190936261230592%26signature%3D1c47fa620e3c962a9c8047a2fd188ae3f198f52a0fb18bff983d907226f220c7%26voucherCode%3DWABRBS1\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FWABRBS1%2F190936261230592%2F1c47fa620e3c962a9c8047a2fd188ae3f198f52a0fb18bff983d907226f220c7%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176409482149888,"voucher_code":"LIFEVD9","signature":"3e9d820d96f899a341d48680ddfe5665c48861e5fc8d3446e0f2367cbb7452f4","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":19900000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":16,"start_time":1630490400,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":8,"reward_value":0,"reward_cap":8000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"72b9cd88c436f69f49dae7ec1d75009b","icon_text":"Nh\u00e0 C\u1eeda-\u0110\u1eddi S\u1ed1ng","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-C0C0C218FA2080280000000044001501","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":8,"discount_cap":8000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"\u00c1p d\u1ee5ng cho m\u1ed9t s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh.\n M\u00e3 LIFEVD9 gi\u1ea3m 8% t\u1ed1i \u0111a 80k cho \u0111\u01a1n h\u00e0ng t\u1eeb 199k tr\u00ean \u1ee9ng d\u1ee5ng Shopee.\n H\u1ea1n s\u1eed d\u1ee5ng 23:59 ph\u00fat, 30\/09\/2021. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n.\n S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.","devices":["iOS","Android"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176409482149888%26signature%3D3e9d820d96f899a341d48680ddfe5665c48861e5fc8d3446e0f2367cbb7452f4%26voucherCode%3DLIFEVD9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FLIFEVD9%2F176409482149888%2F3e9d820d96f899a341d48680ddfe5665c48861e5fc8d3446e0f2367cbb7452f4%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":186031341256704,"voucher_code":"SPPSEP350K","signature":"359e38258d92aff526d3dd045635a3ed2d29a929e446db708bc49551892928a1","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":0,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":30,"start_time":1632157200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":3,"reward_value":0,"reward_cap":5000000000,"coin_earned":null,"title":null,"use_link":"https:\/\/shopee.vn\/m\/shopeepay","icon_hash":"512a3920bbf6de315b98e799a8caf6c0","icon_text":"ShopeePay","icon_url":null,"customised_labels":[{"content":"V\u00ed ShopeePay","color":null}],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":true,"customer_reference_id":"MP-52D2820F100880280000000044410501","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":3,"discount_cap":5000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":true,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 SPPSEP350K gi\u1ea3m 3% t\u1ed1i \u0111a 50K cho \u0111\u01a1n h\u00e0ng h\u1ee3p l\u1ec7 t\u1eeb 0\u0110 tr\u00ean Shopee. HSD: 30\/09\/2021 23:59. \u00c1p d\u1ee5ng khi thanh to\u00e1n ShopeePay. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i kh\u00e1ch h\u00e0ng ch\u1ec9 s\u1eed d\u1ee5ng 1 l\u1ea7n.","devices":["Web","Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D186031341256704%26signature%3D359e38258d92aff526d3dd045635a3ed2d29a929e446db708bc49551892928a1%26voucherCode%3DSPPSEP350K\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPPSEP350K%2F186031341256704%2F359e38258d92aff526d3dd045635a3ed2d29a929e446db708bc49551892928a1%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":186031341256720,"voucher_code":"SPPSEP3FSSA1","signature":"8d07582184861d34c4a22d08a25459b34c321469be0c270e8ed749d7b660da87","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":0,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":80,"start_time":1632157200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":1500000000,"coin_earned":null,"title":null,"use_link":"https:\/\/shopee.vn\/m\/shopeepay","icon_hash":"512a3920bbf6de315b98e799a8caf6c0","icon_text":"ShopeePay","icon_url":null,"customised_labels":[{"content":"V\u00ed ShopeePay","color":null},{"content":"Freeship Xtra","color":null}],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":true,"customer_reference_id":"MP-52D2820F100881280000000044410501","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":1500000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":true,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 SPPSEP3FSSA1 gi\u1ea3m 10% t\u1ed1i \u0111a 15K cho \u0111\u01a1n h\u00e0ng h\u1ee3p l\u1ec7 t\u1eeb 0\u0110 tr\u00ean Shopee. HSD: 30\/09\/2021 23:59. \u00c1p d\u1ee5ng khi thanh to\u00e1n ShopeePay. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i kh\u00e1ch h\u00e0ng ch\u1ec9 s\u1eed d\u1ee5ng 1 l\u1ea7n.","devices":["Web","Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D186031341256720%26signature%3D8d07582184861d34c4a22d08a25459b34c321469be0c270e8ed749d7b660da87%26voucherCode%3DSPPSEP3FSSA1\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPPSEP3FSSA1%2F186031341256720%2F8d07582184861d34c4a22d08a25459b34c321469be0c270e8ed749d7b660da87%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":186031333015552,"voucher_code":"SPPSEP315KALL","signature":"e5828edf8443abcd72c62cb387f224bdda9004623d5e6f8ba037aa35953382d4","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":0,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":18,"start_time":1632157200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":1500000000,"coin_earned":null,"title":null,"use_link":"https:\/\/shopee.vn\/m\/shopeepay","icon_hash":"512a3920bbf6de315b98e799a8caf6c0","icon_text":"ShopeePay","icon_url":null,"customised_labels":[{"content":"V\u00ed ShopeePay","color":null}],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":true,"customer_reference_id":"MP-F8C7C21B400880280000000044410501","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":1500000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":true,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 SPPSEP315KALL gi\u1ea3m 10% t\u1ed1i \u0111a 15K cho \u0111\u01a1n h\u00e0ng h\u1ee3p l\u1ec7 t\u1eeb 0\u0110 tr\u00ean Shopee. HSD: 30\/09\/2021 23:59. \u00c1p d\u1ee5ng khi thanh to\u00e1n ShopeePay. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i kh\u00e1ch h\u00e0ng ch\u1ec9 s\u1eed d\u1ee5ng 1 l\u1ea7n.","devices":["Web","Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D186031333015552%26signature%3De5828edf8443abcd72c62cb387f224bdda9004623d5e6f8ba037aa35953382d4%26voucherCode%3DSPPSEP315KALL\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPPSEP315KALL%2F186031333015552%2Fe5828edf8443abcd72c62cb387f224bdda9004623d5e6f8ba037aa35953382d4%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":186665855696896,"voucher_code":"RWSD12H2509","signature":"b4f7f4f9227901975075ebb1630600346a4db8effa70db136de8ff6214a943c8","use_type":0,"platform_type":null,"voucher_market_type":1,"min_spend":0,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":1,"percentage_claimed":0,"percentage_used":0,"start_time":1632546000,"end_time":1632589140,"collect_time":null,"claim_start_time":1631984400,"valid_days":0,"reward_type":1,"reward_percentage":20,"reward_value":null,"reward_cap":100000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"SHOPEE","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-40C080BB900880280000000044415011","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":null,"discount_percentage":null,"discount_cap":null,"coin_percentage":20,"coin_cap":100000,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 RWSD12H2509 ho\u00e0n 20% t\u1ed1i \u0111a 100,000 Xu cho \u0111\u01a1n t\u1eeb 0\u0111. HSD: t\u1eeb 12h ng\u00e0y 25\/09\/2021 \u0111\u1ebfn 23h59 ng\u00e0y 25\/09\/2021. M\u1ed7i ng\u01b0\u1eddi ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 m\u1ed9t l\u1ea7n. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.\u00c1p d\u1ee5ng tr\u00ean app Shopee","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D186665855696896%26signature%3Db4f7f4f9227901975075ebb1630600346a4db8effa70db136de8ff6214a943c8%26voucherCode%3DRWSD12H2509\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FRWSD12H2509%2F186665855696896%2Fb4f7f4f9227901975075ebb1630600346a4db8effa70db136de8ff6214a943c8%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":175504703635472,"voucher_code":"ULVBTC9","signature":"1e77a2d9793c76a306b40f3ed314f19d1a1cdcdaa158ac72d473d5a354033449","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":25000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":72,"start_time":1630429200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":5,"reward_value":0,"reward_cap":5000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"b0c71ac4233792b24df0739f80aba3a6","icon_text":"Kh\u1ecfe \u0026 \u0110\u1eb9p","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-FBF7E0329A2081280000000041554154","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":5,"discount_cap":5000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 ULVBTC9 gi\u1ea3m 5% t\u1ed1i \u0111a 50000 cho \u0111\u01a1n t\u1eeb 250000. HSD: 23:59 30\/9\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.\u00c1p d\u1ee5ng cho m\u1ed9t s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D175504703635472%26signature%3D1e77a2d9793c76a306b40f3ed314f19d1a1cdcdaa158ac72d473d5a354033449%26voucherCode%3DULVBTC9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FULVBTC9%2F175504703635472%2F1e77a2d9793c76a306b40f3ed314f19d1a1cdcdaa158ac72d473d5a354033449%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176938123886592,"voucher_code":"SKAMLTSM9","signature":"cdfd680072d8cd62aed296661ec858bb69667d1aa1592369b02e3953fc26fc31","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":9900000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":15,"start_time":1631898000,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":5000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"SHOPEE","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-4BF4AAB140A080280000000044005450","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":5000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Voucher SKAMLTSM9  gi\u1ea3m 10% cho \u0111\u01a1n t\u1eeb 99K, t\u1ed1i \u0111a 50K. H\u1ea1n s\u1eed d\u1ee5ng: 23h59 30\/09\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176938123886592%26signature%3Dcdfd680072d8cd62aed296661ec858bb69667d1aa1592369b02e3953fc26fc31%26voucherCode%3DSKAMLTSM9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSKAMLTSM9%2F176938123886592%2Fcdfd680072d8cd62aed296661ec858bb69667d1aa1592369b02e3953fc26fc31%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":186031341469712,"voucher_code":"SPPSEP310KN","signature":"8842b4db387ab0866f5d1441968ed19ddb8808429d6d690dd7a09878b356a4c5","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":0,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":74,"start_time":1632157200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":0,"reward_value":1000000000,"reward_cap":0,"coin_earned":null,"title":null,"use_link":"https:\/\/shopee.vn\/m\/shopeepay","icon_hash":"512a3920bbf6de315b98e799a8caf6c0","icon_text":"ShopeePay","icon_url":null,"customised_labels":[{"content":"V\u00ed ShopeePay","color":null}],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":true,"customer_reference_id":"MP-52D2821E400881280000000044410501","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":1000000000,"discount_percentage":0,"discount_cap":0,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":true,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 SPPSEP310KN gi\u1ea3m t\u1ed1i \u0111a 10K cho \u0111\u01a1n h\u00e0ng h\u1ee3p l\u1ec7 t\u1eeb 0\u0110 tr\u00ean Shopee. HSD: 30\/09\/2021 23:59. \u00c1p d\u1ee5ng khi thanh to\u00e1n ShopeePay. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i kh\u00e1ch h\u00e0ng ch\u1ec9 s\u1eed d\u1ee5ng 1 l\u1ea7n. \u00c1p d\u1ee5ng cho 1 s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh.","devices":["Web","Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D186031341469712%26signature%3D8842b4db387ab0866f5d1441968ed19ddb8808429d6d690dd7a09878b356a4c5%26voucherCode%3DSPPSEP310KN\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPPSEP310KN%2F186031341469712%2F8842b4db387ab0866f5d1441968ed19ddb8808429d6d690dd7a09878b356a4c5%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":186031341469728,"voucher_code":"SPPSEP3FSSN1","signature":"116d45f414686d5056f0a93a711ae347c2bd71ee0d3b2198b0fbe40a3616cac6","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":0,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":41,"start_time":1632157200,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":1500000000,"coin_earned":null,"title":null,"use_link":"https:\/\/shopee.vn\/m\/shopeepay","icon_hash":"512a3920bbf6de315b98e799a8caf6c0","icon_text":"ShopeePay","icon_url":null,"customised_labels":[{"content":"V\u00ed ShopeePay","color":null},{"content":"Freeship Xtra","color":null}],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":true,"customer_reference_id":"MP-52D2821E400884280000000044410501","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":1500000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":true,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 SPPSEP3FSSN1 gi\u1ea3m 10% t\u1ed1i \u0111a 15K cho \u0111\u01a1n h\u00e0ng  h\u1ee3p l\u1ec7 t\u1eeb 0\u0110 tr\u00ean Shopee. HSD: 30\/09\/2021 23:59. \u00c1p d\u1ee5ng khi thanh to\u00e1n ShopeePay. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i kh\u00e1ch h\u00e0ng ch\u1ec9 s\u1eed d\u1ee5ng 1 l\u1ea7n. \u00c1p d\u1ee5ng cho 1 s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh.","devices":["Web","Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D186031341469728%26signature%3D116d45f414686d5056f0a93a711ae347c2bd71ee0d3b2198b0fbe40a3616cac6%26voucherCode%3DSPPSEP3FSSN1\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPPSEP3FSSN1%2F186031341469728%2F116d45f414686d5056f0a93a711ae347c2bd71ee0d3b2198b0fbe40a3616cac6%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":186665855401984,"voucher_code":"RWSC2509","signature":"2802ec14903dea71bdd12810a78f3a521802474a6ee3081beadf7634528e6df9","use_type":0,"platform_type":null,"voucher_market_type":1,"min_spend":0,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":1,"percentage_claimed":0,"percentage_used":0,"start_time":1632535200,"end_time":1632934740,"collect_time":null,"claim_start_time":1632157200,"valid_days":0,"reward_type":0,"reward_percentage":20,"reward_value":0,"reward_cap":1500000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"SHOPEE","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-40C080AAD00880280000000044415011","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":20,"discount_cap":1500000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 RWSC2509 gi\u1ea3m 20% t\u1ed1i \u0111a 15,000\u0111 cho \u0111\u01a1n t\u1eeb 0\u0111 . HSD: t\u1eeb 9h ng\u00e0y 25\/09\/2021 \u0111\u1ebfn 23h59 ng\u00e0y 29\/09\/2021. M\u1ed7i ng\u01b0\u1eddi ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 m\u1ed9t l\u1ea7n. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.\u00c1p d\u1ee5ng tr\u00ean app Shopee","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D186665855401984%26signature%3D2802ec14903dea71bdd12810a78f3a521802474a6ee3081beadf7634528e6df9%26voucherCode%3DRWSC2509\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FRWSC2509%2F186665855401984%2F2802ec14903dea71bdd12810a78f3a521802474a6ee3081beadf7634528e6df9%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176552717828096,"voucher_code":"ELCOOSEP","signature":"692575ff32286648be1773c2e9ffb15d9b609e1487f65a0bcea4bda609d2cc76","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":300000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":65,"start_time":1630508400,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":5,"reward_value":0,"reward_cap":100000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"01ad529d780769c418b225c96cb8a3d7","icon_text":"\u0110i\u1ec7n T\u1eed","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-5C0EA217FA2080280000000044004104","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":5,"discount_cap":100000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 ELCOOSEP gi\u1ea3m 5% t\u00f4\u0301i \u0111a 1000000 cho \u0111\u01a1n t\u1eeb 3000000. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. HSD: 30\/09\/2021 23:59. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n! \u00c1p d\u1ee5ng cho m\u1ed9t s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh","devices":["Web","Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176552717828096%26signature%3D692575ff32286648be1773c2e9ffb15d9b609e1487f65a0bcea4bda609d2cc76%26voucherCode%3DELCOOSEP\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FELCOOSEP%2F176552717828096%2F692575ff32286648be1773c2e9ffb15d9b609e1487f65a0bcea4bda609d2cc76%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":191597937852416,"voucher_code":"239ELHOAN100K","signature":"2c9ca10fafb59ee6e22469d1ce5cd1fb1217a16904adcde7cabd269250d0bd59","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":50000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":33,"start_time":1632330000,"end_time":1632675540,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":1,"reward_percentage":7,"reward_value":null,"reward_cap":100000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"01ad529d780769c418b225c96cb8a3d7","icon_text":"\u0110i\u1ec7n T\u1eed","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-7BF7823E620880280000000044541001","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":null,"discount_percentage":null,"discount_cap":null,"coin_percentage":7,"coin_cap":100000,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 239ELHOAN100K ho\u00e0n 7% t\u1ed1i \u0111a 100,000 xu cho \u0111\u01a1n h\u00e0ng \u0110I\u1ec6N T\u1eec c\u00f3 gi\u00e1 tr\u1ecb t\u1eeb 500,000\u0111 khi mua h\u00e0ng tr\u00ean app. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i kh\u00e1ch h\u00e0ng ch\u1ec9 \u0111\u01b0\u1ee3c d\u00f9ng m\u1ed9t l\u1ea7n. Hi\u1ec7u l\u1ef1c \u0111\u1ebfn 26\/09\/2021 - 23:59","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D191597937852416%26signature%3D2c9ca10fafb59ee6e22469d1ce5cd1fb1217a16904adcde7cabd269250d0bd59%26voucherCode%3D239ELHOAN100K\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2F239ELHOAN100K%2F191597937852416%2F2c9ca10fafb59ee6e22469d1ce5cd1fb1217a16904adcde7cabd269250d0bd59%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":191489766735872,"voucher_code":"LIFEBULKY239","signature":"3abd6edc2da9baa358c00b868b8ffef88ac1f53fd6c585a0239ab6a9e97494df","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":30000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":3,"start_time":1632330000,"end_time":1633021140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":10000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"72b9cd88c436f69f49dae7ec1d75009b","icon_text":"Nh\u00e0 C\u1eeda-\u0110\u1eddi S\u1ed1ng","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-EEDDE8B6320880280000000044540440","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":10000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 LIFEBULKY239 gi\u1ea3m 10% t\u1ed1i \u0111a 100K cho \u0111\u01a1n h\u00e0ng t\u1eeb 300K. H\u1ea1n s\u1eed d\u1ee5ng: 23:59 ng\u00e0y 30\/09\/2021. M\u1ed7i ng\u01b0\u1eddi d\u00f9ng ch\u1ec9 \u0111\u01b0\u1ee3c s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.","devices":["iOS","Android"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D191489766735872%26signature%3D3abd6edc2da9baa358c00b868b8ffef88ac1f53fd6c585a0239ab6a9e97494df%26voucherCode%3DLIFEBULKY239\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FLIFEBULKY239%2F191489766735872%2F3abd6edc2da9baa358c00b868b8ffef88ac1f53fd6c585a0239ab6a9e97494df%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":191597954629632,"voucher_code":"239ELHOAN300K0","signature":"22e32893b7d5d6d0dba4aec1c186f072b056ba148ea319a478772f98b455d898","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":100000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":81,"start_time":1632330000,"end_time":1632675540,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":1,"reward_percentage":7,"reward_value":null,"reward_cap":300000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"01ad529d780769c418b225c96cb8a3d7","icon_text":"\u0110i\u1ec7n T\u1eed","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-540A823E620880280000000044541001","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":null,"discount_percentage":null,"discount_cap":null,"coin_percentage":7,"coin_cap":300000,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 239ELHOAN300K0 ho\u00e0n 7% t\u1ed1i \u0111a 300,000 xu cho \u0111\u01a1n h\u00e0ng \u0110I\u1ec6N T\u1eec c\u00f3 gi\u00e1 tr\u1ecb t\u1eeb 1,000,000\u0111 khi mua h\u00e0ng tr\u00ean app. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i kh\u00e1ch h\u00e0ng ch\u1ec9 \u0111\u01b0\u1ee3c d\u00f9ng m\u1ed9t l\u1ea7n. Hi\u1ec7u l\u1ef1c \u0111\u1ebfn 26\/09\/2021 - 23:59","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D191597954629632%26signature%3D22e32893b7d5d6d0dba4aec1c186f072b056ba148ea319a478772f98b455d898%26voucherCode%3D239ELHOAN300K0\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2F239ELHOAN300K0%2F191597954629632%2F22e32893b7d5d6d0dba4aec1c186f072b056ba148ea319a478772f98b455d898%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":190948944887808,"voucher_code":"249GIAM100K","signature":"8cc283c2cbe64cc485c648b1550ab993d95cdcb16e9f92da24168ad1a3d64462","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":10000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":0,"start_time":1632459600,"end_time":1632502740,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":50,"reward_value":0,"reward_cap":10000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-5212A2B7D20880280000000044514444","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":50,"discount_cap":10000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 249GIAM100K gi\u1ea3m 50% t\u1ed1i \u0111a 100K cho \u0111\u01a1n h\u00e0ng h\u1ee3p l\u1ec7 t\u1eeb 100K tr\u00ean \u1ee9ng d\u1ee5ng Shopee. HSD: 24\/09\/2021 12:00 - 24\/09\/2021 23:59. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i kh\u00e1ch h\u00e0ng ch\u1ec9 s\u1eed d\u1ee5ng 1 l\u1ea7n.","devices":["iOS","Android"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D190948944887808%26signature%3D8cc283c2cbe64cc485c648b1550ab993d95cdcb16e9f92da24168ad1a3d64462%26voucherCode%3D249GIAM100K\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2F249GIAM100K%2F190948944887808%2F8cc283c2cbe64cc485c648b1550ab993d95cdcb16e9f92da24168ad1a3d64462%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":186746923401216,"voucher_code":"CCBELHA0924","signature":"5168f508cee7bba3e3fc5a910531be3e4f2104541778b6a4bf90cd7c8caf4713","use_type":0,"platform_type":null,"voucher_market_type":1,"min_spend":0,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":1,"percentage_claimed":0,"percentage_used":15,"start_time":1632416400,"end_time":1632502740,"collect_time":null,"claim_start_time":1632416400,"valid_days":0,"reward_type":1,"reward_percentage":15,"reward_value":null,"reward_cap":50000,"coin_earned":null,"title":null,"use_link":"https:\/\/shopee.vn\/collections\/577497","icon_hash":"a6ff372c86c4e242c76fb75f65ae7579","icon_text":"\u0110i\u1ec7n T\u1eed","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[""],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-14CA28C0300880280000000044415140","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":null,"discount_percentage":null,"discount_cap":null,"coin_percentage":15,"coin_cap":50000,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":"ad2dd06f75d7ce33662a4a74041fa27a","distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 CCBELHA0924 ho\u00e0n 15% t\u1ed1i \u0111a 50K Xu cho \u0111\u01a1n h\u00e0ng h\u1ee3p l\u1ec7 t\u1eeb 0\u0110 t\u1eeb shop Ho\u00e0n xu Xtra tr\u00ean \u1ee9ng d\u1ee5ng Shopee. HSD: 24\/09\/2021 23:59. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i kh\u00e1ch h\u00e0ng ch\u1ec9 s\u1eed d\u1ee5ng 1 l\u1ea7n.","devices":["iOS","Android"],"force_new_user":0,"is_banner":1,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fm%2Fsieu-sale-nganh-hang-24-09\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D186746923401216%26signature%3D5168f508cee7bba3e3fc5a910531be3e4f2104541778b6a4bf90cd7c8caf4713%26voucherCode%3DCCBELHA0924\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FCCBELHA0924%2F186746923401216%2F5168f508cee7bba3e3fc5a910531be3e4f2104541778b6a4bf90cd7c8caf4713%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":176209447419904,"voucher_code":"INCU2409","signature":"2bd352c52f00ccbf1e3722768c4f39410d9c7fd61519138d5ae66913cdc2a3da","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":5000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":11,"start_time":1632416400,"end_time":1632502740,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":2000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"SHOPEE","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-F73BE23B2A2080280000000044001004","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":2000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 INCU2409 gi\u1ea3m 10% t\u1ed1i \u0111a 20,000vn\u0111 cho \u0111\u01a1n t\u1eeb 50,000vn\u0111 khi mua h\u00e0ng tr\u00ean App. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. Hi\u1ec7u l\u1ef1c t\u1eeb 00:00 ng\u00e0y 24\/09\/2021 \u0111\u1ebfn 23:59 ng\u00e0y 24\/09\/2021","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D176209447419904%26signature%3D2bd352c52f00ccbf1e3722768c4f39410d9c7fd61519138d5ae66913cdc2a3da%26voucherCode%3DINCU2409\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FINCU2409%2F176209447419904%2F2bd352c52f00ccbf1e3722768c4f39410d9c7fd61519138d5ae66913cdc2a3da%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":186031383068672,"voucher_code":"SPPSEP2421","signature":"0b4469e34cccd808604f26f9a524b2929bd7b69b5e0ae36b41528f84598b740b","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":0,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":17,"start_time":1632416400,"end_time":1632502740,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":1000000000,"coin_earned":null,"title":null,"use_link":"https:\/\/shopee.vn\/m\/shopeepay","icon_hash":"512a3920bbf6de315b98e799a8caf6c0","icon_text":"ShopeePay","icon_url":null,"customised_labels":[{"content":"V\u00ed ShopeePay","color":null},{"content":"Fashion","color":null}],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":true,"customer_reference_id":"MP-DAD6C20B100880280000000044410501","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":1000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":true,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 SPPSEP2421 gi\u1ea3m 10% t\u1ed1i \u0111a 10K cho \u0111\u01a1n h\u00e0ng h\u1ee3p l\u1ec7 t\u1eeb 0\u0110 tr\u00ean Shopee. HSD: 24\/09\/2021 23:59. \u00c1p d\u1ee5ng khi thanh to\u00e1n ShopeePay. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i kh\u00e1ch h\u00e0ng ch\u1ec9 s\u1eed d\u1ee5ng 1 l\u1ea7n. \u00c1p d\u1ee5ng cho 1 s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh.","devices":["Web","Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D186031383068672%26signature%3D0b4469e34cccd808604f26f9a524b2929bd7b69b5e0ae36b41528f84598b740b%26voucherCode%3DSPPSEP2421\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FSPPSEP2421%2F186031383068672%2F0b4469e34cccd808604f26f9a524b2929bd7b69b5e0ae36b41528f84598b740b%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":186352163880960,"voucher_code":"2409GIAMBAN25K","signature":"919b91c52dc089510f5901dd7db9691801449e5bc11f5e82430765c26945f0bf","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":15000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":6,"start_time":1632416400,"end_time":1632502740,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":0,"reward_value":2500000000,"reward_cap":0,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"SHOPEE","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[1],"wallet_redeemable":false,"customer_reference_id":"MP-9FFE6AC8800880280000000044411550","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":2500000000,"discount_percentage":0,"discount_cap":0,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":true,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"\u00c1p d\u1ee5ng cho m\u1ed9t s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh. Nh\u00e2p m\u00e3 2409GIAMBAN25K gi\u1ea3m t\u1ed1i \u0111a 25K cho \u0111\u01a1n h\u00e0ng h\u1ee3p l\u1ec7 t\u1eeb 150K . HSD: 24\/09\/2021 00:00 - 24\/09\/2021 23:59. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i kh\u00e1ch h\u00e0ng ch\u1ec9 s\u1eed d\u1ee5ng 1 l\u1ea7n.","devices":["Android","iOS"],"force_new_user":1,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D186352163880960%26signature%3D919b91c52dc089510f5901dd7db9691801449e5bc11f5e82430765c26945f0bf%26voucherCode%3D2409GIAMBAN25K\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2F2409GIAMBAN25K%2F186352163880960%2F919b91c52dc089510f5901dd7db9691801449e5bc11f5e82430765c26945f0bf%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":186352171827200,"voucher_code":"2409GIAMBAN20K","signature":"d08cdd2d66f89952a43db648be01136c983b07eacac8bbe92ef6833dcd106086","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":9900000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":9,"start_time":1632416400,"end_time":1632502740,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":0,"reward_value":2000000000,"reward_cap":0,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"SHOPEE","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[1],"wallet_redeemable":false,"customer_reference_id":"MP-3FFF2A89900880280000000044411550","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":2000000000,"discount_percentage":0,"discount_cap":0,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":true,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"\u00c1p d\u1ee5ng cho m\u1ed9t s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh. Nh\u00e2p m\u00e3 2409GIAMBAN20K gi\u1ea3m t\u1ed1i \u0111a 20K cho \u0111\u01a1n h\u00e0ng h\u1ee3p l\u1ec7 t\u1eeb 99K . HSD: 24\/09\/2021 00:00 - 24\/09\/2021 23:59. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i kh\u00e1ch h\u00e0ng ch\u1ec9 s\u1eed d\u1ee5ng 1 l\u1ea7n.","devices":["Android","iOS"],"force_new_user":1,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D186352171827200%26signature%3Dd08cdd2d66f89952a43db648be01136c983b07eacac8bbe92ef6833dcd106086%26voucherCode%3D2409GIAMBAN20K\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2F2409GIAMBAN20K%2F186352171827200%2Fd08cdd2d66f89952a43db648be01136c983b07eacac8bbe92ef6833dcd106086%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":186352188735488,"voucher_code":"2409HOANBAN20K","signature":"50fe7349d159d3961568d6899fcfa9bd46dfb534ec657753897a7909ce6e9cf6","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":5000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":15,"start_time":1632416400,"end_time":1632502740,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":1,"reward_percentage":100,"reward_value":null,"reward_cap":20000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"e6a3b7beffa95ca492926978d5235f79","icon_text":"SHOPEE","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[1],"wallet_redeemable":false,"customer_reference_id":"MP-4000AA8D900880280000000044411550","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":null,"discount_percentage":null,"discount_cap":null,"coin_percentage":100,"coin_cap":20000,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":true,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"\u00c1p d\u1ee5ng cho m\u1ed9t s\u1ed1 ng\u01b0\u1eddi d\u00f9ng nh\u1ea5t \u0111\u1ecbnh. Nh\u00e2p m\u00e3 2409HOANBAN20K ho\u00e0n t\u1ed1i \u0111a 20K Xu cho \u0111\u01a1n h\u00e0ng h\u1ee3p l\u1ec7 t\u1eeb 50K . HSD: 24\/09\/2021 00:00 - 24\/09\/2021 23:59. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n. M\u1ed7i kh\u00e1ch h\u00e0ng ch\u1ec9 s\u1eed d\u1ee5ng 1 l\u1ea7n.","devices":["Android","iOS"],"force_new_user":1,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D186352188735488%26signature%3D50fe7349d159d3961568d6899fcfa9bd46dfb534ec657753897a7909ce6e9cf6%26voucherCode%3D2409HOANBAN20K\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2F2409HOANBAN20K%2F186352188735488%2F50fe7349d159d3961568d6899fcfa9bd46dfb534ec657753897a7909ce6e9cf6%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":186506640097280,"voucher_code":"FABRNUP9","signature":"6252e37cc019096a411e1c154930653c7f90f923d917e202cf6a4e40790952dd","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":15000000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":4,"start_time":1632416400,"end_time":1632502740,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":10,"reward_value":0,"reward_cap":5000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"aa73f8aa302834aa9fc6adbf6e704cf2","icon_text":"Th\u1eddi Trang","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-1F3E2862800880280000000044414400","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":10,"discount_cap":5000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"M\u00e3 FABRNUP9 gi\u1ea3m 10% t\u1ed1i \u0111a 50K \u0111\u01a1n t\u1eeb 150K. H\u1ea1n s\u1eed d\u1ee5ng: [23h59, 24\/9\/2021]\r\n M\u1ed7i ng\u01b0\u1eddi ch\u1ec9 s\u1eed d\u1ee5ng m\u00e3 1 l\u1ea7n.\r\n S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.","devices":["Android","iOS"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D186506640097280%26signature%3D6252e37cc019096a411e1c154930653c7f90f923d917e202cf6a4e40790952dd%26voucherCode%3DFABRNUP9\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FFABRNUP9%2F186506640097280%2F6252e37cc019096a411e1c154930653c7f90f923d917e202cf6a4e40790952dd%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"},{"promotionid":187904290947072,"voucher_code":"COSUSEP","signature":"02a36e2ed5188f4e15c351c27c3f95402c633270aecd6e9893fb060f641731bc","use_type":1,"platform_type":null,"voucher_market_type":1,"min_spend":39900000000,"used_price":null,"current_spend":null,"product_limit":true,"quota_type":null,"percentage_claimed":0,"percentage_used":0,"start_time":1632330000,"end_time":1633885140,"collect_time":null,"claim_start_time":0,"valid_days":0,"reward_type":0,"reward_percentage":5,"reward_value":0,"reward_cap":5000000000,"coin_earned":null,"title":null,"use_link":null,"icon_hash":"b0c71ac4233792b24df0739f80aba3a6","icon_text":"Kh\u1ecfe \u0026 \u0110\u1eb9p","icon_url":null,"customised_labels":[],"customised_product_scope_tags":[],"shop_id":0,"shop_name":null,"is_shop_preferred":false,"is_shop_official":false,"shop_count":null,"ui_display_type":null,"customised_mall_name":null,"small_icon_list":null,"dp_category_name":null,"invalid_message_code":null,"invalid_message":null,"display_labels":[],"wallet_redeemable":false,"customer_reference_id":"MP-D40AC0A5480880280000000044445411","fully_redeemed":false,"has_expired":null,"disabled":false,"voucher_external_market_type":null,"now_food_extra_info":null,"airpay_opv_extra_info":null,"partner_extra_info":null,"discount_value":0,"discount_percentage":5,"discount_cap":5000000000,"coin_percentage":null,"coin_cap":null,"usage_limit":null,"used_count":null,"left_count":null,"shopee_wallet_only":false,"new_user_only":null,"description":"Phi\u00ean b\u1ea3n \u1ee8ng d\u1ee5ng Shopee b\u1ea1n \u0111ang s\u1eed d\u1ee5ng kh\u00f4ng h\u1ed7 tr\u1ee3 trang n\u00e0y. Vui l\u00f2ng c\u1eadp nh\u1eadt phi\u00ean b\u1ea3n m\u1edbi nh\u1ea5t c\u1ee7a \u1ee9ng d\u1ee5ng.","shop_logo":null,"error_code":null,"is_claimed_before":null,"customised_product_scope_tag_image_hash":null,"distributed_labels":null,"has_pre_excluded_products":false,"usage_terms":"Nh\u1eadp m\u00e3 COSUSEP gi\u1ea3m 5% t\u1ed1i \u0111a 50000 cho \u0111\u01a1n t\u1eeb 399000. HSD: 23:59 10\/10\/2021. S\u1ed1 l\u01b0\u1ee3ng c\u00f3 h\u1ea1n.","devices":["iOS","Android"],"force_new_user":0,"is_banner":0,"banner_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn\u0026mo_source=shopee_voucher","search_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fsearch%3FpromotionId%3D187904290947072%26signature%3D02a36e2ed5188f4e15c351c27c3f95402c633270aecd6e9893fb060f641731bc%26voucherCode%3DCOSUSEP\u0026mo_source=shopee_voucher","detail_link":"https:\/\/rutgon.me\/v0\/MGUYSvZ9xgl_dGJ8LUf8WA?url=https%3A%2F%2Fshopee.vn%2Fvoucher-details%2FCOSUSEP%2F187904290947072%2F02a36e2ed5188f4e15c351c27c3f95402c633270aecd6e9893fb060f641731bc%3Faction%3Dokay%26source%3D0\u0026mo_source=shopee_voucher"}];
moVouchersData = dynamicSort(moVouchersData);
let pagination = {
    block: 'tat-ca',
    pageSize: 10,
    currentPage: 1,
    totalVouchers: moVouchersData.length
};
setPaginationTitle(pagination);

if (moVouchersData.length <= 0) {
    moErrorMessage.innerHTML = 'Hệ thống chưa có mã!';
}
else {
    generateVouchersTabs(moVouchersData);
}

let isTouch = 'ontouchstart' in window;
moWrap.className += isTouch ? ' touch ' : ' no-touch ';
checkScreenSize();

window.addEventListener("resize", checkScreenSize);

let backBtnEnable = true;

document.addEventListener('click', function (e) {
    if (e.target.id === 'cps-btn-search-voucher') {
        let moSearchUrl = moSearchInput.value.trim();
        if (moSearchUrl === '') {
            loadingBar.classList.remove('cps-show');
            loadingTitle.innerHTML = '';
            moErrorMessage.innerHTML = 'Vui lòng điền link sản phẩm!';
            return false;
        }
        let parsedUrl = document.createElement('a');
        parsedUrl.href = moSearchUrl;
        if (parsedUrl.hostname !== 'shopee.vn' || parsedUrl.pathname === '/') {
            loadingBar.classList.remove('cps-show');
            loadingTitle.innerHTML = '';
            moErrorMessage.innerHTML = 'Link sản phẩm không hợp lệ. Vui lòng kiểm tra lại!';
        }

        let productParams = [];
        if (parsedUrl.pathname.indexOf('/product/') !== -1) {
            productParams= parsedUrl.pathname.split("/").slice(-2);
        }
        else {
            productParams= parsedUrl.pathname.split(".").slice(-2);
        }
        if (productParams.length < 2 || !productParams[0].isNumber() || !productParams[1].isNumber()) {
            loadingBar.classList.remove('cps-show');
            loadingTitle.innerHTML = '';
            moErrorMessage.innerHTML = 'Link sản phẩm không hợp lệ. Vui lòng kiểm tra lại!';
            return false;
        }
        alert(productParams[1]);
        alert(productParams[0]);
        searchBtn.disabled = true;
        backBtnEnable = false;
        let xhr = new XMLHttpRequest();
        moWrap.classList.toggle('cps-loading');
        loadingBar.classList.add('cps-show');
        loadingTitle.innerHTML = 'Đang lấy danh sách mã';
        progressBar.innerHTML = '0%';
        progressBar.style.width = '0%';
        xhr.onload = function() {
            moWrap.classList.toggle('cps-loading');
            if (xhr.status === 200) {
                moErrorMessage.innerHTML = '';
                let moResponse = JSON.parse(xhr.response);
                let shopVouchers = moResponse['data']['vouchers'];alert(shopVouchers.length);
                let moProductInfo = moResponse['data']['product_info'];
                if (moVouchersData.length + shopVouchers.length <= 0) {
                    loadingBar.classList.remove('cps-show');
                    loadingTitle.innerHTML = '';
                    moErrorMessage.innerHTML = 'Không tìm thấy mã nào phù phợp!';
                    return false;
                }
                let loadingPercent = 100/(moVouchersData.length + shopVouchers.length);
                loadingTitle.innerHTML = 'Chuẩn bị kiểm tra...';
                progressBar.style.width = '0%';
                let promises = [];
                shopVouchers.forEach(function(shopVoucher, index) {
                    promises.push(checkVoucher(moVoucherslist, shopVoucher, moProductInfo, loadingPercent));
                });
                moVouchersData.forEach(function(moVoucher, index) {
                    promises.push(checkVoucher(moVoucherslist, moVoucher, moProductInfo, loadingPercent));
                });
                Promise.all(promises).then((results) => {
                    let matchedVouchers = results.filter(result => result !== 0);
                    if (matchedVouchers.length > 0) {
                        matchedVouchers = dynamicSort(matchedVouchers);
                        generateVouchersTabs(matchedVouchers, moProductInfo.aff_link);
                        pagination.block = 'tat-ca';
                        pagination.currentPage = 1;
                        pagination.totalVouchers = matchedVouchers.length;
                        setPaginationTitle(pagination);
                        loadingTitle.innerHTML = 'Kiểm tra hoàn tất. Tìm thấy ' + matchedVouchers.length + ' mã phù hợp';
                        backToAllBtn.classList.add('show');
                    }
                    else {
                        loadingTitle.innerHTML = 'Kiểm tra hoàn tất. Không tìm thấy mã nào phù hợp';
                    }
                    progressBar.innerHTML = '100%';
                    searchBtn.disabled = false;
                    backBtnEnable = true;
                    progressBar.style.width = progressBar.innerHTML;
                    doScrolling('#cps-wrap', 200);
                });
            }
            else {
                searchBtn.disabled = false;
                backBtnEnable = true;
                if (xhr.response && JSON.parse(xhr.response).message) {
                    moErrorMessage.innerHTML = JSON.parse(xhr.response).message;
                }
                else {
                    moErrorMessage.innerHTML = 'Lỗi trong quá trình check mã. Vui lòng thử lại sau!';
                }
                loadingBar.classList.remove('cps-show');
                loadingTitle.innerHTML = '';
            }
        }
        // xhr.open('GET', 'https://promotion-api.masoffer.net' + '/v1/promotion/get-shop-vouchers?item_id='+ productParams[1] + '&shop_id=' + productParams[0] + '&encoded_publisher_id=' + 'MGUYSvZ9xgl_dGJ8LUf8WA' + '&domain=' + 'rutgon.me');
        xhr.open('GET', 'https://taobao.cafelinkcustomer.info/shopee/data.php' );
        xhr.send(null);
    }

    if (e.target.classList.contains('cps-btn-get-voucher')) {
        if (e.target.getAttribute("href") === '') {
            e.preventDefault();
        }
        copyVoucherCode(e.target);
    }

    if (e.target.classList.contains('cps-category-label')) {
        removeActive('cps-category-label');
        e.target.classList.add('active');
        removeActive('cps-vouchers-block');
        document.getElementById(e.target.dataset.id).classList.add('active');
        removeActive('cps-vouchers-page');
        document.getElementById(e.target.dataset.id).children[0].classList.add('active');
        pagination.block = e.target.dataset.id;
        let block = document.getElementById(e.target.dataset.id);
        let children = block.childNodes;
        totalVouchers = 0;
        for (let i = 0; i < children.length; i++) {
            totalVouchers += children[i].childElementCount;
        }
        pagination.totalVouchers = totalVouchers;
        pagination.currentPage = 1;
        doScrolling('#cps-wrap', 200);
        setPaginationTitle(pagination);
    }

    if (e.target.classList.contains('cps-toggle-page')) {
        totalPage = Math.ceil(pagination.totalVouchers / pagination.pageSize);
        let step = 1;
        if (e.target.id == 'cps-previous') {
            step = -1;
        }

        pagination.currentPage += step;
        if (pagination.currentPage > totalPage) {
            pagination.currentPage = 1;
        }

        if (pagination.currentPage <= 0) {
            pagination.currentPage = totalPage;
        }
        removeActive('cps-vouchers-page');
        document.getElementById(pagination.block + '-page-' + pagination.currentPage).classList.add('active');
        setPaginationTitle(pagination);
        doScrolling('#cps-wrap', 200);
    }

    if (e.target.id == 'cps-back-btn') {
        if (!backBtnEnable) return false;
        pagination = {
            block: 'tat-ca',
            pageSize: 10,
            currentPage: 1,
            totalVouchers: moVouchersData.length
        };
        setPaginationTitle(pagination);

        if (moVouchersData.length <= 0) {
            moErrorMessage.innerHTML = 'Chưa có mã!';
        }
        else {
            generateVouchersTabs(moVouchersData);
        }
        backToAllBtn.classList.remove('show');
        loadingTitle.innerHTML = '';
        loadingBar.classList.remove('cps-show');
        moSearchInput.value = '';
        doScrolling('#cps-wrap', 200);
    }
}, false);
document.addEventListener('scroll', () => {
    if (vouchersBlocks.offsetHeight > 500 && screen.width < 576) {
        if (window.scrollY >= getElementY('#cps-vouchers-blocks') && window.scrollY <= (getElementY('#cps-pagination') - 220)) {
            stickyBlock.classList.remove('unset');
            stickyBlock.classList.add('fixed');
        }
        else {
            stickyBlock.classList.remove('fixed');
            if (window.scrollY < getElementY('#cps-vouchers-blocks')) {
                stickyBlock.classList.add('unset');
            }
        }
    }
    else {
        stickyBlock.classList.remove('fixed');
        stickyBlock.classList.add('unset');
    }
})
})();