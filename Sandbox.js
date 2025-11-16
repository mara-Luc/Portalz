//using a function change my paragrah
function changeText() 
    {
        document.getElementById("myParagraph").innerHTML = "The text has been changed!";
    }

//using a function to hide content
function hidebtn() 
{
    var x = document.getElementById("myDIV");
    
    if (x.style.display === "none") 
        {
            x.style.display = "block";
        } 
        
        else 
            {
                x.style.display = "none";
            }
    
}

//using a function to change my images
function imagemod() 
    {
        document.getElementById("myImg1").src = "picks/Digimon.jpg";
        document.getElementById("myImg2").src = "picks/Digimon title.jpg";
        document.getElementById("myImg3").src = "picks/digimon-adventure-tr.jpg";
    }

//using a function to change a buttons text
function changebtn(elem) 
    {
        elem.innerHTML = "Hello World!";
    }

//using a function to display onblur event
function validateField()
    {
        var field = document.getElementById("requiredField");
        var errorMessage = document.getElementById("errorMessage");
        if (field.value.trim() === "") 
            {
                errorMessage.style.display = "inline";
            } 
        
            else 
                {
                    errorMessage.style.display = "none";
                }
    }

function fetchText()
    {
        getText("fetch_info.txt");

        async function getText(file) 
            {
                let myObject = await fetch(file);
                let myText = await myObject.text();
                document.getElementById("demo").innerHTML = myText;
            }
    }