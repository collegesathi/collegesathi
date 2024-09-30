function AutoCompleteTextBox(source, target, targetfull, servicepath, splitter, ref_fn) {
    $("input[id*='" + source + "']").autocomplete({
       
        source: function (request, response) {
            $.ajax({
                url: servicepath,
                data: "{ 'Prefix': '" + request.term + "'}",
                dataType: "json",
                type: "POST",
                contentType: "application/json; charset=utf-8",
                success: function (data) {
                    response($.map(data.d, function (item) {
                        //alert(item.split('-')[1]);
                        return {
                            //div: item.split('-')[0],
                            label: item.split(splitter)[0],
                            val: item.split(splitter)[1]
                            // value: item.split('-')[1]
                        }
                    }))
                },
                error: function (response) {
                    alert(response.responseText);
                },
                failure: function (response) {
                    alert(response.responseText);
                }
            });
        },
        select: function (e, i) {
            
            if (target != '') {
                $("#" + target).val(i.item.val);
            }
            if (targetfull != '') {
                $("#" + targetfull).val(i.item.label);
            }
            if (ref_fn != '') {
                window[ref_fn]($(this).attr('id'));
            }
        },
        minLength: 3
    });
}