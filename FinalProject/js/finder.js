function validate() {

        var time = document.getElementById("time").value;
        var soil = document.getElementById("soil").value;
        var season = document.getElementById("season").value;
        var space = document.getElementById("space").value;
       //var submitOK= 0;

        if((time == 1)&&(soil== 2 || 4)&&(season == 1)&&(space == 1 || 4)) {
        alert("Sounds like you have the perfect situation. Any choice is a good choice");  
        }
        else if((time == 3)&&(soil== 1)&&(season == 1)&&(space == 2)) {
        alert("Root vegetables would be your best bet as the soil is too rocky for most other choices")
        }
        else if((time == 3)&&(soil== 3)&&(season == 1)&&(space == 1 || 4)) {
        alert("Root vegetables would be your best bet as your time is limited and the soil is sandy")
        }
        else if((time == 3)&&(soil==1||2||4)&&(season == 4)&&(space == 4)) {
        alert("Radish is your only real option outside of a greenhouse due to your extremely short growing season")
        }
        else if((time == 2)&&(soil== 2 || 4)&&(season == 2||3)&&(space > 0)) {
        alert("Any choice is good but to maximize your time value go with Strawberries, Blueberries, Goji Berries from fruits")
        }
        else if((time == 3)&&(soil== 3 || 1)&&(season == 4)&&(space == 3)) {
        alert("Might be best to stick with small indoor growing such as herbs. If you have grow lights and an indoor greenhouse then anything can go")
        }
        else if((time == 3)&&(soil >0)&&(season == 1)&&(space == 3)) {
        alert("Best to stick with root vegetables as they grow in most soils and require minimum time investment and space")
        }

        
}
