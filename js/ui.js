$("#delete-control").click(function() {
	if($(this).attr("class")=="delete-show")
	{
		$(".manage").toggle();
		$(this).addClass("delete-confirm").removeClass("delete-show");
		$(this).html('<span class="glyphicon glyphicon-remove"></span> Delete Selected');
	}
	else if($(this).attr("class")=="delete-confirm")
	{
		$(".manage").toggle();
		$(this).addClass("delete-show").removeClass("delete-confirm");
		deleteMultiple();
		$(this).html('<span class="glyphicon glyphicon-remove"></span> Delete');
	}
});

$(".delete-link").click(function() {
	var deleteLink = $(this);
	
	deleteSingle(deleteLink.data("delete"));

	var control = $("#delete-control");
	if(control.attr("class") == "delete-confirm")
	{
		$(".manage").toggle();
		control.addClass("delete-show").removeClass("delete-confirm");
		control.html('<span class="glyphicon glyphicon-remove"></span> Delete');
	}
});

function deleteMultiple() {
	var t = []

	$(":checkbox:checked").each(function() {
		t.push($(this).val());
	});

	if(t.length > 0)
	{
		var json = {'toDelete' : t, 'page':(getUrlParameter("page") == undefined ? 0 : page)};

		$.ajax({
			url:"/ajax.php",
			type:"POST",
			dataType:"json",
			data:json,
			success:function(data) {
				$("#grid").html(data["ret"]);
			},
			error:function() {
				alert("Something went wrong!");
			}
		});
	}
}

function deleteSingle(data) {
	var t = []

	t.push(data);

	var json = {'toDelete':t, 'page':(getUrlParameter("page") == undefined ? 0 : page)};

	$.ajax({
		url:"/ajax.php",
		type:"POST",
		dataType:"json",
		data:json,
		success: function(data) {
			$("#grid").html(data["ret"]);
		},
		error: function() {
			alert("Something went wrong !");
		}
	});
}


function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
