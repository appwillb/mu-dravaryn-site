function abrirPag(valor){

var url = valor;


xmlRequest.onreadystatechange = mudancaEstado;

xmlRequest.open("POST",url,true);

xmlRequest.send(null);



if (xmlRequest.readyState == 1) {

document.getElementById("conteudo_mostrar").innerHTML = "<br><BR><BR><Br><br><BR><BR><Br><br><BR><BR><Br><img src='../img/loader.gif'>";

}


return url;

}


function mudancaEstado(){

if (xmlRequest.readyState == 4){

document.getElementById("conteudo_mostrar").innerHTML = xmlRequest.responseText;

}

}

function BuscaElementosForm(idForm)
{  
	var elementosFormulario = document.getElementById(idForm).elements;  
	var qtdElementos = elementosFormulario.length;  
	var queryString = "";  
	var elemento;  

		this.ConcatenaElemento = function(nome,valor)
		{   
			if (queryString.length > 0)
			{   
				queryString += "&"; 
			}  
			queryString += encodeURIComponent(nome) + "=" + encodeURIComponent(valor);  
		};  

		for (var i = 0; i < qtdElementos; i++)
		{   
			elemento = elementosFormulario[i];  
			if (!elemento.disabled)
			{   
				switch(elemento.type)
				{   
					case 'text': case 'password': case 'hidden': case 'textarea':   
						this.ConcatenaElemento(elemento.name,elemento.value);  
						break;  
					case 'select-one':  
						if (elemento.selectedIndex >= 0)
						{  
							this.ConcatenaElemento(elemento.name,elemento.options[elemento.selectedIndex].value);  
						}  
						break;  
					case 'select-multiple':  
						for (var j = 0; j < elemento.options.length; j++)
						{  
							if (elemento.options[j].selected)
							{  
								this.ConcatenaElemento(elemento.name,elemento.options[j].value);  
							}  
						}  
						break;  
					case 'checkbox': case 'radio':  
						if (elemento.checked)
						{  
							this.ConcatenaElemento(elemento.name,elemento.value);  
						}  
						break;  
				}  
			}  
		}
     return queryString;  
}

function ExtractScript(texto)
{
	var ini = 0;
	while(ini != -1)
	{
		ini = texto.indexOf("<script", ini);
		if(ini >= 0)
		{
			ini = texto.indexOf(">", ini) + 1;
			var fim = texto.indexOf("</script>", ini);
			codigo = texto.substring(ini, fim);
			eval(codigo);
		}
	}
}


function load_wt(url, div, tipo, campos)
{
	var ajax = null;

	if(div=='atuchat') {

document.getElementById(div).innerHTML = "<br><BR><BR><Br><br><BR><BR><Br><img src='../img/loader.gif'>";

} else {
document.getElementById("promo").innerHTML = "";
document.getElementById(div).innerHTML = "<br><BR><BR><Br><br><BR><BR><Br><img src='../img/loader.gif'>";

}


	if(window.ActiveXObject)
	{
		ajax = new ActiveXObject('Microsoft.XMLHTTP');
	}
	else if(window.XMLHttpRequest)
	{
		ajax = new XMLHttpRequest();
	}

	if(ajax != null)
	{
		var cache = new Date().getTime()
		ajax.open(tipo, url+'&cache='+cache, true);
		ajax.onreadystatechange = function status()
		{

			if(ajax.readyState == 4)
			{
				if(ajax.status == 200)
				{
					document.getElementById(div).innerHTML = ajax.responseText;
					var texto = unescape(ajax.responseText.replace(/\+/g, " "))
					ExtractScript(texto);
				}
				else {
				document.getElementById(div).innerHTML = "<bR><br> <b> Página não encontrada";
				}
			}
			else
			{
			document.getElementById(div).innerHTML = "<br><BR><BR><Br><br><BR><BR><Br><img src='../img/loader.gif'>";
			}
		}
		
		if(tipo == "POST")
		{
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
			ajax.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
			ajax.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
			ajax.setRequestHeader("Pragma", "no-cache");
			ajax.send(campos); 
		}
		else
		{
			ajax.send(null);
		}
	}
}
