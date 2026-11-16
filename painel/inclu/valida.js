<!--
function checkbox_checker(max,form)
{

var checkbox_choices = 0;
if (form.checkbox1.checked)
{
checkbox_choices = checkbox_choices + 1;
}
if (form.checkbox2.checked)
{
checkbox_choices = checkbox_choices + 1; 
}
if (form.checkbox3.checked)
{
checkbox_choices = checkbox_choices + 1; 
}
if (form.checkbox4.checked)
{
checkbox_choices = checkbox_choices + 1; 
}
if (form.checkbox5.checked)
{
checkbox_choices = checkbox_choices + 1; 
}
if (form.checkbox6.checked)
{
checkbox_choices = checkbox_choices + 1; 
}
if (checkbox_choices > [max] )
{
msg="Você só pode selecionar " + [max] + " opções.\n"
msg=msg + "Por favor retire " + (checkbox_choices-[max]) + ""
alert(msg)
return (false);
}


if (checkbox_choices < [max] )
{
alert("Selecione " + [max] + " Opções. \nVocê selecionou apenas " + checkbox_choices + ".")
return (false);
}

return (true);
}

-->