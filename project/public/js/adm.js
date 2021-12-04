$(function() {


	$("#add_user").click(function(){

		clearErros();
		$("#form_users")[0].reset();
		$("#modal_usuario").modal();


	});

	$("#form_users").submit(function() 
	{
		$.ajax({
			type: "POST",
			url: BASE_URL + "home_adm/ajax_save_user",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function() {
				clearErros();
				$("#btn_save_users").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function(response) {
				clearErros();
				if (response["status"] == 1) 
				{				
					$("#modal_usuario").modal("hide");
					Swal.fire(
					  'Sucesso!',
					  'Usuário salvo com Sucesso!',
					  'success'
					);
					dt_user.ajax.reload();				
				}
				else
				{
					showErrorsModal(response["error_list"]);
				}
			}
		})

		return false;
	});

	$("#btn_your_user").click(function() 
	{
		$.ajax({
			type: "POST",
			url: BASE_URL + "home_adm/ajax_get_user_data",
			dataType: "json",
			data: {"user_id": $(this).attr("user_id")},
			success: function(response) {
				clearErros();
				$("#form_users")[0].reset();
				$.each(response["input"], function(id, value) {
					$("#"+id).val(value);
				});
				$("#div_permissao").hide();
				$("#modal_usuario").modal();
			}
		})

		//return false;
	});

	function active_btn_user() {

		$(".btn-edit-user").click(function() 
		{
		$.ajax({
			type: "POST",
			url: BASE_URL + "home_adm/ajax_get_user_data",
			dataType: "json",
			data: {"user_id": $(this).attr("user_id")},
			success: function(response) {
				clearErros();
				$("#form_users")[0].reset();
				$.each(response["input"], function(id, value) {
					$("#"+id).val(value);
				});
				$("#div_permissao").show();
				$("#modal_usuario").modal();
				
			}
		})


		//return false;
		});





		$(".btn-active-user").click(function(){
			$(".btn-active-user").prop('disabled', true);

			user_id = $(this);
			Swal.fire({  
	  				title: "Atenção!",
					text: "Deseja reativar o usuário?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#00c800",
					cancelButtonText: "Nao",
					confirmButtonText: "Sim",
					CloseOnConfirm: true,
					CloseOnCancel: true,
			}).then((result) => {  
			/* Read more about isConfirmed, isDenied below */  
		    		if (result.isConfirmed) {
				    	$.ajax({
							type: "POST",
							url: BASE_URL + "home_adm/ajax_active_user_data",
							dataType: "json",
							data: {"user_id": user_id.attr("user_id")},
							success: function(response) {
								//swal("Sucesso!", "Ação executada com Sucesso!", "success");
								Swal.fire(
								  'Sucesso!',
								  'Usuário reativado com Sucesso!',
								  'success'
								);
								dt_user.ajax.reload();
							}
					})

	 			}
	 		})

			
		})

		$(".btn-desative-user").click(function(){
			$(".btn-desative-user").prop('disabled', true);

			user_id = $(this);
			Swal.fire({  
	  				title: "Atenção!",
					text: "Deseja desativar o usuário?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#d60000",
					cancelButtonText: "Nao",
					confirmButtonText: "Sim",
					CloseOnConfirm: true,
					CloseOnCancel: true,
			}).then((result) => {  
			/* Read more about isConfirmed, isDenied below */  
		    		if (result.isConfirmed) {
				    	$.ajax({
						type: "POST",
						url: BASE_URL + "home_adm/ajax_desative_user_data",
						dataType: "json",
						data: {"user_id": $(this).attr("user_id")},
						success: function(response) {
							//swal("Sucesso!", "Ação executada com Sucesso!", "success");
							Swal.fire(
							  'Sucesso!',
							  'Usuário desativado com Sucesso!',
							  'success'
							);
							dt_user.ajax.reload();
						}
					})

	 			}
	 		})

			
		})

		/*$(".btn-desative-user").click(function(){
			user_id = $(this);
			swal({
				title: "Atenção!",
				text: "Deseja deletar esse curso?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#ec250d",
				confirmButtonColor: "Sim",
				cancelButtonText: "Nao",
				CloseOnConfirm: true,
				CloseOnCancel: true,

			}).then((result) => {
				if(result.value)
				{

					$.ajax({
						type: "POST",
						url: BASE_URL + "home_adm/ajax_desative_user_data",
						dataType: "json",
						data: {"user_id": user_id.attr("user_id")},
						success: function(response) {
							swal("Sucesso!", "Ação executada com Sucesso!", "success");
							dt.course.ajax.reload();
						}
					})
				}
			})
			//return false;
		});*/
	}

	var dt_user = $("#dt_user").DataTable({
		"autoWidth": false,
		"processing": true,
		"serverSide": true, 
		"ajax": {
			"url": BASE_URL + "home_adm/ajax_list_user",
			"type": "POST",

			
		},
		"columnDefs": [
			{targets: "no-sort", orderable: false},
			{targets: "dt-center", className: "dt-center"},
		],

		"language": DATABASE_PTBR,
        "drawCallback": function() {
        	active_btn_user();

        },


	});

	$("#reload_datatable").click(function(){
		dt_user.ajax.reload();

	})

	$("#reload_datatable_chamados").click(function(){
		
		dt_chamado.ajax.reload();
	})




	// essa function servia para ativar os botoes de ações na tabela, porém achei uma forma mais segura de fazer isso,
	//por isso comentei, mas deixarei ela como aprendizado
	/*$("#dt_user").mouseover(function(){

		active_btn_user();


	});*/


	// JS A RESPEITO DA TROCA DE CONTEÚDO
	//só para a div chamados não aparecer juntamente com a de usuarios
	$("#div_chamados").hide();
	// aparecer div de chamados e sumir a de usuarios
	$("#a_chamados").click(function(){
		$("#div_usuarios").hide();
		$("#div_chamados").show();
		$('#li_chamados').addClass('active');
		$('#li_usuarios').removeClass('active');

	})
	// aparecer div de usuarios e sumir a de chamados
	$("#a_usuarios").click(function(){
		$("#div_usuarios").show();
		$("#div_chamados").hide();
		$('#li_usuarios').addClass('active');
		$('#li_chamados').removeClass('active');
		

	})


	// A PARTIR DAQUI FICARA TODO JS A RESPEITO DE CHAMADOS

	$("#add_chamado").click(function(){

		clearErros();
		$("#form_chamado")[0].reset();
		$("#imagem_path").attr("src", "");

		$('#problema'). prop('disabled', false);
		$('#setor'). prop('disabled', false);
		$('#tipo'). prop('disabled', false);
		$('#descricao'). prop('disabled', false);
		$('#descricao'). prop('disabled', false);
		$('#btn_add_img'). show();
				

		$("#modal_chamado").modal();


	});

	//upload imagem de chamado
	$("#btn_upload_imagem").change(function(){
		uploadImg($(this), $("#imagem_path"), $("#imagem"));
	});

	// ajax para abrir/editar chamado
	$("#form_chamado").submit(function() 
	{
		$.ajax({
			type: "POST",
			url: BASE_URL + "home_adm/ajax_save_chamado",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function() {
				clearErros();
				$("#btn_save_chamados").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function(response) {
				clearErros();
				if (response["status"] == 1) 
				{				
					$("#modal_chamado").modal("hide");
					Swal.fire(
					  'Sucesso!',
					  'Chamado salvo com Sucesso!',
					  'success'
					);
					dt_chamado.ajax.reload();				
				}
				else
				{
					showErrorsModal(response["error_list"]);
				}
			}
		})

		return false;
	});

	var dt_chamado = $("#dt_chamado").DataTable({
		"autoWidth": false,
		"processing": true,
		"serverSide": true, 
		"ajax": {
			"url": BASE_URL + "home_adm/ajax_list_chamado",
			"type": "POST",

			
		},
		"columnDefs": [
			{targets: "no-sort", orderable: false},
			{targets: "dt-center", className: "dt-center"},
		],

		"language": DATABASE_PTBR,
        "drawCallback": function() {
        	active_btn_chamado();

        }


	});



	function active_btn_chamado() {

		$(".btn-edit-chamado").click(function() 
		{
		$.ajax({
			type: "POST",
			url: BASE_URL + "home_adm/ajax_get_chamado_data",
			dataType: "json",
			data: {"chamado_id": $(this).attr("chamado_id")},
			success: function(response) {
				clearErros();
				$("#form_chamado")[0].reset();
				$.each(response["input"], function(id, value) {
					$("#"+id).val(value);
				});
				// colocando o campo img
				$("#imagem_path").attr("src", response["img"]["imagem"])

				$('#problema'). prop('disabled', true);
				$('#setor'). prop('disabled', true);
				$('#tipo'). prop('disabled', true);
				$('#descricao'). prop('disabled', true);
				$('#descricao'). prop('disabled', true);
				$('#btn_add_img'). hide();

				$("#div_contesta").hide();
				$("#btn_contestar_chamados").hide();

				$("#modal_chamado").modal();


				
			}
		})


		//return false;
		});


		$(".btn-ver-contesta").click(function() 
		{
		$.ajax({
			type: "POST",
			url: BASE_URL + "home_adm/ajax_get_chamado_detalhes",
			dataType: "json",
			data: {"chamado_id": $(this).attr("chamado_id")},
			success: function(response) {
				clearErros();
				$("#form_chamado")[0].reset();
				$.each(response["input"], function(id, value) {
					$("#"+id).val(value);
				});
				// colocando o campo img
				$("#imagem_path_list").attr("src", response["img"]["imagem"])
				$("#div_contesta_list").show();

				$("#div_detalhes").hide();
				
				$("#modal_chamado_detalhes").modal();
				
			}
		})

		});

		$(".btn-ver-chamado").click(function() 
		{
		$.ajax({
			type: "POST",
			url: BASE_URL + "home_adm/ajax_get_chamado_detalhes",
			dataType: "json",
			data: {"chamado_id": $(this).attr("chamado_id")},
			success: function(response) {
				clearErros();
				$("#form_chamado")[0].reset();
				$.each(response["input"], function(id, value) {
					$("#"+id).val(value);
				});
				// colocando o campo img
				$("#imagem_path_list").attr("src", response["img"]["imagem"])
				$("#div_contesta_list").hide();
				$("#div_detalhes").show();
				$("#modal_chamado_detalhes").modal();
				
			}
		})


		//return false;
		});

		$(".btn-andamento_chamado").click(function() 
		{

			chamado_id = $(this);
			Swal.fire({  
	  				title: "Atenção!",
					text: "Deseja colocar chamado em andamento? Após esta ação não será possível retornar ao status atual!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#1e90ff",
					cancelButtonText: "Nao",
					confirmButtonText: "Sim",
					CloseOnConfirm: true,
					CloseOnCancel: true,
			}).then((result) => {  
			/* Read more about isConfirmed, isDenied below */  
		    	if (result.isConfirmed) {
				    	$.ajax({
							type: "POST",
									url: BASE_URL + "home_adm/ajax_andamento_chamado",
									dataType: "json",
									data: {"chamado_id": chamado_id.attr("chamado_id")},
									success: function(response) {
										//swal("Sucesso!", "Ação executada com Sucesso!", "success");
										Swal.fire(
										  'Sucesso!',
										  'Chamado colocado em andamento!',
										  'success'
										);
										dt_chamado.ajax.reload();
							}
						}) 

		 			}
	 		})
		});

		$(".btn-retorna_andamento_chamado").click(function() 
		{

			chamado_id = $(this);
			Swal.fire({  
	  				title: "Atenção!",
					text: "Deseja retornar o chamado para em andamento?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#1e90ff",
					confirmButtonColor: "Sim",
					cancelButtonText: "Nao",
					CloseOnConfirm: true,
					CloseOnCancel: true,
			}).then((result) => {  
			/* Read more about isConfirmed, isDenied below */  
		    	if (result.isConfirmed) {
				    	$.ajax({
							type: "POST",
									url: BASE_URL + "home_adm/ajax_andamento_chamado",
									dataType: "json",
									data: {"chamado_id": chamado_id.attr("chamado_id")},
									success: function(response) {
										//swal("Sucesso!", "Ação executada com Sucesso!", "success");
										Swal.fire(
										  'Sucesso!',
										  'Chamado colocado em andamento!',
										  'success'
										);
										dt_chamado.ajax.reload();
							}
						}) 

		 			}
	 		})
		});

		$(".btn-concluir_chamado").click(function() 
		{

			chamado_id = $(this);
			Swal.fire({  
	  				title: "Atenção!",
					text: "Deseja colocar chamado como concluído?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#00c800",
					cancelButtonColor: "#d60000",
					cancelButtonText: "Nao",
					confirmButtonText: "Sim",
					CloseOnConfirm: true,
					CloseOnCancel: true,
			}).then((result) => {  
			/* Read more about isConfirmed, isDenied below */  
	    		if (result.isConfirmed) {
			    	$.ajax({
						type: "POST",
								url: BASE_URL + "home_adm/ajax_concluir_chamado",
								dataType: "json",
								data: {"chamado_id": chamado_id.attr("chamado_id")},
								success: function(response) {
									//swal("Sucesso!", "Ação executada com Sucesso!", "success");
									Swal.fire(
									  'Sucesso!',
									  'Chamado colocado em andamento!',
									  'success'
									);
									dt_chamado.ajax.reload();
						}
					}) 

		 		}
				});
			//return false;
		});
		
		
	}


})