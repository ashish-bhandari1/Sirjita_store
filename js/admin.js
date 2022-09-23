//for dashboard menu
var date = document.getElementById("date");
var topnav = document.getElementById("welcomeAdmin");
var error = document.getElementById('ermsg');

function realtime() {
    var refresh = 1; // Refresh rate in milli seconds
    mytime = setTimeout('printdate()', refresh)
}

function printdate() {
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ':' + today.getMinutes() + ':' + today.getSeconds();
    topnav.innerHTML = 'Time: ' + time + '  Date: ' + date;
    realtime();
    //for billing
    var inputD = document.getElementById("inputDate");
    var inputT = document.getElementById("inputTime");
    inputD.value = date;
    inputT.value = time;
    //for input form
    //for billing
    var a = document.getElementById("inputDate2");
    var b = document.getElementById("inputTime2");
    a.value = date;
    b.value = time;
}

function greeting() {
    var today = new Date();
    var x = today.getHours();
    var greet;
    if (x < 12 && x > 3) {
        greet = "Good Morning Admin!"
    } else if (x < 17 && x >= 12) {
        greet = "Good Afternoon Admin!"
        console.log(x);
    } else if (x < 20 && x >= 16) {
        greet = "Good Evening Admin!"
        console.log(x);
    } else {
        greet = "Wish you sweet night Admin!";
        console.log(x);
    }
    date.innerHTML = greet;
}
greeting();

// function for opening and closing add  form 
function addForm() {
    var form = document.getElementById("formWrap");
    var formCls = form.className;
    if (formCls === "UploadFrom") {
        form.classList.add('FormShow');
    } else {
        form.className = "UploadFrom";
    }
}

function closeFrom() {
    var formAdd = document.getElementById("formWrap");
    var formEdit = document.getElementById("formEdit");
    formAdd.className = "UploadFrom";
    formEdit.className = "UploadFrom";
}
window.addEventListener("dblclick", function(event) {
    var formAdd = document.getElementById("formWrap");
    var formEdit = document.getElementById("formEdit");
    if (event.target == formAdd || event.target == formEdit) {
        formAdd.className = "UploadFrom";
        formEdit.className = "UploadFrom";
    }
});
// function for opening and closing add  form 
function editForm() {
    var form = document.getElementById("formEdit");
    var formCls = form.className;
    if (formCls === "UploadFrom") {
        form.classList.add('FormShow');
    } else {
        form.className = "UploadFrom";
    }
}
//seat selection function
function selectSeat(seatId) {
    var seat = document.getElementById(seatId);
    var input = document.getElementById("seat_id");
    var count = document.getElementById("count");
    var inputValue = input.value;
    var countValue = count.textContent;
    //checking class name of seats
    if (seat.classList != "seat-btn color Booked") {
        var limit = parseInt(countValue) + 1;
        count.innerHTML = limit;
        //avoiding more than 5 bookings
        if (limit <= 5) {
            seat.style.backgroundColor = "#1aeb1a";
            if (inputValue == 0) {
                input.value = seatId;
            } else {
                input.value = inputValue + "," + seatId;
            }
        } else {
            alert("Booking Limit Exeed!");
        }
    } else {
        alert("Sorry, Can't select Booked seat");
    }
}

function errorfunction() {
    error.style.display = "none";
}

function password_valid() {
    var pw, repw, btn;
    pw = document.getElementById('new_pw').value;
    repw = document.getElementById('renew_pw').value;
    btn = document.getElementById('passwordBtn');
    msg = document.getElementById('error');
    if (pw != repw) {
        msg.innerHTML = "<br> * Password does not match";
        btn.disabled = true;
        btn.style.cursor = 'not-allowed';
        btn.style.backgroundColor = 'rgba(255, 0, 0, 0.432)';
    } else {
        msg.innerHTML = "";
        btn.disabled = false;
        btn.style.cursor = 'pointer';
        btn.style.backgroundColor = 'rgb(13, 129, 182)';
    }
}

function stockradioLbl() {
    var form;
    form = document.getElementById("jsform");
    var lbl1 = document.getElementById("radioMsg1");
    var lbl2 = document.getElementById("radioMsg2");
    var lbl3 = document.getElementById("radioMsg3");
    var lbl4 = document.getElementById("radioMsg4");
    var lbl5 = document.getElementById("radioMsg5");
    var lbl6 = document.getElementById("radioMsg6");
    if (form.type[0].checked == true) {
        lbl1.innerHTML = "Quantity of Sack";
        lbl2.innerHTML = "Amount Per <i> Sack  </i>";
        lbl3.innerHTML = "Cost Price <i>/ Sack  </i>";
        lbl4.innerHTML = "Wholesell Price <i>/ Sack  </i>";
        lbl5.innerHTML = "Sell Price <i>/ Sack  </i>";
        lbl6.innerHTML = "Retail Price <i>/ Sack </i>";
    }
    if (form.type[1].checked == true) {
        lbl1.innerHTML = "Quantity of Cartoon";
        lbl2.innerHTML = "Amount Per <i> Cartoon  </i>";
        lbl3.innerHTML = "Cost Price <i>/ Cartoon  </i>";
        lbl4.innerHTML = "Wholesell Price <i>/ Cartoon  </i>";
        lbl5.innerHTML = "Sell Price <i>/ Cartoon  </i>";
        lbl6.innerHTML = "Retail Price <i>/ Cartoon </i>";
    }
}

