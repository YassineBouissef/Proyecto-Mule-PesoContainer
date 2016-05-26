

function compruebacookie(namecookie) {
  var keyValue = document.cookie.match('(^|;) ?' + namecookie + '=([^;]*)(;|$)');
            
  if(keyValue == null){
  
    muestradiv("cookies-overlay");

    //crear la cookie con caducidad a 30 dias
    var expira=new Date();
    expira.setDate(expira.getDate()+30);
    
    setCookie(namecookie, 1, expira);
  }
}

function setCookie(name, value, expires) {
  document.cookie = name + "=" + escape(value) + 
  ((expires == null) ? "" : "; expires=" + expires.toGMTString());
}


function muestradiv(id){
  if (document.getElementById){ //se obtiene el id
    var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
    el.style.display = 'block'; //damos un atributo display:block que muestra el div
  }
}


function cierradiv(id){
  if (document.getElementById){ //se obtiene el id
    var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
    el.style.display = 'none'; //damos un atributo display:none que oculta el div
  }
}

