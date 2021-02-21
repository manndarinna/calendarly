$(document).ready(function() {
    rezervisaniCasoviDatatable();
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
            data: {},
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

    function rezervisaniCasoviDatatable() {
        $.noConflict();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        $("#datatable").DataTable({
            processing: true,
            servserSide: true,
            ajax: "http://127.0.0.1:8000/api/rezervacije/casovi",

            columns: [
                { data: "naziv" },
                { data: "datum" },

                {
                    data: "trajanje",
                    render: function(data) {
                        return (
                            parseInt(data / 3600) +
                            ":" +
                            (parseInt(data / 60) % 60)
                        );
                    }
                },
                { data: "name" },
                {
                    data: "id",
                    render: function(data) {
                        return `<a href="http://127.0.0.1:8000/cas/${data}" >Prikazi detaljno</a>`;
                    }
                }
            ]
        });
    }

    $(".slikaLink").click(function(e) {
        e.preventDefault();
        var otvorena = $(this).attr("href");
        $("body").append(
            '<div class = "okvir"><div class="otvorena"><img src="' +
                otvorena +
                '"> </div></div>'
        );

        $(".okvir").click(function(e) {
            e.preventDefault();
            $(this).remove();
        });
    });
});
