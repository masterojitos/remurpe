$.ajaxSetup({
    type: 'post',
    url: 'directory.php',
    error: function(data){
        alert(data.responseText);
    }
});

var oTable;
$(document).on("ready", function() {
    var nav = eval($("#nav").height() - 30);
    if(nav > $("#content").height()) $("#content").css("min-height", nav + "px");
    var blank = ($(document).height() - $("#container").height()) - ($("#footer_admin").height() + 40);
    if(blank > 0) $("#content").css("min-height", ($("#content").height() + blank) + "px");

    var span_slide_status = new Array();
    $("#nav > ul > li").each(function() {
        var span_slide = $('<span />').on("click", function() {
            span_slide_status[$(this).parent().index()] = $(this).next().next().is(":visible");
            $(this).next().next().slideToggle();
        });
        if($("ul:visible", this).size()){
            span_slide_status[$(this).index()] = false;
            $(this).prepend(span_slide);
        }
    });
    $("#nav > ul > li").mouseenter(function() {
        var span_slide = $('<span />').on("click", function() {
            span_slide_status[$(this).parent().index()] = $(this).next().next().is(":visible");
            $(this).next().next().slideToggle();
        });
        if($(this).html().search(/<\/ul>/) >= 0 && $("ul:hidden", this).size()) $(this).prepend(span_slide);
    }).mouseleave(function() {
        if($("ul:hidden", this).size() || span_slide_status[$(this).index()]) $("span", this).remove();
    });

    $("#form_login").on("submit", function() {
        if(!required('#username', 'Por favor, ingrese su nobre de usuario.')) return false;
        if(!required('#password', 'Por favor, ingrese su contraseña.')) return false;
        $.ajax({
            data: "mod=5&" + $(this).serialize(),
            success: function(msg){
                if(msg != "") mo_error(msg);
                else document.location = "./";
            }
        });
        return false;
    });

    $("#form_forgot_password").on("submit", function() {
        if(!required('#username2', 'Por favor, ingrese su nobre de usuario.')) return false;
        $.ajax({
            data: "mod=6&" + $(this).serialize(),
            success: function(msg){
                if(msg != "") mo_error(msg);
                else{
                    $("#form_forgot_password, div.message").hide();
                    $("div.error").remove();
                    $("#form_login").fadeIn();
                    $("div.message").html("Su contraseña ha sido enviada a su email.").fadeIn();
                }
            }
        });
        return false;
    });

    $("a.forgot_password").on("click", function() {
        $("#form_login").hide();
        $("div.error").remove();
        $("#form_forgot_password, div.message").fadeIn();
        return false;
    });

    $("a.login").on("click", function() {
        $("#form_forgot_password, div.message").hide();
        $("div.error").remove();
        $("#form_login").fadeIn();
        return false;
    });

    $("#logout").on("click", function(e) {
        e.preventDefault();
        confirm("Está seguro que desea cerrar la sesión?", function() {
            $.ajax({
                data: "mod=7", 
                success: function(msg){
                    document.location = "./";
                }
            });
        });
        return false;
    });
    
    if (mod !== null) {
        mo_list(mod);
        $(document).on("click", ".list", function(){mo_list(mod);return false;});
        $(document).on("click", ".update", function(){mo_update(mod, $(this));return false;});
        $(document).on("click", ".delete", function(){mo_delete(mod, $(this));return false;});
        $(document).on("submit", "form", function(){mo_submit(mod, 5);return false;});        
    }
    
    var profesion, especializacion, intervencion;
    $(document).on("click", "#clear_filter", function() {
        mo_list(20);
        setTimeout(function() {
            $('#content .datatable th:first').trigger("click");
        }, 1000);
    });
    var filters = [];
    $(document).on("click", "#special_filter", function() {
        filters = [];
        var profesion = $("#profesion").val();
        var especializacion = $("#especializacion").val();
        var intervencion = $("#intervencion").val();
        if (profesion) {
            filters.push(profesion.join('|||'));
        }
        filters.push('***');
        if (especializacion) {
            filters.push(especializacion.join('|||'));
        }
        filters.push('***');
        if (intervencion) {
            filters.push(intervencion.join('|||'));
        }
        if (filters.length) {
            oTable.fnFilter(filters.join(''), 6);
        }
    });
});

function mo_error(text){
    if(!$("div.error").length) $("form:visible").before('<div class="error"></div>');
    $("div.error").hide().html('<strong>ERROR: </strong>' + text).fadeIn();
    if(location.href.search(/mod/) >= 0) $("html, body").animate({
        scrollTop: $("#content").offset().top
        }, 1000);
}

function mo_search(mod){
    $.ajax({
        data: "mod=" + mod + "&search=" + $("#search").val(),
        success: function(html){
            $("#list").html(html);
            Shadowbox.setup();
        }
    });
}

