var xmlhttp2;
    function assign(course,teacher){  
        xmlhttp2 = getXMLHttpObject2();
            if(xmlhttp2 == null) { alert("No XMLHttp support.");
                return; 
            }
        var url ="assign.php";
        course = document.querySelector('#courses option:checked').value;
        teacher = document.querySelector('#teachers option:checked').value;
        
        url = url + "?q="+ course + "&s=" + teacher;
        url = url + "&sid="+ Math.random();
        
        xmlhttp2.onreadystatechange=stateChanged2;
        xmlhttp2.open("GET", url, true);
        xmlhttp2.send(); 
    }
    
function stateChanged2() {
    if(xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
        var xml, token, txt;
            xml = xmlhttp2.responseXML.documentElement.getElementsByTagName("assignment");
            txt = "<table border='1'><tr><th>Instructor ID</th><th>Course ID</th></tr>";
    for(var i = 0; i < xml.length; i++) {
        txt = txt + "<tr>";
        token = xml[i].getElementsByTagName("instructorID");
        
    try{  
        txt = txt + "<td>"+ token[0].firstChild.nodeValue + "</td>"; 
    }
    
    catch(er) {
        txt = txt + "<td>&nbsp</td>"; 
    }
    
      token = xml[i].getElementsByTagName("courseID");
      
    try{ 
        txt = txt + "<td>" + token[0].firstChild.nodeValue + "</td>";
    }
    
    catch(er) { 
        txt = txt + "<td>&nbsp</td>"; }
    }
    
    txt = txt + "</table>";
    document.getElementById('assignments').innerHTML = txt; }
}
function getXMLHttpObject2() {
    if(window.XMLHttpRequest) {
    // IE7+, Firefox, Chrome, Safari, Opera
        return new XMLHttpRequest();
    }
    else{
    // IE5, IE6
        return new ActiveObject("Microsoft.XMLHTTP"); 
    }
    return null;
}

