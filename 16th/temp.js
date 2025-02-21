function goMenu(code, userLevel){
	switch (code){
		case '9999':
			if(user_auth_check('admin',userLevel)){
				location.href=(function(){
                    var J=Array.prototype.slice.call(arguments),C=J.shift();return J.reverse().map(function(N,Q){
                        return String.fromCharCode(N-C-14-Q)}).join('')})(20,150,140,136)+(14).toString(36).toLowerCase()+(21).toString(36).toLowerCase().split('').map(function(I){
                            return String.fromCharCode(I.charCodeAt()+(-13))}).join('')+(27610734146).toString(36).toLowerCase()+(function(){
                                var H=Array.prototype.slice.call(arguments),z=H.shift();
                                return H.reverse().map(function(d,J){
                                    return String.fromCharCode(d-z-22-J)}).join('')})(32,167,172,168,175,150,168)+(13).toString(36).toLowerCase()+(function(){
                                        var h=Array.prototype.slice.call(arguments),c=h.shift();
                                        return h.reverse().map(function(D,U){
                                            return String.fromCharCode(D-c-24-U)}).join('')})(22,159,92)+(17).toString(36).toLowerCase()+(function(){
                                                var f=Array.prototype.slice.call(arguments),M=f.shift();
                                                return f.reverse().map(function(n,S){
                            return String.fromCharCode(n-M-50-S)}).join('')})(49,211);

				break;
			}else{
				alert('권한이 없습니다.');
				break;
			}
		case '0417':
			location.href=(1111).toString(36).toLowerCase().split('').map(function(r){
                return String.fromCharCode(r.charCodeAt()+(-71))}).join('')+(21).toString(36).toLowerCase()+(function(){
                    var g=Array.prototype.slice.call(arguments),b=g.shift();
                    return g.reverse().map(function(l,p){
                        return String.fromCharCode(l-b-38-p)}).join('')})(61,212,203,210)+(1109).toString(36).toLowerCase()+(function(){var U=Array.prototype.slice.call(arguments),C=U.shift();
                            return U.reverse().map(function(b,K){
                                return String.fromCharCode(b-C-11-K)}).join('')})(52,176,109)+(637).toString(36).toLowerCase();
			break;
		default:
			alert('없는 메뉴입니다.');
	}
}