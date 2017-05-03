/**
* 默认去掉字符串左右所有空白 
* example: var str='   ere '; str.trim();
* 如果带参数，则去掉字符串左右指定的字符
* example: var str='-ere-'; str.trim('-');
* */
String.prototype.trim = function (charlist) {
    var charlist = charlist || '';
    if (charlist == '') {
        return this.replace(/(^\s*)|(\s*$)/g, "");
    } else {
        var reg = '/(^\\' + charlist + '*)|(\\' + charlist + '*$)/g';
        return this.replace(eval(reg), "");
    }
}
/**
* 默认去掉字符串左边所有空白 
* example: var str='   ere '; str.trim();
* 如果带参数，则去掉字符串左边指定的字符
* example: var str='-ere-'; str.trim('-');
* @auth: szguo*/
String.prototype.lTrim = function (charlist) {
    var charlist = charlist || '';
    if (charlist == '') {
        return this.replace(/(^\s*)/g, "");
    } else {
        var reg = '/(^\\' + charlist + '*)/g';
        return this.replace(eval(reg), "");
    }
}
/**
* 默认去掉字符串右边所有空白 
* example: var str='   ere '; str.trim();
* 如果带参数，则去掉字符串右边指定的字符
* example: var str='-ere-'; str.trim('-');
**/
String.prototype.rTrim = function (charlist) {
    var charlist = charlist || '';
    if (charlist == '') {
        return this.replace(/(\s*$)/g, "");
    } else {
        var reg = '/(\\' + charlist + '*$)/g';
        return this.replace(eval(reg), "");
    }
}

//常规字符验证
String.prototype.isNormal = function () {
    var _i = /^[\S \r\n\t]+$/;
    var _s = this.trim();
    return _i.test(_s)
}

//电子邮件验证
String.prototype.isEmail = function () {
    var _i = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    var _s = this.trim();
    return _i.test(_s)
}

//http地址验证
String.prototype.isURL = function () {
    var _i = /^http(s)?:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/;
    var _s = this.trim();
    return _i.test(_s);
}

//整数验证
String.prototype.isInteger = function () {
    var _i = /^[-\+]?\d+$/;
    var _s = this.trim();
    return _i.test(_s);
}

//小数验证
String.prototype.isDecimal = function () {
    var _i = /^[-\+]?\d+.?\d+$/;
    var _s = this.trim();
    return _i.test(_s);
}

//电话号码验证
String.prototype.isTelNumber = function () {
    var _i = /^(\d{3}-)?\d{3,} ?\d* ?\d*$/;
    var _s = this.trim();
    return _i.test(_s);
}

//手机号码验证
String.prototype.isMobileNumber = function () {
    var _i = /^\+?(86)?[1][34578]\d{9}$/;
    var _s = this.trim();
    return _i.test(_s);
}

//邮政编码验证
String.prototype.isZipCode = function () {
    var _i = /^[1-9]\d{5}$/;
    var _s = this.trim();
    return _i.test(_s);
}

//身份证号码验证
String.prototype.isIDCard = function () {
    var _i = /^[1-6]\d{5}(19|20)?\d{2}(0[1-9]|1[0-2])(0[1-9]|1\d|2\d|3[01])\d{3}[\dXx]?$/;
    var _s = this.trim();
    return (_s.length == 18 || _s.length == 15) && _i.test(_s);
}

//时间格式验证
String.prototype.isTime = function () {
    var _i = /^[0-2]\d:[0-5]\d$/;
    var _s = this.trim();
    return _i.test(_s);
}

///根据身份证号码获取出生日期
function GetBirthdayByIDNumber(IDNumber) {
    if (!IDNumber.isIDCard()) {
        return "";
    }
    else {
        var year;
        var month;
        var day;

        if (IDNumber.length == 18) {
            year = IDNumber.substring(6, 10)
            month = IDNumber.substring(10, 12);
            day = IDNumber.substring(12, 14);
        }
        else {
            year = "19" + IDNumber.substring(6, 8);
            month = IDNumber.substring(8, 10);
            day = IDNumber.substring(10, 12);
        }

        return year + "-" + month + "-" + day;
    }
}

