function updateLast()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status==200)
        {
            var myObj = JSON.parse(this.responseText);

            document.getElementById('TIMESTAMP').innerHTML = '<font color="0088FF" size="6">'+myObj.timestamp+'</font>';
            document.getElementById('SENSOR').innerHTML = '<font color="0088FF" size="6">'+myObj.sensor+'</font>';
            document.getElementById('VALUE').innerHTML = '<font color="0088FF" size="6">'+myObj.powerValue+' W</font>';
        }
    };
    xmlhttp.open("GET", "data.php?req=LAST",true);
    xmlhttp.send();

    var t = setTimeout(updateLast,2000);
}

onload = function() {
    updateLast();
}