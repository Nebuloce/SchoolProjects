var xmlhttp;
    function loadXMLDoc(pid,semester) {  
            xmlhttp = getXMLHttpObject();
    
        if(xmlhttp == null) { 
            alert("No XMLHttp support.");
            return;  
        }
    
var url ="populateCourses.php";
    pid = document.querySelector('#programs option:checked').value;
    semester = document.querySelector('#semesters option:checked').value;
    
    url = url + "?q="+ pid + "&s=" + semester; 
    url = url + "&sid="+ Math.random();
    
    xmlhttp.onreadystatechange=stateChanged;
    xmlhttp.open("GET", url, true);
    xmlhttp.send(); 
     
    }
    
function stateChanged() {
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    var xml, token, txt;
        xml = xmlhttp.responseXML.documentElement.getElementsByTagName("course");
        
        txt = "<select id='courses'>";
    
        for(var i = 0;i < xml.length; i++) {
        token = xml[i].getElementsByTagName("cid");
        
            try{
                txt = txt + "<option value=" + token[0].firstChild.nodeValue+">" + token[0].firstChild.nodeValue;
            }
            catch(er) {
                txt = txt + "<option>&nbsp</option>";
            }
          
        token = xml[i].getElementsByTagName("cname");
        
            try {  
                txt = txt + " "+ token[0].firstChild.nodeValue  + "</option>";
            }
            catch(er) {
                txt = txt + "<option>&nbsp</option>";
            }
            
            
        }
        txt = txt + "</select>";
        document.getElementById('courses').innerHTML = txt;  }
}
function getXMLHttpObject() { 
    if(window.XMLHttpRequest) {
       
// IE7+, Firefox, Chrome, Safari, Opera
        return new XMLHttpRequest(); 
    }
    else{ // IE5, IE6
        return new ActiveObject("Microsoft.XMLHTTP");
    }
return null; 
    
}