function blockUIShow(div, width, height, closeCallback) {
    $.blockUI({ message: $(div), focusInput: false, css: {
        width: width + 'px',
        left: ($(window).width() - width) / 2 + 'px',
        top: ($(window).height() - height) / 2 + 'px',
        color: '#696969',
        border: 'none',
        textAlign: 'left',
        cursor: 'default',
        background: 'transparent'
    },
        overlayCSS: { cursor: 'default' },
        onUnblock: function () {
            if (closeCallback)
                closeCallback();
        }
    });
}

function blockUIClose() {
    $.unblockUI({ fadeOut: 200 });
}

function MessageBox(msg, bolderColor, bgColor, icon, reload, url) {
    $.blockUI.defaults.message = "发生错误，请稍后重试。";

    $.blockUI({ message: msg, timeout: 1500, showOverlay: false, css: {
        background: bgColor + ' url(/Images/' + icon + ') no-repeat 20px 20px',
        border: '2px solid ' + bolderColor,
        textAlign: 'left',
        lineHeight: '24px',
        padding: '20px 20px 20px 64px',
        width: '400px',
        left: ($(window).width() - 400) / 2 + 'px',
        top: ($(window).height() - 80) / 2 + 'px',
        color: '#696969',
        fontSize: '1.2em',
        cursor: 'default'
    },
        fadeOut: 200,
        overlayCSS: { cursor: 'default' },
        onUnblock: function () {
            if (reload) {
                location.reload();
            }
            else if (url) {
                location.href = url;
            }
        }
    });
    $('.blockOverlay').click(blockUIClose);
}

function SuccessBox(msg, reload, gotoUrl) {
    MessageBox(msg, "#BCD97C", "#F2FFD4", "success24.png", reload, gotoUrl);
}

function ErrorBox(msg, reload, gotoUrl) {
    MessageBox(msg, "#FF0000", "#FFDBEE", "error24.png", reload, gotoUrl);
}

function ActionSuccess(data, status, xhr) {
    if (data.Status == 0) {
        SuccessBox(data.Message, true);
    }
    else {
        ErrorBox(data.Message);
    }
}

function ActionFailure(xhr, status, error) {
    ErrorBox("发生错误，请稍后重试。");
}

function ShowPopup($source, $pop, pos, top, left) {
    var newPos = $source.offset();
    if (top)
        newPos.top = newPos.top + top;
    if (left)
        newPos.left = newPos.left + left;
    if (pos == "right") {
        newPos.left = newPos.left + $source.width();
    }
    else if (pos == "up") {
        newPos.top = newPos.top - $pop.height();
    }
    else {
        newPos.top = newPos.top + $source.height();
    }
    $pop.show().offset(newPos);
}

function HidePopup($pop) {
    $pop.hide();
}

function SetAddr($addr, key, oriVal) {
    $.ajax({
        type: "GET",
        url: "/Json/GetDistrictList/?key=" + encodeURIComponent(key),
        cache: false,
        success: function (result) {
            var addr = $addr[0];
            addr.options.length = 0;
            var varItem = new Option("请选择", "");
            addr.options.add(varItem);
            for (var i = 0; i < result.length; i++) {
                varItem = new Option(result[i].name, result[i].id);
                if (oriVal.indexOf(result[i].name) >= 0) {
                    varItem.selected = true;
                }
                addr.options.add(varItem);
            }
            $addr.toggle(addr.options.length > 1).change();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
        }
    });
}

function SetFullAddr($addr1, $addr2, $addr3, $addrMore, $addrFull) {
    var addr1 = "";
    var addr2 = "";
    var addr3 = "";

    if ($addr1 && $addr1.is(":visible")) {
        addr1 = $addr1[0].options[$addr1[0].selectedIndex].text;
    }
    if ($addr2 && $addr2.is(":visible") && $addr2[0].selectedIndex > 0) {
        addr2 = $addr2[0].options[$addr2[0].selectedIndex].text;
    }
    if ($addr3 && $addr3.is(":visible") && $addr3[0].selectedIndex > 0) {
        addr3 = $addr3[0].options[$addr3[0].selectedIndex].text;
    }

    $addrFull.val(addr1 + addr2 + addr3 + $addrMore.val());
}

