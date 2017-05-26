$(document).ready(function(){
var checkkey = function(){ //checks is it worth to update the amount of beers by typing it
var val = parseInt($(this).val());
if((Number.isInteger(val) == true) && val != $(this).prev(".hid").val())
$(this).next(":submit").removeAttr("disabled");
else $(this).next(":submit").attr("disabled", true);
}
var checkbutton = function(){ //checks is it worth to update the amount of beers by clicking button
var val = parseInt($(this).prev().parent().children(":text").val());
if((Number.isInteger(val) == true) && val != $(this).parent().children(".hid").val())
$(this).parent().children(":submit").removeAttr("disabled");
else $(this).parent().children(":submit").attr("disabled", true);
}
$(".minus").bind("click", function(){ // the subtract function after clicking minus button
var val = parseInt($(this).parent().children(":text").val());
var minus =function(){
if(val > 0)
return val-1;
else
return 0;
}
$(this).parent().children(":text").val(minus);
})
$(".plus").bind("click", function(){ //the addition function after clicking plus button
var val = parseInt($(this).parent().children(":text").val());
var plus =function(){
if(val >= 0)
return val+1;
else
return 0;
}
$(this).prev().prev().val(plus);
})
$(":text").bind("keyup", checkkey)
$(".button").bind("click", checkbutton)
});

