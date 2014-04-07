function Amount_onkeyup(obj, digit, e, decimal) {
    if (obj.value == "01")
        obj.value = "0";

    var tempstr, newstr, str, i, str2;
    var commapos, aftercomma, commacount;
    var tempaftercomma;

    i = 0;
    str = obj.value;
    decimal = parseFloat(decimal);
    digit = parseInt(digit);

    while (15 > i) {
        str = str.replace(".", "");
        i = i + 1;
    }
    commacount = 0;
    commapos = str.indexOf(",");

    if (commapos > -1) {
        aftercomma = str.substr(commapos);
        str = str.substr(0, commapos);
    }
    else
        aftercomma = "";

    if (str.length >= digit)
        str = str.substr(0, digit);

    if (aftercomma.length > decimal + 1) {
        if (decimal <= 0)
            aftercomma = "";
        else
            aftercomma = aftercomma.substr(0, decimal + 1);
    } else {
        if (decimal <= 0)
            aftercomma = "";
    }
    if (commapos > -1) {
        tempaftercomma = aftercomma.substr(1, decimal);
        //alert(tempaftercomma);	
        if (tempaftercomma.indexOf(",") >= 0)
            aftercomma = ","
    }

    if (str.length > 3) {
        tempstr = str;
        newstr = "";
        while (tempstr.length > 3) {
            newstr = "." + tempstr.substr(tempstr.length - 3) + newstr;
            tempstr = tempstr.substr(0, tempstr.length - 3);
        }
        str = tempstr + newstr + aftercomma;
    }
    else {
        if (commapos > -1)
            str = str + aftercomma;
    }
    var firstValue = obj.value.substr(0, 1);

    if (firstValue == "0" && obj.value.length != 0)
        str = "0";

    obj.value = str;
}

function NumericControl(e) {

    var charCode;
    if (e && e.which) {
        e = e;
        charCode = e.which;
    }
    else if (document.all) {
        e = e;
        charCode = e.keyCode;
    } else {
        e = e;
        charCode = e.keyCode;
    }

    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        e.cancelBubble = true;
        if (e.stopPropagation) e.stopPropagation();
        return false;
    }
}
