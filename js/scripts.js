$(document).on("ready", function() {
    var $this;
    
    //Unsupported CSS3 Code
    $("#reglamento").on("click", function() {
        $("#terms-conditions-modal").animate({ left: '50%' }, 500);
    });
    $("#terms-conditions-modal header a").on("click", function() {
        $("#terms-conditions-modal").css("left", "-100%");
    });
    
    var moFile = function(e) {
        e.preventDefault();
        $(".mo_file_trigger[name='" + $(this).data("filename") + "']").trigger("click");
    };
    $('.mo_file').on("click", moFile);
    $('.mo_file').next().on("click", moFile);
    $('.mo_file_trigger').on("change", function() {
        $('.mo_file[id="' + this.name + '"]').val(this.value);
    });
    
    var provincias = $('#variables').data('provincias');
    var distritos = $('#variables').data('distritos');
    
    var options_provincias, provincia_index, provincia_value;
    $('#departamento').on('change', function() {
        options_provincias = new Array();
        $('#provincia option:gt(0), #distrito option:gt(0)').remove();
        $this = $(this).val();
        if ($this === '') {
            $('#provincia, #distrito').attr("disabled", "disabled");
            return;
        }
        $('#distrito').attr("disabled", "disabled");
        for (provincia_index in provincias[$this]) {
            provincia_value = provincias[$this][provincia_index];
            options_provincias.push($('<option />', {value: provincia_value, text: provincia_value}));
        }
        $('#provincia').append(options_provincias).removeAttr('disabled');
    });
    
    var options_distritos, distrito_index, distrito_value;
    $('#provincia').on('change', function() {
        options_distritos = new Array();
        $('#distrito option:gt(0)').remove();
        $this = $(this).val();
        if ($this === '') {
            $('#distrito').attr("disabled", "disabled");
            return;
        }
        for (distrito_index in distritos[$('#departamento').val()][$this]) {
            distrito_value = distritos[$('#departamento').val()][$this][distrito_index];
            options_distritos.push($('<option />', {value: distrito_value, text: distrito_value}));
        }
        $('#distrito').append(options_distritos).removeAttr('disabled');
    });
    
    var checkbox_name, checkboxs_selector;
    $(".checkbox-checkall").on("click", function() {
        $this = $(this);
        checkbox_name = $("." + $this.data("trigger")).data("checkname");
        checkboxs_selector = "." + $this.data("trigger") + " input[type=checkbox][name^=" + checkbox_name + "]";
        $("." + $this.data("trigger") + " .checkall").prop("checked", ($(checkboxs_selector).length === $(checkboxs_selector + ":checked").length));
    });
    $(document).on("click", ".checkall", function() {
        $this = $(this);
        checkbox_name = $("." + $this.data("trigger")).data("checkname");
        $("." + $this.data("trigger") + " input[type=checkbox][name^=" + checkbox_name + "]").prop("checked", $this.is(":checked"));
    });

    $("form").on("submit", function() {
        if ($('#condiciones_no').is(":checked")) {
            $("html").animate({scrollTop : $('#condiciones_no').parent().parent().position().top}, 500, function() {
                alert("Debe aceptar las condiciones de los requesitos necesarios para inscribirse.");
            });
            return false;
        } else if ($('table#aliados input[type=checkbox]:checked').length <= 0) {
            $("html").animate({scrollTop : $('table#aliados').prev().position().top}, 500, function() {
                alert("Debe marcar por lo menos un aliado.");
            });
            return false;
        } else if ($('div.especializacion-1 input[type=checkbox]:checked, div.especializacion-2 input[type=checkbox]:checked, div.especializacion-3 input[type=checkbox]:checked').length <= 0) {
            $("html").animate({scrollTop : $('div.especializacion-1').prev().position().top}, 500, function() {
                alert("Debe marcar por lo menos un área de especialización.");
            });
            return false;
        } else if ($('div.zonas-intervencion input[type=checkbox]:checked').length <= 0) {
            $("html").animate({scrollTop : $(document).height() }, 500, function() {
                alert("Debe marcar por lo menos una zona de internvención.");
            });
            return false;
        } else {
            return true;
        }
    });
});