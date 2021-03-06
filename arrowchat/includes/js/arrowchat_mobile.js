if(typeof(jqac) === 'undefined') {
	jqac = jQuery;
}

/*!
  jQuery Cookie Plugin v1.4.0
  https://github.com/carhartl/jquery-cookie
 */
(function(factory){if(typeof define==='function'&&define.amd){define(['jqac'],factory);}else{factory(jqac);}}(function($){var pluses=/\+/g;function encode(s){return config.raw?s:encodeURIComponent(s);}
function decode(s){return config.raw?s:decodeURIComponent(s);}
function stringifyCookieValue(value){return encode(config.json?JSON.stringify(value):String(value));}
function parseCookieValue(s){if(s.indexOf('"')===0){s=s.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,'\\');}
try{s=decodeURIComponent(s.replace(pluses,' '));return config.json?JSON.parse(s):s;}catch(e){}}
function read(s,converter){var value=config.raw?s:parseCookieValue(s);return $.isFunction(converter)?converter(value):value;}
var config=$.cookie=function(key,value,options){if(value!==undefined&&!$.isFunction(value)){options=$.extend({},config.defaults,options);if(typeof options.expires==='number'){var days=options.expires,t=options.expires=new Date();t.setDate(t.getDate()+days);}
return(document.cookie=[encode(key),'=',stringifyCookieValue(value),options.expires?'; expires='+options.expires.toUTCString():'',options.path?'; path='+options.path:'',options.domain?'; domain='+options.domain:'',options.secure?'; secure':''].join(''));}
var result=key?undefined:{};var cookies=document.cookie?document.cookie.split('; '):[];for(var i=0,l=cookies.length;i<l;i++){var parts=cookies[i].split('=');var name=decode(parts.shift());var cookie=parts.join('=');if(key&&key===name){result=read(cookie,value);break;}
if(!key&&(cookie=read(cookie))!==undefined){result[name]=cookie;}}
return result;};config.defaults={};$.removeCookie=function(key,options){if($.cookie(key)===undefined){return false;}
$.cookie(key,'',$.extend({},options,{expires:-1}));return!$.cookie(key);};}));

