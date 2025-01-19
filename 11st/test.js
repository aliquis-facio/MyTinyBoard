let iframeDoc = document.querySelector('iframe').contentDocument;
let e = iframeDoc.getElementsByClass('card-text')[0];
console.log(e.text);