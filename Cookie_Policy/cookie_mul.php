<?php 

$naz = $_SERVER[REQUEST_URI]; 

$ita ='<a href="#iubendaita" class="iubenda-white iubenda-embed " title="Cookie Policy">Cookie Policy</a> <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';

$fra='<a href="#iubendafra" class="iubenda-white iubenda-embed " title="Cookie Policy">Cookie Policy</a> <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';

$eng='<a href="#iubendaeng" class="iubenda-white iubenda-embed " title="Cookie Policy">Cookie Policy</a> <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>';

echo $naz;
switch($naz){
	case "/fr/":
           echo $fra;
	break;
	case "/en/":
	    echo $eng;
	break;
	default:
	    echo $ita;
	break;

} 

?>