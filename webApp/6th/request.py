import requests

url = f"http://ctf.segfaulthub.com:9999/login4/login.php"
response = requests.get(url)

text_response = response.text

session = requests.Session()

response = session.get()