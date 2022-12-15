require('./bootstrap');

$("input:checkbox[name=portadorComorbidade]:checked").each(function(){
    arr.push($(this).val());
});

$("input:checkbox[name=vacinaAplicada]:checked").each(function(){
    arr.push($(this).val());
});