function stockradio() {
    var form, input, inputAmtwrap, inputQtwrap, screenBtn;
    form = document.getElementById("jsform");
    input = document.getElementById("inputQt");
    inputQtwrap = document.getElementById("inputQtwrap");
    input2 = document.getElementById("inputAmt");
    inputAmtwrap = document.getElementById("inputAmtwrap");
    if (form.type[0].checked == true) {
        inputQtwrap.classList.remove('noVisible');
        inputAmtwrap.className = 'inputWrapper noVisible';
        input.required = true;
        input2.value = '';
        input2.required = false;
    }
    if (form.type[1].checked == true) {
        inputAmtwrap.classList.remove('noVisible');
        inputQtwrap.className = 'inputWrapper noVisible';
        input2.required = true;
        input.required = false;
        input.value = '';
    }
}

function stockinputerror(id) {
    var input, getid, screenBtn;
    //screening seat number validaing
    getid = document.getElementById('error');
    input = document.getElementById(id).value;
    screenBtn = document.getElementById('screeningBtn');
    // document.write("hello");
    if (input > 10000) {
        getid.innerHTML = "<br> * Having stock more than 10,000 at one is unappropiate please contact your servce provider 9869213908";
        screenBtn.disabled = true;
        screenBtn.style.cursor = 'not-allowed';
        screenBtn.style.backgroundColor = 'rgba(255, 0, 0, 0.432)';
    } else {
        getid.innerHTML = "";
        screenBtn.disabled = false;
        screenBtn.style.cursor = 'pointer';
        screenBtn.style.backgroundColor = 'rgb(13, 129, 182)';
    }
}

function billradio() {
    var form, input, oldType, newType, name, phone, address;
    form = document.getElementById("jsform");
    oldType = document.getElementById("oldwrap");
    newType = document.getElementById("newwrap");
    customerId = document.getElementById("customerId");
    name = document.getElementById("inputName");
    address = document.getElementById("inputAdr");
    phone = document.getElementById("inputNum");
    if (form.type[0].checked == true) {
        oldType.classList.remove('noVisible');
        newType.className = 'inputWrapper noVisible';
        customerId.required = true;
        name.value = '';
        address.value = '';
        phone.value = '';
        name.required = false;
        address.required = false;
    }
    if (form.type[1].checked == true) {
        newType.classList.remove('noVisible');
        oldType.className = 'inputWrapper noVisible';
        customerId.required = false;
        name.required = true;
        address.required = true;
    }
}

function billingTotal() {
    var screenBtn, name, sum, form, wp, sp, rp, rateType, amtType, qty, amount, total;
    rateType = document.getElementById("rateType").value;
    form = document.getElementById("jsform");
    name = document.getElementById("pType").innerHTML;
    wp = parseFloat(document.getElementById("wp").innerHTML);
    sp = parseFloat(document.getElementById("sp").innerHTML);
    rp = parseFloat(document.getElementById("rp").innerHTML);
    amtType = parseInt(document.getElementById("amtType").innerHTML);
    qty = document.getElementById("quantity").value;
    amount = parseInt(document.getElementById("amount").value);
    total = document.getElementById("total");
    var getid = document.getElementById('error');
    screenBtn = document.getElementById('screeningBtn');
    sum = (amtType * qty) + amount;
    if (amount < amtType) {
        if (rateType == "wp") {
            total.innerHTML = 'Total: ' + (sum * wp);
        } else if (rateType == "sp") {
            total.innerHTML = 'Total: ' + (sum * sp);
        } else if (rateType == "rp") {
            total.innerHTML = 'Total: ' + (sum * rp);
        } else {
            total.innerHTML = 'Total: Please Select Rate Structure First';
        }
        getid.innerHTML = "";
        screenBtn.disabled = false;
        screenBtn.style.cursor = 'pointer';
        screenBtn.style.backgroundColor = 'rgb(13, 129, 182)';
    } else {
        getid.innerHTML = "<br> * According to your database " + amtType + "= 1 " + name + ". Please add item in " + name;
        screenBtn.disabled = true;
        screenBtn.style.cursor = 'not-allowed';
        screenBtn.style.backgroundColor = 'rgba(255, 0, 0, 0.432)';
    }
    // total.innerHTML = 'Total: '+ amtType +  (sum * wp);
}