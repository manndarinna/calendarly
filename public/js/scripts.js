$(document).ready(function() {
    $(".prikljuciSeKonsultacijiForm").submit(function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        let id = $(this)
            .find(".idKonsultacije")
            .val();
        console.log("test");
        $.ajax({
            url:
                "http://127.0.0.1:8000/api/konsultacija/put/" +
                id +
                "?_method=PUT",
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                "Content-Type": "application/json"
            },
            dataType: "json",
            data: {
                _method: "PUT"
            },
            success: function(response) {
                alert(response.message);
            },
            error: function(err) {
                alert(err.responseJSON.message);
            }
        });
    });
    $(".rezervisiCasForm").submit(function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        let id = $(this)
            .find(".idCasa")
            .val();
        $.ajax({
            url:
                "http://127.0.0.1:8000/api/privatan-cas/put/" +
                id +
                "?_method=PUT",
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                "Content-Type": "application/json"
            },
            dataType: "json",
            data: {
                _method: "PUT"
            },
            success: function(response) {
                alert(response.message);
                $(this)
                    .find('input[type="submit"]')
                    .attr("disabled", "disabled");
            },
            error: function(err) {
                alert(err.responseJSON.message);
            }
        });
    });
});
