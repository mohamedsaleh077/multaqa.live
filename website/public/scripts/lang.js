$(document).ready(function () {
    $.get("/lang/en.json", function (data) {
        $.each(data, function (key, value) {
            let el = "#" + key ;
            if ($(el).is("input")) {
                $(el).attr("placeholder", value);
            } else {
                $(el).html(value);
                // console.log(el + value);
            }
        });
    })
})