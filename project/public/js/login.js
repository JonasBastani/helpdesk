$(function()
{
	$("#login_form").submit(function()
	{
		$.ajax({
			type: "post",
			url: BASE_URL + "login/ajax_login",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function()
			{
				clearErros();
				$("#btn-login").siblings(".help-block").html(loadingImg("<center>Verificando...</ceter>"));
			},
			success: function(json)
			{

				if(json["status"] == 1)
				{
					clearErros();
					$("#btn-login").siblings(".help-block").html(loadingImg("<center>Logando...</center>"));
					window.location = BASE_URL + "login";
					
					
				}
				else
				{
					showErrors(json["error_list"]);
				}
			},
			error: function(response)
			{
				console.log(response);
			}
		})

		return false;
	}) 
})