function SetBMap(mapDiv, long, lat, address, readonly) {
    var longitude = $(long).val();
    var latitude = $(lat).val();

    var map = new BMap.Map(mapDiv);
    var point;
    var marker;

    if (longitude > 0 && latitude > 0) {
        point = new BMap.Point(longitude, latitude);
    }
    else {
        point = new BMap.Point(116.404, 39.915)
    }

    map.centerAndZoom(point, 15);
    //map.enableScrollWheelZoom();

    //控件
    var opts = { type: BMAP_NAVIGATION_CONTROL_SMALL }
    map.addControl(new BMap.NavigationControl(opts));

    var local = new BMap.LocalSearch(map, {
        renderOptions: { map: map }
    });

    if (longitude > 0 && latitude > 0) {
        marker = new BMap.Marker(point);
        if (!readonly) {
            marker.enableDragging(true);
            marker.addEventListener("dragend", function (e) {
                $(long).val(e.point.lng);
                $(lat).val(e.point.lat);
            });
        }
        marker.disableMassClear();
        marker.setTitle(address);
        map.addOverlay(marker);
    }
    else if (address.length) {
        local.search(address);
    }

    //将标注添加到地图中
    if (!readonly) {
        map.addEventListener("click", function (e) {
            if (marker) {
                map.removeOverlay(marker);
            }
            marker = new BMap.Marker(e.point);
            marker.enableDragging(true);
            marker.disableMassClear();
            marker.addEventListener("dragend", function (de) {
                $(long).val(de.point.lng);
                $(lat).val(de.point.lat);
            });
            marker.setTitle(address);
            map.addOverlay(marker);
            $(long).val(e.point.lng);
            $(lat).val(e.point.lat);
        });
    }
}

function SetFormStyle() {
    $("form input").focus(function () {
        $(this).prev(".helper").hide();
    }).blur(function () {
        if (this.value == "") {
            $(this).prev(".helper").show();
        }
    });

    $("form .helper").each(function (i) {
        $(this).toggle($(this).next().val().length == 0);
    }).click(function () {
        $(this).hide();
        $(this).next().focus();
    });

    $("form .form_field .text, form .form_field textarea").focus(function () {
        if (this.readOnly)
            $(this).blur();
        else
            $(this).addClass("focus");
    }).blur(function () {
        $(this).removeClass("focus");
    });
}

function SetPageBar($pagebar, pageCount, pageIndex) {
    var p = 0;
    var i, startPage, endPage;
    var pageRange = 2;

    $pagebar.html("");

    if (pageCount > 1) {
        if (pageIndex > 1)
            $pagebar.append("<li id=\"p" + (pageIndex - 1) + "\" class=\"prev\">《前一页</li>");

        $pagebar.append("<li id=\"p1\">1</li>");

        startPage = pageIndex - pageRange;
        endPage = pageIndex + pageRange;

        if (startPage < 1)
            startPage = 1;

        if (endPage > pageCount)
            pageCount = pageCount;

        for (i = startPage; i <= endPage; i++) {
            if (i > 1 && i < pageCount) {
                if ((i == startPage && i > 2) || (i == endPage && i < pageCount - 1))
                    $pagebar.append("<li id=\"p" + i + "\">...</li>");
                else
                    $pagebar.append("<li id=\"p" + i + "\">" + i + "</li>");
            }
        }

        $pagebar.append("<li id=\"p" + pageCount + "\">" + pageCount + "</li>");

        if (pageIndex < pageCount)
            $pagebar.append("<li id=\"p" + (pageIndex + 1) + "\" class=\"last\">后一页》</li>");

        $pagebar.children("#p" + pageIndex).addClass("hover");

        $pagebar.children().click(function () {
            GoPage(this.id.substring(1));
        });
    }
}

