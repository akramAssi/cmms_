function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('demo').innerHTML =
  h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
  
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
function infopage(s) {
  location.replace(s);
}
function calculat(x,y,i) {
  z=((x-y)/100);
  result=z.toString().substring(0,4);
  if(z<100){
 document.getElementById('prsant'+i).innerHTML=result+'%';
 document.getElementById('kilometer'+i).style.borderColor ='black';
}
else if(z>=100)
  document.getElementById('prsant'+i).innerHTML='100%';
 if(z<0){
  document.getElementById('prsant'+i).innerHTML='0%';
  document.getElementById('kilometer'+i).style.borderColor ='red';
}
}