function mo_list(mod){
    var add_data = $(".filter").length > 0 ? "&filter=" + $(".filter").val() : "";
    $.ajax({
        data: "mod=" + mod + add_data,
        success: function(html){
            $("#form, #list, .search, a.cancel").hide();
            $("#list").html(html);
            $(".search, #list, a.new").fadeIn();
            mo_style();
            if (mod === 20) {
                oTable = $('#content .datatable').dataTable({
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "directory.php",
                    "fnServerParams": function ( aoData ) {
                        aoData.push({"name": "mod", "value": mod});
                        aoData.push({"name": "do", "value": 6});
                    },
                    "sServerMethod": "POST",
                    "bStateSave": true,
                    "aoColumnDefs": [
                        {"mRender": 
                            function ( data, type, row ) {
                                return '<a href="#" id="' + data + '" class="update no-background" title="Ver detalle">' + data + '</a>';
                            }, "aTargets": [ 0 ]},
                        { "bVisible": false, "aTargets": [ 6, 7, 8 ] },
                        {"sClass": "center", "aTargets": [ 0, 3 ]}
                    ],
                    "oLanguage": {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros por pagina",
                        "sZeroRecords": "No se encontraron registros.",
                        "sInfo": "Mostrando del _START_ al _END_ de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando del 0 al 0 de 0 registros",
                        "sInfoFiltered": "(Filtrado de un total de _MAX_ registros)",
                        "sSearch": "Busqueda General",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sPrevious": "Anterior",
                            "sNext":     "Siguiente",
                            "sLast":     "Último"
                        }
                    }
                });
            }
            $("#content #list table.listing tbody tr:nth-child(odd)").addClass("odd");
            $("#content #list table.listing tbody tr").hover(
                function() {
                    $(this).addClass("hover");
                },
                function() {
                    $(this).removeClass("hover");
                }
            );
        }
    });
}

function mo_update(mod, e){
    if ($.trim(e.attr("id")) === "") return;
    $.ajax({
        data: "mod=" + mod + "&do=1&id=" + e.attr("id"),
        success : function(html){
            $("#form, .search, a.new").hide();
            $("#list").empty();
            $("#form").html(html);
            $("#form table.table-detail tr:nth-child(odd)").addClass("odd");
            $("#form, a.cancel").fadeIn();
            if (mod !== 20) mo_style();
        }
    });
}

function mo_submit(mod, $do){
    $.ajax({
        data: "mod=" + mod + "&do=" + $do + "&" + $("form").serialize(),
        success: function() {
            mo_list(mod);
        }
    });
}

function mo_delete(mod, e){
    confirm("Está seguro que desea eliminar el registro?", function() {
        $.ajax({
            data: "mod=" + mod + "&do=4&id=" + e.attr("id"),
            success: function() {
                document.location = "./?mod=" + mod;
            }
        });
    });
}

function mo_style(){
    var width = 0;
    $("fieldset:visible > table > tbody > tr > td:first-child label").each(function() {
        if($(this).width() > width) width = $(this).width();
    });
    $("fieldset:visible > table > tbody > tr").addClass("texgray").each(function() {
        if($(this).children().filter(":nth-child(2)").size()){
            if($(this).children().filter(":nth-child(2)").html().search(/<input|<select|<textarea/) >= 0 && $(this).children().filter(":nth-child(2)").html().search(/type="hidden"/) < 0){
                $(this).children().filter(":nth-child(1)").attr("width", width + 10).css({
                    "vertical-align": "top", 
                    "padding-top": 8
                });
            }else{
                $(this).children().attr("height", 34).css({
                    "vertical-align": "top", 
                    "padding-top": 8
                });
                $(this).children().filter(":nth-child(1)").attr("width", width + 15);
            }
        }
    });
}

var key;
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57 , '.' = 46, '-' = 45, ' ' = 32
function type_number(evt){
    (document.all)?key=evt.keyCode:key=evt.which;
    return (key <= 13 || key == 46 || key == 45 || key == 32 || evt.ctrlKey || (key >= 48 && key <= 57));
}

function type_price(evt){
    (document.all)?key=evt.keyCode:key=evt.which;
    return (key <= 13 || key == 46 || (key >= 48 && key <= 57));
}

function required(elem, msg, conten){
    if(conten == null) conten = "";
    if($.trim($(elem).val()) == conten){
        mo_error(msg);
        $(elem).focus();
        return false;
    }
    return true;
}

function maxlength(elem, value, msg){
    if(msg == null) msg = "You must enter " + value + " characters";
    if($.trim($(elem).val()).length < value){
        mo_error(msg);
        $(elem).focus();
        return false;
    }
    return true;
}

function validateEmail(elem){
    if($.trim($(elem).val()) != "" && !emailCheck($.trim($(elem).val()))){
        $(elem).focus();
        return false;
    }
    return true;
}

function emailCheck(email){
    var msg = "The email address is invalid.<br />";
    var atom = '\[^\\s\\(\\)<>@,;:\\\\\\\"\\.\\[\\]\]+';
    var word = "(" + atom + "|(\"[^\"]*\"))";
    var userPat = new RegExp("^" + word + "(\\." + word + ")*$");
    var domainPat = new RegExp("^" + atom + "(\\." + atom +")*$");
    var matchArray = email.match(/^(.+)@(.+)$/);
    if(matchArray == null){
        mo_error(msg + "(verify [@] and [.])");
        return false;
    }
    var user = matchArray[1];
    var domain = matchArray[2];
    if(user.match(userPat) == null){
        mo_error(msg + "(verify data before [@])");
        return false;
    }
    var IPArray = domain.match(/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/);
    if(IPArray != null){
        for(var i = 1; i <= 4; i++){
            if(IPArray[i] > 255){
                mo_error(msg + "(Incorrect destination IP)");
                return false;
            }
        }
        return true;
    }
    if(domain.match(domainPat) == null){
        mo_error(msg + "(verify data after [@])");
        return false;
    }
    var atomPat = new RegExp(atom, "g");
    var domArr = domain.match(atomPat);
    var len = domArr.length;
    if(domArr[len - 1].length < 2 || domArr[len - 1].length > 3){
        mo_error(msg + "(verify data after [.])");
        return false;
    }
    if(len < 2){
        mo_error(msg + "(verify data after [.])");
        return false;
    }
    return true;
}