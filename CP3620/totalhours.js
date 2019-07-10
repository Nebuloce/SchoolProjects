var xmlhttp;
function hours(teacher){  xmlhttp2 = getXMLHttpObject();

if(xmlhttp2 == null) { alert("No XMLHttp support.");
return;  }
var url ="hours.php"; //Make this later lol
 teacher = document.querySelector('#teachers option:checked').value;
 url = url + "?q="+ teacher;
 url = url + "&sid="+ Math.random();
 xmlhttp2.onreadystatechange=stateChanged3;
 xmlhttp2.open("GET", url, true);
 xmlhttp2.send(); }
function stateChanged3() {
if(xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
var xml, token, txt;
    xml = xmlhttp2.responseXML.documentElement.getElementsByTagName("hours");
    txt = "<table border='1'><tr><th>Instructor ID</th><th>Total Lecture Hours</th><th>Total Lab Hours</th></tr>";
for(var i = 0; i < xml.length; i++) {
  txt = txt + "<tr>";
  token = xml[i].getElementsByTagName("instructorID");
try{    txt = txt + "<td>"+ token[0].firstChild.nodeValue + "</td>"; }
 catch(er) { txt = txt + "<td>&nbsp</td>"; }
      token = xml[i].getElementsByTagName("lecthours");
try{ txt = txt + "<td>" + token[0].firstChild.nodeValue + "</td>";
      }
catch(er) { txt = txt + "<td>&nbsp</td>"; }
      token = xml[i].getElementsByTagName("labhours");
try{ txt = txt + "<td>" + token[0].firstChild.nodeValue + "</td>";
      }
catch(er) { txt = txt + "<td>&nbsp</td>"; }
    txt = txt + "</table>";
    document.getElementById('totalhours').innerHTML = txt; }
  }
}
function getXMLHttpObject2() {
if(window.XMLHttpRequest) {
// IE7+, Firefox, Chrome, Safari, Opera
return new XMLHttpRequest();
 }
else{
// IE5, IE6
return new ActiveObject("Microsoft.XMLHTTP"); }
return null;
}

