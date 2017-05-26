$(document).ready(function(){
var liczba = $("e").text();
var arr = liczba.split(' ');
var res = 0;
for(var i=0; i<arr.length-1; i++)
{
res +=parseInt(arr[i]);
//alert(res);
}
$("<p>", {
	"text": "sumaryczna kwota zamóweinia wynosi: "+res+" golda."
	}).appendTo("body");

});
