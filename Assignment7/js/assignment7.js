//Function To Login.

$(document).ready(function () {
	$("#loginForm").submit(function (event) {
		event.preventDefault();

		var formData = {
			username: $("#username").val(),
			password: $("#password").val()
		};

		$.ajax({
			url: "./php/login.php",
			type: "POST",
			data: { formData: JSON.stringify(formData) },
			dataType: "json",
			success: function (response) {
				console.log(JSON.stringify(response));
				if (response.status) {
					window.location.href = "../../Assignment4/index.html";
					console.log("hello");
				} else {
					console.log("Login Failed");
					$(".status-label").css({
						"opacity": "1"
					});
				}
			},
			error: function (xhr, status, error) {
				console.log("AJAX Error: " + status + " - " + error);
				console.log(xhr.responseText);
			}
		});
	});
});

//Function Hide Error.

function hideStatus() {
	$(".status-label").css({
		"opacity": "0"
	});
}
