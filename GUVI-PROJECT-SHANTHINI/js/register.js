$(document).ready(function () {
    $("#myForm").validate();
});

$('#submit').on('click', function () {
    $.ajax({
      
        url: 'php/register.php',
        method: 'POST',
        data: $('#myForm').serialize(),
        success: function (response) {
             alert("Your Successfully Signup");
             var url = "http://localhost/GUVI-PROJECT-SHANTHINI/login.html";
             $(location).attr('href', url);
            console.log(response);
        },
        error: function () {
            alert("error")
        }
    })
})



 if (localStorage.getItem("Auth")) {
   window.location="profile.html";
 }