if (c_push_engine == "1") {
/**
 * ArrowPush v3.7.2
 */
(function(){
var aa=void 0,v=!0,z=null,A=!1;function C(){return function(){}}
window.JSON&&window.JSON.stringify||function(){function a(){try{return this.valueOf()}catch(a){return z}}function d(a){c.lastIndex=0;return c.test(a)?'"'+a.replace(c,function(a){var b=q[a];return"string"===typeof b?b:"\\u"+("0000"+a.charCodeAt(0).toString(16)).slice(-4)})+'"':'"'+a+'"'}function b(c,q){var s,r,f,h,j,m=e,l=q[c];l&&"object"===typeof l&&(l=a.call(l));"function"===typeof g&&(l=g.call(q,c,l));switch(typeof l){case "string":return d(l);case "number":return isFinite(l)?String(l):"null";case "boolean":case "null":return String(l);
case "object":if(!l)return"null";e+=p;j=[];if("[object Array]"===Object.prototype.toString.apply(l)){h=l.length;for(s=0;s<h;s+=1)j[s]=b(s,l)||"null";f=0===j.length?"[]":e?"[\n"+e+j.join(",\n"+e)+"\n"+m+"]":"["+j.join(",")+"]";e=m;return f}if(g&&"object"===typeof g){h=g.length;for(s=0;s<h;s+=1)r=g[s],"string"===typeof r&&(f=b(r,l))&&j.push(d(r)+(e?": ":":")+f)}else for(r in l)Object.hasOwnProperty.call(l,r)&&(f=b(r,l))&&j.push(d(r)+(e?": ":":")+f);f=0===j.length?"{}":e?"{\n"+e+j.join(",\n"+e)+"\n"+
m+"}":"{"+j.join(",")+"}";e=m;return f}}window.JSON||(window.JSON={});var c=/[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,e,p,q={"\b":"\\b","\t":"\\t","\n":"\\n","\f":"\\f","\r":"\\r",'"':'\\"',"\\":"\\\\"},g;"function"!==typeof JSON.stringify&&(JSON.stringify=function(a,c,d){var q;p=e="";if("number"===typeof d)for(q=0;q<d;q+=1)p+=" ";else"string"===typeof d&&(p=d);if((g=c)&&"function"!==typeof c&&("object"!==typeof c||"number"!==
typeof c.length))throw Error("JSON.stringify");return b("",{"":a})});"function"!==typeof JSON.parse&&(JSON.parse=function(a){return eval("("+a+")")})}();var ba=1,ea=A,ha=[],ia="-pnpres",D=1E3,ja="/",ka="&",la=/{([\w\-]+)}/g;function ma(){return"x"+ ++ba+""+ +new Date}function E(){return+new Date}var na,pa=Math.floor(20*Math.random());na=function(a,d){return 0<a.indexOf("pubsub.")&&a.replace("pubsub","ps"+(d?qa().split("-")[0]:20>++pa?pa:pa=1))||a};
function ra(a,d){var b=a.join(ja),c=[];if(!d)return b;H(d,function(a,b){var d="object"==typeof b?JSON.stringify(b):b;"undefined"!=typeof b&&(b!=z&&0<encodeURIComponent(d).length)&&c.push(a+"="+encodeURIComponent(d))});return b+="?"+c.join(ka)}function sa(a,d){function b(){e+d>E()?(clearTimeout(c),c=setTimeout(b,d)):(e=E(),a())}var c,e=0;return b}function ta(a,d){var b=[];H(a||[],function(a){d(a)&&b.push(a)});return b}function ua(a,d){return a.replace(la,function(a,c){return d[c]||a})}
function qa(a){var d="xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g,function(a){var c=16*Math.random()|0;return("x"==a?c:c&3|8).toString(16)});a&&a(d);return d}function H(a,d){if(a&&d)if(a&&Array.isArray&&Array.isArray(a))for(var b=0,c=a.length;b<c;)d.call(a[b],a[b],b++);else for(b in a)a.hasOwnProperty&&a.hasOwnProperty(b)&&d.call(a[b],b,a[b])}function va(a,d){var b=[];H(a||[],function(a,e){b.push(d(a,e))});return b}
function wa(a,d){var b=[];H(a,function(a,e){d?0>a.search("-pnpres")&&e.h&&b.push(a):e.h&&b.push(a)});return b.sort()}function xa(a,d){var b=[];H(a,function(a,e){d?0>channel.search("-pnpres")&&e.h&&b.push(a):e.h&&b.push(a)});return b.sort()}function ya(){setTimeout(function(){ea||(ea=1,H(ha,function(a){a()}))},D)}var L,R=14,S=8,za=A;
function Ba(a,d){var b="",c,e;if(d){c=a[15];if(16<c)throw"Decryption error: Maybe bad key";if(16==c)return"";for(e=0;e<16-c;e++)b+=String.fromCharCode(a[e])}else for(e=0;16>e;e++)b+=String.fromCharCode(a[e]);return b}function Ca(a,d){var b=[],c;if(!d)try{a=unescape(encodeURIComponent(a))}catch(e){throw"Error on UTF-8 encode";}for(c=0;c<a.length;c++)b[c]=a.charCodeAt(c);return b}
function Da(a,d){var b=12<=R?3:2,c=[],e=[],c=[],e=[],p=a.concat(d),q;c[0]=GibberishAES.Q.S(p);e=c[0];for(q=1;q<b;q++)c[q]=GibberishAES.Q.S(c[q-1].concat(p)),e=e.concat(c[q]);c=e.slice(0,4*S);e=e.slice(4*S,4*S+16);return{key:c,J:e}}
function Ea(a,d,b){var d=Fa(d),c=Math.ceil(a.length/16),e=[],p,q=[];for(p=0;p<c;p++){var g=e,t=p,x=a.slice(16*p,16*p+16),s=[],r=aa,r=aa;16>x.length&&(r=16-x.length,s=[r,r,r,r,r,r,r,r,r,r,r,r,r,r,r,r]);for(r=0;r<x.length;r++)s[r]=x[r];g[t]=s}0===a.length%16&&e.push([16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16]);for(p=0;p<e.length;p++)e[p]=0===p?Ga(e[p],b):Ga(e[p],q[p-1]),q[p]=Ha(e[p],d);return q}
function Ia(a,d,b,c){var d=Fa(d),e=a.length/16,p=[],q,g=[],t="";for(q=0;q<e;q++)p.push(a.slice(16*q,16*(q+1)));for(q=p.length-1;0<=q;q--)g[q]=Ja(p[q],d),g[q]=0===q?Ga(g[q],b):Ga(g[q],p[q-1]);for(q=0;q<e-1;q++)t+=Ba(g[q]);var t=t+Ba(g[q],v),x;if(c)x=t;else try{x=decodeURIComponent(escape(t))}catch(s){throw"Bad Key";}return x}function Ha(a,d){za=A;var b=Ka(a,d,0),c;for(c=1;c<R+1;c++)b=La(b),b=Ma(b),c<R&&(b=Na(b)),b=Ka(b,d,c);return b}
function Ja(a,d){za=v;var b=Ka(a,d,R),c;for(c=R-1;-1<c;c--)b=Ma(b),b=La(b),b=Ka(b,d,c),0<c&&(b=Na(b));return b}function La(a){var d=za?Oa:Pa,b=[],c;for(c=0;16>c;c++)b[c]=d[a[c]];return b}function Ma(a){var d=[],b=za?[0,13,10,7,4,1,14,11,8,5,2,15,12,9,6,3]:[0,5,10,15,4,9,14,3,8,13,2,7,12,1,6,11],c;for(c=0;16>c;c++)d[c]=a[b[c]];return d}
function Na(a){var d=[],b;if(za)for(b=0;4>b;b++)d[4*b]=Qa[a[4*b]]^Sa[a[1+4*b]]^Ta[a[2+4*b]]^Ua[a[3+4*b]],d[1+4*b]=Ua[a[4*b]]^Qa[a[1+4*b]]^Sa[a[2+4*b]]^Ta[a[3+4*b]],d[2+4*b]=Ta[a[4*b]]^Ua[a[1+4*b]]^Qa[a[2+4*b]]^Sa[a[3+4*b]],d[3+4*b]=Sa[a[4*b]]^Ta[a[1+4*b]]^Ua[a[2+4*b]]^Qa[a[3+4*b]];else for(b=0;4>b;b++)d[4*b]=Va[a[4*b]]^bb[a[1+4*b]]^a[2+4*b]^a[3+4*b],d[1+4*b]=a[4*b]^Va[a[1+4*b]]^bb[a[2+4*b]]^a[3+4*b],d[2+4*b]=a[4*b]^a[1+4*b]^Va[a[2+4*b]]^bb[a[3+4*b]],d[3+4*b]=bb[a[4*b]]^a[1+4*b]^a[2+4*b]^Va[a[3+4*
b]];return d}function Ka(a,d,b){var c=[],e;for(e=0;16>e;e++)c[e]=a[e]^d[b][e];return c}function Ga(a,d){var b=[],c;for(c=0;16>c;c++)b[c]=a[c]^d[c];return b}
function Fa(a){var d=[],b=[],c,e,p=[];for(c=0;c<S;c++)e=[a[4*c],a[4*c+1],a[4*c+2],a[4*c+3]],d[c]=e;for(c=S;c<4*(R+1);c++){d[c]=[];for(a=0;4>a;a++)b[a]=d[c-1][a];if(0===c%S){a=b[0];e=aa;for(e=0;4>e;e++)b[e]=b[e+1];b[3]=a;b=cb(b);b[0]^=db[c/S-1]}else 6<S&&4==c%S&&(b=cb(b));for(a=0;4>a;a++)d[c][a]=d[c-S][a]^b[a]}for(c=0;c<R+1;c++){p[c]=[];for(b=0;4>b;b++)p[c].push(d[4*c+b][0],d[4*c+b][1],d[4*c+b][2],d[4*c+b][3])}return p}function cb(a){for(var d=0;4>d;d++)a[d]=Pa[a[d]];return a}
function eb(a,d){var b=[];for(i=0;i<a.length;i+=d)b[i/d]=parseInt(a.substr(i,d),16);return b}function fb(a){for(var d=[],b=0;256>b;b++){for(var c=a,e=b,p=aa,q=aa,p=q=0;8>p;p++)q=1==(e&1)?q^c:q,c=127<c?283^c<<1:c<<1,e>>>=1;d[b]=q}return d}
var Pa=eb("637c777bf26b6fc53001672bfed7ab76ca82c97dfa5947f0add4a2af9ca472c0b7fd9326363ff7cc34a5e5f171d8311504c723c31896059a071280e2eb27b27509832c1a1b6e5aa0523bd6b329e32f8453d100ed20fcb15b6acbbe394a4c58cfd0efaafb434d338545f9027f503c9fa851a3408f929d38f5bcb6da2110fff3d2cd0c13ec5f974417c4a77e3d645d197360814fdc222a908846eeb814de5e0bdbe0323a0a4906245cc2d3ac629195e479e7c8376d8dd54ea96c56f4ea657aae08ba78252e1ca6b4c6e8dd741f4bbd8b8a703eb5664803f60e613557b986c11d9ee1f8981169d98e949b1e87e9ce5528df8ca1890dbfe6426841992d0fb054bb16",2),
Oa,gb=Pa,hb=[];for(i=0;i<gb.length;i++)hb[gb[i]]=i;Oa=hb;var db=eb("01020408102040801b366cd8ab4d9a2f5ebc63c697356ad4b37dfaefc591",2),Va=fb(2),bb=fb(3),Ua=fb(9),Sa=fb(11),Ta=fb(13),Qa=fb(14),ib,jb="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",lb=jb.split("");"function"===typeof Array.indexOf&&(jb=lb);
ib={encode:function(a){var d=[],b="",c;for(c=0;c<16*a.length;c++)d.push(a[Math.floor(c/16)][c%16]);for(c=0;c<d.length;c+=3)b+=lb[d[c]>>2],b+=lb[(d[c]&3)<<4|d[c+1]>>4],b=d[c+1]!==aa?b+lb[(d[c+1]&15)<<2|d[c+2]>>6]:b+"=",b=d[c+2]!==aa?b+lb[d[c+2]&63]:b+"=";a=b.slice(0,64);for(c=1;c<Math.ceil(b.length/64);c++)a+=b.slice(64*c,64*c+64)+(Math.ceil(b.length/64)==c+1?"":"\n");return a},decode:function(a){var a=a.replace(/\n/g,""),d=[],b=[],c=[],e;for(e=0;e<a.length;e+=4)b[0]=jb.indexOf(a.charAt(e)),b[1]=jb.indexOf(a.charAt(e+
1)),b[2]=jb.indexOf(a.charAt(e+2)),b[3]=jb.indexOf(a.charAt(e+3)),c[0]=b[0]<<2|b[1]>>4,c[1]=(b[1]&15)<<4|b[2]>>2,c[2]=(b[2]&3)<<6|b[3],d.push(c[0],c[1],c[2]);return d=d.slice(0,d.length-d.length%16)}};
L={size:function(a){switch(a){case 128:R=10;S=4;break;case 192:R=12;S=6;break;case 256:R=14;S=8;break;default:throw"Invalid Key Size Specified:"+a;}},h2a:function(a){var d=[];a.replace(/(..)/g,function(a){d.push(parseInt(a,16))});return d},expandKey:Fa,encryptBlock:Ha,decryptBlock:Ja,Decrypt:za,s2a:Ca,rawEncrypt:Ea,rawDecrypt:Ia,dec:function(a,d,b){var a=ib.ja(a),c=a.slice(8,16),c=Da(Ca(d,b),c),d=c.key,c=c.J,a=a.slice(16,a.length);return a=Ia(a,d,c,b)},openSSLKey:Da,a2h:function(a){var d="",b;for(b=
0;b<a.length;b++)d+=(16>a[b]?"0":"")+a[b].toString(16);return d},enc:function(a,d,b){var c;c=[];var e;for(e=0;8>e;e++)c=c.concat(Math.floor(256*Math.random()));e=Da(Ca(d,b),c);d=e.key;e=e.J;c=[[83,97,108,116,101,100,95,95].concat(c)];a=Ca(a,b);a=Ea(a,d,e);a=c.concat(a);return ib.ka(a)},Hash:{MD5:function(a){function d(a,b){var d,c,e,f,g;e=a&2147483648;f=b&2147483648;d=a&1073741824;c=b&1073741824;g=(a&1073741823)+(b&1073741823);return d&c?g^2147483648^e^f:d|c?g&1073741824?g^3221225472^e^f:g^1073741824^
e^f:g^e^f}function b(a,b,c,e,f,g,l){a=d(a,d(d(b&c|~b&e,f),l));return d(a<<g|a>>>32-g,b)}function c(a,b,c,e,f,g,l){a=d(a,d(d(b&e|c&~e,f),l));return d(a<<g|a>>>32-g,b)}function e(a,b,c,e,g,f,l){a=d(a,d(d(b^c^e,g),l));return d(a<<f|a>>>32-f,b)}function p(a,b,c,e,f,g,l){a=d(a,d(d(c^(b|~e),f),l));return d(a<<g|a>>>32-g,b)}function q(a){var b,d,c=[];for(d=0;3>=d;d++)b=a>>>8*d&255,c=c.concat(b);return c}var g=[],t,x,s,r,f,h,j,m,l=eb("67452301efcdab8998badcfe10325476d76aa478e8c7b756242070dbc1bdceeef57c0faf4787c62aa8304613fd469501698098d88b44f7afffff5bb1895cd7be6b901122fd987193a679438e49b40821f61e2562c040b340265e5a51e9b6c7aad62f105d02441453d8a1e681e7d3fbc821e1cde6c33707d6f4d50d87455a14eda9e3e905fcefa3f8676f02d98d2a4c8afffa39428771f6816d9d6122fde5380ca4beea444bdecfa9f6bb4b60bebfbc70289b7ec6eaa127fad4ef308504881d05d9d4d039e6db99e51fa27cf8c4ac5665f4292244432aff97ab9423a7fc93a039655b59c38f0ccc92ffeff47d85845dd16fa87e4ffe2ce6e0a30143144e0811a1f7537e82bd3af2352ad7d2bbeb86d391",
8),g=a.length;t=g+8;x=16*((t-t%64)/64+1);s=[];for(f=r=0;f<g;)t=(f-f%4)/4,r=8*(f%4),s[t]|=a[f]<<r,f++;t=(f-f%4)/4;s[t]|=128<<8*(f%4);s[x-2]=g<<3;s[x-1]=g>>>29;g=s;f=l[0];h=l[1];j=l[2];m=l[3];for(a=0;a<g.length;a+=16)t=f,x=h,s=j,r=m,f=b(f,h,j,m,g[a+0],7,l[4]),m=b(m,f,h,j,g[a+1],12,l[5]),j=b(j,m,f,h,g[a+2],17,l[6]),h=b(h,j,m,f,g[a+3],22,l[7]),f=b(f,h,j,m,g[a+4],7,l[8]),m=b(m,f,h,j,g[a+5],12,l[9]),j=b(j,m,f,h,g[a+6],17,l[10]),h=b(h,j,m,f,g[a+7],22,l[11]),f=b(f,h,j,m,g[a+8],7,l[12]),m=b(m,f,h,j,g[a+9],
12,l[13]),j=b(j,m,f,h,g[a+10],17,l[14]),h=b(h,j,m,f,g[a+11],22,l[15]),f=b(f,h,j,m,g[a+12],7,l[16]),m=b(m,f,h,j,g[a+13],12,l[17]),j=b(j,m,f,h,g[a+14],17,l[18]),h=b(h,j,m,f,g[a+15],22,l[19]),f=c(f,h,j,m,g[a+1],5,l[20]),m=c(m,f,h,j,g[a+6],9,l[21]),j=c(j,m,f,h,g[a+11],14,l[22]),h=c(h,j,m,f,g[a+0],20,l[23]),f=c(f,h,j,m,g[a+5],5,l[24]),m=c(m,f,h,j,g[a+10],9,l[25]),j=c(j,m,f,h,g[a+15],14,l[26]),h=c(h,j,m,f,g[a+4],20,l[27]),f=c(f,h,j,m,g[a+9],5,l[28]),m=c(m,f,h,j,g[a+14],9,l[29]),j=c(j,m,f,h,g[a+3],14,l[30]),
h=c(h,j,m,f,g[a+8],20,l[31]),f=c(f,h,j,m,g[a+13],5,l[32]),m=c(m,f,h,j,g[a+2],9,l[33]),j=c(j,m,f,h,g[a+7],14,l[34]),h=c(h,j,m,f,g[a+12],20,l[35]),f=e(f,h,j,m,g[a+5],4,l[36]),m=e(m,f,h,j,g[a+8],11,l[37]),j=e(j,m,f,h,g[a+11],16,l[38]),h=e(h,j,m,f,g[a+14],23,l[39]),f=e(f,h,j,m,g[a+1],4,l[40]),m=e(m,f,h,j,g[a+4],11,l[41]),j=e(j,m,f,h,g[a+7],16,l[42]),h=e(h,j,m,f,g[a+10],23,l[43]),f=e(f,h,j,m,g[a+13],4,l[44]),m=e(m,f,h,j,g[a+0],11,l[45]),j=e(j,m,f,h,g[a+3],16,l[46]),h=e(h,j,m,f,g[a+6],23,l[47]),f=e(f,h,
j,m,g[a+9],4,l[48]),m=e(m,f,h,j,g[a+12],11,l[49]),j=e(j,m,f,h,g[a+15],16,l[50]),h=e(h,j,m,f,g[a+2],23,l[51]),f=p(f,h,j,m,g[a+0],6,l[52]),m=p(m,f,h,j,g[a+7],10,l[53]),j=p(j,m,f,h,g[a+14],15,l[54]),h=p(h,j,m,f,g[a+5],21,l[55]),f=p(f,h,j,m,g[a+12],6,l[56]),m=p(m,f,h,j,g[a+3],10,l[57]),j=p(j,m,f,h,g[a+10],15,l[58]),h=p(h,j,m,f,g[a+1],21,l[59]),f=p(f,h,j,m,g[a+8],6,l[60]),m=p(m,f,h,j,g[a+15],10,l[61]),j=p(j,m,f,h,g[a+6],15,l[62]),h=p(h,j,m,f,g[a+13],21,l[63]),f=p(f,h,j,m,g[a+4],6,l[64]),m=p(m,f,h,j,g[a+
11],10,l[65]),j=p(j,m,f,h,g[a+2],15,l[66]),h=p(h,j,m,f,g[a+9],21,l[67]),f=d(f,t),h=d(h,x),j=d(j,s),m=d(m,r);return q(f).concat(q(h),q(j),q(m))}},Base64:ib};
if(!window.PUBNUB){var mb=function(a,d){return V.HmacSHA256(a,d).toString(V.enc.Base64)},tb=function(a){return document.getElementById(a)},ub=function(a){console.error(a)},vb=function(a,d){var b=[];H(a.split(/\s+/),function(a){H((d||document).getElementsByTagName(a),function(a){b.push(a)})});return b},wb=function(a,d,b){H(a.split(","),function(a){function e(a){a||(a=window.event);b(a)||(a.cancelBubble=v,a.preventDefault&&a.preventDefault(),a.stopPropagation&&a.stopPropagation())}d.addEventListener?
d.addEventListener(a,e,A):d.attachEvent?d.attachEvent("on"+a,e):d["on"+a]=e})},xb=function(){return vb("head")[0]},yb=function(a,d,b){if(b)a.setAttribute(d,b);else return a&&a.getAttribute&&a.getAttribute(d)},zb=function(a,d){for(var b in d)if(d.hasOwnProperty(b))try{a.style[b]=d[b]+(0<"|width|height|top|left|".indexOf(b)&&"number"==typeof d[b]?"px":"")}catch(c){}},Ab=function(a){return document.createElement(a)},Cb=function(){return Bb||X()?0:ma()},Db=function(a){function d(a,b){W||(W=1,l.onerror=
z,clearTimeout(T),a||!b||Ra(b),setTimeout(function(){a&&kb();var b=tb(y),d=b&&b.parentNode;d&&d.removeChild(b)},D))}if(Bb||X()){a:{var b,c,e=function(){if(!q){q=1;clearTimeout(t);try{c=JSON.parse(b.responseText)}catch(a){return h(1)}p=1;r(c)}},p=0,q=0,g=a.timeout||1E4,t=setTimeout(function(){h(1,{message:"timeout"})},g),x=a.d||C(),s=a.data||{},r=a.e||C(),f=!a.D,h=function(a,d){p||(p=1,clearTimeout(t),b&&(b.onerror=b.onload=z,b.abort&&b.abort(),b=z),a&&x(d))};try{b=X()||window.XDomainRequest&&new XDomainRequest||
new XMLHttpRequest;b.onerror=b.onabort=function(){h(1,b.responseText||{error:"Network Connection Error"})};b.onload=b.onloadend=e;b.onreadystatechange=function(){if(b&&4==b.readyState)switch(b.status){case 401:case 402:case 403:try{c=JSON.parse(b.responseText),h(1,c)}catch(a){return h(1,b.responseText)}}};var j=ra(a.url,s);b.open("GET",j,f);f&&(b.timeout=g);b.send()}catch(m){h(0);Bb=0;a=Db(a);break a}a=h}return a}var l=Ab("script"),e=a.c,y=ma(),W=0,T=setTimeout(function(){d(1,{message:"timeout"})},
a.timeout||1E4),kb=a.d||C(),g=a.data||{},Ra=a.e||C();window[e]=function(a){d(0,a)};a.D||(l[Eb]=Eb);l.onerror=function(){d(1)};l.src=ra(a.url,g);yb(l,"id",y);xb().appendChild(l);return d},Fb=function(){return!("onLine"in navigator)?1:navigator.onLine},X=function(){if(!Gb||!Gb.get)return 0;var a={id:X.id++,send:C(),abort:function(){a.id={}},open:function(d,b){X[a.id]=a;Gb.get(a.id,b)}};return a},Eb="async",Bb=-1==navigator.userAgent.indexOf("MSIE 6");window.console||(window.console=window.console||
{});console.log||(console.log=console.error=(window.opera||{}).postError||C());var Hb,Ib={},Jb=A;try{Jb=window.localStorage}catch(Kb){}var Lb=function(a){return-1==document.cookie.indexOf(a)?z:((document.cookie||"").match(RegExp(a+"=([^;]+)"))||[])[1]||z},Mb=function(a,d){document.cookie=a+"="+d+"; expires=Thu, 1 Aug 2030 20:00:00 UTC; path=/"},Nb;try{Mb("pnctest","1"),Nb="1"===Lb("pnctest")}catch(Ob){Nb=A}Hb={get:function(a){try{return Jb?Jb.getItem(a):Nb?Lb(a):Ib[a]}catch(d){return Ib[a]}},set:function(a,
d){try{if(Jb)return Jb.setItem(a,d)&&0;Nb&&Mb(a,d);Ib[a]=d}catch(b){Ib[a]=d}}};var Pb={list:{},unbind:function(a){Pb.list[a]=[]},bind:function(a,d){(Pb.list[a]=Pb.list[a]||[]).push(d)},fire:function(a,d){H(Pb.list[a]||[],function(a){a(d)})}},Qb=tb("pubnub")||0,Sb=function(a){function d(){}function b(a,b){function d(b){b&&(nb=E()-(b/1E4+(E()-c)/2),a&&a(nb))}var c=E();b&&d(b)||B.time(d)}function c(a,b){Wa&&Wa(a,b);Wa=z;clearTimeout(ca);clearTimeout(Y)}function e(){B.time(function(a){b(C(),a);a||c(1,
{error:"Heartbeat failed to connect to Pubnub Servers.Please check your network settings."});Y&&clearTimeout(Y);Y=setTimeout(e,Rb)})}function p(){sc()||c(1,{error:"Offline. Please check your network settings. "});ca&&clearTimeout(ca);ca=setTimeout(p,D)}function q(a,b,d,c){var b=a.callback||b,e=a.error||u,a=I(),f=[J,"v1","channel-registration","sub-key",w];f.push.apply(f,d);G({c:a,data:l(c),e:function(a){t(a,b,e)},d:function(a){g(a,e)},url:f})}function g(a,b){"object"==typeof a&&a.error&&a.message&&
a.payload?b({message:a.message,payload:a.payload}):b(a)}function t(a,b,d){if("object"==typeof a){if(a.error&&a.message&&a.payload){d({message:a.message,payload:a.payload});return}if(a.payload){b(a.payload);return}}b(a)}function x(a){var b=0;H(wa(F),function(d){if(d=F[d])b++,(a||C())(d)});return b}function s(a){if(tc){if(!Z.length)return}else{a&&(Z.L=0);if(Z.L||!Z.length)return;Z.L=1}G(Z.shift())}function r(){!ob&&f()}function f(){clearTimeout(Xa);!M||500<=M||1>M||!wa(F,v).length?ob=A:(ob=v,B.presence_heartbeat({callback:function(){Xa=
setTimeout(f,M*D)},error:function(a){u&&u("Presence Heartbeat unable to reach Pubnub servers."+JSON.stringify(a));Xa=setTimeout(f,M*D)}}))}function h(a,b){return Ya.decrypt(a,b||N)||Ya.decrypt(a,N)||a}function j(a,b,d){var c=A;if("number"===typeof a)c=5<a||0==a?A:v;else{if("boolean"===typeof a)return a?30:0;c=v}return c?(d&&d("Presence Heartbeat value invalid. Valid range ( x > 5 or x = 0). Current Value : "+(b||5)),b||5):a}function m(a){var b="",d=[];H(a,function(a){d.push(a)});var c=d.sort(),e;
for(e in c){var f=c[e],b=b+(f+"="+encodeURIComponent(a[f]));e!=c.length-1&&(b+="&")}return b}function l(a){a||(a={});H($,function(b,d){b in a||(a[b]=d)});return a}function y(a){return Sb(a)}function W(a){function b(a,d){var c=(a&65535)+(d&65535);return(a>>16)+(d>>16)+(c>>16)<<16|c&65535}function d(a,b){return a>>>b|a<<32-b}var c;c=a.replace(/\r\n/g,"\n");for(var a="",e=0;e<c.length;e++){var f=c.charCodeAt(e);128>f?a+=String.fromCharCode(f):(127<f&&2048>f?a+=String.fromCharCode(f>>6|192):(a+=String.fromCharCode(f>>
12|224),a+=String.fromCharCode(f>>6&63|128)),a+=String.fromCharCode(f&63|128))}e=a;c=[];for(f=0;f<8*e.length;f+=8)c[f>>5]|=(e.charCodeAt(f/8)&255)<<24-f%32;var g=8*a.length,e=[1116352408,1899447441,3049323471,3921009573,961987163,1508970993,2453635748,2870763221,3624381080,310598401,607225278,1426881987,1925078388,2162078206,2614888103,3248222580,3835390401,4022224774,264347078,604807628,770255983,1249150122,1555081692,1996064986,2554220882,2821834349,2952996808,3210313671,3336571891,3584528711,113926993,
338241895,666307205,773529912,1294757372,1396182291,1695183700,1986661051,2177026350,2456956037,2730485921,2820302411,3259730800,3345764771,3516065817,3600352804,4094571909,275423344,430227734,506948616,659060556,883997877,958139571,1322822218,1537002063,1747873779,1955562222,2024104815,2227730452,2361852424,2428436474,2756734187,3204031479,3329325298],a=[1779033703,3144134277,1013904242,2773480762,1359893119,2600822924,528734635,1541459225],f=Array(64),l,h,j,m,p,q,r,t,u,s,w;c[g>>5]|=128<<24-g%32;
c[(g+64>>9<<4)+15]=g;for(t=0;t<c.length;t+=16){g=a[0];l=a[1];h=a[2];j=a[3];m=a[4];p=a[5];q=a[6];r=a[7];for(u=0;64>u;u++)f[u]=16>u?c[u+t]:b(b(b(d(f[u-2],17)^d(f[u-2],19)^f[u-2]>>>10,f[u-7]),d(f[u-15],7)^d(f[u-15],18)^f[u-15]>>>3),f[u-16]),s=b(b(b(b(r,d(m,6)^d(m,11)^d(m,25)),m&p^~m&q),e[u]),f[u]),w=b(d(g,2)^d(g,13)^d(g,22),g&l^g&h^l&h),r=q,q=p,p=m,m=b(j,s),j=h,h=l,l=g,g=b(s,w);a[0]=b(g,a[0]);a[1]=b(l,a[1]);a[2]=b(h,a[2]);a[3]=b(j,a[3]);a[4]=b(m,a[4]);a[5]=b(p,a[5]);a[6]=b(q,a[6]);a[7]=b(r,a[7])}c="";
for(e=0;e<4*a.length;e++)c+="0123456789abcdef".charAt(a[e>>2]>>8*(3-e%4)+4&15)+"0123456789abcdef".charAt(a[e>>2]>>8*(3-e%4)&15);return c}a.jsonp&&(Bb=0);var T=a.subscribe_key||"";a.uuid||Hb.get(T+"uuid");var kb=a.leave_on_unload||0;a.xdr=Db;a.db=Hb;a.error=a.error||ub;a._is_online=Fb;a.jsonp_cb=Cb;a.hmac_SHA256=mb;L.size(256);var Ra=L.s2a("0123456789012345");a.crypto_obj={encrypt:function(a,b){if(!b)return a;var d=L.s2a(W(b).slice(0,32)),c=L.s2a(JSON.stringify(a)),d=L.rawEncrypt(c,d,Ra);return L.Base64.encode(d)||
a},decrypt:function(a,b){if(!b)return a;var d=L.s2a(W(b).slice(0,32));try{var c=L.Base64.decode(a),e=L.rawDecrypt(c,d,Ra,A);return JSON.parse(e)}catch(f){}}};a.params={pnsdk:"PubNub-JS-Web/3.7.2"};var lc=+a.windowing||10,mc=(+a.timeout||310)*D,Rb=(+a.keepalive||60)*D,qc=a.noleave||0,O=a.publish_key||"demo",w=a.subscribe_key||"demo",P=a.auth_key||"",Za=a.secret_key||"",Wb=a.hmac_SHA256,pb=a.ssl?"s":"",Aa=c_push_ssl==1?"https://arrowchat.pubnub.com":"http://www.arrowpushengine.com",J=na(Aa),Xb=na(Aa),Z=[],qb=v,nb=0,rb=0,Yb=0,Wa=
0,$a=a.restore||0,fa=0,sb=A,F={},da={},Q={},Xa=z,U=j(a.heartbeat||a.pnexpires||0,a.error),M=a.heartbeat_interval||U-3,ob=A,tc=a.no_wait_for_pending,uc=a["compatible_3.5"]||A,G=a.xdr,$=a.params||{},u=a.error||C(),sc=a._is_online||function(){return 1},I=a.jsonp_cb||function(){return 0},ga=a.db||{get:C(),set:C()},N=a.cipher_key,K=a.uuid||ga&&ga.get(w+"uuid")||"",ca,Y,Ya=a.crypto_obj||{encrypt:function(a){return a},decrypt:function(a){return a}},B={LEAVE:function(a,b,d,c){var e={uuid:K,auth:P},f=na(Aa),
d=d||C(),h=c||C(),c=I();if(0<a.indexOf(ia))return v;if(uc&&(!pb||"0"==c)||qc)return A;"0"!=c&&(e.callback=c);G({D:b||pb,timeout:2E3,c:c,data:l(e),e:function(a){t(a,d,h)},d:function(a){g(a,h)},url:[f,"v2","presence","sub_key",w,"channel",encodeURIComponent(a),"leave"]});return v},set_resumed:function(a){sb=a},get_cipher_key:function(){return N},set_cipher_key:function(a){N=a},raw_encrypt:function(a,b){return Ya.encrypt(a,b||N)||a},raw_decrypt:function(a,b){return h(a,b)},get_heartbeat:function(){return U},
set_heartbeat:function(a){U=j(a,M,u);M=1<=U-3?U-3:1;d();f()},get_heartbeat_interval:function(){return M},set_heartbeat_interval:function(a){M=a;f()},get_version:function(){return"3.7.2"},getGcmMessageObject:function(a){return{data:a}},getApnsMessageObject:function(a){var b={aps:{badge:1,alert:""}};for(k in a)k[b]=a[k];return b},newPnMessage:function(){var a={};gcm&&(a.pn_gcm=gcm);apns&&(a.pn_apns=apns);for(k in n)a[k]=n[k];return a},_add_param:function(a,b){$[a]=b},channel_group:function(a,b){var d=
a.channel_group,c=a.channels||a.channel,e=a.cloak,f,g,l=[],h={},j=a.mode||"add";d&&(d=d.split(":"),1<d.length?(f="*"===d[0]?z:d[0],g=d[1]):g=d[0]);f&&l.push("namespace")&&l.push(encodeURIComponent(f));l.push("channel-group");g&&"*"!==g&&l.push(g);c?(c&&(Array.isArray&&Array.isArray(c))&&(c=c.join(",")),h[j]=c,h.cloak=qb?"true":"false"):"remove"===j&&l.push("remove");"undefined"!=typeof e&&(h.cloak=e?"true":"false");q(a,b,l,h)},channel_group_list_groups:function(a,b){var d;(d=a.namespace||a.ns||a.channel_group||
z)&&(a.channel_group=d+":*");B.channel_group(a,b)},channel_group_list_channels:function(a,b){if(!a.channel_group)return u("Missing Channel Group");B.channel_group(a,b)},channel_group_remove_channel:function(a,b){if(!a.channel_group)return u("Missing Channel Group");if(!a.channel&&!a.channels)return u("Missing Channel");a.mode="remove";B.channel_group(a,b)},channel_group_remove_group:function(a,b){if(!a.channel_group)return u("Missing Channel Group");if(a.channel)return u("Use channel_group_remove_channel if you want to remove a channel from a group.");
a.mode="remove";B.channel_group(a,b)},channel_group_add_channel:function(a,b){if(!a.channel_group)return u("Missing Channel Group");if(!a.channel&&!a.channels)return u("Missing Channel");B.channel_group(a,b)},channel_group_cloak:function(a,b){"undefined"==typeof a.cloak?b(qb):(qb=a.cloak,B.channel_group(a,b))},channel_group_list_namespaces:function(a,b){q(a,b,["namespace"])},channel_group_remove_namespace:function(a,b){q(a,b,["namespace",a.namespace,"remove"])},history:function(a,b){var b=a.callback||
b,d=a.count||a.limit||100,c=a.reverse||"false",e=a.error||C(),f=a.auth_key||P,j=a.cipher_key,m=a.channel,p=a.channel_group,q=a.start,r=a.end,t=a.include_token,s={},x=I();if(!m&&!p)return u("Missing Channel");if(!b)return u("Missing Callback");if(!w)return u("Missing Subscribe Key");s.stringtoken="true";s.count=d;s.reverse=c;s.auth=f;p&&(s["channel-group"]=p,m||(m=","));x&&(s.callback=x);q&&(s.start=q);r&&(s.end=r);t&&(s.include_token="true");G({c:x,data:l(s),e:function(a){if("object"==typeof a&&a.error)e({message:a.message,
payload:a.payload});else{for(var d=a[0],c=[],f=0;f<d.length;f++){var g=h(d[f],j);try{c.push(JSON.parse(g))}catch(l){c.push(g)}}b([c,a[1],a[2]])}},d:function(a){g(a,e)},url:[J,"v2","history","sub-key",w,"channel",encodeURIComponent(m)]})},replay:function(a,b){var b=b||a.callback||C(),d=a.auth_key||P,c=a.source,e=a.destination,f=a.stop,g=a.start,h=a.end,j=a.reverse,m=a.limit,p=I(),q={};if(!c)return u("Missing Source Channel");if(!e)return u("Missing Destination Channel");if(!O)return u("Missing Publish Key");
if(!w)return u("Missing Subscribe Key");"0"!=p&&(q.callback=p);f&&(q.stop="all");j&&(q.reverse="true");g&&(q.start=g);h&&(q.end=h);m&&(q.count=m);q.auth=d;G({c:p,e:function(a){t(a,b,err)},d:function(){b([0,"Disconnected"])},url:[J,"v1","replay",O,w,c,e],data:l(q)})},auth:function(a){P=a;d()},time:function(a){var b=I();G({c:b,data:l({uuid:K,auth:P}),timeout:5*D,url:[J,"time",b],e:function(b){a(b[0])},d:function(){a(0)}})},publish:function(a,b){var d=a.message;if(!d)return u("Missing Message");var b=
b||a.callback||d.callback||C(),c=a.channel||d.channel,e=a.auth_key||P,f=a.cipher_key,h=a.error||d.error||C(),j=a.post||A,m="store_in_history"in a?a.store_in_history:v,p=I(),q="push";a.prepend&&(q="unshift");if(!c)return u("Missing Channel");if(!O)return u("Missing Publish Key");if(!w)return u("Missing Subscribe Key");d.getPubnubMessage&&(d=d.getPubnubMessage());d=JSON.stringify(Ya.encrypt(d,f||N)||d);d=[J,"publish",O,w,0,encodeURIComponent(c),p,encodeURIComponent(d)];$={uuid:K,auth:e};m||($.store=
"0");Z[q]({c:p,timeout:5*D,url:d,data:l($),d:function(a){g(a,h);s(1)},e:function(a){t(a,b,h);s(1)},mode:j?"POST":"GET"});s()},unsubscribe:function(a,b){var c=a.channel,e=a.channel_group,b=b||a.callback||C(),f=a.error||C();fa=0;c&&(c=va((c.join?c.join(","):""+c).split(","),function(a){if(F[a])return a+","+a+ia}).join(","),H(c.split(","),function(a){var d=v;a&&(ea&&(d=B.LEAVE(a,0,b,f)),d||b({action:"leave"}),F[a]=0,a in Q&&delete Q[a])}));e&&(e=va((e.join?e.join(","):""+e).split(","),function(a){if(da[a])return a+
","+a+ia}).join(","),H(e.split(","),function(){var a=v;e&&(ea&&(a=B.LEAVE(e,0,b,f)),a||b({action:"leave"}),da[e]=0,e in Q&&delete Q[e])}));d()},subscribe:function(a,b){function e(a){a?setTimeout(d,D):(J=na(Aa,1),Xb=na(Aa,1),setTimeout(function(){B.time(e)},D));x(function(b){if(a&&b.i)return b.i=0,b.K(b.name);!a&&!b.i&&(b.i=1,b.H(b.name))})}function f(){var a=I(),b=wa(F).join(","),j=xa(da).join(",");if(b||j){b||(b=",");c();var m=l({uuid:K,auth:p});j&&(m["channel-group"]=j);2<JSON.stringify(Q).length&&
(m.state=JSON.stringify(Q));U&&(m.heartbeat=U);r();Wa=G({timeout:ca,c:a,d:function(a){g(a,y);B.time(e)},data:l(m),url:[Xb,"subscribe",w,encodeURIComponent(b),a,fa],e:function(a){if(!a||"object"==typeof a&&"error"in a&&a.error)return y(a.error),setTimeout(d,D);M(a[1]);fa=!fa&&$a&&ga.get(w)||a[1];x(function(a){a.l||(a.l=1,a.G(a.name))});if(sb&&!$a)fa=0,sb=A,ga.set(w,0);else{T&&(fa=1E4,T=0);ga.set(w,a[1]);var b,c="",c=3<a.length?a[3]:2<a.length?a[2]:va(wa(F),function(b){return va(Array(a[0].length).join(",").split(","),
function(){return b})}).join(","),e=c.split(",");b=function(){var a=e.shift()||Yb;return[(F[a]||{}).c||rb,a.split(ia)[0]]};var g=E()-nb-+a[1]/1E4;H(a[0],function(d){var c=b(),d=h(d,F[c[1]]?F[c[1]].cipher_key:z);c[0](d,a,c[2]||c[1],g)})}setTimeout(f,Y)}})}}var j=a.channel,m=a.channel_group,b=(b=b||a.callback)||a.message,p=a.auth_key||P,q=a.connect||C(),t=a.reconnect||C(),s=a.disconnect||C(),y=a.error||C(),M=a.idle||C(),oa=a.presence||0,O=a.noheresync||0,T=a.backfill||0,Z=a.timetoken||0,ca=a.timeout||
mc,Y=a.windowing||lc,N=a.state,W=a.heartbeat||a.pnexpires,$=a.restore||$a;$a=$;fa=Z;if(!j&&!m)return u("Missing Channel");if(!b)return u("Missing Callback");if(!w)return u("Missing Subscribe Key");(W||0===W)&&B.set_heartbeat(W);j&&H((j.join?j.join(","):""+j).split(","),function(d){var c=F[d]||{};F[Yb=d]={name:d,l:c.l,i:c.i,h:1,c:rb=b,cipher_key:a.cipher_key,G:q,H:s,K:t};N&&(Q[d]=d in N?N[d]:N);oa&&(B.subscribe({channel:d+ia,callback:oa,restore:$}),!c.h&&!O&&B.here_now({channel:d,callback:function(a){H("uuids"in
a?a.uuids:[],function(b){oa({action:"join",uuid:b,timestamp:Math.floor(E()/1E3),occupancy:a.occupancy||1},a,d)})}}))});m&&H((m.join?m.join(","):""+m).split(","),function(d){var c=da[d]||{};da[d]={name:d,l:c.l,i:c.i,h:1,c:rb=b,cipher_key:a.cipher_key,G:q,H:s,K:t};oa&&(B.subscribe({channel_group:d+ia,callback:oa,restore:$}),!c.h&&!O&&B.here_now({channel_group:d,callback:function(a){H("uuids"in a?a.uuids:[],function(b){oa({action:"join",uuid:b,timestamp:Math.floor(E()/1E3),occupancy:a.occupancy||1},
a,d)})}}))});d=function(){c();setTimeout(f,Y)};if(!ea)return ha.push(d);d()},here_now:function(a,b){var b=a.callback||b,d=a.error||C(),c=a.auth_key||P,e=a.channel,f=a.channel_group,h=I(),j=a.state,c={uuid:K,auth:c};if(!("uuids"in a?a.uuids:1))c.disable_uuids=1;j&&(c.state=1);if(!b)return u("Missing Callback");if(!w)return u("Missing Subscribe Key");j=[J,"v2","presence","sub_key",w];e&&j.push("channel")&&j.push(encodeURIComponent(e));"0"!=h&&(c.callback=h);f&&(c["channel-group"]=f,!e&&j.push("channel")&&
j.push(","));G({c:h,data:l(c),e:function(a){t(a,b,d)},d:function(a){g(a,d)},url:j})},where_now:function(a,b){var b=a.callback||b,d=a.error||C(),c=a.auth_key||P,e=I(),f=a.uuid||K,c={auth:c};if(!b)return u("Missing Callback");if(!w)return u("Missing Subscribe Key");"0"!=e&&(c.callback=e);G({c:e,data:l(c),e:function(a){t(a,b,d)},d:function(a){g(a,d)},url:[J,"v2","presence","sub_key",w,"uuid",encodeURIComponent(f)]})},state:function(a,b){var b=a.callback||b||C(),d=a.error||C(),c=a.auth_key||P,e=I(),f=
a.state,h=a.uuid||K,j=a.channel,m=a.channel_group,c=l({auth:c});if(!w)return u("Missing Subscribe Key");if(!h)return u("Missing UUID");if(!j&&!m)return u("Missing Channel");"0"!=e&&(c.callback=e);"undefined"!=typeof j&&F[j]&&F[j].h&&f&&(Q[j]=f);"undefined"!=typeof m&&(da[m]&&da[m].h)&&(f&&(Q[m]=f),c["channel-group"]=m,j||(j=","));c.state=JSON.stringify(f);f=f?[J,"v2","presence","sub-key",w,"channel",j,"uuid",h,"data"]:[J,"v2","presence","sub-key",w,"channel",j,"uuid",encodeURIComponent(h)];G({c:e,
data:l(c),e:function(a){t(a,b,d)},d:function(a){g(a,d)},url:f})},grant:function(a,b){var b=a.callback||b,d=a.error||C(),c=a.channel,e=a.channel_group,f=I(),j=a.ttl,h=a.read?"1":"0",p=a.write?"1":"0",q=a.manage?"1":"0",r=a.auth_key;if(!b)return u("Missing Callback");if(!w)return u("Missing Subscribe Key");if(!O)return u("Missing Publish Key");if(!Za)return u("Missing Secret Key");var s=w+"\n"+O+"\ngrant\n",h={w:p,r:h,timestamp:Math.floor((new Date).getTime()/1E3)};a.manage&&(h.m=q);"undefined"!=typeof c&&
(c!=z&&0<c.length)&&(h.channel=c);"undefined"!=typeof e&&(e!=z&&0<e.length)&&(h["channel-group"]=e);"0"!=f&&(h.callback=f);if(j||0===j)h.ttl=j;r&&(h.auth=r);h=l(h);r||delete h.auth;s+=m(h);c=Wb(s,Za);c=c.replace(/\+/g,"-");c=c.replace(/\//g,"_");h.signature=c;G({c:f,data:h,e:function(a){t(a,b,d)},d:function(a){g(a,d)},url:[J,"v1","auth","grant","sub-key",w]})},audit:function(a,b){var b=a.callback||b,d=a.error||C(),c=a.channel,e=a.channel_group,f=a.auth_key,h=I();if(!b)return u("Missing Callback");
if(!w)return u("Missing Subscribe Key");if(!O)return u("Missing Publish Key");if(!Za)return u("Missing Secret Key");var j=w+"\n"+O+"\naudit\n",p={timestamp:Math.floor((new Date).getTime()/1E3)};"0"!=h&&(p.callback=h);"undefined"!=typeof c&&(c!=z&&0<c.length)&&(p.channel=c);"undefined"!=typeof e&&(e!=z&&0<e.length)&&(p["channel-group"]=e);f&&(p.auth=f);p=l(p);f||delete p.auth;j+=m(p);c=Wb(j,Za);c=c.replace(/\+/g,"-");c=c.replace(/\//g,"_");p.signature=c;G({c:h,data:p,e:function(a){t(a,b,d)},d:function(a){g(a,
d)},url:[J,"v1","auth","audit","sub-key",w]})},revoke:function(a,b){a.read=A;a.write=A;B.grant(a,b)},set_uuid:function(a){K=a;d()},get_uuid:function(){return K},presence_heartbeat:function(a){var b=a.callback||C(),d=a.error||C(),a=I(),c={uuid:K,auth:P};2<JSON.stringify(Q).length&&(c.state=JSON.stringify(Q));0<U&&320>U&&(c.heartbeat=U);"0"!=a&&(c.callback=a);var e;e=wa(F,v).join(",");e=encodeURIComponent(e);var f=xa(da,v).join(",");e||(e=",");f&&(c["channel-group"]=f);G({c:a,data:l(c),timeout:5*D,
url:[J,"v2","presence","sub-key",w,"channel",e,"heartbeat"],e:function(a){t(a,b,d)},d:function(a){g(a,d)}})},stop_timers:function(){clearTimeout(ca);clearTimeout(Y)},xdr:G,ready:ya,db:ga,uuid:qa,map:va,each:H,"each-channel":x,grep:ta,offline:function(){c(1,{message:"Offline. Please check your network settings."})},supplant:ua,now:E,unique:ma,updater:sa};K||(K=B.uuid());ga.set(w+"uuid",K);ca=setTimeout(p,D);Y=setTimeout(e,Rb);Xa=setTimeout(r,(M-3)*D);b();var T=B,ab;for(ab in T)T.hasOwnProperty(ab)&&
(y[ab]=T[ab]);y.css=zb;y.$=tb;y.create=Ab;y.bind=wb;y.head=xb;y.search=vb;y.attr=yb;y.events=Pb;y.init=y;y.secure=y;wb("beforeunload",window,function(){if(kb)y["each-channel"](function(a){y.LEAVE(a.name,0)});return v});if(a.notest)return y;wb("offline",window,y.offline);wb("offline",document,y.offline);return y};Sb.init=Sb;Sb.secure=Sb;"complete"===document.readyState?setTimeout(ya,0):wb("load",window,function(){setTimeout(ya,0)});var Tb=Qb||{};PUBNUB=Sb({notest:1,publish_key:yb(Tb,"pub-key"),subscribe_key:yb(Tb,
"sub-key"),ssl:!document.location.href.indexOf("https")||"on"==yb(Tb,"ssl"),origin:yb(Tb,"origin"),uuid:yb(Tb,"uuid")});window.jQuery&&(window.jQuery.PUBNUB=Sb);"undefined"!==typeof module&&(module.exports=PUBNUB)&&ya();var Gb=tb("pubnubs")||0;if(Qb){zb(Qb,{position:"absolute",top:-D});if("opera"in window||yb(Qb,"flash"))Qb.innerHTML="<object id=pubnubs data=https://pubnub.a.ssl.fastly.net/pubnub.swf><param name=movie value=https://pubnub.a.ssl.fastly.net/pubnub.swf><param name=allowscriptaccess value=always></object>";
PUBNUB.rdx=function(a,d){if(!d)return X[a].onerror();X[a].responseText=unescape(d);X[a].onload()};X.id=D}}
var Ub=PUBNUB.ws=function(a,d){if(!(this instanceof Ub))return new Ub(a,d);var b=this,a=b.url=a||"";b.protocol=d||"Sec-WebSocket-Protocol";var c=a.split("/"),c={ssl:"wss:"===c[0],origin:c[2],publish_key:c[3],subscribe_key:c[4],channel:c[5]};b.CONNECTING=0;b.OPEN=1;b.CLOSING=2;b.CLOSED=3;b.CLOSE_NORMAL=1E3;b.CLOSE_GOING_AWAY=1001;b.CLOSE_PROTOCOL_ERROR=1002;b.CLOSE_UNSUPPORTED=1003;b.CLOSE_TOO_LARGE=1004;b.CLOSE_NO_STATUS=1005;b.CLOSE_ABNORMAL=1006;b.onclose=b.onerror=b.onmessage=b.onopen=b.onsend=
C();b.binaryType="";b.extensions="";b.bufferedAmount=0;b.trasnmitting=A;b.buffer=[];b.readyState=b.CONNECTING;if(!a)return b.readyState=b.CLOSED,b.onclose({code:b.CLOSE_ABNORMAL,reason:"Missing URL",wasClean:v}),b;b.o=PUBNUB.init(c);b.o.M=c;b.M=c;b.o.subscribe({restore:A,channel:c.channel,disconnect:b.onerror,reconnect:b.onopen,error:function(){b.onclose({code:b.CLOSE_ABNORMAL,reason:"Missing URL",wasClean:A})},callback:function(a){b.onmessage({data:a})},connect:function(){b.readyState=b.OPEN;b.onopen()}})};
Ub.prototype.send=function(a){var d=this;d.o.publish({channel:d.o.M.channel,message:a,callback:function(a){d.onsend({data:a})}})};var Vb;
if(!(Vb=V)){var Zb=Math,$b={},ac=$b.t={},bc=C(),cc=ac.O={extend:function(a){bc.prototype=this;var d=new bc;a&&d.da(a);d.hasOwnProperty("init")||(d.a=function(){d.N.a.apply(this,arguments)});d.a.prototype=d;d.N=this;return d},create:function(){var a=this.extend();a.a.apply(a,arguments);return a},a:C(),da:function(a){for(var d in a)a.hasOwnProperty(d)&&(this[d]=a[d]);a.hasOwnProperty("toString")&&(this.toString=a.toString)},g:function(){return this.a.prototype.extend(this)}},ec=ac.u=cc.extend({a:function(a,
d){a=this.f=a||[];this.b=d!=aa?d:4*a.length},toString:function(a){return(a||dc).stringify(this)},concat:function(a){var d=this.f,b=a.f,c=this.b,a=a.b;this.s();if(c%4)for(var e=0;e<a;e++)d[c+e>>>2]|=(b[e>>>2]>>>24-8*(e%4)&255)<<24-8*((c+e)%4);else if(65535<b.length)for(e=0;e<a;e+=4)d[c+e>>>2]=b[e>>>2];else d.push.apply(d,b);this.b+=a;return this},s:function(){var a=this.f,d=this.b;a[d>>>2]&=4294967295<<32-8*(d%4);a.length=Zb.ceil(d/4)},g:function(){var a=cc.g.call(this);a.f=this.f.slice(0);return a},
random:function(a){for(var d=[],b=0;b<a;b+=4)d.push(4294967296*Zb.random()|0);return new ec.a(d,a)}}),fc=$b.I={},dc=fc.ga={stringify:function(a){for(var d=a.f,a=a.b,b=[],c=0;c<a;c++){var e=d[c>>>2]>>>24-8*(c%4)&255;b.push((e>>>4).toString(16));b.push((e&15).toString(16))}return b.join("")},parse:function(a){for(var d=a.length,b=[],c=0;c<d;c+=2)b[c>>>3]|=parseInt(a.substr(c,2),16)<<24-4*(c%8);return new ec.a(b,d/2)}},gc=fc.ia={stringify:function(a){for(var d=a.f,a=a.b,b=[],c=0;c<a;c++)b.push(String.fromCharCode(d[c>>>
2]>>>24-8*(c%4)&255));return b.join("")},parse:function(a){for(var d=a.length,b=[],c=0;c<d;c++)b[c>>>2]|=(a.charCodeAt(c)&255)<<24-8*(c%4);return new ec.a(b,d)}},hc=fc.U={stringify:function(a){try{return decodeURIComponent(escape(gc.stringify(a)))}catch(d){throw Error("Malformed UTF-8 data");}},parse:function(a){return gc.parse(unescape(encodeURIComponent(a)))}},ic=ac.fa=cc.extend({reset:function(){this.k=new ec.a;this.q=0},v:function(a){"string"==typeof a&&(a=hc.parse(a));this.k.concat(a);this.q+=
a.b},A:function(a){var d=this.k,b=d.f,c=d.b,e=this.C,p=c/(4*e),p=a?Zb.ceil(p):Zb.max((p|0)-this.ba,0),a=p*e,c=Zb.min(4*a,c);if(a){for(var q=0;q<a;q+=e)this.Y(b,q);q=b.splice(0,a);d.b-=c}return new ec.a(q,c)},g:function(){var a=cc.g.call(this);a.k=this.k.g();return a},ba:0});ac.R=ic.extend({F:cc.extend(),a:function(a){this.F=this.F.extend(a);this.reset()},reset:function(){ic.reset.call(this);this.Z()},update:function(a){this.v(a);this.A();return this},j:function(a){a&&this.v(a);return this.X()},C:16,
V:function(a){return function(d,b){return(new a.a(b)).j(d)}},W:function(a){return function(d,b){return(new jc.P.a(a,b)).j(d)}}});var jc=$b.B={};Vb=$b}for(var V=Vb,kc=Math,nc=V.t,oc=nc.u,pc=nc.R,nc=V.B,rc=[],vc=[],wc=2,xc=0;64>xc;){var yc;a:{yc=wc;for(var zc=kc.sqrt(yc),Ac=2;Ac<=zc;Ac++)if(!(yc%Ac)){yc=A;break a}yc=v}yc&&(8>xc&&(rc[xc]=4294967296*(kc.pow(wc,0.5)-(kc.pow(wc,0.5)|0))|0),vc[xc]=4294967296*(kc.pow(wc,1/3)-(kc.pow(wc,1/3)|0))|0,xc++);wc++}
var Bc=[],nc=nc.T=pc.extend({Z:function(){this.n=new oc.a(rc.slice(0))},Y:function(a,d){for(var b=this.n.f,c=b[0],e=b[1],p=b[2],q=b[3],g=b[4],t=b[5],x=b[6],s=b[7],r=0;64>r;r++){if(16>r)Bc[r]=a[d+r]|0;else{var f=Bc[r-15],h=Bc[r-2];Bc[r]=((f<<25|f>>>7)^(f<<14|f>>>18)^f>>>3)+Bc[r-7]+((h<<15|h>>>17)^(h<<13|h>>>19)^h>>>10)+Bc[r-16]}f=s+((g<<26|g>>>6)^(g<<21|g>>>11)^(g<<7|g>>>25))+(g&t^~g&x)+vc[r]+Bc[r];h=((c<<30|c>>>2)^(c<<19|c>>>13)^(c<<10|c>>>22))+(c&e^c&p^e&p);s=x;x=t;t=g;g=q+f|0;q=p;p=e;e=c;c=f+h|
0}b[0]=b[0]+c|0;b[1]=b[1]+e|0;b[2]=b[2]+p|0;b[3]=b[3]+q|0;b[4]=b[4]+g|0;b[5]=b[5]+t|0;b[6]=b[6]+x|0;b[7]=b[7]+s|0},X:function(){var a=this.k,d=a.f,b=8*this.q,c=8*a.b;d[c>>>5]|=128<<24-c%32;d[(c+64>>>9<<4)+14]=kc.floor(b/4294967296);d[(c+64>>>9<<4)+15]=b;a.b=4*d.length;this.A();return this.n},g:function(){var a=pc.g.call(this);a.n=this.n.g();return a}});V.T=pc.V(nc);V.ha=pc.W(nc);var Cc=V.I.U;
V.B.P=V.t.O.extend({a:function(a,d){a=this.p=new a.a;"string"==typeof d&&(d=Cc.parse(d));var b=a.C,c=4*b;d.b>c&&(d=a.j(d));d.s();for(var e=this.ca=d.g(),p=this.aa=d.g(),q=e.f,g=p.f,t=0;t<b;t++)q[t]^=1549556828,g[t]^=909522486;e.b=p.b=c;this.reset()},reset:function(){var a=this.p;a.reset();a.update(this.aa)},update:function(a){this.p.update(a);return this},j:function(a){var d=this.p,a=d.j(a);d.reset();return d.j(this.ca.g().concat(a))}});var Dc=V.t.u;
V.I.ea={stringify:function(a){var d=a.f,b=a.b,c=this.z;a.s();for(var a=[],e=0;e<b;e+=3)for(var p=(d[e>>>2]>>>24-8*(e%4)&255)<<16|(d[e+1>>>2]>>>24-8*((e+1)%4)&255)<<8|d[e+2>>>2]>>>24-8*((e+2)%4)&255,q=0;4>q&&e+0.75*q<b;q++)a.push(c.charAt(p>>>6*(3-q)&63));if(d=c.charAt(64))for(;a.length%4;)a.push(d);return a.join("")},parse:function(a){var d=a.length,b=this.z,c=b.charAt(64);c&&(c=a.indexOf(c),-1!=c&&(d=c));for(var c=[],e=0,p=0;p<d;p++)p%4&&(c[e>>>2]|=(b.indexOf(a.charAt(p-1))<<2*(p%4)|b.indexOf(a.charAt(p))>>>
6-2*(p%4))<<24-8*(e%4),e++);return Dc.create(c,e)},z:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/="};
})();
}

(function (a) {
	a.arrowchat = function () {
	
		// Cache frequently used jQuery objects;
		var $body = a('body');
		
		function runarrowchat() {
			if (c_enable_mobile == 1) {
				if (a.cookie('ac_hide_mobile') != 1) {
					$body.append('<div id="arrowchat_mobiletab"><div id="arrowchat_mobiletab_new"><span class="arrowchat_mobiletab_new_count">0</span></div>' + lang[145] + ' (<span id="arrowchat_mobiletab_count">0</span>)</div>');
					$body.append('<div class="arrowchat_notify_box"><div class="arrowchat_notify_box_wrapper"><div class="arrowchat_notify_avatar"></div><div class="arrowchat_notify_info_wrapper"><div class="arrowchat_notify_username"></div><div class="arrowchat_notify_msg"></div></div><div class="arrowchat_clearfix"></div></div></div>');
					a("#arrowchat_mobiletab_new").hide();
					
					if (c_push_engine == 1) {
						push = PUBNUB.init({
							publish_key   : c_push_publish,
							subscribe_key : c_push_subscribe
						});
					}
					
					pushSubscribe();
					loadBuddyList();
					receiveCore();
					
					a("#arrowchat_mobiletab").click(function () {
						window.open(c_ac_path + 'public/mobile/', 'mobiletab', '_blank');
					});
				}
			}
		}
		
		function pushSubscribe() {
			if (c_push_engine == 1) {
				push.subscribe({ "channel" : "u"+u_id, "callback" : function(data) { pushReceive(data); } });
			}
		}
		
		function pushReceive(data) {
			if ("messages" in data) {
				receiveMessage(data.messages.id, data.messages.from, data.messages.message, data.messages.sent, data.messages.self, data.messages.old);
				addToCount(1);
			}
		}
		function stripslashes(str) {
			str=str.replace(/\\'/g,'\'');
			str=str.replace(/\\"/g,'"');
			str=str.replace(/\\0/g,'\0');
			str=str.replace(/\\\\/g,'\\');
			return str;
		}
		function receiveMessage(id, from, message, sent, self, old) {
			if (from != u_id && typeof(uc_name[from]) != "undefined") {
				message = stripslashes(message);
				a(".arrowchat_notify_avatar").html('<img src="' + uc_avatar[from] + '" alt="" />');
				a(".arrowchat_notify_username").html(uc_name[from]);
				a(".arrowchat_notify_msg").html(message);
				clearTimeout(message_timeout);
				a(".arrowchat_notify_box").show("slide", { direction: "up"}, 250);
				message_timeout = setTimeout(function () {
					a(".arrowchat_notify_box").hide("slide", { direction: "up"}, 250);
				}, 5000);
				a(".arrowchat_notify_box").unbind('click');
				a(".arrowchat_notify_box").click(function() {
					clearTimeout(message_timeout);
					a(".arrowchat_notify_box").hide();
					window.open(c_ac_path + 'public/mobile/#chatwith-' + from, 'mobiletab', '_blank');
				});
			}
		}
		function addToCount(number) {
			var count = parseInt(a(".arrowchat_mobiletab_new_count").html()) + number;
			var fontSize = parseInt(a('#arrowchat_mobiletab').css('font-size'), 10);
			a("#arrowchat_mobiletab_new").css("line-height", a("#arrowchat_mobiletab").css("font-size"));
			a("#arrowchat_mobiletab_new").css("top", "-" + fontSize/2 + "px");
			a("#arrowchat_mobiletab_new").css("right", fontSize/2 + "px");
			a(".arrowchat_mobiletab_new_count").html(count);
			a("#arrowchat_mobiletab_new").show();
		}
		function loadBuddyList() {
			clearTimeout(Z);
			a.ajax({
				url: c_ac_path + "includes/json/receive/receive_buddylist.php?mobile=1",
				cache: false,
				type: "get",
				dataType: "json",
				success: function (b) {
					buildBuddyList(b);
				}
			});
			if (typeof c_list_heart_beat != "undefined") {
				var BLHT = c_list_heart_beat * 1000;
			} else {
				var BLHT = 60000;
			}
			Z = setTimeout(function () {
				loadBuddyList()			
			}, BLHT)
		}
		function cancelJSONP() {
			if (typeof CHA != "undefined") {
				clearTimeout(CHA);
			}
			if (typeof xOptions != "undefined") {
				xOptions.abort();
			}
		}
		function receiveCore() {
			cancelJSONP();
			var url = c_ac_path + "includes/json/receive/receive_core.php?hash=" + u_hash_id + "&init=" + acsi + "&room=0";
			xOptions = a.ajax({
				url: url,
				dataType: "jsonp",
				success: function (b) {
					var new_messages = 0;
					if (b && b != null) {
						a.each(b, function (e, l) {
							if (e == "messages") {
								a.each(l, function (f, h) {
									if (acsi != 1)
										receiveMessage(h.id, h.from, h.message, h.sent, h.self, 1);
									new_messages++;
								});
							}
						});
					}
					acsi++;
					
					if (new_messages > 0) {
						addToCount(new_messages);
					}
				}
			});
			var CHT = c_heart_beat * 1000 * 3;
			if (c_push_engine != 1) {
				CHA = setTimeout(function () {
					receiveCore()
				}, CHT);
			}
		}
		function buildBuddyList(b) {
			var onlineNumber = 0;
			b && a.each(b, function (i, e) {
				if (i == "buddylist") {
					a.each(e, function (l, f) {
						if (f.s == "available" || f.s == "away" || f.s == "busy") 
							onlineNumber++;
                        uc_status[f.id] = f.s;
                        uc_name[f.id] = f.n;
                        uc_avatar[f.id] = f.a;
                        uc_link[f.id] = f.l
					});
					a("#arrowchat_mobiletab_count").html(onlineNumber);
				}
			})
		}
		function scaletab() {
			var zoomFactor = window.innerWidth/document.documentElement.clientWidth;

			if (zoomFactor < 1) {
				a("#arrowchat_mobiletab").hide();
				a(".arrowchat_notify_box").hide();
			} else {
				a("#arrowchat_mobiletab").show();
			}
			
			var fontSize = parseInt(a('#arrowchat_mobiletab').css('font-size'), 10);
			a("#arrowchat_mobiletab_new").css("line-height", a("#arrowchat_mobiletab").css("font-size"));
			a("#arrowchat_mobiletab_new").css("top", "-" + fontSize/2 + "px");
			a("#arrowchat_mobiletab_new").css("right", fontSize/2 + "px");
		}
		
		window.onresize = window.onscroll = function() {
			scaletab();
		};
		window.onload = function() {
			scaletab();
		};
		
		var Z,
			CHA,
			zoomFactor2 = window.innerWidth/document.documentElement.clientWidth,
			message_timeout,
			acsi = 1;
		
		// Modified by Nicolas Ward to redirect instead of opening a new window
		arguments.callee.chatWith = function (b) {
			//window.open(c_ac_path + 'mobile/#chatwith-' + b, 'mobiletab', '_blank');
			window.location.href = c_ac_path + 'mobile/#chatwith-' + b;
		};

		/* Taken from arrow_core.js by Nicolas Ward and added here */
		arguments.callee.sendMessage = function (b, c) {
			c != "" && a.post(c_ac_path + "includes/json/send/send_message.php", {
				to: b,
				message: c
			}, function (d) {
				if (d) {
					if (d == "-1") {
						displayMessage("arrowchat_chatbox_message_flyout_" + b, lang[102], "error");
					} else {
						addMessageToChatbox(b, c, 1, 1, d, 1, 1);
					}
					a(".arrowchat_tabcontenttext", $user_popups[b]).scrollTop(a(".arrowchat_tabcontenttext", $user_popups[b])[0].scrollHeight)
				}
				K = 1;
			})
		};

		arguments.callee.runarrowchat = runarrowchat;
	}
})(jqac);

jqac(document).ready(function () {
	if (u_logged_in != 1 && c_disable_arrowchat != 1) {
		jqac.arrowchat();
		jqac.arrowchat.runarrowchat()
	}
});