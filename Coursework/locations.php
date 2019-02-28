function getLocations()
{
    $.ajax({

        type: "POST", 
        dataType: "json",
        url: "yourPhpFile.php",
        success: function(locations)
        {
            //place markers
        },
        error: function()
        {
            alert("error");
        }
    });


}