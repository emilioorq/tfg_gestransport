$("#frmLogin").on('submit',function(e)
{
	e.preventDefault();
	loginuser = $("#loginuser").val();
	passuser = $("#passuser").val();

	$.post("../ajax/usuarios.php?op=checkUser",
			{"loginuser" : loginuser, "passuser" : passuser},
				function(data)
				{
					if(data != "null")
					{
						//bootbox.alert(data);
						$(location).attr("href","home.php");
					}
					else
					{
						//bootbox.alert(data);
						bootbox.alert("Usuario y/o Password incorrectos");
					}
				}
			);		
});