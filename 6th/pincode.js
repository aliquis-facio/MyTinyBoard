const btnOTP = document.querySelector("#sendOTP");

function sendOTP() {
    let i = 0;
    let j = 0;
    while (j < 10000) {
        setTimeout(() => {
            while (i < j) {
                setTimeout(() => {
                    let otpNum = i;
                    let url = `checkOTP.php?otpNum=${otpNum}`;
                    let newtab;
                    newtab = window.open(url);
                    setTimeout(() => {
                        newtab.close();
                    }, "1000");
                }, "3000");
                i++;
            }
        }, "2000");
        j += 10;
    }
}

btnOTP.addEventListener("click", sendOTP);