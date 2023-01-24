import{n as C,V as O}from"./js/_plugin-vue2_normalizer.d86aa1f3.js";import"./js/index.5dd9aaae.js";import{a as q}from"./js/vuex.esm.19624049.js";import{S as h}from"./js/Standalone.aee167f9.js";import{C as K,a as Q}from"./js/Overview.5d0ba62a.js";import{s as X}from"./js/index.8eedf1b9.js";import{e as rr}from"./js/elemLoaded.b1f6e29c.js";import{c as s}from"./js/_commonjsHelpers.10c44588.js";import"./js/client.1a03de11.js";import"./js/translations.b7a6f669.js";import"./js/default-i18n.31663a66.js";import"./js/Caret.2b15c7cb.js";import"./js/helpers.a2b0759e.js";import"./js/constants.a33ff6d4.js";import"./js/isArrayLikeObject.5268a676.js";import"./js/portal-vue.esm.c4534d19.js";import"./js/Rocket.a0e2bb67.js";import"./js/DonutChartWithLegend.0cf1920e.js";import"./js/AnimatedNumber.c7763fcb.js";const er={mixins:[h],components:{CoreSeoSetup:K},computed:{...q(["internalOptions"])}};var or=function(){var e=this,o=e._self._c;return e.internalOptions.internal?o("div",[o("core-seo-setup",{attrs:{isWpDashboard:!0}})],1):e._e()},ur=[],ar=C(er,or,ur,!1,null,null,null,null);const nr=ar.exports,tr={components:{CoreOverview:Q},mixins:[h]};var ir=function(){var e=this,o=e._self._c;return o("div",{staticClass:"aioseo-app",staticStyle:{"background-color":"transparent"}},[o("core-overview",{attrs:{isWpDashboard:!0}})],1)},sr=[],fr=C(tr,ir,sr,!1,null,null,null,null);const cr=fr.exports;var dr=typeof s=="object"&&s&&s.Object===Object&&s,lr=dr,pr=lr,br=typeof self=="object"&&self&&self.Object===Object&&self,xr=pr||br||Function("return this")(),mr=xr,vr=mr,gr=vr.Symbol,l=gr;function $r(r,e){for(var o=-1,a=r==null?0:r.length,u=Array(a);++o<a;)u[o]=e(r[o],o,r);return u}var _r=$r,Sr=Array.isArray,yr=Sr,p=l,T=Object.prototype,Rr=T.hasOwnProperty,Ar=T.toString,i=p?p.toStringTag:void 0;function Cr(r){var e=Rr.call(r,i),o=r[i];try{r[i]=void 0;var a=!0}catch{}var u=Ar.call(r);return a&&(e?r[i]=o:delete r[i]),u}var Or=Cr,hr=Object.prototype,Tr=hr.toString;function jr(r){return Tr.call(r)}var Ur=jr,b=l,Lr=Or,Mr=Ur,Er="[object Null]",Wr="[object Undefined]",x=b?b.toStringTag:void 0;function kr(r){return r==null?r===void 0?Wr:Er:x&&x in Object(r)?Lr(r):Mr(r)}var wr=kr;function zr(r){return r!=null&&typeof r=="object"}var Ir=zr,Nr=wr,Zr=Ir,Dr="[object Symbol]";function Fr(r){return typeof r=="symbol"||Zr(r)&&Nr(r)==Dr}var Pr=Fr,m=l,Gr=_r,Hr=yr,Vr=Pr,Jr=1/0,v=m?m.prototype:void 0,g=v?v.toString:void 0;function j(r){if(typeof r=="string")return r;if(Hr(r))return Gr(r,j)+"";if(Vr(r))return g?g.call(r):"";var e=r+"";return e=="0"&&1/r==-Jr?"-0":e}var Yr=j,Br=Yr;function qr(r){return r==null?"":Br(r)}var f=qr;function Kr(r,e,o){var a=-1,u=r.length;e<0&&(e=-e>u?0:u+e),o=o>u?u:o,o<0&&(o+=u),u=e>o?0:o-e>>>0,e>>>=0;for(var n=Array(u);++a<u;)n[a]=r[a+e];return n}var Qr=Kr,Xr=Qr;function re(r,e,o){var a=r.length;return o=o===void 0?a:o,!e&&o>=a?r:Xr(r,e,o)}var ee=re,oe="\\ud800-\\udfff",ue="\\u0300-\\u036f",ae="\\ufe20-\\ufe2f",ne="\\u20d0-\\u20ff",te=ue+ae+ne,ie="\\ufe0e\\ufe0f",se="\\u200d",fe=RegExp("["+se+oe+te+ie+"]");function ce(r){return fe.test(r)}var U=ce;function de(r){return r.split("")}var le=de,L="\\ud800-\\udfff",pe="\\u0300-\\u036f",be="\\ufe20-\\ufe2f",xe="\\u20d0-\\u20ff",me=pe+be+xe,ve="\\ufe0e\\ufe0f",ge="["+L+"]",c="["+me+"]",d="\\ud83c[\\udffb-\\udfff]",$e="(?:"+c+"|"+d+")",M="[^"+L+"]",E="(?:\\ud83c[\\udde6-\\uddff]){2}",W="[\\ud800-\\udbff][\\udc00-\\udfff]",_e="\\u200d",k=$e+"?",w="["+ve+"]?",Se="(?:"+_e+"(?:"+[M,E,W].join("|")+")"+w+k+")*",ye=w+k+Se,Re="(?:"+[M+c+"?",c,E,W,ge].join("|")+")",Ae=RegExp(d+"(?="+d+")|"+Re+ye,"g");function Ce(r){return r.match(Ae)||[]}var Oe=Ce,he=le,Te=U,je=Oe;function Ue(r){return Te(r)?je(r):he(r)}var Le=Ue,Me=ee,Ee=U,We=Le,ke=f;function we(r){return function(e){e=ke(e);var o=Ee(e)?We(e):void 0,a=o?o[0]:e.charAt(0),u=o?Me(o,1).join(""):e.slice(1);return a[r]()+u}}var ze=we,Ie=ze,Ne=Ie("toUpperCase"),Ze=Ne,De=f,Fe=Ze;function Pe(r){return Fe(De(r).toLowerCase())}var Ge=Pe;function He(r,e,o,a){var u=-1,n=r==null?0:r.length;for(a&&n&&(o=r[++u]);++u<n;)o=e(o,r[u],u,r);return o}var Ve=He;function Je(r){return function(e){return r==null?void 0:r[e]}}var Ye=Je,Be=Ye,qe={\u00C0:"A",\u00C1:"A",\u00C2:"A",\u00C3:"A",\u00C4:"A",\u00C5:"A",\u00E0:"a",\u00E1:"a",\u00E2:"a",\u00E3:"a",\u00E4:"a",\u00E5:"a",\u00C7:"C",\u00E7:"c",\u00D0:"D",\u00F0:"d",\u00C8:"E",\u00C9:"E",\u00CA:"E",\u00CB:"E",\u00E8:"e",\u00E9:"e",\u00EA:"e",\u00EB:"e",\u00CC:"I",\u00CD:"I",\u00CE:"I",\u00CF:"I",\u00EC:"i",\u00ED:"i",\u00EE:"i",\u00EF:"i",\u00D1:"N",\u00F1:"n",\u00D2:"O",\u00D3:"O",\u00D4:"O",\u00D5:"O",\u00D6:"O",\u00D8:"O",\u00F2:"o",\u00F3:"o",\u00F4:"o",\u00F5:"o",\u00F6:"o",\u00F8:"o",\u00D9:"U",\u00DA:"U",\u00DB:"U",\u00DC:"U",\u00F9:"u",\u00FA:"u",\u00FB:"u",\u00FC:"u",\u00DD:"Y",\u00FD:"y",\u00FF:"y",\u00C6:"Ae",\u00E6:"ae",\u00DE:"Th",\u00FE:"th",\u00DF:"ss",\u0100:"A",\u0102:"A",\u0104:"A",\u0101:"a",\u0103:"a",\u0105:"a",\u0106:"C",\u0108:"C",\u010A:"C",\u010C:"C",\u0107:"c",\u0109:"c",\u010B:"c",\u010D:"c",\u010E:"D",\u0110:"D",\u010F:"d",\u0111:"d",\u0112:"E",\u0114:"E",\u0116:"E",\u0118:"E",\u011A:"E",\u0113:"e",\u0115:"e",\u0117:"e",\u0119:"e",\u011B:"e",\u011C:"G",\u011E:"G",\u0120:"G",\u0122:"G",\u011D:"g",\u011F:"g",\u0121:"g",\u0123:"g",\u0124:"H",\u0126:"H",\u0125:"h",\u0127:"h",\u0128:"I",\u012A:"I",\u012C:"I",\u012E:"I",\u0130:"I",\u0129:"i",\u012B:"i",\u012D:"i",\u012F:"i",\u0131:"i",\u0134:"J",\u0135:"j",\u0136:"K",\u0137:"k",\u0138:"k",\u0139:"L",\u013B:"L",\u013D:"L",\u013F:"L",\u0141:"L",\u013A:"l",\u013C:"l",\u013E:"l",\u0140:"l",\u0142:"l",\u0143:"N",\u0145:"N",\u0147:"N",\u014A:"N",\u0144:"n",\u0146:"n",\u0148:"n",\u014B:"n",\u014C:"O",\u014E:"O",\u0150:"O",\u014D:"o",\u014F:"o",\u0151:"o",\u0154:"R",\u0156:"R",\u0158:"R",\u0155:"r",\u0157:"r",\u0159:"r",\u015A:"S",\u015C:"S",\u015E:"S",\u0160:"S",\u015B:"s",\u015D:"s",\u015F:"s",\u0161:"s",\u0162:"T",\u0164:"T",\u0166:"T",\u0163:"t",\u0165:"t",\u0167:"t",\u0168:"U",\u016A:"U",\u016C:"U",\u016E:"U",\u0170:"U",\u0172:"U",\u0169:"u",\u016B:"u",\u016D:"u",\u016F:"u",\u0171:"u",\u0173:"u",\u0174:"W",\u0175:"w",\u0176:"Y",\u0177:"y",\u0178:"Y",\u0179:"Z",\u017B:"Z",\u017D:"Z",\u017A:"z",\u017C:"z",\u017E:"z",\u0132:"IJ",\u0133:"ij",\u0152:"Oe",\u0153:"oe",\u0149:"'n",\u017F:"s"},Ke=Be(qe),Qe=Ke,Xe=Qe,ro=f,eo=/[\xc0-\xd6\xd8-\xf6\xf8-\xff\u0100-\u017f]/g,oo="\\u0300-\\u036f",uo="\\ufe20-\\ufe2f",ao="\\u20d0-\\u20ff",no=oo+uo+ao,to="["+no+"]",io=RegExp(to,"g");function so(r){return r=ro(r),r&&r.replace(eo,Xe).replace(io,"")}var fo=so,co=/[^\x00-\x2f\x3a-\x40\x5b-\x60\x7b-\x7f]+/g;function lo(r){return r.match(co)||[]}var po=lo,bo=/[a-z][A-Z]|[A-Z]{2}[a-z]|[0-9][a-zA-Z]|[a-zA-Z][0-9]|[^a-zA-Z0-9 ]/;function xo(r){return bo.test(r)}var mo=xo,z="\\ud800-\\udfff",vo="\\u0300-\\u036f",go="\\ufe20-\\ufe2f",$o="\\u20d0-\\u20ff",_o=vo+go+$o,I="\\u2700-\\u27bf",N="a-z\\xdf-\\xf6\\xf8-\\xff",So="\\xac\\xb1\\xd7\\xf7",yo="\\x00-\\x2f\\x3a-\\x40\\x5b-\\x60\\x7b-\\xbf",Ro="\\u2000-\\u206f",Ao=" \\t\\x0b\\f\\xa0\\ufeff\\n\\r\\u2028\\u2029\\u1680\\u180e\\u2000\\u2001\\u2002\\u2003\\u2004\\u2005\\u2006\\u2007\\u2008\\u2009\\u200a\\u202f\\u205f\\u3000",Z="A-Z\\xc0-\\xd6\\xd8-\\xde",Co="\\ufe0e\\ufe0f",D=So+yo+Ro+Ao,F="['\u2019]",$="["+D+"]",Oo="["+_o+"]",P="\\d+",ho="["+I+"]",G="["+N+"]",H="[^"+z+D+P+I+N+Z+"]",To="\\ud83c[\\udffb-\\udfff]",jo="(?:"+Oo+"|"+To+")",Uo="[^"+z+"]",V="(?:\\ud83c[\\udde6-\\uddff]){2}",J="[\\ud800-\\udbff][\\udc00-\\udfff]",t="["+Z+"]",Lo="\\u200d",_="(?:"+G+"|"+H+")",Mo="(?:"+t+"|"+H+")",S="(?:"+F+"(?:d|ll|m|re|s|t|ve))?",y="(?:"+F+"(?:D|LL|M|RE|S|T|VE))?",Y=jo+"?",B="["+Co+"]?",Eo="(?:"+Lo+"(?:"+[Uo,V,J].join("|")+")"+B+Y+")*",Wo="\\d*(?:1st|2nd|3rd|(?![123])\\dth)(?=\\b|[A-Z_])",ko="\\d*(?:1ST|2ND|3RD|(?![123])\\dTH)(?=\\b|[a-z_])",wo=B+Y+Eo,zo="(?:"+[ho,V,J].join("|")+")"+wo,Io=RegExp([t+"?"+G+"+"+S+"(?="+[$,t,"$"].join("|")+")",Mo+"+"+y+"(?="+[$,t+_,"$"].join("|")+")",t+"?"+_+"+"+S,t+"+"+y,ko,Wo,P,zo].join("|"),"g");function No(r){return r.match(Io)||[]}var Zo=No,Do=po,Fo=mo,Po=f,Go=Zo;function Ho(r,e,o){return r=Po(r),e=o?void 0:e,e===void 0?Fo(r)?Go(r):Do(r):r.match(e)||[]}var Vo=Ho,Jo=Ve,Yo=fo,Bo=Vo,qo="['\u2019]",Ko=RegExp(qo,"g");function Qo(r){return function(e){return Jo(Bo(Yo(e).replace(Ko,"")),r,"")}}var Xo=Qo,ru=Ge,eu=Xo,ou=eu(function(r,e,o){return e=e.toLowerCase(),r+(o?ru(e):e)}),R=ou;O.config.productionTip=!1;const uu=[{id:"aioseo-seo-setup-app",component:nr},{id:"aioseo-overview-app",component:cr}],A=r=>{new O({store:X,render:e=>e(r.component)}).$mount("#"+r.id)};uu.forEach(r=>{document.getElementById(r.id)?A(r):(rr("#"+r.id,R(r.id)),document.addEventListener("animationstart",function(e){R(r.id)===e.animationName&&A(r)},{passive:!0}))});