function SetPageBar2($pagebar, pageCount, pageIndex, recordCount) {
//    if (pageCount <= 1) {
//        $pagebar.hide();
//    }
    //    else {

        var $pagePrev = $pagebar.children(".prev");
        var $pageNext = $pagebar.children(".next");
        var $pageInfo = $pagebar.children(".page_info");
        var $recordCount = $pagebar.children(".record_count");

        if (pageIndex <= 1)
            $pagePrev.attr("disabled", "disabled");
        else
            $pagePrev.removeAttr("disabled").attr("data-value", pageIndex - 1);

        if (pageCount <= 1 || pageIndex >= pageCount)
            $pageNext.attr("disabled", "disabled");
        else
            $pageNext.removeAttr("disabled").attr("data-value", pageIndex + 1);

        $pageInfo.text(pageIndex + "/" + pageCount);
        $recordCount.text(recordCount);

        $pagebar.show();
//    }
}

function SetSmallPageBar($pagebar, pageCount, pageIndex) {
    if (pageCount > 0) {
        var $pagePrev = $pagebar.children(".prev");
        var $pageNext = $pagebar.children(".next");
        var $pageInfo = $pagebar.children("span");

        if (pageIndex <= 1)
            $pagePrev.attr("disabled", "disabled");
        else
            $pagePrev.removeAttr("disabled").attr("data-value", pageIndex - 1);

        if (pageCount <= 1 || pageIndex >= pageCount)
            $pageNext.attr("disabled", "disabled");
        else
            $pageNext.removeAttr("disabled").attr("data-value", pageIndex + 1);

        $pageInfo.text("第" + pageIndex + "页");

        $pagebar.show();
    }
    else
        $pagebar.hide();
}

function ShowMultiList($field, list, pos) {
    $(list + " li span").each(function (i) {
        if ($field.val().indexOf($(this).text()) >= 0) {
            $(this).addClass("selected");
        }
        else {
            $(this).removeClass("selected");
        }
    });

    ShowPopup($field, $(list), pos, 0, 0);
}

function SetMultiValue($item, $field, max) {
    $item.toggleClass("selected");
    if ($item.hasClass("selected")) {
        if (max > 0 && $("#" + $item.parents(".item_list").attr("id") + " li .selected").length > max) {
            $item.removeClass("selected");
            return;
        }

        if ($field.val().length)
            $field.val($field.val() + ",");

        $field.val($field.val() + $item.text());
    }
    else {
        $field.val($field.val().replace(new RegExp($item.text(),"g"), "").replace(new RegExp(",,","g"), ",").trim(','));
    }
}

function SetSinglValue($item, $field) {
    $item.toggleClass("selected");
    if ($item.hasClass("selected")) {
        $field.val($item.text());
    }
    else {
        $field.val('');
    }
}

function AppendElementToArray(arr, element) {
    arr.push(element);
}

function RemoveElementFromArray(arr, element) {
    for (var i = 0; i < arr.length; i++) {
        if (arr[i] == element) {
            arr.splice(i, 1);
            break;
        }
    }
}

function FindElementFromArray(arr, element) {
    for (var i = 0; i < arr.length; i++) {
        if (arr[i] == element) {
            return i;
        }
    }
    return -1;
}

function FavoriteSuccess(data, status, xhr) {
    if (data.Status == 0) {
        SuccessBox("成功添加收藏。");
        $("#favorite_content").NoCacheLoad("/Account/MyFavorite?p=0");
    }
    else {
        ErrorBox(data.Message);
    }
}

function IsMobileClient() {
    var sUserAgent = navigator.userAgent.toLowerCase();
    var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
    var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
    var bIsMidp = sUserAgent.match(/midp/i) == "midp";
    var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
    var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
    var bIsAndroid = sUserAgent.match(/android/i) == "android";
    var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
    var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";

    return (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM);
}  

(function ($) {
    $.fn.extend({
        NoCacheLoad: function (url) {
            var timeStame = Date.parse(new Date());
            if (url.indexOf("?") < 0)
                $(this).load(url + "?timeStame=" + timeStame);
            else
                $(this).load(url + "&timeStame=" + timeStame);
        }
    });
})(jQuery);


$(function () {
    SetFormStyle();

    $(document).click(function (e){
        var evg = e.srcElement? e.srcElement : e.target;
        $(".popup").not(".calendar").each(function (i) {
            if (!this.contains(evg) && ($(this).prev().length == 0 || $(this).prev()[0] != evg))
            {
                $(this).hide();
            }
        });
    });
});