!function(){var e="error",a=document.forms["mm4-contact-form"],t=document.querySelector('form[name="'+a.name+'"] .msg-box');a.addEventListener("submit",function(a){!function(a,t,r){var n,s=[],i=[];for(s.length=0,i.length=0,a.classList.remove(e),t.classList.remove(e),n=0;n<a.length;n++)a[n].classList.remove(e);var l=a.getElementsByTagName("label");for(n=0;n<l.length;n++)l[n].classList.remove(e);var d,o,m,h=a.getElementsByClassName("required"),c="";for(n=0;n<h.length;n++){var u=h[n].name;-1===c.indexOf(u)&&(s.push([h[n]]),c+=" "+u)}for(n=0;n<s.length;n++)if("checkbox"===s[n][0].type){m=!1,d=document.getElementsByName(s[n][0].name);for(var v=0;v<d.length;v++)if(d[v].checked){m=!0;break}!1===m&&i.push([d[0].name,"<div>The <span>"+d[0].getAttribute("data-error-label")+"</span> field is required.</div>"])}else if("radio"===s[n][0].type){m=!1,o=document.getElementsByName(s[n][0].name);for(var f=0;f<o.length;f++)if(o[f].checked){m=!0;break}!1===m&&i.push([o[0].name,"<div>The <span>"+o[0].getAttribute("data-error-label")+"</span> field is required.</div>"])}else""===s[n][0].value&&i.push([s[n][0].name,"<div>The <span>"+s[n][0].getAttribute("data-error-label")+"</span> field is required.</div>"]);0===grecaptcha.getResponse().length&&i.push(["recaptcha","<div>The <span>Anti-Spam</span> field is required. Please check the box to continue.</div>"]);var g=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;for(n=0;n<a.length;n++)"email"!==a[n].type||""===a[n].value||a[n].value.match(g)||i.push([a[n].name,"<div>Please enter a valid email address for the <span>"+a[n].getAttribute("data-error-label")+"</span> field.</div>"]);if(i.length>0){r.preventDefault();var p="";for(n=0;n<i.length;n++){p+=i[n][1];for(var b=document.getElementsByName(i[n][0]),y=0;y<b.length;y++)b[y].classList.add(e),b[y].parentNode.classList.add(e);t.innerHTML=p}t.classList.add(e)}}(this,t,a)})}();